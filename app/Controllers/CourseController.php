<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Course;
use App\Core\Database;
use App\Core\CSRF;
use PDO;

class CourseController extends Controller {

    public function show($courseId = null) {

        if (!$courseId) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/dashboard");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $courseModel = new Course();

        if (!$courseModel->isEnrolled($userId, $courseId)) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/pricing");
            exit;
        }

        $examPassed = $courseModel->hasPassedExam($userId, $courseId);
        $contents = $courseModel->getContents($userId, $courseId);
        $course = $courseModel->findById($courseId);

        $this->view('course/view', [
            'course'      => $course,
            'contents'    => $contents,
            'exam_passed' => $examPassed,
            'course_id'   => $courseId,
            'user_id'     => $userId,
        ]);
    }

    public function enroll() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 Method Not Allowed");
            header("Location: /public/dashboard");
            exit;
        }

        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            http_response_code(403);
            die("Invalid CSRF token.");
        }

        $userId   = $_SESSION['user_id'];
        $courseId = $_POST['course_id'] ?? $_POST['id'] ?? null;

        if (!$courseId) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/dashboard");
            exit;
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM payments WHERE users_id = ? AND status = 'paid'");
        $stmt->execute([$userId]);
        $hasPaid = $stmt->fetchColumn() > 0;

        if (!$hasPaid) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/pricing");
            exit;
        } else {
            $syncUser = $db->prepare("UPDATE users SET isPro = 1 WHERE id = ?");
            $syncUser->execute([$userId]);
        }

        $courseModel = new Course();

        if (!$courseModel->isEnrolled($userId, $courseId)) {
            $courseModel->enroll($userId, $courseId);
        }

        header("Location: /public/course/" . $courseId);
        exit;
    }

    public function markWatched() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $contentId = (int)($input['content_id'] ?? $_POST['content_id'] ?? 0);
        $token = $input['csrf_token'] ?? $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';

        if (!CSRF::validate($token)) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid CSRF token']);
            exit;
        }

        if (!$contentId) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid content ID']);
            exit;
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT IGNORE INTO watched_videos (user_id, video_id) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $contentId]);

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    }

    public function getExamQuestions() {
        header('Content-Type: application/json');

        $courseId = $_GET['course_id'] ?? null;
        if (!$courseId) {
            echo json_encode(['success' => false, 'message' => 'Course ID required']);
            exit;
        }

        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT id, course_id, question, option_a, option_b, option_c, option_d FROM exam_questions WHERE course_id = ? ORDER BY id ASC LIMIT 10");
            $stmt->execute([$courseId]);
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($questions) < 10) {
                echo json_encode(['success' => false, 'message' => 'Not enough questions available']);
                exit;
            }

            $filteredQuestions = array_map(function ($q) {
                return [
                    'id'        => (int)$q['id'],
                    'course_id' => (int)$q['course_id'],
                    'question'  => $q['question'],
                    'option_a'  => $q['option_a'],
                    'option_b'  => $q['option_b'],
                    'option_c'  => $q['option_c'],
                    'option_d'  => $q['option_d'],
                ];
            }, $questions);

            echo json_encode(['success' => true, 'questions' => $filteredQuestions]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Database error']);
        }
        exit;
    }

    public function submitExam() {
        header('Content-Type: application/json');

        $input    = json_decode(file_get_contents('php://input'), true);
        $userId   = $_SESSION['user_id'];
        $courseId = $input['course_id'] ?? null;
        $answers  = $input['answers'] ?? [];

        if (!$courseId || empty($answers)) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            exit;
        }

        try {
            $db = Database::getInstance()->getConnection();
            $questionIds  = array_keys($answers);
            $placeholders = str_repeat('?,', count($questionIds) - 1) . '?';

            $stmt = $db->prepare("SELECT id, correct_answer FROM exam_questions WHERE id IN ($placeholders)");
            $stmt->execute($questionIds);
            $correctAnswers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            $correctCount    = 0;
            $totalQuestions  = count($answers);
            foreach ($answers as $qId => $userAnswer) {
                $qidInt = (int)$qId;
                $userAns = strtoupper(trim((string)$userAnswer));
                $correctAns = isset($correctAnswers[$qidInt]) ? strtoupper(trim((string)$correctAnswers[$qidInt])) : null;
                if ($correctAns !== null && $correctAns === $userAns) {
                    $correctCount++;
                }
            }

            $score  = round(($correctCount / $totalQuestions) * 100);
            $passed = $score >= 70;

            $stmt = $db->prepare("INSERT INTO exam_results (user_id, course_id, score, passed, taken_at) VALUES (?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE score = VALUES(score), passed = VALUES(passed), taken_at = VALUES(taken_at)");
            $stmt->execute([$userId, $courseId, $score, $passed ? 1 : 0]);

            echo json_encode([
                'success'          => true,
                'score'            => $score,
                'passed'           => $passed,
                'correct_answers'  => $correctCount,
                'total_questions'  => $totalQuestions,
            ]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Database error']);
        }
        exit;
    }

    public function details($slug) {

        $slug = urldecode($slug);
        if (!preg_match('/^[a-zA-Z0-9_\-\s]+$/', $slug)) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/dashboard");
            exit;
        }

        $db = \App\Core\Database::getInstance()->getConnection();
        $courseModel = new Course();

        $stmt = $db->prepare("SELECT id FROM courses WHERE detail_link LIKE ? LIMIT 1");
        $stmt->execute(['%/public/course-details/' . $slug . '%']);
        $realCourseId = $stmt->fetchColumn();

        if (!$realCourseId) {
            $courseByCode = $courseModel->findByCode($slug);
            if ($courseByCode) {
                $realCourseId = $courseByCode['id'];
            }
        }

        if ($realCourseId) {
            $detail = $courseModel->getDetailByCourseId($realCourseId);
            if ($detail) {
                $course = $courseModel->findById($realCourseId);
                $this->view('course-details/dynamic', [
                    'course'        => $course,
                    'detail'        => $detail,
                    'real_course_id' => $realCourseId,
                ]);
                return;
            }
        }

        $viewFile = __DIR__ . '/../Views/course-details/' . $slug . '.php';
        if (file_exists($viewFile)) {
            $this->view('course-details/' . $slug, ['real_course_id' => $realCourseId]);
        } else {
            header("HTTP/1.1 302 Found");
            header("Location: /public/dashboard");
            exit;
        }
    }

    private function fixText($text) {
        return iconv('UTF-8', 'windows-1252//TRANSLIT', (string)$text);
    }

    public function certificate() {
        if (!isset($_SESSION['user_id'])) {
            die("Unauthorized access.");
        }

        $userId   = $_SESSION['user_id'];
        $courseId = $_GET['course_id'] ?? null;
        $getUserId = $_GET['user_id'] ?? null;

        if ($getUserId !== null && $userId != $getUserId && empty($_SESSION['admin_id'])) {
            die("Permission denied.");
        }

        if (!$courseId) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/dashboard");
            exit;
        }

        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT title FROM courses WHERE id = ?");
        $stmt->execute([$courseId]);
        $course = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !$course) {
            die("Course or user not found.");
        }

        require_once __DIR__ . '/../Libraries/fpdf.php';

        $pdf = new \FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $logoPath = __DIR__ . '/../../public/images/logo-university.png';
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 10, 10, 40);
        }

        $pdf->SetFont('Arial', 'B', 28);
        $pdf->Ln(20);
        $pdf->Cell(0, 20, $this->fixText('Certificate of Completion'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 18);
        $pdf->Cell(0, 15, $this->fixText('This certificate is awarded to'), 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 26);
        $pdf->Cell(0, 20, $this->fixText(strtoupper($user['username'])), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 18);
        $pdf->Cell(0, 12, $this->fixText('for successfully completing the course'), 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetTextColor(0, 102, 204);
        $pdf->Cell(0, 20, $this->fixText('"' . $course['title'] . '"'), 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(0, 10, 'Date: ' . date('F j, Y'), 0, 1, 'C');

        $pdf->Ln(25);
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 8, $this->fixText('Generated by OpenCourse Platform'), 0, 1, 'C');

        $signaturePath = __DIR__ . '/../../public/images/certificate-signature.png';
        if (file_exists($signaturePath)) {
            $pdf->Image($signaturePath, 220, 160, 40);
        }

        $pdf->Output('I', 'Certificate_' . $user['username'] . '.pdf');
        exit;
    }
}

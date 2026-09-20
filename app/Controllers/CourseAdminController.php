<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Course;
use App\Core\CSRF;

class CourseAdminController extends Controller {

    public function index() {
        header("HTTP/1.1 302 Found");
        header("Location: /public/admin?tab=courses");
        exit;
    }

    private function handleImageUpload($fileInputName) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES[$fileInputName]['tmp_name'];
            $name = basename($_FILES[$fileInputName]['name']);
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array(strtolower($ext), $allowedExts)) {
                $newName = uniqid('img_') . '_' . time() . '.' . $ext;
                $uploadDir = __DIR__ . '/../../public/images/uploads/';
                
                if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                    return '/public/images/uploads/' . $newName;
                }
            }
        }
        return '';
    }

    public function add() {
        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "csrf");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $title          = $_POST['title'] ?? '';
        $code           = $_POST['code'] ?? '';
        $imagePath      = $this->handleImageUpload('image_path');
        $instructorName = $_POST['instructor_name'] ?? '';
        $instructorImage = $this->handleImageUpload('instructor_image');
        
        if (empty($instructorImage) && !empty($_POST['existing_instructor_image'])) {
            $instructorImage = $_POST['existing_instructor_image'];
        }
        
        $detailLink     = $_POST['detail_link'] ?? '';
        $rating         = $_POST['rating'] ?? 0;

        $courseModel = new Course();
        $result = $courseModel->add($title, $code, $imagePath, $instructorName, $instructorImage, $detailLink, $rating);

        if ($result) {
            header("HTTP/1.1 302 Found");
        \App\Core\Flash::set("success", "course_added");
        header("Location: /public/admin?tab=courses");
        } else {
            header("HTTP/1.1 302 Found");
        \App\Core\Flash::set("error", "duplicate");
        header("Location: /public/admin?tab=courses");
        }
        exit;
    }

    public function delete() {
        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "csrf");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $id = $_POST['id'] ?? null;
        if ($id) {
            $courseModel = new Course();
            $courseModel->delete($id);
        }
        header("HTTP/1.1 302 Found");
        header("Location: /public/admin?tab=courses");
        exit;
    }

    public function manageContent($courseId) {
        $courseModel = new Course();
        $course = $courseModel->findById($courseId);

        if (!$course) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "notfound");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $contents  = $courseModel->getContentsByCourseId($courseId);
        $questions = $courseModel->getQuestionsByCourseId($courseId);
        $detail    = $courseModel->getDetailByCourseId($courseId);

        $this->view('admin/course_content', [
            'course'    => $course,
            'contents'  => $contents,
            'questions' => $questions,
            'detail'    => $detail,
        ]);
    }

    public function addContent() {
        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "csrf");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $courseId    = $_POST['course_id'] ?? null;
        $title       = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $videoUrl    = $_POST['video_url'] ?? '';
        $fileUrl     = $_POST['file_url'] ?? '';

        if ($courseId && $title && $videoUrl) {
            $courseModel = new Course();
            $courseModel->addContent($courseId, $title, $description, $videoUrl, $fileUrl);
        }

        header("HTTP/1.1 302 Found");
        \App\Core\Flash::set("success", "content_added");
        header("Location: /public/admin/courses/{$courseId}/content");
        exit;
    }

    public function deleteContent() {
        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "csrf");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $contentId = $_POST['content_id'] ?? null;
        $courseId   = $_POST['course_id'] ?? null;

        if ($contentId) {
            $courseModel = new Course();
            $courseModel->deleteContent($contentId);
        }

        header("HTTP/1.1 302 Found");
        header("Location: /public/admin/courses/{$courseId}/content");
        exit;
    }

    public function addQuestion() {
        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "csrf");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $courseId = $_POST['course_id'] ?? null;
        $question = $_POST['question'] ?? '';
        $optA     = $_POST['option_a'] ?? '';
        $optB     = $_POST['option_b'] ?? '';
        $optC     = $_POST['option_c'] ?? '';
        $optD     = $_POST['option_d'] ?? '';
        $correct  = $_POST['correct_answer'] ?? '';

        if ($courseId && $question && $optA && $optB && $optC && $optD && $correct) {
            $courseModel = new Course();
            $courseModel->addQuestion($courseId, $question, $optA, $optB, $optC, $optD, $correct);
        }

        header("HTTP/1.1 302 Found");
        \App\Core\Flash::set("success", "question_added");
        header("Location: /public/admin/courses/{$courseId}/content");
        exit;
    }

    public function deleteQuestion() {
        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "csrf");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $questionId = $_POST['question_id'] ?? null;
        $courseId    = $_POST['course_id'] ?? null;

        if ($questionId) {
            $courseModel = new Course();
            $courseModel->deleteQuestion($questionId);
        }

        header("HTTP/1.1 302 Found");
        header("Location: /public/admin/courses/{$courseId}/content");
        exit;
    }

    public function saveDetail() {
        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            header("HTTP/1.1 302 Found");
            \App\Core\Flash::set("error", "csrf");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $courseId = $_POST['course_id'] ?? null;

        if (!$courseId) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/admin?tab=courses");
            exit;
        }

        $learnItems = array_filter($_POST['learn_items'] ?? [], function($v) { return trim($v) !== ''; });
        $learnItems = array_values($learnItems);

        $includesInfo = array_filter($_POST['includes_info'] ?? [], function($v) { return trim($v) !== ''; });
        $includesInfo = array_values($includesInfo);

        $data = [
            'badge_text'        => $_POST['badge_text'] ?? '',
            'subtitle'          => $_POST['subtitle'] ?? '',
            'rating'            => (float)($_POST['detail_rating'] ?? 0),
            'rating_count'      => (int)($_POST['rating_count'] ?? 0),
            'student_count'     => (int)($_POST['student_count'] ?? 0),
            'language'          => $_POST['language'] ?? 'English',
            'last_updated'      => $_POST['last_updated'] ?? '',
            'preview_video_url' => $_POST['preview_video_url'] ?? '',
            'learn_items'       => json_encode($learnItems),
            'includes_info'     => json_encode($includesInfo),
        ];

        $courseModel = new Course();
        $courseModel->saveDetail($courseId, $data);

        header("HTTP/1.1 302 Found");
        \App\Core\Flash::set("success", "detail_saved");
        header("Location: /public/admin/courses/{$courseId}/content");
        exit;
    }
}

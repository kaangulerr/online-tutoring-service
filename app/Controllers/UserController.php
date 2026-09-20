<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller {
    
    public function settings() {
        if (!isset($_SESSION['user_id'])) {
            
        header("Location: /public/login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $userModel = new User();

        $user = $userModel->findById($userId);
        $courseCount = $userModel->getEnrollmentCount($userId);
        $videoCount = $userModel->getWatchedVideoCount($userId);
        $certificates = $userModel->getCertificates($userId);

        $this->view('user/settings', [
            'user' => $user,
            'course_count' => $courseCount,
            'video_count' => $videoCount,
            'certificates' => $certificates
        ]);
    }

    public function progress() {
        if (!isset($_SESSION['user_id'])) {
            header("HTTP/1.1 200 OK");
            
        header("Location: /public/login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $pdo = \App\Core\Database::getInstance()->getConnection();

        $stmt_user = $pdo->prepare("SELECT username FROM users WHERE id = ?");
        $stmt_user->execute([$user_id]);
        $user = $stmt_user->fetch(\PDO::FETCH_ASSOC);
        $username = $user ? htmlspecialchars($user['username']) : 'User';

        $stmt2 = $pdo->prepare("
            SELECT 
                c.title, 
                e.score, 
                e.taken_at,
                CASE WHEN e.passed = 1 THEN 'Yes' ELSE 'No' END as certificate_earned
            FROM exam_results e 
            JOIN courses c ON e.course_id = c.id 
            WHERE e.user_id = ?
        ");
        $stmt2->execute([$user_id]);
        $completedCourses = $stmt2->fetchAll(\PDO::FETCH_ASSOC);

        $stmt3 = $pdo->prepare("
            SELECT 
                AVG(score) as average_score_passed,
                (SELECT AVG(score) FROM exam_results WHERE user_id = ? AND passed = 0) as average_score_failed
            FROM exam_results 
            WHERE user_id = ? AND passed = 1
        ");
        $stmt3->execute([$user_id, $user_id]);
        $avgScore = $stmt3->fetch(\PDO::FETCH_ASSOC);

        $stmt4 = $pdo->prepare("
            SELECT MAX(payment_at) as last_payment 
            FROM payments 
            WHERE users_id = ? AND status = 'paid'
        ");
        $stmt4->execute([$user_id]);
        $payment = $stmt4->fetch(\PDO::FETCH_ASSOC);

        $stmt6 = $pdo->prepare("
            SELECT c.title, e.score, e.passed 
            FROM exam_results e 
            JOIN courses c ON e.course_id = c.id 
            WHERE e.user_id = ?
            ORDER BY e.taken_at ASC
        ");
        $stmt6->execute([$user_id]);
        $chartData = $stmt6->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('user/progress', [
            'username' => $username,
            'completedCourses' => $completedCourses,
            'avgScore' => $avgScore,
            'payment' => $payment,
            'chartData' => $chartData
        ]);
    }

    public function payment() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $pdo = \App\Core\Database::getInstance()->getConnection();

        $check = $pdo->prepare("SELECT * FROM payments WHERE users_id = ? AND status = 'paid'");
        $check->execute([$user_id]);

        if ($check->rowCount() > 0) {
            echo "<script>
                alert('You already have an active membership.');
                window.location.href = '/public/dashboard';
            </script>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO payments (users_id, status) VALUES (?, 'paid')");
            $stmt->execute([$user_id]);
            
            $updateUser = $pdo->prepare("UPDATE users SET isPro = 1 WHERE id = ?");
            $updateUser->execute([$user_id]);

            echo "<script>
                alert('Your payment has been successfully received!');
                window.location.href = '/public/dashboard';
            </script>";
            exit;
        }

        $this->view('user/payment');
    }
}

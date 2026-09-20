<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {

        $this->view('home/index', [
            'pageTitle' => 'Home - Online Tutoring Service'
        ]);
    }

    public function about() {
        $this->view('home/about');
    }

    public function contact() {
        $this->view('home/contact');
    }

    public function pricing() {
        $this->view('home/pricing');
    }

    public function trainers() {
        $this->view('home/trainers');
    }

    public function certification() {
        $this->view('home/certification');
    }

    public function survey() {
        $this->view('home/survey');
    }

    public function pet() {
        if (!isset($_SESSION['user_id'])) {
            header("HTTP/1.1 302 Found");
        header("Location: /public/login");
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $pdo = \App\Core\Database::getInstance()->getConnection();

        $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT id, pet_name, pet_level, pet_points FROM user_pets WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $pet = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$pet) {
            $default_pet_name = $user['username'] . "'s Paws";

            $stmt = $pdo->prepare("INSERT INTO user_pets (user_id, pet_name, pet_level, pet_points) VALUES (?, ?, 1, 0)");
            $stmt->execute([$user_id, $default_pet_name]);

            $stmt = $pdo->prepare("SELECT id, pet_name, pet_level, pet_points FROM user_pets WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $pet = $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM watched_videos WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $video_count = $stmt->fetchColumn();
        $video_points = $video_count * 10;

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM exam_results WHERE user_id = ? AND passed = 1");
        $stmt->execute([$user_id]);
        $passed_count = $stmt->fetchColumn();
        $exam_points = $passed_count * 50;

        $total_points = $video_points + $exam_points;
        $pet_level = floor($total_points / 100) + 1;
        $progress = $total_points % 100;

        $stmt = $pdo->prepare("UPDATE user_pets SET pet_points = ?, pet_level = ? WHERE id = ?");
        $stmt->execute([$total_points, $pet_level, $pet['id']]);

        $pet_image = '/public/images/pet-companion-cat.png';
        $base_size = 120;
        $size_increment = 20;
        $max_size = 300;
        $pet_size = min($base_size + ($pet_level * $size_increment), $max_size);

        $brightness = min(100 + ($pet_level * 5), 130);
        $glow_intensity = min(0.2 + ($pet_level * 0.02), 0.5);

        $this->view('home/pet', [
            'pet' => $pet,
            'video_count' => $video_count,
            'video_points' => $video_points,
            'passed_count' => $passed_count,
            'exam_points' => $exam_points,
            'total_points' => $total_points,
            'pet_level' => $pet_level,
            'progress' => $progress,
            'pet_image' => $pet_image,
            'pet_size' => $pet_size,
            'brightness' => $brightness,
            'glow_intensity' => $glow_intensity
        ]);
    }



    public function aiChat() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $userModel = new \App\Models\User();
        if (!$userModel->hasPaid($userId)) {
            echo "
            <script>
                alert('You need to complete your payment to access this page.');
                window.location.href = '/public/pricing';
            </script>
            ";
            exit;
        }

        $this->view('home/ai_chat');
    }
}

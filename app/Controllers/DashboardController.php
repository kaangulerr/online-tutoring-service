<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Course;

class DashboardController extends Controller {
    
    public function index() {
        
        $userId = $_SESSION['user_id'] ?? null;

        $courseModel = new Course();
        $courses = $courseModel->getAll();

        $userModel = new \App\Models\User();
        $hasPaid = $userId ? $userModel->hasPaid($userId) : false;

        $this->view('dashboard/index', [
            'courses' => $courses,
            'username' => $_SESSION['username'] ?? null,
            'has_paid' => $hasPaid
        ]);
    }

    public function myCourses() {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header("Location: /public/login");
            exit;
        }

        $courseModel = new Course();
        $courses = $courseModel->getEnrolledCourses($userId);

        $userModel = new \App\Models\User();
        $hasPaid = $userModel->hasPaid($userId);

        $this->view('dashboard/index', [
            'courses' => $courses,
            'username' => $_SESSION['username'] ?? null,
            'has_paid' => $hasPaid,
            'is_my_courses' => true
        ]);
    }
}

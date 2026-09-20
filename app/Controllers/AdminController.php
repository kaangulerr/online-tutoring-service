<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;
use App\Core\CSRF;

class AdminController extends Controller {

    public function showLogin() {
        if (isset($_SESSION['admin_logged_in'])) {
            header("HTTP/1.1 302 Found");
        header("Location: /public/admin");
            exit;
        }
        $this->view('admin/login');
    }

    public function processLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            $this->view('admin/login', ['error' => 'Invalid CSRF token.']);
            return;
        }

        $adminModel = new Admin();
        $admin = $adminModel->findByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header("HTTP/1.1 302 Found");
        header("Location: /public/admin");
            exit;
        }

        $this->view('admin/login', ['error' => 'Invalid username or password.']);
    }

    public function index() {

        $activeTab = $_GET['tab'] ?? 'dashboard';
        $adminModel = new Admin();

        $results = [];
        $courses = [];
        switch ($activeTab) {
            case 'customers':
                $results = $adminModel->getAllUsers();
                break;
            case 'products':
                $results = $adminModel->getAllCourses();
                break;
            case 'mails':
                $results = $adminModel->getMessages();
                break;
            case 'courses':
                $courseModel = new \App\Models\Course();
                $courses = $courseModel->getAll();
                break;
            default:
                $results = $adminModel->getProUsers();
                $activeTab = 'dashboard';
        }

        $graphData = $adminModel->getPaymentStats();
        $labels = [];
        $data = [];
        foreach ($graphData as $row) {
            if (empty($row['payment_date'])) continue;
            
            $date = \DateTime::createFromFormat('Y-m-d', $row['payment_date']);
            if ($date) {
                $labels[] = $date->format('d-m-Y');
                $data[] = (int)$row['payment_count'];
            }
        }

        if (empty($labels)) {
            $labels[] = date('d-m-Y', strtotime('-1 day'));
            $data[] = 0;
            $labels[] = date('d-m-Y');
            $data[] = 0;
        } else if (count($labels) === 1) {
            array_unshift($labels, date('d-m-Y', strtotime('-1 day', strtotime($labels[0]))));
            array_unshift($data, 0);
        }

        $detailsDir = __DIR__ . '/../Views/course-details';
        $instructors = [];
        if (is_dir($detailsDir)) {
            $files = scandir($detailsDir);
            foreach ($files as $f) {
                if ($f !== '.' && $f !== '..' && pathinfo($f, PATHINFO_EXTENSION) === 'php') {
                    $content = file_get_contents($detailsDir . '/' . $f);
                    if (preg_match('/Created by:\s*<span[^>]*>(.*?)<\/span>/i', $content, $matches)) {
                        $instName = trim(strip_tags($matches[1]));
                        if (!empty($instName) && !in_array($instName, $instructors)) {
                            $instructors[] = $instName;
                        }
                    }
                }
            }
        }
        sort($instructors);
        
        $instructorImages = [];
        $db = \App\Core\Database::getInstance()->getConnection();
        $imgStmt = $db->query("SELECT instructor_name, instructor_image FROM courses WHERE instructor_name IS NOT NULL AND instructor_image IS NOT NULL AND instructor_image != ''");
        while ($row = $imgStmt->fetch(\PDO::FETCH_ASSOC)) {
            $instructorImages[$row['instructor_name']] = $row['instructor_image'];
        }
        


        $this->view('admin/dashboard', [
            'results'    => $results,
            'courses'    => $courses,
            'active_tab' => $activeTab,
            'labels'     => $labels,
            'graph_data' => $data,
            'pro_package_price' => 15,
            'instructors'  => $instructors,
            'instructorImages' => $instructorImages
        ]);
    }

    public function logout() {
        unset($_SESSION['admin_logged_in'], $_SESSION['admin_username']);
        header("HTTP/1.1 302 Found");
        header("Location: /public/admin/login");
        exit;
    }
}

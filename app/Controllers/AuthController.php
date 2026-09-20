<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\CSRF;

class AuthController extends Controller {
    
    public function showLogin() {
        $this->view('auth/login');
    }

    public function processLogin() {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        $errorMessage = '';

        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            $errorMessage = "Invalid CSRF token.";
        } else if (!$email || !$password) {
            $errorMessage = "Email and password are required.";
        } else {
            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['logged_in'] = true;

                header("HTTP/1.1 302 Found");
        header("Location: /public/dashboard");
                exit;
            } else {
                $errorMessage = "Invalid email or password.";
            }
        }

        $this->view('auth/login', [
            'error_message' => $errorMessage
        ]);
    }

    public function showSignup() {
        $this->view('auth/signup');
    }

    public function processSignup() {
        $username = trim($_POST['Username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['password2'] ?? '';

        $errors = [];

        if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
            $errors[] = "Invalid CSRF token.";
        }

        if (!$username || !$email || !$password || !$confirmPassword) {
            $errors[] = "All fields are required";
        }

        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match";
        }

        if (empty($errors)) {
            $userModel = new User();
            if ($userModel->findByUsernameOrEmail($username, $email)) {
                $errors[] = "Username or email already exists";
            } else {
                if ($userModel->create($username, $email, $password)) {
                    
                    $this->view('auth/signup', [
                        'registration_success' => true
                    ]);
                    return;
                } else {
                    $errors[] = "Failed to register user";
                }
            }
        }

        $this->view('auth/signup', [
            'errors' => $errors,
            'formUsername' => $username,
            'formEmail' => $email
        ]);
    }

    public function logout() {
        session_destroy();
        header("HTTP/1.1 302 Found");
        header("Location: /public/");
        exit;
    }

    public function passwordReset() {
        $this->view('auth/password_reset');
    }
}

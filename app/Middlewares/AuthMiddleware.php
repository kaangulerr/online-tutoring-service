<?php
namespace App\Middlewares;

use App\Core\Middleware;

class AuthMiddleware implements Middleware {
    public function handle() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/login");
            exit;
        }
    }
}

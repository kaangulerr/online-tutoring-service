<?php
namespace App\Middlewares;

use App\Core\Middleware;

class AdminMiddleware implements Middleware {
    public function handle() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("HTTP/1.1 302 Found");
            header("Location: /public/admin/login");
            exit;
        }
    }
}

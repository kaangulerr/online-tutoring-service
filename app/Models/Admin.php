<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Admin {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProUsers() {
        $stmt = $this->db->prepare("
            SELECT u.id, u.username, p.status, p.payment_at
            FROM payments p
            JOIN users u ON p.users_id = u.id
            WHERE p.status = 'paid'
            ORDER BY p.payment_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT id, username, email, isPro FROM users ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCourses() {
        $stmt = $this->db->prepare("SELECT id, title FROM courses ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessages() {
        $stmt = $this->db->prepare("
            SELECT m.id, u.username, m.subject, m.message
            FROM messages m
            LEFT JOIN users u ON m.user_id = u.id
            ORDER BY m.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaymentStats() {
        $stmt = $this->db->prepare("
            SELECT DATE(payment_at) AS payment_date, COUNT(*) AS payment_count
            FROM payments
            WHERE status = 'paid'
            GROUP BY DATE(payment_at)
            ORDER BY payment_date
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

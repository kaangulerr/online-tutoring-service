<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUsernameOrEmail($username, $email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEnrollmentCount($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM enrollments WHERE users_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public function getWatchedVideoCount($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM watched_videos WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public function getCertificates($userId) {

        $stmt = $this->db->prepare("
            SELECT c.id AS course_id, c.title, er.taken_at
            FROM exam_results er 
            JOIN courses c ON er.course_id = c.id 
            WHERE er.user_id = ? AND er.passed = 1
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasPaid($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM payments WHERE users_id = ? AND status = 'paid'");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn() > 0;
    }
}

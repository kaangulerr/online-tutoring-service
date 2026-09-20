<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Course {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM courses ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrolledCourses($userId) {
        $stmt = $this->db->prepare("
            SELECT c.* 
            FROM courses c
            JOIN enrollments e ON c.id = e.course_id
            WHERE e.users_id = ?
            ORDER BY e.id DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isEnrolled($userId, $courseId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM enrollments WHERE users_id = ? AND course_id = ?");
        $stmt->execute([$userId, $courseId]);
        return $stmt->fetchColumn() > 0;
    }

    public function hasPassedExam($userId, $courseId) {
        $stmt = $this->db->prepare("SELECT * FROM exam_results WHERE user_id = ? AND course_id = ? AND passed = 1");
        $stmt->execute([$userId, $courseId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getContents($userId, $courseId) {
        $stmt = $this->db->prepare("
            SELECT cc.*, 
                   (SELECT COUNT(*) FROM watched_videos wv WHERE wv.user_id = ? AND wv.video_id = cc.id) AS watched 
            FROM course_contents cc 
            WHERE cc.course_id = ?
        ");
        $stmt->execute([$userId, $courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enroll($userId, $courseId) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO enrollments (users_id, course_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $courseId]);
    }

    public function add($title, $code, $imagePath, $instructorName, $instructorImage, $detailLink, $rating) {
        $check = $this->db->prepare("SELECT COUNT(*) FROM courses WHERE code = :code");
        $check->execute([':code' => $code]);
        if ($check->fetchColumn() > 0) {
            return false;
        }
        $stmt = $this->db->prepare("INSERT INTO courses (title, code, image_path, instructor_name, instructor_image, detail_link, rating) VALUES (:title, :code, :image_path, :instructor_name, :instructor_image, :detail_link, :rating)");
        return $stmt->execute([
            ':title' => $title, ':code' => $code, ':image_path' => $imagePath,
            ':instructor_name' => $instructorName, ':instructor_image' => $instructorImage,
            ':detail_link' => $detailLink, ':rating' => $rating
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM courses WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getContentsByCourseId($courseId) {
        $stmt = $this->db->prepare("SELECT * FROM course_contents WHERE course_id = ? ORDER BY id ASC");
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addContent($courseId, $title, $description, $videoUrl, $fileUrl) {
        $stmt = $this->db->prepare(
            "INSERT INTO course_contents (course_id, title, description, video_url, file_url) VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$courseId, $title, $description, $videoUrl, $fileUrl]);
    }

    public function deleteContent($contentId) {
        $stmt = $this->db->prepare("DELETE FROM course_contents WHERE id = ?");
        return $stmt->execute([$contentId]);
    }

    public function getQuestionsByCourseId($courseId) {
        $stmt = $this->db->prepare("SELECT * FROM exam_questions WHERE course_id = ? ORDER BY id ASC");
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addQuestion($courseId, $question, $optA, $optB, $optC, $optD, $correct) {
        $stmt = $this->db->prepare(
            "INSERT INTO exam_questions (course_id, question, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$courseId, $question, $optA, $optB, $optC, $optD, $correct]);
    }

    public function deleteQuestion($questionId) {
        $stmt = $this->db->prepare("DELETE FROM exam_questions WHERE id = ?");
        return $stmt->execute([$questionId]);
    }

    public function getDetailByCourseId($courseId) {
        $stmt = $this->db->prepare("SELECT * FROM course_details WHERE course_id = ?");
        $stmt->execute([$courseId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveDetail($courseId, $data) {
        $existing = $this->getDetailByCourseId($courseId);
        if ($existing) {
            $stmt = $this->db->prepare("
                UPDATE course_details SET
                    badge_text = ?, subtitle = ?, rating = ?, rating_count = ?,
                    student_count = ?, language = ?, last_updated = ?,
                    preview_video_url = ?, learn_items = ?, includes_info = ?
                WHERE course_id = ?
            ");
            return $stmt->execute([
                $data['badge_text'], $data['subtitle'], $data['rating'], $data['rating_count'],
                $data['student_count'], $data['language'], $data['last_updated'],
                $data['preview_video_url'], $data['learn_items'], $data['includes_info'],
                $courseId
            ]);
        } else {
            $stmt = $this->db->prepare("
                INSERT INTO course_details
                    (course_id, badge_text, subtitle, rating, rating_count, student_count,
                     language, last_updated, preview_video_url, learn_items, includes_info)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([
                $courseId,
                $data['badge_text'], $data['subtitle'], $data['rating'], $data['rating_count'],
                $data['student_count'], $data['language'], $data['last_updated'],
                $data['preview_video_url'], $data['learn_items'], $data['includes_info']
            ]);
        }
    }

    public function findByCode($code) {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE code = ?");
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

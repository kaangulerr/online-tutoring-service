<?php
/**
 * Database Seeder Script
 * Run this script via CLI to populate the database with dummy data for testing.
 * Command: php database/seeder.php
 */

require_once __DIR__ . '/../app/Core/Env.php';
use App\Core\Env;

Env::load(__DIR__ . '/../.env');

$host = Env::get('DB_HOST', 'localhost');
$port = Env::get('DB_PORT', '3306');
$dbname = Env::get('DB_NAME', 'opencourse');
$username = Env::get('DB_USER', 'root');
$password = Env::get('DB_PASS', '');

try {
    $pdo = new PDO("mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully.\n";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}

echo "Starting Database Seeding...\n";

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

$tables = ['users', 'courses', 'enrollments', 'exam_results'];
foreach ($tables as $table) {
    $pdo->exec("TRUNCATE TABLE `$table`");
    echo "Truncated table: $table\n";
}

$pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

$users = [
    ['username' => 'johndoe', 'email' => 'john@example.com', 'password' => password_hash('password123', PASSWORD_BCRYPT)],
    ['username' => 'janedoe', 'email' => 'jane@example.com', 'password' => password_hash('password123', PASSWORD_BCRYPT)],
    ['username' => 'alice_smith', 'email' => 'alice@example.com', 'password' => password_hash('password123', PASSWORD_BCRYPT)],
];

$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
foreach ($users as $user) {
    $stmt->execute([$user['username'], $user['email'], $user['password']]);
}
echo "Seeded " . count($users) . " users.\n";

$courses = [
    ['title' => 'Advanced Data Systems', 'code' => 'ADS101', 'instructor' => 'Dr. Smith', 'rating' => 4.5],
    ['title' => 'Machine Learning Basics', 'code' => 'ML202', 'instructor' => 'Prof. Alan', 'rating' => 4.8],
    ['title' => 'Cybersecurity Fundamentals', 'code' => 'CYB303', 'instructor' => 'Dr. Jane', 'rating' => 4.9],
    ['title' => 'Software Architecture', 'code' => 'SA404', 'instructor' => 'Mr. Bob', 'rating' => 4.2],
];

$stmt = $pdo->prepare("INSERT INTO courses (title, code, instructor_name, rating) VALUES (?, ?, ?, ?)");
foreach ($courses as $course) {
    $stmt->execute([$course['title'], $course['code'], $course['instructor'], $course['rating']]);
}
echo "Seeded " . count($courses) . " courses.\n";

$userIds = $pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);
$courseIds = $pdo->query("SELECT id FROM courses")->fetchAll(PDO::FETCH_COLUMN);

$stmt = $pdo->prepare("INSERT INTO enrollments (users_id, course_id) VALUES (?, ?)");
$enrollmentCount = 0;
foreach ($userIds as $uid) {
    
    $randomCourses = (array) array_rand(array_flip($courseIds), 2);
    foreach ($randomCourses as $cid) {
        $stmt->execute([$uid, $cid]);
        $enrollmentCount++;
    }
}
echo "Seeded $enrollmentCount enrollments.\n";

echo "\nDatabase seeding completed successfully!\n";

<?php
namespace App\Core;

use PDO;
use PDOException;
use App\Core\Env;

/**
 * Class Database
 * Singleton class for managing the PDO database connection.
 *
 * @package App\Core
 */
class Database {
    private static $instance = null;
    private $pdo;

    /**
     * Database constructor.
     * Initializes the PDO connection using environment variables.
     */
    private function __construct() {
        $host = Env::get('DB_HOST', 'localhost');
        $port = Env::get('DB_PORT', '8889');
        $dbname = Env::get('DB_NAME', 'opencourse');
        $username = Env::get('DB_USER', 'root');
        $password = Env::get('DB_PASS', 'root');

        try {
            $this->pdo = new PDO("mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Retrieves the singleton instance of the Database class.
     *
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Retrieves the active PDO connection instance.
     *
     * @return PDO
     */
    public function getConnection() {
        return $this->pdo;
    }
}

<?php
namespace App\Core;

/**
 * Class CSRF
 * Provides Cross-Site Request Forgery (CSRF) protection mechanisms.
 *
 * @package App\Core
 */
class CSRF {
    /**
     * Generates a new CSRF token if one does not exist in the session.
     *
     * @return string The CSRF token.
     */
    public static function generateToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validates a given CSRF token against the session token.
     *
     * @param string $token The token submitted in the request.
     * @return bool True if valid, false otherwise.
     */
    public static function validate($token) {
        if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
            return false;
        }
        return true;
    }

    /**
     * Generates a hidden HTML input field containing the CSRF token.
     *
     * @return string HTML input field.
     */
    public static function csrfField() {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
    }
}

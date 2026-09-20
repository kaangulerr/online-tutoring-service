<?php
namespace App\Core;

class Flash {
    /**
     * Set a flash message
     * 
     * @param string $key The key for the flash message (e.g., 'error', 'success')
     * @param string $message The message to store
     */
    public static function set($key, $message) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['flash_' . $key] = $message;
    }

    /**
     * Get and immediately clear a flash message
     * 
     * @param string $key The key for the flash message
     * @return string|null The message or null if not found
     */
    public static function get($key) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $sessionKey = 'flash_' . $key;
        
        if (isset($_SESSION[$sessionKey])) {
            $message = $_SESSION[$sessionKey];
            unset($_SESSION[$sessionKey]);
            return $message;
        }

        return null;
    }

    /**
     * Check if a flash message exists without clearing it
     * 
     * @param string $key The key for the flash message
     * @return bool True if exists
     */
    public static function has($key) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['flash_' . $key]);
    }
}

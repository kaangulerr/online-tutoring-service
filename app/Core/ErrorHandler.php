<?php
namespace App\Core;

/**
 * Class ErrorHandler
 * Intercepts uncaught exceptions and fatal errors, logging them securely and displaying a user-friendly error page.
 *
 * @package App\Core
 */
class ErrorHandler {
    /**
     * Registers the custom error and exception handlers.
     *
     * @return void
     */
    public static function register() {
        set_error_handler([__CLASS__, 'handleError']);
        set_exception_handler([__CLASS__, 'handleException']);
    }

    /**
     * Converts standard PHP errors into ErrorExceptions.
     *
     * @param int $level Error level
     * @param string $message Error message
     * @param string $file File where the error occurred
     * @param int $line Line number where the error occurred
     * @throws \ErrorException
     */
    public static function handleError($level, $message, $file = '', $line = 0) {
        if (error_reporting() & $level) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Handles uncaught exceptions, logs them to a file, and outputs a response based on APP_DEBUG mode.
     *
     * @param \Throwable $exception
     * @return void
     */
    public static function handleException(\Throwable $exception) {
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        if (!headers_sent()) {
            http_response_code($code);
        }

        $logMessage = "[" . date('Y-m-d H:i:s') . "] " 
            . get_class($exception) . ": '{$exception->getMessage()}' "
            . "in {$exception->getFile()}:{$exception->getLine()}\n"
            . "Stack trace:\n" . $exception->getTraceAsString() . "\n\n";
        
        error_log($logMessage, 3, __DIR__ . '/../../storage/logs/error.log');

        $debug = Env::get('APP_DEBUG', 'false') === 'true';

        if ($debug) {
            echo "<h1>Fatal Error</h1>";
            echo "<p><b>Message:</b> " . htmlspecialchars($exception->getMessage()) . "</p>";
            echo "<p><b>File:</b> " . htmlspecialchars($exception->getFile()) . " on line " . $exception->getLine() . "</p>";
            echo "<h3>Stack Trace:</h3><pre>" . htmlspecialchars($exception->getTraceAsString()) . "</pre>";
        } else {
            echo "<h1>500 Internal Server Error</h1>";
            echo "<p>Something went wrong. The issue has been logged.</p>";
        }
    }
}

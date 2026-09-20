<?php
namespace App\Core;

/**
 * Class Env
 * Handles loading and parsing of environment variables from a .env file.
 *
 * @package App\Core
 */
class Env {
    private static $variables = [];
    private static $loaded = false;

    /**
     * Loads and parses the .env file.
     *
     * @param string $path The absolute path to the .env file.
     * @return void
     */
    public static function load($path) {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
                self::$variables[$name] = $value;
            }
        }
        self::$loaded = true;
    }

    /**
     * Retrieves an environment variable.
     *
     * @param string $key The environment variable key.
     * @param mixed $default The default value to return if the key is not set.
     * @return mixed
     */
    public static function get($key, $default = null) {
        $value = getenv($key);
        if ($value === false) {
            return isset($_ENV[$key]) ? $_ENV[$key] : $default;
        }
        return $value;
    }
}

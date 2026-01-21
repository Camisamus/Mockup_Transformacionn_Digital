<?php
namespace App\Helpers;

class ConfigLoader
{
    private static $vars = [];

    public static function load($path)
    {
        if (!file_exists($path))
            return;
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                self::$vars[trim($key)] = trim($value);
            }
        }
    }

    public static function get($key, $default = null)
    {
        return self::$vars[$key] ?? $default;
    }
}

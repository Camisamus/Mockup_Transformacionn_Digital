<?php
/**
 * Custom Autoloader for the 'App' namespace.
 * Maps 'App\' to the 'src/' directory.
 */
spl_autoload_register(function ($class) {
    if (strpos($class, 'App\\') === 0) {
        // Base directory for the App namespace
        $baseDir = dirname(__DIR__, 2) . '/src/';
        
        // Remove 'App\' prefix and replace backslashes with slashes
        $relativeClass = substr($class, 4);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

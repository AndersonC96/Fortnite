<?php

/**
 * PSR-4 Autoloader
 * 
 * A simple autoloader that follows PSR-4 standards without external dependencies.
 * 
 * @package FortniteHub
 */

declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    // Base namespace and directory
    $prefix = 'FortniteHub\\';
    $baseDir = __DIR__ . '/../app/';

    // Check if the class uses the namespace prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get the relative class name
    $relativeClass = substr($class, $len);

    // Replace the namespace prefix with the base directory, 
    // replace namespace separators with directory separators
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/**
 * Simple Environment Loader
 * 
 * Loads .env file without external dependencies.
 */
function loadEnv(string $path): void
{
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Parse key=value
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if (preg_match('/^(["\'])(.*)\\1$/', $value, $matches)) {
                $value = $matches[2];
            }

            $_ENV[$key] = $value;
            putenv("{$key}={$value}");
        }
    }
}

// Load environment variables
loadEnv(__DIR__ . '/../.env');

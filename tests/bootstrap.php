<?php

/**
 * PHPUnit Bootstrap File
 */

declare(strict_types=1);

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Load autoloader
require BASE_PATH . '/public/autoload.php';

// Set testing environment variables
$_ENV['APP_ENV'] = 'testing';
$_ENV['CACHE_ENABLED'] = 'false';
$_ENV['FORTNITE_API_KEY'] = 'test-api-key';
$_ENV['FORTNITE_API_URL'] = 'https://fortnite-api.com/v2/';

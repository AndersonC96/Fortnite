<?php

/**
 * Fortnite Hub - Front Controller
 * 
 * All requests are routed through this file.
 * 
 * @package FortniteHub
 */

declare(strict_types=1);

// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Autoloader (standalone version without Composer)
require __DIR__ . '/autoload.php';

// Initialize Router
use FortniteHub\Core\Router;

$router = new Router();

// Set base path for XAMPP installation
$basePath = '/Fortnite/public';
$router->setBasePath($basePath);

// Define Routes
// Home
$router->get('/', 'HomeController', 'index');

// Shop
$router->get('/shop', 'ShopController', 'index');

// Cosmetics
$router->get('/cosmetics', 'CosmeticsController', 'index');
$router->get('/cosmetics/api', 'CosmeticsController', 'api');
$router->get('/cosmetics/{id}', 'CosmeticsController', 'show');

// News
$router->get('/news', 'NewsController', 'index');
$router->get('/news/br', 'NewsController', 'br');
$router->get('/news/stw', 'NewsController', 'stw');

// Map
$router->get('/map', 'MapController', 'index');

// Modes
$router->get('/modes', 'ModesController', 'index');

// Player
$router->get('/player', 'PlayerController', 'search');
$router->get('/player/{name}', 'PlayerController', 'stats');

// Dispatch request
try {
    $router->dispatch();
} catch (Exception $e) {
    http_response_code(500);
    
    if ($_ENV['APP_DEBUG'] ?? false) {
        echo '<pre>' . $e->getMessage() . "\n" . $e->getTraceAsString() . '</pre>';
    } else {
        include BASE_PATH . '/app/Views/errors/500.php';
    }
}

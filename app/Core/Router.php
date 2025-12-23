<?php

declare(strict_types=1);

namespace FortniteHub\Core;

/**
 * Simple Router for handling HTTP requests
 * 
 * @package FortniteHub\Core
 */
class Router
{
    /** @var array<string, array> */
    private array $routes = [];

    /** @var string */
    private string $basePath = '';

    /**
     * Set base path for all routes
     */
    public function setBasePath(string $basePath): void
    {
        $this->basePath = rtrim($basePath, '/');
    }

    /**
     * Register a GET route
     */
    public function get(string $path, string $controller, string $method): void
    {
        $this->addRoute('GET', $path, $controller, $method);
    }

    /**
     * Register a POST route
     */
    public function post(string $path, string $controller, string $method): void
    {
        $this->addRoute('POST', $path, $controller, $method);
    }

    /**
     * Add route to registry
     */
    private function addRoute(string $httpMethod, string $path, string $controller, string $method): void
    {
        $this->routes[] = [
            'httpMethod' => $httpMethod,
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    /**
     * Dispatch the request to appropriate controller
     */
    public function dispatch(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove base path from URI
        if ($this->basePath && strpos($requestUri, $this->basePath) === 0) {
            $requestUri = substr($requestUri, strlen($this->basePath));
        }
        
        $requestUri = $requestUri ?: '/';

        foreach ($this->routes as $route) {
            $params = $this->matchRoute($route['path'], $requestUri);
            
            if ($params !== false && $route['httpMethod'] === $requestMethod) {
                $this->callController($route['controller'], $route['method'], $params);
                return;
            }
        }

        // No route found - 404
        $this->handleNotFound();
    }

    /**
     * Match route pattern against URI
     * 
     * @return array|false
     */
    private function matchRoute(string $routePath, string $requestUri)
    {
        // Convert route pattern to regex
        $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<$1>[^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $requestUri, $matches)) {
            // Filter out numeric keys
            return array_filter($matches, fn($key) => !is_numeric($key), ARRAY_FILTER_USE_KEY);
        }

        return false;
    }

    /**
     * Call controller method
     */
    private function callController(string $controller, string $method, array $params): void
    {
        $controllerClass = "FortniteHub\\Controllers\\{$controller}";
        
        if (!class_exists($controllerClass)) {
            throw new \RuntimeException("Controller {$controllerClass} not found");
        }

        $instance = new $controllerClass();
        
        if (!method_exists($instance, $method)) {
            throw new \RuntimeException("Method {$method} not found in {$controllerClass}");
        }

        call_user_func_array([$instance, $method], $params);
    }

    /**
     * Handle 404 Not Found
     */
    private function handleNotFound(): void
    {
        http_response_code(404);
        
        if (file_exists(__DIR__ . '/../Views/errors/404.php')) {
            include __DIR__ . '/../Views/errors/404.php';
        } else {
            echo '<h1>404 - Page Not Found</h1>';
        }
    }
}

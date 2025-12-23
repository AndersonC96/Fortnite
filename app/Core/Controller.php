<?php

declare(strict_types=1);

namespace FortniteHub\Core;

/**
 * Base Controller class
 * 
 * @package FortniteHub\Core
 */
abstract class Controller
{
    /** @var string */
    protected string $pageTitle = 'Fortnite Hub';

    /**
     * Render a view with layout
     * 
     * @param string $view View path (e.g., 'home/index')
     * @param array<string, mixed> $data Data to pass to view
     */
    protected function view(string $view, array $data = []): void
    {
        // Extract data to variables
        extract($data);
        
        // Set page title
        $pageTitle = $this->pageTitle;
        
        // Get current page for navigation
        $currentPage = $this->getCurrentPage();

        // Start output buffering for content
        ob_start();
        
        $viewPath = __DIR__ . "/../Views/{$view}.php";
        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View {$view} not found");
        }
        
        include $viewPath;
        $content = ob_get_clean();

        // Include layout
        include __DIR__ . '/../Views/layouts/main.php';
    }

    /**
     * Render JSON response
     * 
     * @param array<string, mixed> $data
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Redirect to another URL
     */
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    /**
     * Get current page identifier
     */
    private function getCurrentPage(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return trim($uri, '/') ?: 'home';
    }

    /**
     * Get query parameter
     * 
     * @param mixed $default
     * @return mixed
     */
    protected function getQuery(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Get POST parameter
     * 
     * @param mixed $default
     * @return mixed
     */
    protected function getPost(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * Escape HTML output
     */
    protected function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

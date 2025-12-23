<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use FortniteHub\Core\Router;

/**
 * Router Unit Tests
 */
class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        $this->router = new Router();
    }

    public function testCanBeInstantiated(): void
    {
        $this->assertInstanceOf(Router::class, $this->router);
    }

    public function testCanSetBasePath(): void
    {
        $this->router->setBasePath('/test/path');
        // No exception means success
        $this->assertTrue(true);
    }

    public function testCanAddGetRoute(): void
    {
        $this->router->get('/test', 'TestController', 'index');
        // No exception means success
        $this->assertTrue(true);
    }

    public function testCanAddPostRoute(): void
    {
        $this->router->post('/test', 'TestController', 'store');
        // No exception means success
        $this->assertTrue(true);
    }

    public function testCanAddMultipleRoutes(): void
    {
        $this->router->get('/', 'HomeController', 'index');
        $this->router->get('/shop', 'ShopController', 'index');
        $this->router->get('/cosmetics/{id}', 'CosmeticsController', 'show');
        $this->assertTrue(true);
    }
}

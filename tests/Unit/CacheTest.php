<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use FortniteHub\Core\Cache;

/**
 * Cache Unit Tests
 */
class CacheTest extends TestCase
{
    private Cache $cache;
    private string $testKey = 'test_key';

    protected function setUp(): void
    {
        // Disable cache for testing to avoid file system issues
        $_ENV['CACHE_ENABLED'] = 'true';
        $_ENV['CACHE_TTL'] = '60';
        $this->cache = new Cache();
    }

    protected function tearDown(): void
    {
        // Clean up test cache
        $this->cache->delete($this->testKey);
    }

    public function testCanBeInstantiated(): void
    {
        $this->assertInstanceOf(Cache::class, $this->cache);
    }

    public function testCanSetAndGetValue(): void
    {
        $value = ['test' => 'data', 'number' => 123];
        
        $this->cache->set($this->testKey, $value);
        $result = $this->cache->get($this->testKey);
        
        $this->assertEquals($value, $result);
    }

    public function testReturnsNullForMissingKey(): void
    {
        $result = $this->cache->get('nonexistent_key_12345');
        $this->assertNull($result);
    }

    public function testCanDeleteValue(): void
    {
        $this->cache->set($this->testKey, 'test');
        $this->cache->delete($this->testKey);
        
        $result = $this->cache->get($this->testKey);
        $this->assertNull($result);
    }

    public function testRememberExecutesCallbackWhenMissing(): void
    {
        $callbackExecuted = false;
        
        $result = $this->cache->remember('remember_test', function () use (&$callbackExecuted) {
            $callbackExecuted = true;
            return 'callback_result';
        });
        
        $this->assertTrue($callbackExecuted);
        $this->assertEquals('callback_result', $result);
        
        // Clean up
        $this->cache->delete('remember_test');
    }

    public function testRememberReturnsCachedValueWhenExists(): void
    {
        // Set initial value
        $this->cache->set('remember_cached', 'cached_value');
        
        $callbackExecuted = false;
        $result = $this->cache->remember('remember_cached', function () use (&$callbackExecuted) {
            $callbackExecuted = true;
            return 'new_value';
        });
        
        $this->assertFalse($callbackExecuted);
        $this->assertEquals('cached_value', $result);
        
        // Clean up
        $this->cache->delete('remember_cached');
    }
}

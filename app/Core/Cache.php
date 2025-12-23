<?php

declare(strict_types=1);

namespace FortniteHub\Core;

/**
 * Simple file-based cache system
 * 
 * @package FortniteHub\Core
 */
class Cache
{
    /** @var string */
    private string $cachePath;

    /** @var int */
    private int $defaultTtl;

    /** @var bool */
    private bool $enabled;

    /**
     * Initialize cache
     */
    public function __construct()
    {
        $this->cachePath = dirname(__DIR__, 2) . '/cache';
        $this->defaultTtl = (int) ($_ENV['CACHE_TTL'] ?? 300);
        $this->enabled = ($_ENV['CACHE_ENABLED'] ?? 'true') === 'true';

        // Create cache directory if not exists
        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0755, true);
        }
    }

    /**
     * Get cached value
     * 
     * @return mixed|null
     */
    public function get(string $key)
    {
        if (!$this->enabled) {
            return null;
        }

        $file = $this->getCacheFile($key);
        
        if (!file_exists($file)) {
            return null;
        }

        $content = file_get_contents($file);
        $data = json_decode($content, true);

        if ($data === null || !isset($data['expires']) || !isset($data['value'])) {
            return null;
        }

        // Check if expired
        if ($data['expires'] < time()) {
            $this->delete($key);
            return null;
        }

        return $data['value'];
    }

    /**
     * Set cached value
     * 
     * @param mixed $value
     */
    public function set(string $key, $value, ?int $ttl = null): bool
    {
        if (!$this->enabled) {
            return false;
        }

        $ttl = $ttl ?? $this->defaultTtl;
        $file = $this->getCacheFile($key);

        $data = [
            'expires' => time() + $ttl,
            'value' => $value,
        ];

        return file_put_contents($file, json_encode($data)) !== false;
    }

    /**
     * Delete cached value
     */
    public function delete(string $key): bool
    {
        $file = $this->getCacheFile($key);
        
        if (file_exists($file)) {
            return unlink($file);
        }

        return true;
    }

    /**
     * Clear all cache
     */
    public function clear(): void
    {
        $files = glob($this->cachePath . '/*.cache');
        
        foreach ($files as $file) {
            unlink($file);
        }
    }

    /**
     * Remember - get from cache or execute callback
     * 
     * @param callable $callback
     * @return mixed
     */
    public function remember(string $key, callable $callback, ?int $ttl = null)
    {
        $value = $this->get($key);

        if ($value !== null) {
            return $value;
        }

        $value = $callback();
        $this->set($key, $value, $ttl);

        return $value;
    }

    /**
     * Get cache file path
     */
    private function getCacheFile(string $key): string
    {
        $hash = md5($key);
        return $this->cachePath . '/' . $hash . '.cache';
    }
}

<?php

declare(strict_types=1);

namespace FortniteHub\Models;

use FortniteHub\Core\Cache;

/**
 * Fortnite API Model
 * 
 * Handles all communication with the Fortnite API
 * 
 * @package FortniteHub\Models
 */
class FortniteAPI
{
    /** @var string */
    private string $apiUrl;

    /** @var string */
    private string $apiKey;

    /** @var Cache */
    private Cache $cache;

    /**
     * Initialize API configuration
     */
    public function __construct()
    {
        $this->apiUrl = $_ENV['FORTNITE_API_URL'] ?? 'https://fortnite-api.com/v2/';
        $this->apiKey = $_ENV['FORTNITE_API_KEY'] ?? '';
        $this->cache = new Cache();
    }

    /**
     * Make API request
     * 
     * @return array<string, mixed>|null
     */
    public function call(string $endpoint, bool $useCache = true, int $cacheTtl = 300): ?array
    {
        $cacheKey = 'api_' . md5($endpoint);

        // Try cache first
        if ($useCache) {
            $cached = $this->cache->get($cacheKey);
            if ($cached !== null) {
                return $cached;
            }
        }

        // Make API request
        $url = rtrim($this->apiUrl, '/') . '/' . ltrim($endpoint, '/');
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . $this->apiKey,
                'Accept: application/json',
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error || $httpCode !== 200) {
            return null;
        }

        $data = json_decode($response, true);

        // Cache successful response
        if ($useCache && $data !== null && isset($data['status']) && $data['status'] === 200) {
            $this->cache->set($cacheKey, $data, $cacheTtl);
        }

        return $data;
    }

    /**
     * Get shop items
     * 
     * @return array<string, mixed>|null
     */
    public function getShop(): ?array
    {
        return $this->call('shop', true, 600); // Cache for 10 minutes
    }

    /**
     * Get news
     * 
     * @return array<string, mixed>|null
     */
    public function getNews(): ?array
    {
        return $this->call('news', true, 300);
    }

    /**
     * Get Battle Royale news
     * 
     * @return array<string, mixed>|null
     */
    public function getNewsBR(): ?array
    {
        return $this->call('news/br', true, 300);
    }

    /**
     * Get Save the World news
     * 
     * @return array<string, mixed>|null
     */
    public function getNewsSTW(): ?array
    {
        return $this->call('news/stw', true, 300);
    }

    /**
     * Search cosmetics by name
     * 
     * @return array<string, mixed>|null
     */
    public function searchCosmetics(string $query): ?array
    {
        $endpoint = 'cosmetics/br/search/all?name=' . urlencode($query) . '&matchMethod=contains';
        return $this->call($endpoint, true, 600);
    }

    /**
     * Get cosmetic by ID
     * 
     * @return array<string, mixed>|null
     */
    public function getCosmetic(string $id): ?array
    {
        return $this->call("cosmetics/br/{$id}", true, 3600); // Cache for 1 hour
    }

    /**
     * Search cosmetic by exact name
     * 
     * @return array<string, mixed>|null
     */
    public function getCosmeticByName(string $name): ?array
    {
        $endpoint = 'cosmetics/br/search?name=' . urlencode($name);
        return $this->call($endpoint, true, 3600);
    }

    /**
     * Get player stats
     * 
     * @return array<string, mixed>|null
     */
    public function getPlayerStats(string $name, string $platform = 'epic'): ?array
    {
        $endpoint = "stats/br/v2?name=" . urlencode($name) . "&accountType=" . $platform;
        return $this->call($endpoint, true, 300);
    }

    /**
     * Get playlists
     * 
     * @return array<string, mixed>|null
     */
    public function getPlaylists(): ?array
    {
        return $this->call('../v1/playlists', true, 3600);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use FortniteHub\Models\FortniteAPI;

/**
 * FortniteAPI Model Unit Tests
 */
class FortniteAPITest extends TestCase
{
    private FortniteAPI $api;

    protected function setUp(): void
    {
        $_ENV['FORTNITE_API_KEY'] = 'test-key';
        $_ENV['FORTNITE_API_URL'] = 'https://fortnite-api.com/v2/';
        $_ENV['CACHE_ENABLED'] = 'false';
        
        $this->api = new FortniteAPI();
    }

    public function testCanBeInstantiated(): void
    {
        $this->assertInstanceOf(FortniteAPI::class, $this->api);
    }

    public function testGetShopReturnsArrayOrNull(): void
    {
        $result = $this->api->getShop();
        
        $this->assertTrue(
            is_array($result) || is_null($result),
            'getShop should return array or null'
        );
    }

    public function testGetNewsReturnsArrayOrNull(): void
    {
        $result = $this->api->getNews();
        
        $this->assertTrue(
            is_array($result) || is_null($result),
            'getNews should return array or null'
        );
    }

    public function testSearchCosmeticsReturnsArrayOrNull(): void
    {
        $result = $this->api->searchCosmetics('Raven');
        
        $this->assertTrue(
            is_array($result) || is_null($result),
            'searchCosmetics should return array or null'
        );
    }

    public function testGetCosmeticWithInvalidIdReturnsNull(): void
    {
        $result = $this->api->getCosmetic('invalid_id_12345');
        
        // Should return null or error response
        $this->assertTrue(
            is_null($result) || (is_array($result) && isset($result['status']) && $result['status'] !== 200),
            'getCosmetic with invalid ID should return null or error'
        );
    }
}

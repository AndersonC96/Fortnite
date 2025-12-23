<?php

declare(strict_types=1);

namespace FortniteHub\Controllers;

use FortniteHub\Core\Controller;
use FortniteHub\Models\FortniteAPI;

/**
 * Shop Controller
 * 
 * @package FortniteHub\Controllers
 */
class ShopController extends Controller
{
    /** @var FortniteAPI */
    private FortniteAPI $api;

    public function __construct()
    {
        $this->api = new FortniteAPI();
        $this->pageTitle = 'Loja - Fortnite Hub';
    }

    /**
     * Display shop page
     */
    public function index(): void
    {
        $searchQuery = $this->getQuery('query', '');
        $shopData = $this->api->getShop();
        
        $sections = [];
        $shopDate = '';

        if ($shopData && $shopData['status'] === 200 && !empty($shopData['data']['entries'])) {
            $shopDate = $shopData['data']['date'] ?? '';
            
            foreach ($shopData['data']['entries'] as $entry) {
                $sectionName = $entry['layout']['name'] ?? 'Outros';
                
                // Get image
                $imageUrl = './img/logo.png';
                if (!empty($entry['bundle']['image'])) {
                    $imageUrl = $entry['bundle']['image'];
                } elseif (!empty($entry['newDisplayAsset']['renderImages'][0]['image'])) {
                    $imageUrl = $entry['newDisplayAsset']['renderImages'][0]['image'];
                } elseif (!empty($entry['brItems'][0]['images']['featured'])) {
                    $imageUrl = $entry['brItems'][0]['images']['featured'];
                } elseif (!empty($entry['brItems'][0]['images']['icon'])) {
                    $imageUrl = $entry['brItems'][0]['images']['icon'];
                } elseif (!empty($entry['tracks'][0]['albumArt'])) {
                    $imageUrl = $entry['tracks'][0]['albumArt'];
                }
                
                // Get name
                $itemName = $entry['bundle']['name'] 
                    ?? $entry['brItems'][0]['name'] 
                    ?? $entry['tracks'][0]['title'] 
                    ?? $entry['cars'][0]['name'] 
                    ?? 'Item';
                
                // Get rarity
                $rarity = strtolower($entry['brItems'][0]['rarity']['value'] ?? 'common');
                
                // Get item type
                $itemType = $entry['brItems'][0]['type']['displayValue'] ?? '';
                if (!empty($entry['tracks'])) {
                    $itemType = 'Jam Track';
                } elseif (!empty($entry['cars'])) {
                    $itemType = 'Vehicle';
                } elseif (!empty($entry['bundle'])) {
                    $itemType = 'Bundle';
                }
                
                // Get series
                $series = $entry['brItems'][0]['series']['value'] ?? '';
                
                // Get banner
                $banner = $entry['banner']['value'] ?? '';
                
                // Filter by search
                if ($searchQuery && stripos($itemName, $searchQuery) === false) {
                    continue;
                }
                
                $item = [
                    'name' => $itemName,
                    'image' => $imageUrl,
                    'price' => $entry['finalPrice'] ?? 0,
                    'regularPrice' => $entry['regularPrice'] ?? 0,
                    'rarity' => $rarity,
                    'type' => $itemType,
                    'series' => $series,
                    'banner' => $banner,
                    'giftable' => $entry['giftable'] ?? false,
                ];
                
                if (!isset($sections[$sectionName])) {
                    $sections[$sectionName] = [];
                }
                
                $sections[$sectionName][] = $item;
            }
        }

        $this->view('shop/index', [
            'sections' => $sections,
            'shopDate' => $shopDate,
            'searchQuery' => $searchQuery,
        ]);
    }
}

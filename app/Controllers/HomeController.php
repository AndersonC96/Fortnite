<?php

declare(strict_types=1);

namespace FortniteHub\Controllers;

use FortniteHub\Core\Controller;
use FortniteHub\Models\FortniteAPI;

/**
 * Home Controller
 * 
 * @package FortniteHub\Controllers
 */
class HomeController extends Controller
{
    /** @var FortniteAPI */
    private FortniteAPI $api;

    public function __construct()
    {
        $this->api = new FortniteAPI();
        $this->pageTitle = 'Home - Fortnite Hub';
    }

    /**
     * Display home page
     */
    public function index(): void
    {
        $shopData = $this->api->getShop();
        $featuredItems = [];

        if ($shopData && $shopData['status'] === 200 && !empty($shopData['data']['entries'])) {
            $count = 0;
            foreach ($shopData['data']['entries'] as $entry) {
                if ($count >= 4) {
                    break;
                }

                $imageUrl = './img/logo.png';
                if (!empty($entry['bundle']['image'])) {
                    $imageUrl = $entry['bundle']['image'];
                } elseif (!empty($entry['newDisplayAsset']['renderImages'][0]['image'])) {
                    $imageUrl = $entry['newDisplayAsset']['renderImages'][0]['image'];
                } elseif (!empty($entry['brItems'][0]['images']['featured'])) {
                    $imageUrl = $entry['brItems'][0]['images']['featured'];
                }

                $featuredItems[] = [
                    'name' => $entry['bundle']['name'] ?? ($entry['brItems'][0]['name'] ?? 'Item'),
                    'image' => $imageUrl,
                    'price' => $entry['finalPrice'] ?? 0,
                ];

                $count++;
            }
        }

        $this->view('home/index', [
            'featuredItems' => $featuredItems,
        ]);
    }
}

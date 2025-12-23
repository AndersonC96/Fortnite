<?php

declare(strict_types=1);

namespace FortniteHub\Controllers;

use FortniteHub\Core\Controller;
use FortniteHub\Models\FortniteAPI;

/**
 * Cosmetics Controller
 * 
 * @package FortniteHub\Controllers
 */
class CosmeticsController extends Controller
{
    /** @var FortniteAPI */
    private FortniteAPI $api;

    /** @var array<string> */
    private array $popularSkins = [
        'Drift', 'Raven', 'Skull Trooper', 'Midas', 'Peely', 'Fishstick',
        'Aura', 'Omega', 'Lynx', 'Black Knight', 'Catalyst', 'Meowscles',
        'Jonesy', 'The Reaper', 'Spider-Man', 'Kratos', 'Master Chief',
        'Lara Croft', 'Deadpool', 'Wolverine', 'Iron Man', 'Thor', 'Batman',
    ];

    public function __construct()
    {
        $this->api = new FortniteAPI();
        $this->pageTitle = 'Cosméticos - Fortnite Hub';
    }

    /**
     * Display cosmetics list page
     */
    public function index(): void
    {
        $searchQuery = $this->getQuery('query', '');

        $this->view('cosmetics/index', [
            'searchQuery' => $searchQuery,
            'popularSkins' => $this->popularSkins,
        ]);
    }

    /**
     * Display cosmetic details
     */
    public function show(string $id): void
    {
        $cosmeticData = $this->api->getCosmetic($id);

        if (!$cosmeticData || $cosmeticData['status'] !== 200) {
            $this->redirect('/cosmetics');
            return;
        }

        $item = $cosmeticData['data'];
        $this->pageTitle = ($item['name'] ?? 'Cosmético') . ' - Fortnite Hub';

        $this->view('cosmetics/show', [
            'item' => $item,
        ]);
    }

    /**
     * API endpoint for infinite scroll
     */
    public function api(): void
    {
        $query = $this->getQuery('query', '');
        $page = (int) $this->getQuery('page', 1);
        $perPage = 12;

        $items = [];

        if ($query) {
            $result = $this->api->searchCosmetics($query);
            if ($result && $result['status'] === 200) {
                $allItems = is_array($result['data']) ? $result['data'] : [$result['data']];
                $offset = ($page - 1) * $perPage;
                $items = array_slice($allItems, $offset, $perPage);
            }
        } else {
            // Return popular skins for default page
            $offset = ($page - 1) * $perPage;
            $skins = array_slice($this->popularSkins, $offset, $perPage);
            
            foreach ($skins as $skinName) {
                $result = $this->api->getCosmeticByName($skinName);
                if ($result && $result['status'] === 200) {
                    $items[] = $result['data'];
                }
            }
        }

        $this->json([
            'items' => $items,
            'page' => $page,
            'hasMore' => count($items) === $perPage,
        ]);
    }
}

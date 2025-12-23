<?php

declare(strict_types=1);

namespace FortniteHub\Controllers;

use FortniteHub\Core\Controller;

/**
 * Map Controller
 * 
 * @package FortniteHub\Controllers
 */
class MapController extends Controller
{
    /** @var array<array{name: string, icon: string}> */
    private array $pois = [
        ['name' => 'Pleasant Palms', 'icon' => '🌴'],
        ['name' => 'Grand Glacier', 'icon' => '🏔️'],
        ['name' => 'Shogun\'s Solitude', 'icon' => '⛩️'],
        ['name' => 'Seaport City', 'icon' => '🏙️'],
        ['name' => 'Demon\'s Dojo', 'icon' => '👹'],
        ['name' => 'Nightshift Forest', 'icon' => '🌲'],
        ['name' => 'Pumped Power', 'icon' => '⚡'],
        ['name' => 'Magic Moss', 'icon' => '🍄'],
        ['name' => 'Hopeful Heights', 'icon' => '🏠'],
        ['name' => 'Warrior\'s Watch', 'icon' => '⚔️'],
        ['name' => 'Masked Meadows', 'icon' => '🎭'],
        ['name' => 'Twisted Towers', 'icon' => '🗼'],
    ];

    public function __construct()
    {
        $this->pageTitle = 'Mapa - Fortnite Hub';
    }

    /**
     * Display map page
     */
    public function index(): void
    {
        $this->view('map/index', [
            'pois' => $this->pois,
            'mapUrl' => 'https://media.fortniteapi.io/images/map.png?showPOI=true',
            'mapUrlBlank' => 'https://media.fortniteapi.io/images/map.png',
        ]);
    }
}

<?php

declare(strict_types=1);

namespace FortniteHub\Controllers;

use FortniteHub\Core\Controller;

/**
 * Modes Controller
 * 
 * @package FortniteHub\Controllers
 */
class ModesController extends Controller
{
    /** @var array<array<string, mixed>> */
    private array $playlists = [
        // Battle Royale
        ['id' => 'solo', 'name' => 'Solo', 'desc' => 'Jogue sozinho em uma batalha para ser o último em pé.', 'type' => 'br', 'icon' => '🎯', 'color' => 'var(--fn-blue)'],
        ['id' => 'duo', 'name' => 'Duos', 'desc' => 'Forme dupla com um amigo e elimine todos os outros.', 'type' => 'br', 'icon' => '👥', 'color' => 'var(--fn-blue)'],
        ['id' => 'trios', 'name' => 'Trios', 'desc' => 'Battle Royale clássico com esquadrões de três pessoas.', 'type' => 'br', 'icon' => '👨‍👩‍👦', 'color' => 'var(--fn-blue)'],
        ['id' => 'squad', 'name' => 'Squads', 'desc' => 'Agrupe-se e sobreviva contra todos os outros esquadrões.', 'type' => 'br', 'icon' => '👨‍👩‍👧‍👦', 'color' => 'var(--fn-blue)'],
        
        // Zero Build
        ['id' => 'zb-solo', 'name' => 'Zero Build - Solo', 'desc' => 'Battle Royale sem construção para jogadores solo.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
        ['id' => 'zb-duo', 'name' => 'Zero Build - Duos', 'desc' => 'Battle Royale sem construção em duplas.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
        ['id' => 'zb-trio', 'name' => 'Zero Build - Trios', 'desc' => 'Battle Royale sem construção em trios.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
        ['id' => 'zb-squad', 'name' => 'Zero Build - Squads', 'desc' => 'Battle Royale sem construção em esquadrões.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
        
        // LTMs
        ['id' => 'rumble', 'name' => 'Team Rumble', 'desc' => 'Duas grandes equipes lutam pela Victory Royale!', 'type' => 'br', 'icon' => '⚔️', 'color' => 'var(--fn-orange)'],
        ['id' => 'solid-gold', 'name' => 'Solid Gold', 'desc' => 'Todas as armas são Lendárias!', 'type' => 'br', 'icon' => '🥇', 'color' => 'var(--fn-yellow)'],
        
        // Festival
        ['id' => 'main-stage', 'name' => 'Festival Main Stage', 'desc' => 'Toque em uma banda com amigos ou solo com suas músicas favoritas.', 'type' => 'festival', 'icon' => '🎸', 'color' => 'var(--fn-pink)'],
        ['id' => 'battle-stage', 'name' => 'Festival Battle Stage', 'desc' => 'Domine o palco na batalha musical!', 'type' => 'festival', 'icon' => '🎤', 'color' => 'var(--fn-pink)'],
        ['id' => 'jam-stage', 'name' => 'Festival Jam Stage', 'desc' => 'Explore o Jam Stage e faça mix de músicas!', 'type' => 'festival', 'icon' => '🎧', 'color' => 'var(--fn-pink)'],
        
        // Rocket Racing
        ['id' => 'racing-ranked', 'name' => 'Rocket Racing - Ranked', 'desc' => 'Corridas competitivas ranqueadas.', 'type' => 'racing', 'icon' => '🏆', 'color' => 'var(--fn-purple)'],
        ['id' => 'racing-casual', 'name' => 'Rocket Racing - Casual', 'desc' => 'Corridas competitivas casuais.', 'type' => 'racing', 'icon' => '🏎️', 'color' => 'var(--fn-purple)'],
        ['id' => 'speed-run', 'name' => 'Speed Run', 'desc' => 'Corra contra o tempo!', 'type' => 'racing', 'icon' => '⏱️', 'color' => 'var(--fn-purple)'],
        
        // Other
        ['id' => 'lego', 'name' => 'LEGO Fortnite', 'desc' => 'Construa e sobreviva no mundo LEGO!', 'type' => 'other', 'icon' => '🧱', 'color' => 'var(--fn-yellow)'],
        ['id' => 'creative', 'name' => 'Creative', 'desc' => 'Jogue os melhores jogos feitos pela comunidade!', 'type' => 'other', 'icon' => '🎨', 'color' => 'var(--text-secondary)'],
    ];

    public function __construct()
    {
        $this->pageTitle = 'Modos de Jogo - Fortnite Hub';
    }

    /**
     * Display modes page
     */
    public function index(): void
    {
        $this->view('modes/index', [
            'playlists' => $this->playlists,
            'types' => [
                'br' => 'Battle Royale',
                'zerobuild' => 'Zero Build',
                'festival' => 'Festival',
                'racing' => 'Rocket Racing',
                'other' => 'Outros',
            ],
        ]);
    }
}

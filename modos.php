<?php 
include 'apiConfig.php'; 
$pageTitle = 'Modos de Jogo - Fortnite Hub';
include 'header.php'; 

// Fetch playlists from v1 API
$playlistsData = callFortniteAPI('../v1/playlists');
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🎮 Modos de Jogo</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Todos os modos disponíveis no Fortnite</p>
    </div>
    
    <!-- Category Filter -->
    <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 30px; flex-wrap: wrap;">
        <button class="btn-fn filter-btn active" onclick="filterPlaylists('all')">📋 Todos</button>
        <button class="btn-fn btn-fn-outline filter-btn" onclick="filterPlaylists('br')">🎯 Battle Royale</button>
        <button class="btn-fn btn-fn-outline filter-btn" onclick="filterPlaylists('zerobuild')">🔨 Zero Build</button>
        <button class="btn-fn btn-fn-outline filter-btn" onclick="filterPlaylists('festival')">🎵 Festival</button>
        <button class="btn-fn btn-fn-outline filter-btn" onclick="filterPlaylists('racing')">🏎️ Rocket Racing</button>
    </div>
    
    <div class="items-grid" id="playlists-grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
        <?php
        // Filter and display relevant playlists
        $mainPlaylists = [
            // Battle Royale
            ['id' => 'Playlist_DefaultSolo', 'name' => 'Solo', 'desc' => 'Jogue sozinho em uma batalha para ser o último em pé.', 'type' => 'br', 'icon' => '🎯', 'color' => 'var(--fn-blue)'],
            ['id' => 'Playlist_DefaultDuo', 'name' => 'Duos', 'desc' => 'Forme dupla com um amigo e elimine todos os outros.', 'type' => 'br', 'icon' => '👥', 'color' => 'var(--fn-blue)'],
            ['id' => 'Playlist_Trios', 'name' => 'Trios', 'desc' => 'Battle Royale clássico com esquadrões de três pessoas.', 'type' => 'br', 'icon' => '👨‍👩‍👦', 'color' => 'var(--fn-blue)'],
            ['id' => 'Playlist_DefaultSquad', 'name' => 'Squads', 'desc' => 'Agrupe-se e sobreviva contra todos os outros esquadrões.', 'type' => 'br', 'icon' => '👨‍👩‍👧‍👦', 'color' => 'var(--fn-blue)'],
            
            // Zero Build
            ['id' => 'Playlist_NoBuildBR_Solo', 'name' => 'Zero Build - Solo', 'desc' => 'Battle Royale sem construção para jogadores solo.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
            ['id' => 'Playlist_NoBuildBR_Duo', 'name' => 'Zero Build - Duos', 'desc' => 'Battle Royale sem construção em duplas.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
            ['id' => 'Playlist_NoBuildBR_Trio', 'name' => 'Zero Build - Trios', 'desc' => 'Battle Royale sem construção em trios.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
            ['id' => 'Playlist_NoBuildBR_Squad', 'name' => 'Zero Build - Squads', 'desc' => 'Battle Royale sem construção em esquadrões.', 'type' => 'zerobuild', 'icon' => '🔨', 'color' => 'var(--fn-green)'],
            
            // LTMs
            ['id' => 'Playlist_Respawn_24', 'name' => 'Team Rumble', 'desc' => 'Duas grandes equipes lutam pela Victory Royale!', 'type' => 'br', 'icon' => '⚔️', 'color' => 'var(--fn-orange)'],
            ['id' => 'Playlist_SolidGold_Squads', 'name' => 'Solid Gold', 'desc' => 'Todas as armas são Lendárias!', 'type' => 'br', 'icon' => '🥇', 'color' => 'var(--fn-yellow)'],
            
            // Festival
            ['id' => 'Playlist_PilgrimQuickplay', 'name' => 'Festival Main Stage', 'desc' => 'Toque em uma banda com amigos ou solo com suas músicas favoritas.', 'type' => 'festival', 'icon' => '🎸', 'color' => 'var(--fn-pink)'],
            ['id' => 'Playlist_PilgrimBattleStage', 'name' => 'Festival Battle Stage', 'desc' => 'Domine o palco na batalha musical!', 'type' => 'festival', 'icon' => '🎤', 'color' => 'var(--fn-pink)'],
            ['id' => 'Playlist_FMClubIsland', 'name' => 'Festival Jam Stage', 'desc' => 'Explore o Jam Stage e faça mix de músicas!', 'type' => 'festival', 'icon' => '🎧', 'color' => 'var(--fn-pink)'],
            
            // Rocket Racing
            ['id' => 'Playlist_DelMar_Ranked_Root', 'name' => 'Rocket Racing - Ranked', 'desc' => 'Corridas competitivas ranqueadas.', 'type' => 'racing', 'icon' => '🏆', 'color' => 'var(--fn-purple)'],
            ['id' => 'Playlist_DelMar_Racing_Root', 'name' => 'Rocket Racing - Casual', 'desc' => 'Corridas competitivas casuais.', 'type' => 'racing', 'icon' => '🏎️', 'color' => 'var(--fn-purple)'],
            ['id' => 'Playlist_DelMar_SpeedRun_Root', 'name' => 'Speed Run', 'desc' => 'Corra contra o tempo!', 'type' => 'racing', 'icon' => '⏱️', 'color' => 'var(--fn-purple)'],
            
            // LEGO
            ['id' => 'Playlist_Juno', 'name' => 'LEGO Fortnite', 'desc' => 'Construa e sobreviva no mundo LEGO!', 'type' => 'other', 'icon' => '🧱', 'color' => 'var(--fn-yellow)'],
            
            // Creative
            ['id' => 'Playlist_PlaygroundV2', 'name' => 'Creative', 'desc' => 'Jogue os melhores jogos feitos pela comunidade!', 'type' => 'other', 'icon' => '🎨', 'color' => 'var(--text-secondary)'],
        ];
        
        foreach($mainPlaylists as $playlist):
        ?>
        <div class="playlist-card" data-type="<?php echo $playlist['type']; ?>" style="animation-delay: <?php echo array_search($playlist, $mainPlaylists) * 0.05; ?>s;">
            <div class="item-card" style="border-left: 4px solid <?php echo $playlist['color']; ?>;">
                <div class="card-body" style="padding: 25px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <span style="font-size: 2.5rem;"><?php echo $playlist['icon']; ?></span>
                        <div>
                            <h4 style="margin: 0; color: <?php echo $playlist['color']; ?>;"><?php echo htmlspecialchars($playlist['name']); ?></h4>
                            <span style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">
                                <?php 
                                $types = ['br' => 'Battle Royale', 'zerobuild' => 'Zero Build', 'festival' => 'Festival', 'racing' => 'Rocket Racing', 'other' => 'Outros'];
                                echo $types[$playlist['type']];
                                ?>
                            </span>
                        </div>
                    </div>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.5;">
                        <?php echo htmlspecialchars($playlist['desc']); ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Stats -->
    <div style="margin-top: 50px; text-align: center;">
        <div class="feature-card" style="display: inline-block; padding: 30px 50px;">
            <p style="color: var(--text-secondary); margin-bottom: 10px;">Total de modos principais</p>
            <p style="font-size: 3rem; font-weight: bold; color: var(--fn-blue);"><?php echo count($mainPlaylists); ?></p>
        </div>
    </div>
</div>

<style>
.playlist-card {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.playlist-card .item-card {
    height: 100%;
    transition: all 0.3s ease;
}

.playlist-card .item-card:hover {
    transform: translateX(10px);
    box-shadow: 0 10px 30px rgba(157, 78, 221, 0.3);
}

.filter-btn.active {
    background: var(--fn-purple) !important;
}
</style>

<script>
function filterPlaylists(type) {
    const cards = document.querySelectorAll('.playlist-card');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update button states
    buttons.forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('btn-fn-outline');
    });
    event.target.classList.add('active');
    event.target.classList.remove('btn-fn-outline');
    
    // Filter cards
    cards.forEach(card => {
        if(type === 'all' || card.dataset.type === type) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?php include 'footer.php'; ?>

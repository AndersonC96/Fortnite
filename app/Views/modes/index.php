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
        <?php foreach ($playlists as $index => $playlist): ?>
        <div class="playlist-card" data-type="<?= $playlist['type'] ?>" style="animation-delay: <?= $index * 0.05 ?>s;">
            <div class="item-card" style="border-left: 4px solid <?= $playlist['color'] ?>;">
                <div class="card-body" style="padding: 25px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <span style="font-size: 2.5rem;"><?= $playlist['icon'] ?></span>
                        <div>
                            <h4 style="margin: 0; color: <?= $playlist['color'] ?>;"><?= htmlspecialchars($playlist['name']) ?></h4>
                            <span style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">
                                <?= $types[$playlist['type']] ?? 'Outro' ?>
                            </span>
                        </div>
                    </div>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.5;">
                        <?= htmlspecialchars($playlist['desc']) ?>
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
            <p style="font-size: 3rem; font-weight: bold; color: var(--fn-blue);"><?= count($playlists) ?></p>
        </div>
    </div>
</div>

<style>
.playlist-card {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
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
    
    buttons.forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('btn-fn-outline');
    });
    event.target.classList.add('active');
    event.target.classList.remove('btn-fn-outline');
    
    cards.forEach(card => {
        card.style.display = (type === 'all' || card.dataset.type === type) ? 'block' : 'none';
    });
}
</script>

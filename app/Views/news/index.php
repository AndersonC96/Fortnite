<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">📰 Notícias do Fortnite</h1>
        <?php if ($lastUpdate): ?>
        <p style="color: var(--text-secondary); margin-top: 10px;">
            Última atualização: <?= date('d/m/Y H:i', strtotime($lastUpdate)) ?>
        </p>
        <?php endif; ?>
    </div>
    
    <!-- Tabs -->
    <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 40px; flex-wrap: wrap;">
        <button class="btn-fn tab-btn active" onclick="showTab('all')">📋 Todas</button>
        <button class="btn-fn btn-fn-outline tab-btn" onclick="showTab('br')">🎮 Battle Royale</button>
        <button class="btn-fn btn-fn-outline tab-btn" onclick="showTab('stw')">⚔️ Salve o Mundo</button>
    </div>
    
    <!-- BR News -->
    <div id="tab-all" class="tab-content">
        <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
            <?php 
            $allNews = array_merge(
                array_map(fn($n) => array_merge($n, ['source' => 'br']), $brNews),
                array_map(fn($n) => array_merge($n, ['source' => 'stw']), $stwNews)
            );
            usort($allNews, fn($a, $b) => ($b['sortingPriority'] ?? 0) - ($a['sortingPriority'] ?? 0));
            
            foreach ($allNews as $index => $news): 
                $imageUrl = $news['tileImage'] ?? $news['image'] ?? '';
                $priority = $news['sortingPriority'] ?? 0;
            ?>
            <div class="item-card news-card" style="animation-delay: <?= $index * 0.05 ?>s;">
                <?php if ($priority >= 10): ?>
                <span style="position: absolute; top: 10px; right: 10px; background: var(--fn-yellow); color: #000; padding: 3px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">
                    ⭐ DESTAQUE
                </span>
                <?php endif; ?>
                
                <span style="position: absolute; top: 10px; left: 10px; background: <?= $news['source'] === 'br' ? 'var(--fn-blue)' : 'var(--fn-orange)' ?>; padding: 3px 10px; border-radius: 4px; font-size: 0.75rem;">
                    <?= $news['source'] === 'br' ? '🎮 BR' : '⚔️ STW' ?>
                </span>
                
                <?php if ($imageUrl): ?>
                <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($news['title'] ?? '') ?>" loading="lazy">
                <?php endif; ?>
                
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($news['title'] ?? 'Sem título') ?></h5>
                    <p class="card-text" style="color: var(--text-secondary); font-size: 0.9rem;">
                        <?= htmlspecialchars(substr($news['body'] ?? '', 0, 120)) ?>...
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div id="tab-br" class="tab-content" style="display: none;">
        <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
            <?php foreach ($brNews as $index => $news): 
                $imageUrl = $news['tileImage'] ?? $news['image'] ?? '';
            ?>
            <div class="item-card news-card" style="animation-delay: <?= $index * 0.05 ?>s;">
                <?php if ($imageUrl): ?>
                <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($news['title'] ?? '') ?>" loading="lazy">
                <?php endif; ?>
                
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($news['title'] ?? 'Sem título') ?></h5>
                    <p class="card-text" style="color: var(--text-secondary); font-size: 0.9rem;">
                        <?= htmlspecialchars($news['body'] ?? '') ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div id="tab-stw" class="tab-content" style="display: none;">
        <?php if (empty($stwNews)): ?>
        <div style="text-align: center; padding: 60px;">
            <span style="font-size: 4rem;">⚔️</span>
            <h3 style="margin: 20px 0;">Nenhuma notícia de Salve o Mundo</h3>
            <p style="color: var(--text-secondary);">Não há notícias disponíveis no momento.</p>
        </div>
        <?php else: ?>
        <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
            <?php foreach ($stwNews as $index => $news): 
                $imageUrl = $news['image'] ?? '';
            ?>
            <div class="item-card news-card" style="animation-delay: <?= $index * 0.05 ?>s;">
                <?php if ($imageUrl): ?>
                <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($news['title'] ?? '') ?>" loading="lazy">
                <?php endif; ?>
                
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($news['title'] ?? 'Sem título') ?></h5>
                    <p class="card-text" style="color: var(--text-secondary); font-size: 0.9rem;">
                        <?= htmlspecialchars($news['body'] ?? '') ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.news-card {
    position: relative;
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.tab-btn.active {
    background: var(--fn-purple) !important;
}
</style>

<script>
function showTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('active');
        el.classList.add('btn-fn-outline');
    });
    
    document.getElementById('tab-' + tab).style.display = 'block';
    event.target.classList.add('active');
    event.target.classList.remove('btn-fn-outline');
}
</script>

<?php $base = '/Fortnite/public'; ?>
<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🛒 Loja de Hoje</h1>
        <?php if ($shopDate): ?>
        <p style="color: var(--text-secondary); margin-top: 10px;">
            Atualizada em: <?= date('d/m/Y H:i', strtotime($shopDate)) ?>
        </p>
        <?php endif; ?>
    </div>
    
    <!-- Search Bar -->
    <form class="search-box" action="<?= $base ?>/shop" method="GET" style="max-width: 500px; margin: 0 auto 40px;">
        <input type="text" name="query" placeholder="🔍 Buscar na loja..." 
               value="<?= htmlspecialchars($searchQuery) ?>">
        <button type="submit">Buscar</button>
    </form>
    
    <?php if (empty($sections)): ?>
    <div style="text-align: center; padding: 60px;">
        <p style="font-size: 3rem;">🛍️</p>
        <h3>Nenhum item encontrado</h3>
        <p style="color: var(--text-secondary);">Tente buscar por outro termo.</p>
    </div>
    <?php else: ?>
    
    <?php foreach ($sections as $sectionName => $items): ?>
    <section style="margin-bottom: 50px;">
        <h2 style="margin-bottom: 25px; display: flex; align-items: center; gap: 15px;">
            <span class="text-gradient"><?= htmlspecialchars($sectionName) ?></span>
            <span style="background: var(--fn-purple); padding: 4px 12px; border-radius: 20px; font-size: 0.85rem;">
                <?= count($items) ?> itens
            </span>
        </h2>
        
        <div class="items-grid">
            <?php foreach ($items as $item): ?>
            <div class="item-card rarity-<?= htmlspecialchars($item['rarity']) ?>">
                <?php if ($item['banner']): ?>
                <span class="item-badge" style="position: absolute; top: 10px; right: 10px; background: var(--fn-orange); padding: 3px 8px; border-radius: 4px; font-size: 0.7rem;">
                    <?= htmlspecialchars($item['banner']) ?>
                </span>
                <?php endif; ?>
                
                <?php if ($item['series']): ?>
                <span class="series-badge" style="position: absolute; top: 10px; left: 10px; background: rgba(0,0,0,0.7); padding: 3px 8px; border-radius: 4px; font-size: 0.7rem;">
                    ⭐ <?= htmlspecialchars($item['series']) ?>
                </span>
                <?php endif; ?>
                
                <img src="<?= htmlspecialchars($item['image']) ?>" 
                     alt="<?= htmlspecialchars($item['name']) ?>"
                     onerror="this.src='<?= $base ?>/img/logo.png'"
                     loading="lazy">
                
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                    
                    <?php if ($item['type']): ?>
                    <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 8px;">
                        <?= htmlspecialchars($item['type']) ?>
                    </p>
                    <?php endif; ?>
                    
                    <p class="card-text">
                        <?php if ($item['regularPrice'] > $item['price']): ?>
                        <span style="text-decoration: line-through; color: var(--text-secondary); margin-right: 8px;">
                            <?= number_format($item['regularPrice'], 0, ',', '.') ?>
                        </span>
                        <?php endif; ?>
                        💰 <?= number_format($item['price'], 0, ',', '.') ?> V-Bucks
                    </p>
                    
                    <?php if ($item['giftable']): ?>
                    <span style="font-size: 0.75rem; color: var(--fn-green);">🎁 Presenteável</span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endforeach; ?>
    
    <?php endif; ?>
</div>

<style>
.item-card {
    position: relative;
}
</style>

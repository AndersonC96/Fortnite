<?php $base = '/Fortnite/public'; ?>
<div class="page-container container-fn">
    <a href="<?= $base ?>/cosmetics" class="btn-fn btn-fn-outline" style="margin-bottom: 30px;">← Voltar</a>
    
    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px; max-width: 1200px; margin: 0 auto;">
        <!-- Image Section -->
        <div>
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <?php 
                $imageUrl = $item['images']['featured'] ?? $item['images']['icon'] ?? $base . '/img/logo.png';
                $rarity = strtolower($item['rarity']['value'] ?? 'common');
                ?>
                <img src="<?= htmlspecialchars($imageUrl) ?>" 
                     alt="<?= htmlspecialchars($item['name']) ?>" 
                     style="max-width: 100%; border-radius: 12px; border-bottom: 4px solid var(--rarity-<?= $rarity ?>);"
                     onerror="this.src='<?= $base ?>/img/logo.png'">
                
                <!-- LEGO/Bean versions -->
                <div style="display: flex; gap: 10px; margin-top: 15px; justify-content: center;">
                    <?php if (!empty($item['images']['lego'])): ?>
                    <div style="flex: 1; max-width: 120px;">
                        <img src="<?= htmlspecialchars($item['images']['lego']) ?>" 
                             alt="LEGO Version" style="width: 100%; border-radius: 8px;">
                        <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 5px;">🧱 LEGO</p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($item['images']['bean'])): ?>
                    <div style="flex: 1; max-width: 120px;">
                        <img src="<?= htmlspecialchars($item['images']['bean']) ?>" 
                             alt="Fall Guys Version" style="width: 100%; border-radius: 8px;">
                        <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 5px;">🫘 Fall Guys</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Info Section -->
        <div>
            <!-- Title and Series Badge -->
            <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap; margin-bottom: 20px;">
                <h1 style="margin: 0;"><?= htmlspecialchars($item['name']) ?></h1>
                
                <?php if (!empty($item['series'])): ?>
                <span style="background: linear-gradient(135deg, <?= htmlspecialchars($item['series']['colors']['color1'] ?? 'var(--fn-purple)') ?>, <?= htmlspecialchars($item['series']['colors']['color2'] ?? 'var(--fn-blue)') ?>); padding: 5px 12px; border-radius: 20px; font-size: 0.85rem;">
                    ⭐ <?= htmlspecialchars($item['series']['value']) ?>
                </span>
                <?php endif; ?>
            </div>
            
            <!-- Rarity Badge -->
            <span style="display: inline-block; background: var(--rarity-<?= $rarity ?>); padding: 5px 15px; border-radius: 20px; margin-bottom: 20px; text-transform: uppercase; font-size: 0.85rem;">
                <?= htmlspecialchars(ucfirst($item['rarity']['value'] ?? 'Common')) ?>
            </span>
            
            <!-- Description -->
            <?php if (!empty($item['description'])): ?>
            <p style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px;">
                "<?= htmlspecialchars($item['description']) ?>"
            </p>
            <?php endif; ?>
            
            <!-- Info Cards -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                <?php if (!empty($item['type'])): ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Tipo</p>
                    <p style="font-weight: bold;"><?= htmlspecialchars($item['type']['displayValue']) ?></p>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($item['set'])): ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Conjunto</p>
                    <p style="font-weight: bold;"><?= htmlspecialchars($item['set']['value']) ?></p>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($item['introduction'])): ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Introduzido</p>
                    <p style="font-weight: bold;">
                        <?= htmlspecialchars($item['introduction']['text'] ?? "Capítulo {$item['introduction']['chapter']} - Temporada {$item['introduction']['season']}") ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($item['added'])): ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Adicionado em</p>
                    <p style="font-weight: bold;"><?= date('d/m/Y', strtotime($item['added'])) ?></p>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Showcase Video -->
            <?php if (!empty($item['showcaseVideo'])): ?>
            <div style="margin-top: 30px;">
                <h3 style="margin-bottom: 15px;">🎬 Vídeo de Demonstração</h3>
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px;">
                    <iframe 
                        src="https://www.youtube.com/embed/<?= htmlspecialchars($item['showcaseVideo']) ?>" 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Variants Section -->
    <?php if (!empty($item['variants'])): ?>
    <div style="margin-top: 50px; max-width: 1200px; margin-left: auto; margin-right: auto;">
        <h2 style="margin-bottom: 25px;">
            <span class="text-gradient">🎨 Variantes</span>
        </h2>
        
        <?php foreach ($item['variants'] as $variant): ?>
        <div class="feature-card" style="padding: 20px; margin-bottom: 20px;">
            <h4 style="margin-bottom: 15px;"><?= htmlspecialchars($variant['type'] ?? $variant['channel']) ?></h4>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <?php foreach ($variant['options'] as $option): ?>
                <div style="text-align: center; width: 80px;">
                    <?php if (!empty($option['image'])): ?>
                    <img src="<?= htmlspecialchars($option['image']) ?>" 
                         alt="<?= htmlspecialchars($option['name']) ?>"
                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                    <?php endif; ?>
                    <p style="font-size: 0.75rem; margin-top: 5px;"><?= htmlspecialchars($option['name']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<style>
@media (max-width: 768px) {
    .page-container > div:first-of-type:not(.btn-fn) {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php 
$base = '/Fortnite/public';

// Safe string helper function
function safeStr($value, $default = ''): string {
    if (is_string($value)) {
        return $value;
    }
    return $default;
}

// Get image URL safely
$featuredImg = $item['images']['featured'] ?? null;
$iconImg = $item['images']['icon'] ?? null;

$imageUrl = $base . '/img/logo.png';
if (is_string($featuredImg) && !empty($featuredImg)) {
    $imageUrl = $featuredImg;
} elseif (is_string($iconImg) && !empty($iconImg)) {
    $imageUrl = $iconImg;
}

$rarity = strtolower(safeStr($item['rarity']['value'] ?? null, 'common'));
$itemName = safeStr($item['name'] ?? null, 'Cosmético');
?>
<div class="page-container container-fn">
    <a href="<?= $base ?>/cosmetics" class="btn-fn btn-fn-outline" style="margin-bottom: 30px;">← Voltar</a>
    
    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px; max-width: 1200px; margin: 0 auto;">
        <!-- Image Section -->
        <div>
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <img src="<?= htmlspecialchars($imageUrl) ?>" 
                     alt="<?= htmlspecialchars($itemName) ?>" 
                     style="max-width: 100%; border-radius: 12px; border-bottom: 4px solid var(--rarity-<?= $rarity ?>);"
                     onerror="this.src='<?= $base ?>/img/logo.png'">
                
                <!-- LEGO/Bean versions -->
                <?php 
                $legoImg = $item['images']['lego'] ?? null;
                $beanImg = $item['images']['bean'] ?? null;
                ?>
                <div style="display: flex; gap: 10px; margin-top: 15px; justify-content: center;">
                    <?php if (!empty($legoImg) && is_string($legoImg)): ?>
                    <div style="flex: 1; max-width: 120px;">
                        <img src="<?= htmlspecialchars($legoImg) ?>" 
                             alt="LEGO Version" style="width: 100%; border-radius: 8px;">
                        <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 5px;">🧱 LEGO</p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($beanImg) && is_string($beanImg)): ?>
                    <div style="flex: 1; max-width: 120px;">
                        <img src="<?= htmlspecialchars($beanImg) ?>" 
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
                <h1 style="margin: 0;"><?= htmlspecialchars($itemName) ?></h1>
                
                <?php 
                $series = $item['series'] ?? null;
                if (!empty($series) && is_array($series)): 
                    $seriesValue = safeStr($series['value'] ?? null, '');
                    $color1 = safeStr($series['colors']['color1'] ?? null, 'var(--fn-purple)');
                    $color2 = safeStr($series['colors']['color2'] ?? null, 'var(--fn-blue)');
                ?>
                <span style="background: linear-gradient(135deg, <?= htmlspecialchars($color1) ?>, <?= htmlspecialchars($color2) ?>); padding: 5px 12px; border-radius: 20px; font-size: 0.85rem;">
                    ⭐ <?= htmlspecialchars($seriesValue) ?>
                </span>
                <?php endif; ?>
            </div>
            
            <!-- Rarity Badge -->
            <span style="display: inline-block; background: var(--rarity-<?= $rarity ?>); padding: 5px 15px; border-radius: 20px; margin-bottom: 20px; text-transform: uppercase; font-size: 0.85rem;">
                <?= htmlspecialchars(ucfirst($rarity)) ?>
            </span>
            
            <!-- Description -->
            <?php $description = safeStr($item['description'] ?? null, ''); ?>
            <?php if (!empty($description)): ?>
            <p style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px;">
                "<?= htmlspecialchars($description) ?>"
            </p>
            <?php endif; ?>
            
            <!-- Info Cards -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                <?php 
                $type = $item['type'] ?? null;
                if (!empty($type) && is_array($type)): 
                ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Tipo</p>
                    <p style="font-weight: bold;"><?= htmlspecialchars(safeStr($type['displayValue'] ?? null, 'N/A')) ?></p>
                </div>
                <?php endif; ?>
                
                <?php 
                $set = $item['set'] ?? null;
                if (!empty($set) && is_array($set)): 
                ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Conjunto</p>
                    <p style="font-weight: bold;"><?= htmlspecialchars(safeStr($set['value'] ?? null, 'N/A')) ?></p>
                </div>
                <?php endif; ?>
                
                <?php 
                $intro = $item['introduction'] ?? null;
                if (!empty($intro) && is_array($intro)): 
                    $introText = safeStr($intro['text'] ?? null, '');
                    if (empty($introText)) {
                        $chapter = $intro['chapter'] ?? '?';
                        $season = $intro['season'] ?? '?';
                        $introText = "Capítulo $chapter - Temporada $season";
                    }
                ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Introduzido</p>
                    <p style="font-weight: bold;"><?= htmlspecialchars($introText) ?></p>
                </div>
                <?php endif; ?>
                
                <?php 
                $added = safeStr($item['added'] ?? null, '');
                if (!empty($added)): 
                ?>
                <div class="feature-card" style="padding: 15px;">
                    <p style="color: var(--text-secondary); font-size: 0.8rem;">Adicionado em</p>
                    <p style="font-weight: bold;"><?= date('d/m/Y', strtotime($added)) ?></p>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Showcase Video -->
            <?php 
            $video = safeStr($item['showcaseVideo'] ?? null, '');
            if (!empty($video)): 
            ?>
            <div style="margin-top: 30px;">
                <h3 style="margin-bottom: 15px;">🎬 Vídeo de Demonstração</h3>
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px;">
                    <iframe 
                        src="https://www.youtube.com/embed/<?= htmlspecialchars($video) ?>" 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Variants Section -->
    <?php 
    $variants = $item['variants'] ?? [];
    if (!empty($variants) && is_array($variants)): 
    ?>
    <div style="margin-top: 50px; max-width: 1200px; margin-left: auto; margin-right: auto;">
        <h2 style="margin-bottom: 25px;">
            <span class="text-gradient">🎨 Variantes</span>
        </h2>
        
        <?php foreach ($variants as $variant): 
            if (!is_array($variant)) continue;
        ?>
        <div class="feature-card" style="padding: 20px; margin-bottom: 20px;">
            <h4 style="margin-bottom: 15px;"><?= htmlspecialchars(safeStr($variant['type'] ?? $variant['channel'] ?? null, 'Variante')) ?></h4>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <?php 
                $options = $variant['options'] ?? [];
                foreach ($options as $option): 
                    if (!is_array($option)) continue;
                    $optionImage = safeStr($option['image'] ?? null, '');
                    $optionName = safeStr($option['name'] ?? null, '');
                ?>
                <div style="text-align: center; width: 80px;">
                    <?php if (!empty($optionImage)): ?>
                    <img src="<?= htmlspecialchars($optionImage) ?>" 
                         alt="<?= htmlspecialchars($optionName) ?>"
                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                    <?php endif; ?>
                    <p style="font-size: 0.75rem; margin-top: 5px;"><?= htmlspecialchars($optionName) ?></p>
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

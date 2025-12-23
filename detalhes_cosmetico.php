<?php
include 'apiConfig.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
    $cosmeticId = $_GET['id'];
    $cosmeticData = callFortniteAPI("cosmetics/br/$cosmeticId");
    
    if(!$cosmeticData || $cosmeticData['status'] != 200) {
        header('Location: cosmeticos.php');
        exit;
    }
    
    $pageTitle = $cosmeticData['data']['name'] . ' - Fortnite Hub';
} else {
    header('Location: cosmeticos.php');
    exit;
}

include 'header.php';
$item = $cosmeticData['data'];
$rarity = strtolower($item['rarity']['value'] ?? 'common');
$hasSeries = !empty($item['series']['value']);
$seriesValue = $item['series']['value'] ?? '';
?>

<div class="page-container container-fn">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 50px; align-items: start;">
            
            <!-- Image Section -->
            <div>
                <div class="item-card rarity-<?php echo $rarity; ?>" style="padding: 0; overflow: hidden; margin-bottom: 20px;">
                    <?php 
                    // Choose best image: featured > icon > smallIcon
                    $mainImage = $item['images']['featured'] ?? $item['images']['icon'] ?? $item['images']['smallIcon'] ?? './IMG/logo.png';
                    ?>
                    <img src="<?php echo htmlspecialchars($mainImage); ?>" 
                         alt="<?php echo htmlspecialchars($item['name']); ?>" 
                         style="width: 100%; height: auto;"
                         onerror="this.src='./IMG/logo.png'">
                </div>
                
                <!-- LEGO Version if available -->
                <?php if(!empty($item['images']['lego'])): ?>
                <div class="feature-card" style="margin-bottom: 20px;">
                    <h4 style="color: var(--fn-yellow); margin-bottom: 15px; text-align: center;">🧱 Versão LEGO</h4>
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <?php if(!empty($item['images']['lego']['small'])): ?>
                        <img src="<?php echo htmlspecialchars($item['images']['lego']['small']); ?>" 
                             alt="LEGO Small" style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px; background: rgba(255,255,255,0.1);">
                        <?php endif; ?>
                        <?php if(!empty($item['images']['lego']['large'])): ?>
                        <img src="<?php echo htmlspecialchars($item['images']['lego']['large']); ?>" 
                             alt="LEGO Large" style="width: 120px; height: 120px; object-fit: contain; border-radius: 8px; background: rgba(255,255,255,0.1);">
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Bean/Fall Guys Version if available -->
                <?php if(!empty($item['images']['bean'])): ?>
                <div class="feature-card" style="margin-bottom: 20px;">
                    <h4 style="color: var(--fn-pink); margin-bottom: 15px; text-align: center;">🫘 Versão Fall Guys</h4>
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <?php if(!empty($item['images']['bean']['small'])): ?>
                        <img src="<?php echo htmlspecialchars($item['images']['bean']['small']); ?>" 
                             alt="Bean Small" style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px; background: rgba(255,255,255,0.1);">
                        <?php endif; ?>
                        <?php if(!empty($item['images']['bean']['large'])): ?>
                        <img src="<?php echo htmlspecialchars($item['images']['bean']['large']); ?>" 
                             alt="Bean Large" style="width: 120px; height: 120px; object-fit: contain; border-radius: 8px; background: rgba(255,255,255,0.1);">
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Details Section -->
            <div>
                <!-- Series Badge -->
                <?php if($hasSeries): 
                    $seriesColors = $item['series']['colors'] ?? [];
                    $seriesBg = 'linear-gradient(135deg, var(--fn-purple), var(--fn-blue))';
                    if(count($seriesColors) >= 2){
                        $seriesBg = 'linear-gradient(135deg, #' . substr($seriesColors[0], 0, 6) . ', #' . substr($seriesColors[1], 0, 6) . ')';
                    }
                ?>
                <span style="display: inline-block; padding: 8px 20px; background: <?php echo $seriesBg; ?>; color: white; border-radius: 25px; font-size: 0.9rem; margin-bottom: 15px; font-weight: 700; text-transform: uppercase; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    ⭐ <?php echo htmlspecialchars($seriesValue); ?>
                </span>
                <?php endif; ?>
                
                <!-- Rarity Badge -->
                <span style="display: inline-block; padding: 6px 16px; background: var(--rarity-<?php echo $rarity; ?>); color: black; border-radius: 20px; font-size: 0.85rem; margin-bottom: 15px; font-weight: 600; text-transform: uppercase; margin-left: <?php echo $hasSeries ? '10px' : '0'; ?>;">
                    <?php echo htmlspecialchars($item['rarity']['displayValue'] ?? 'Common'); ?>
                </span>
                
                <h1 style="font-size: 2.8rem; margin-bottom: 10px; line-height: 1.2;">
                    <?php echo htmlspecialchars($item['name']); ?>
                </h1>
                
                <p style="color: var(--text-secondary); font-size: 1.15rem; margin-bottom: 25px; font-style: italic;">
                    "<?php echo htmlspecialchars($item['description'] ?? 'Sem descrição disponível.'); ?>"
                </p>
                
                <!-- Info Cards Grid -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 25px;">
                    <!-- Type -->
                    <div class="feature-card" style="padding: 15px;">
                        <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 5px;">📦 Tipo</p>
                        <p style="font-weight: 600; color: var(--fn-blue);"><?php echo htmlspecialchars($item['type']['displayValue'] ?? '-'); ?></p>
                    </div>
                    
                    <!-- Set -->
                    <div class="feature-card" style="padding: 15px;">
                        <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 5px;">🎯 Conjunto</p>
                        <p style="font-weight: 600; color: var(--fn-purple);"><?php echo htmlspecialchars($item['set']['value'] ?? 'Nenhum'); ?></p>
                    </div>
                    
                    <!-- Introduction -->
                    <?php if(isset($item['introduction'])): ?>
                    <div class="feature-card" style="padding: 15px;">
                        <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 5px;">📅 Introdução</p>
                        <p style="font-weight: 600; color: var(--fn-yellow);">
                            Cap. <?php echo $item['introduction']['chapter']; ?>, Temp. <?php echo $item['introduction']['season']; ?>
                        </p>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Added Date -->
                    <?php if(!empty($item['added'])): ?>
                    <div class="feature-card" style="padding: 15px;">
                        <p style="color: var(--text-secondary); font-size: 0.8rem; margin-bottom: 5px;">🆕 Adicionado</p>
                        <p style="font-weight: 600; color: var(--fn-green);">
                            <?php 
                            $addedDate = new DateTime($item['added']);
                            echo $addedDate->format('d/m/Y');
                            ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Set Info (if available) -->
                <?php if(!empty($item['set']['text'])): ?>
                <div class="feature-card" style="padding: 15px; margin-bottom: 25px; border-left: 4px solid var(--fn-purple);">
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">
                        ℹ️ <?php echo htmlspecialchars($item['set']['text']); ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <!-- Showcase Video -->
                <?php if(!empty($item['showcaseVideo'])): ?>
                <div class="feature-card" style="padding: 20px; margin-bottom: 25px;">
                    <h4 style="color: var(--fn-pink); margin-bottom: 15px;">🎬 Vídeo de Demonstração</h4>
                    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px;">
                        <iframe 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                            src="https://www.youtube.com/embed/<?php echo htmlspecialchars($item['showcaseVideo']); ?>" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Action Buttons -->
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="cosmeticos.php" class="btn-fn btn-fn-outline">← Voltar aos Cosméticos</a>
                    
                    <?php if(!empty($item['set']['value'])): ?>
                    <a href="cosmeticos.php?query=<?php echo urlencode($item['set']['value']); ?>" class="btn-fn">
                        🔍 Ver Conjunto Completo
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Variants Section -->
        <?php if(!empty($item['variants'])): ?>
        <div style="margin-top: 60px;">
            <h2 style="text-align: center; margin-bottom: 30px;">
                <span class="text-gradient">🎨 Variantes & Estilos</span>
            </h2>
            <p style="text-align: center; color: var(--text-secondary); margin-bottom: 40px;">
                Este cosmético possui <?php echo count($item['variants']); ?> categoria(s) de personalização
            </p>
            
            <?php foreach($item['variants'] as $variant): ?>
            <div class="feature-card" style="margin-bottom: 30px; padding: 25px;">
                <h4 style="color: var(--fn-blue); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--fn-blue); color: black; padding: 4px 12px; border-radius: 15px; font-size: 0.8rem;">
                        <?php echo htmlspecialchars(ucfirst($variant['type'] ?? 'Estilo')); ?>
                    </span>
                    <?php echo htmlspecialchars($variant['channel']); ?>
                </h4>
                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <?php foreach($variant['options'] as $option): ?>
                    <div style="text-align: center; min-width: 100px;">
                        <?php if(!empty($option['image'])): ?>
                        <img src="<?php echo htmlspecialchars($option['image']); ?>" 
                             alt="<?php echo htmlspecialchars($option['name']); ?>" 
                             style="width: 90px; height: 90px; object-fit: contain; margin-bottom: 10px; border-radius: 12px; background: rgba(255,255,255,0.05); padding: 5px;"
                             onerror="this.style.display='none'">
                        <?php endif; ?>
                        <p style="font-size: 0.85rem; font-weight: 500;"><?php echo htmlspecialchars($option['name']); ?></p>
                        <?php if(!empty($option['unlockRequirements'])): ?>
                        <p style="font-size: 0.7rem; color: var(--fn-yellow); margin-top: 5px;">
                            🔓 <?php echo htmlspecialchars($option['unlockRequirements']); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <!-- Built-in Emotes / Extras -->
        <?php if(!empty($item['builtInEmoteIds']) || !empty($item['customExclusiveCallout'])): ?>
        <div style="margin-top: 40px;">
            <h2 style="text-align: center; margin-bottom: 30px;">
                <span class="text-gradient">✨ Extras Especiais</span>
            </h2>
            
            <?php if(!empty($item['customExclusiveCallout'])): ?>
            <div class="feature-card" style="padding: 20px; text-align: center; border: 1px solid var(--fn-yellow);">
                <p style="color: var(--fn-yellow);">⚠️ <?php echo htmlspecialchars($item['customExclusiveCallout']); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if(!empty($item['builtInEmoteIds'])): ?>
            <div class="feature-card" style="padding: 20px; margin-top: 15px;">
                <h4 style="color: var(--fn-green); margin-bottom: 15px;">💃 Emotes Integrados</h4>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <?php foreach($item['builtInEmoteIds'] as $emoteId): ?>
                    <span style="background: rgba(0,255,136,0.2); color: var(--fn-green); padding: 5px 12px; border-radius: 15px; font-size: 0.85rem;">
                        <?php echo htmlspecialchars($emoteId); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
    </div>
</div>

<style>
/* Responsive adjustments */
@media (max-width: 768px) {
    .page-container > div > div:first-child {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php include 'footer.php'; ?>
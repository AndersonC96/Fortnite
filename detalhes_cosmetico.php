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
?>

<div class="page-container container-fn">
    <div style="max-width: 1000px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
            
            <!-- Image -->
            <div class="feature-card" style="padding: 0; overflow: hidden;">
                <img src="<?php echo htmlspecialchars($item['images']['icon'] ?? $item['images']['featured'] ?? './IMG/logo.png'); ?>" 
                     alt="<?php echo htmlspecialchars($item['name']); ?>" 
                     style="width: 100%; height: auto;">
            </div>
            
            <!-- Details -->
            <div>
                <span style="display: inline-block; padding: 6px 16px; background: var(--rarity-<?php echo $rarity; ?>); color: black; border-radius: 20px; font-size: 0.85rem; margin-bottom: 15px; font-weight: 600; text-transform: uppercase;">
                    <?php echo htmlspecialchars($item['rarity']['displayValue'] ?? 'Common'); ?>
                </span>
                
                <h1 style="font-size: 2.5rem; margin-bottom: 10px;"><?php echo htmlspecialchars($item['name']); ?></h1>
                
                <p style="color: var(--text-secondary); font-size: 1.1rem; margin-bottom: 30px;">
                    <?php echo htmlspecialchars($item['description'] ?? 'Sem descrição disponível.'); ?>
                </p>
                
                <div class="feature-card" style="margin-bottom: 20px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <p style="color: var(--text-secondary); margin-bottom: 5px;">Tipo</p>
                            <p style="font-weight: 600;"><?php echo htmlspecialchars($item['type']['displayValue'] ?? '-'); ?></p>
                        </div>
                        <div>
                            <p style="color: var(--text-secondary); margin-bottom: 5px;">Set</p>
                            <p style="font-weight: 600;"><?php echo htmlspecialchars($item['set']['text'] ?? 'Nenhum'); ?></p>
                        </div>
                        <?php if(isset($item['introduction'])): ?>
                        <div style="grid-column: 1/-1;">
                            <p style="color: var(--text-secondary); margin-bottom: 5px;">Introdução</p>
                            <p style="font-weight: 600;">Capítulo <?php echo $item['introduction']['chapter']; ?>, Temporada <?php echo $item['introduction']['season']; ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <a href="cosmeticos.php" class="btn-fn btn-fn-outline">← Voltar aos Cosméticos</a>
            </div>
        </div>
        
        <!-- Variants -->
        <?php if(!empty($item['variants'])): ?>
        <div style="margin-top: 60px;">
            <h2 style="text-align: center; margin-bottom: 30px;">
                <span class="text-gradient">🎨 Variantes</span>
            </h2>
            <?php foreach($item['variants'] as $variant): ?>
            <div style="margin-bottom: 30px;">
                <h4 style="color: var(--fn-blue); margin-bottom: 15px;"><?php echo htmlspecialchars($variant['channel']); ?></h4>
                <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                    <?php foreach($variant['options'] as $option): ?>
                    <div class="feature-card" style="padding: 15px; text-align: center; min-width: 120px;">
                        <img src="<?php echo htmlspecialchars($option['image']); ?>" alt="<?php echo htmlspecialchars($option['name']); ?>" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 10px;">
                        <p style="font-size: 0.85rem;"><?php echo htmlspecialchars($option['name']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
<?php 
include 'apiConfig.php'; 
$pageTitle = 'Loja Diária - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🛒 Loja Diária</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Itens disponíveis hoje na Item Shop</p>
    </div>
    
    <div class="items-grid">
        <?php
        $storeData = callFortniteAPI('shop/br');
        if($storeData && $storeData['status'] == 200 && !empty($storeData['data']['featured']['entries'])){
            foreach($storeData['data']['featured']['entries'] as $entry){
                $imageUrl = $entry['bundle']['image'] ?? ($entry['newDisplayAsset']['materialInstances'][0]['images']['Background'] ?? './IMG/logo.png');
                $itemName = $entry['bundle']['name'] ?? 'Item';
                $itemInfo = $entry['bundle']['info'] ?? '';
                $regularPrice = $entry['regularPrice'] ?? 0;
                $finalPrice = $entry['finalPrice'] ?? 0;
                $discount = ($regularPrice > $finalPrice) ? round((1 - $finalPrice/$regularPrice) * 100) : 0;
                
                echo "<div class='item-card rarity-legendary'>";
                echo "<img src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($itemName) . "' onerror=\"this.src='./IMG/logo.png'\">";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($itemName, ENT_QUOTES, 'UTF-8') . "</h5>";
                if($itemInfo) {
                    echo "<p class='card-text' style='font-size: 0.8rem; opacity: 0.7;'>" . htmlspecialchars($itemInfo, ENT_QUOTES, 'UTF-8') . "</p>";
                }
                echo "<p class='card-text' style='margin-top: 10px;'>";
                if($discount > 0) {
                    echo "<span style='text-decoration: line-through; opacity: 0.5;'>" . number_format($regularPrice, 0, ',', '.') . "</span> ";
                    echo "<span style='color: var(--fn-green); font-weight: 600;'>" . number_format($finalPrice, 0, ',', '.') . " V-Bucks</span>";
                    echo "<span style='background: var(--fn-green); color: black; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; margin-left: 8px;'>-$discount%</span>";
                } else {
                    echo "<span style='color: var(--fn-yellow);'>💰 " . number_format($finalPrice, 0, ',', '.') . " V-Bucks</span>";
                }
                echo "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div style='text-align: center; grid-column: 1/-1; padding: 60px;'>";
            echo "<p style='font-size: 1.2rem;'>😕 Não foi possível carregar os itens da loja.</p>";
            echo "<p style='color: var(--text-secondary);'>Tente novamente mais tarde.</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
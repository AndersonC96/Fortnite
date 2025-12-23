<?php 
include 'apiConfig.php'; 
$pageTitle = 'Loja Diária - Fortnite Hub';
include 'header.php'; 

// Get search query
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🛒 Loja Diária</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Itens disponíveis hoje na Item Shop</p>
        
        <!-- Search Bar -->
        <form class="search-box" method="GET" action="">
            <input type="text" name="q" placeholder="🔍 Buscar na loja..." value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>
    
    <?php
    $storeData = callFortniteAPI('shop');
    
    if($storeData && $storeData['status'] == 200 && !empty($storeData['data']['entries'])){
        
        // Group items by layout/section
        $sections = [];
        foreach($storeData['data']['entries'] as $entry){
            $sectionName = $entry['layout']['name'] ?? 'Outros';
            if(!isset($sections[$sectionName])){
                $sections[$sectionName] = [];
            }
            $sections[$sectionName][] = $entry;
        }
        
        // Show shop date
        $shopDate = $storeData['data']['date'] ?? '';
        if($shopDate){
            $date = new DateTime($shopDate);
            echo "<p style='text-align: center; color: var(--fn-yellow); margin-bottom: 30px;'>";
            echo "📅 Atualizada: " . $date->format('d/m/Y H:i') . " UTC";
            echo "</p>";
        }
        
        foreach($sections as $sectionName => $entries){
            // Filter by search query if provided
            $filteredEntries = [];
            foreach($entries as $entry){
                // Get item name for filtering
                $itemName = '';
                if(!empty($entry['bundle']['name'])){
                    $itemName = $entry['bundle']['name'];
                } elseif(!empty($entry['brItems'][0]['name'])){
                    $itemName = $entry['brItems'][0]['name'];
                } elseif(!empty($entry['tracks'][0]['title'])){
                    $itemName = $entry['tracks'][0]['title'];
                } elseif(!empty($entry['cars'][0]['name'])){
                    $itemName = $entry['cars'][0]['name'];
                }
                
                // Check if matches search
                if(empty($searchQuery) || stripos($itemName, $searchQuery) !== false || stripos($sectionName, $searchQuery) !== false){
                    $filteredEntries[] = $entry;
                }
            }
            
            if(empty($filteredEntries)) continue;
            
            echo "<div class='shop-section' style='margin-bottom: 60px;'>";
            echo "<h2 style='color: var(--fn-purple); margin-bottom: 25px; display: flex; align-items: center; gap: 10px;'>";
            echo "<span style='background: linear-gradient(135deg, var(--fn-purple), var(--fn-blue)); padding: 8px 16px; border-radius: 8px; font-size: 0.9rem;'>$sectionName</span>";
            echo "<span style='color: var(--text-secondary); font-size: 0.9rem;'>(" . count($filteredEntries) . " itens)</span>";
            echo "</h2>";
            echo "<div class='items-grid'>";
            
            foreach($filteredEntries as $entry){
                // Get image from various possible sources
                $imageUrl = './IMG/logo.png';
                if(!empty($entry['bundle']['image'])){
                    $imageUrl = $entry['bundle']['image'];
                } elseif(!empty($entry['newDisplayAsset']['renderImages'][0]['image'])){
                    $imageUrl = $entry['newDisplayAsset']['renderImages'][0]['image'];
                } elseif(!empty($entry['brItems'][0]['images']['featured'])){
                    $imageUrl = $entry['brItems'][0]['images']['featured'];
                } elseif(!empty($entry['brItems'][0]['images']['icon'])){
                    $imageUrl = $entry['brItems'][0]['images']['icon'];
                } elseif(!empty($entry['tracks'][0]['albumArt'])){
                    $imageUrl = $entry['tracks'][0]['albumArt'];
                } elseif(!empty($entry['cars'][0]['images']['large'])){
                    $imageUrl = $entry['cars'][0]['images']['large'];
                }
                
                // Get item name
                $itemName = 'Item';
                $itemType = '';
                $itemSet = '';
                if(!empty($entry['bundle']['name'])){
                    $itemName = $entry['bundle']['name'];
                    $itemType = $entry['bundle']['info'] ?? 'Bundle';
                } elseif(!empty($entry['brItems'][0]['name'])){
                    $itemName = $entry['brItems'][0]['name'];
                    $itemType = $entry['brItems'][0]['type']['displayValue'] ?? '';
                    $itemSet = $entry['brItems'][0]['set']['value'] ?? '';
                } elseif(!empty($entry['tracks'][0]['title'])){
                    $itemName = $entry['tracks'][0]['title'];
                    $itemType = 'Jam Track';
                    $itemSet = $entry['tracks'][0]['artist'] ?? '';
                } elseif(!empty($entry['cars'][0]['name'])){
                    $itemName = $entry['cars'][0]['name'];
                    $itemType = $entry['cars'][0]['type']['displayValue'] ?? 'Vehicle';
                }
                
                // Get rarity
                $rarity = 'common';
                if(!empty($entry['brItems'][0]['rarity']['value'])){
                    $rarity = strtolower($entry['brItems'][0]['rarity']['value']);
                } elseif(!empty($entry['brItems'][0]['series']['value'])){
                    $rarity = 'legendary'; // Icon series, etc
                }
                
                // Get series info
                $seriesName = '';
                if(!empty($entry['brItems'][0]['series']['value'])){
                    $seriesName = $entry['brItems'][0]['series']['value'];
                } elseif(!empty($entry['cars'][0]['series']['value'])){
                    $seriesName = $entry['cars'][0]['series']['value'];
                }
                
                // Price info
                $regularPrice = $entry['regularPrice'] ?? 0;
                $finalPrice = $entry['finalPrice'] ?? 0;
                $discount = ($regularPrice > $finalPrice && $regularPrice > 0) ? round((1 - $finalPrice/$regularPrice) * 100) : 0;
                
                // Banner info
                $bannerText = $entry['banner']['value'] ?? '';
                
                // Is giftable
                $giftable = $entry['giftable'] ?? false;
                
                echo "<div class='item-card rarity-$rarity' style='position: relative;'>";
                
                // Banner badge
                if($bannerText){
                    echo "<div style='position: absolute; top: 10px; left: 10px; background: var(--fn-green); color: black; padding: 4px 10px; border-radius: 12px; font-size: 0.7rem; font-weight: bold; z-index: 10;'>$bannerText</div>";
                }
                
                // Series badge
                if($seriesName){
                    echo "<div style='position: absolute; top: 10px; right: 10px; background: linear-gradient(135deg, #5cf2f3, #004c71); color: white; padding: 4px 8px; border-radius: 8px; font-size: 0.65rem; font-weight: bold; z-index: 10;'>" . htmlspecialchars($seriesName) . "</div>";
                }
                
                echo "<img src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($itemName) . "' onerror=\"this.src='./IMG/logo.png'\">";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($itemName, ENT_QUOTES, 'UTF-8') . "</h5>";
                
                // Item type
                if($itemType){
                    echo "<p class='item-type' style='color: var(--text-secondary); font-size: 0.75rem; margin: 5px 0;'>" . htmlspecialchars($itemType) . "</p>";
                }
                
                // Set info (for tracks, shows artist)
                if($itemSet){
                    echo "<p style='color: var(--fn-purple); font-size: 0.7rem; margin: 3px 0;'>🎵 " . htmlspecialchars($itemSet) . "</p>";
                }
                
                // Price
                echo "<p class='card-text' style='margin-top: 10px;'>";
                if($discount > 0) {
                    echo "<span style='text-decoration: line-through; opacity: 0.5; font-size: 0.8rem;'>" . number_format($regularPrice, 0, ',', '.') . "</span> ";
                    echo "<span style='color: var(--fn-green); font-weight: 600;'>" . number_format($finalPrice, 0, ',', '.') . "</span>";
                    echo "<span style='background: var(--fn-green); color: black; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; margin-left: 6px;'>-$discount%</span>";
                } else {
                    echo "<span style='color: var(--fn-yellow);'>💰 " . number_format($finalPrice, 0, ',', '.') . " V-Bucks</span>";
                }
                echo "</p>";
                
                // Giftable indicator
                if($giftable){
                    echo "<p style='color: var(--fn-pink); font-size: 0.7rem; margin-top: 8px;'>🎁 Presenteável</p>";
                }
                
                echo "</div>";
                echo "</div>";
            }
            
            echo "</div>"; // items-grid
            echo "</div>"; // shop-section
        }
        
    } else {
        echo "<div style='text-align: center; padding: 60px;'>";
        echo "<p style='font-size: 1.2rem;'>😕 Não foi possível carregar os itens da loja.</p>";
        echo "<p style='color: var(--text-secondary);'>Tente novamente mais tarde.</p>";
        echo "</div>";
    }
    ?>
</div>

<style>
/* Shop specific styles */
.shop-section {
    animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.item-card {
    transition: all 0.3s ease;
}

.item-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(157, 78, 221, 0.3);
}

.item-card .card-body {
    padding: 15px;
}

.item-card .card-title {
    font-size: 0.95rem;
    margin-bottom: 5px;
}
</style>

<?php include 'footer.php'; ?>
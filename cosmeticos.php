<?php 
include 'apiConfig.php'; 
$pageTitle = 'Cosméticos - Fortnite Hub';
$searchQuery = $_GET['query'] ?? '';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">✨ Cosméticos</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Explore todos os cosméticos do Fortnite</p>
        
        <!-- Search Box -->
        <form class="search-box" action="cosmeticos.php" method="GET" style="margin-top: 30px;">
            <input type="text" name="query" placeholder="🔍 Buscar cosmético..." value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>
    
    <div class="items-grid">
        <?php
        // If search query provided, use search endpoint
        if(!empty($searchQuery)){
            // Use search/all to get multiple results
            $cosmeticsData = callFortniteAPI('cosmetics/br/search/all?name=' . urlencode($searchQuery));
            
            if($cosmeticsData && $cosmeticsData['status'] == 200 && !empty($cosmeticsData['data'])){
                echo "<div style='grid-column: 1/-1; text-align: center; margin-bottom: 20px;'>";
                echo "<p style='color: var(--fn-yellow);'>🔍 Resultados para: <strong>" . htmlspecialchars($searchQuery) . "</strong> (" . count($cosmeticsData['data']) . " encontrados)</p>";
                echo "</div>";
                
                foreach ($cosmeticsData['data'] as $item){
                    $imageUrl = $item['images']['icon'] ?? $item['images']['smallIcon'] ?? './IMG/logo.png';
                    $itemName = $item['name'] ?? 'Cosmético';
                    $itemType = $item['type']['displayValue'] ?? '';
                    $rarity = strtolower($item['rarity']['value'] ?? 'common');
                    $itemDesc = $item['description'] ?? '';
                    
                    echo "<a href='detalhes_cosmetico.php?id=" . htmlspecialchars($item['id']) . "' style='text-decoration: none;'>";
                    echo "<div class='item-card rarity-$rarity'>";
                    echo "<img src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($itemName) . "' onerror=\"this.src='./IMG/logo.png'\">";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($itemName, ENT_QUOTES, 'UTF-8') . "</h5>";
                    echo "<p class='card-text'>" . htmlspecialchars($itemType, ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "<span style='display: inline-block; padding: 4px 12px; background: rgba(255,255,255,0.1); border-radius: 20px; font-size: 0.75rem; text-transform: capitalize;'>" . $rarity . "</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "<div style='text-align: center; grid-column: 1/-1; padding: 60px;'>";
                echo "<p style='font-size: 1.2rem;'>😕 Nenhum cosmético encontrado para: <strong>" . htmlspecialchars($searchQuery) . "</strong></p>";
                echo "<p style='color: var(--text-secondary);'>Tente outro termo de busca.</p>";
                echo "</div>";
            }
        } else {
            // Show featured/popular cosmetics when no search query
            // Get some iconic skins
            $popularSkins = ['Drift', 'Raven', 'Skull Trooper', 'Midas', 'Peely', 'Fishstick', 'Aura', 'Omega', 'Lynx', 'Black Knight', 'Catalyst', 'Meowscles'];
            $displayedItems = [];
            
            echo "<div style='grid-column: 1/-1; text-align: center; margin-bottom: 20px;'>";
            echo "<p style='color: var(--text-secondary);'>💡 Digite o nome de um cosmético para buscar, ou explore os populares abaixo:</p>";
            echo "</div>";
            
            foreach($popularSkins as $skinName){
                $cosmeticsData = callFortniteAPI('cosmetics/br/search?name=' . urlencode($skinName));
                
                if($cosmeticsData && $cosmeticsData['status'] == 200 && !empty($cosmeticsData['data'])){
                    $item = $cosmeticsData['data'];
                    
                    // Avoid duplicates
                    if(in_array($item['id'], $displayedItems)) continue;
                    $displayedItems[] = $item['id'];
                    
                    $imageUrl = $item['images']['icon'] ?? $item['images']['smallIcon'] ?? './IMG/logo.png';
                    $itemName = $item['name'] ?? 'Cosmético';
                    $itemType = $item['type']['displayValue'] ?? '';
                    $rarity = strtolower($item['rarity']['value'] ?? 'common');
                    
                    echo "<a href='detalhes_cosmetico.php?id=" . htmlspecialchars($item['id']) . "' style='text-decoration: none;'>";
                    echo "<div class='item-card rarity-$rarity'>";
                    echo "<img src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($itemName) . "' onerror=\"this.src='./IMG/logo.png'\">";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($itemName, ENT_QUOTES, 'UTF-8') . "</h5>";
                    echo "<p class='card-text'>" . htmlspecialchars($itemType, ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "<span style='display: inline-block; padding: 4px 12px; background: rgba(255,255,255,0.1); border-radius: 20px; font-size: 0.75rem; text-transform: capitalize;'>" . $rarity . "</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            
            if(empty($displayedItems)){
                echo "<div style='text-align: center; grid-column: 1/-1; padding: 60px;'>";
                echo "<p style='font-size: 1.2rem;'>😕 Não foi possível carregar os cosméticos.</p>";
                echo "<p style='color: var(--text-secondary);'>Tente fazer uma busca específica.</p>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
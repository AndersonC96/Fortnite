<?php 
$pageTitle = 'Home - Fortnite Hub'; 
include 'header.php'; 
include 'apiConfig.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Fortnite Hub</h1>
        <p class="hero-subtitle">
            Sua central de informações para <span>Loja</span>, <span>Notícias</span> e <span>Cosméticos</span>
        </p>
        
        <!-- Search Box -->
        <form class="search-box" action="cosmeticos.php" method="GET">
            <input type="text" name="query" placeholder="🔍 Buscar cosméticos, skins, emotes...">
            <button type="submit">Buscar</button>
        </form>
        
        <!-- Server Status -->
        <div class="status-indicator">
            <span class="status-dot"></span>
            <span>Servidores Online</span>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="container-fn" style="margin-top: -60px; position: relative; z-index: 10;">
    <div class="features-grid">
        
        <!-- Shop Card -->
        <div class="feature-card">
            <div class="feature-icon">🛒</div>
            <h3>Loja Diária</h3>
            <p>Confira todos os itens disponíveis na loja de hoje em tempo real.</p>
            <a href="loja.php" class="btn-fn">Ver Loja</a>
        </div>
        
        <!-- News Card -->
        <div class="feature-card">
            <div class="feature-icon">📰</div>
            <h3>Últimas Notícias</h3>
            <p>Fique por dentro das atualizações, eventos e patch notes.</p>
            <a href="noticias.php" class="btn-fn">Ver Notícias</a>
        </div>
        
        <!-- Cosmetics Card -->
        <div class="feature-card">
            <div class="feature-icon">✨</div>
            <h3>Cosméticos</h3>
            <p>Explore todos os cosméticos disponíveis no jogo.</p>
            <a href="cosmeticos.php" class="btn-fn">Explorar</a>
        </div>
        
        <!-- Platforms Card -->
        <div class="feature-card">
            <div class="feature-icon">🎮</div>
            <h3>Plataformas</h3>
            <p>Descubra onde jogar Fortnite e baixe o jogo.</p>
            <a href="plataformas.php" class="btn-fn">Ver Plataformas</a>
        </div>
        
    </div>
</section>

<!-- Live Shop Preview -->
<section class="container-fn" style="margin-top: 80px;">
    <h2 style="text-align: center; margin-bottom: 40px;">
        <span class="text-gradient">🔥 Destaques da Loja</span>
    </h2>
    
    <div class="items-grid" style="max-width: 1000px; margin: 0 auto;">
        <?php
        $storeData = callFortniteAPI('shop/br');
        $count = 0;
        if($storeData && $storeData['status'] == 200 && !empty($storeData['data']['featured']['entries'])){
            foreach($storeData['data']['featured']['entries'] as $entry){
                if($count >= 4) break; // Limit to 4 items
                
                $imageUrl = $entry['bundle']['image'] ?? ($entry['newDisplayAsset']['materialInstances'][0]['images']['Background'] ?? './IMG/logo.png');
                $itemName = $entry['bundle']['name'] ?? 'Item';
                $finalPrice = $entry['finalPrice'] ?? 0;
                
                echo "<div class='item-card rarity-legendary'>";
                echo "<img src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($itemName) . "'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($itemName, ENT_QUOTES, 'UTF-8') . "</h5>";
                echo "<p class='card-text'>💰 " . number_format($finalPrice, 0, ',', '.') . " V-Bucks</p>";
                echo "</div>";
                echo "</div>";
                
                $count++;
            }
        } else {
            echo "<p style='text-align: center; grid-column: 1/-1;'>Carregando itens da loja...</p>";
        }
        ?>
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <a href="loja.php" class="btn-fn btn-fn-outline">Ver Loja Completa →</a>
    </div>
</section>

<?php include 'footer.php'; ?>

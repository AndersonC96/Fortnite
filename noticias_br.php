<?php 
include 'apiConfig.php'; 
$pageTitle = 'Notícias BR - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🎮 Notícias Battle Royale</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Atualizações do modo Battle Royale</p>
        
        <!-- Category Tabs -->
        <div style="display: flex; justify-content: center; gap: 15px; margin-top: 30px; flex-wrap: wrap;">
            <a href="noticias.php" class="btn-fn btn-fn-outline" style="padding: 10px 25px;">📰 Todas</a>
            <a href="noticias_br.php" class="btn-fn" style="padding: 10px 25px;">🎮 Battle Royale</a>
            <a href="noticias_stw.php" class="btn-fn btn-fn-outline" style="padding: 10px 25px;">⚔️ Salve o Mundo</a>
        </div>
    </div>
    
    <?php
    $newsData = callFortniteAPI('news/br');
    
    if($newsData && $newsData['status'] == 200 && !empty($newsData['data']['motds'])):
        
        // Show last update date
        $brDate = $newsData['data']['date'] ?? '';
        if($brDate){
            $date = new DateTime($brDate);
            echo "<p style='text-align: center; color: var(--fn-blue); margin-bottom: 30px;'>";
            echo "📅 Última atualização: " . $date->format('d/m/Y H:i') . " UTC";
            echo "</p>";
        }
        
        // Sort by priority
        $brNews = $newsData['data']['motds'];
        usort($brNews, function($a, $b) {
            return ($b['sortingPriority'] ?? 0) - ($a['sortingPriority'] ?? 0);
        });
    ?>
    
    <!-- Featured News (highest priority) -->
    <?php 
    $featuredNews = array_filter($brNews, function($item) { 
        return ($item['sortingPriority'] ?? 0) >= 90 && !($item['hidden'] ?? false); 
    });
    if(!empty($featuredNews)): 
        $featured = reset($featuredNews);
    ?>
    <div class="feature-card" style="margin-bottom: 40px; padding: 0; overflow: hidden; display: grid; grid-template-columns: 1fr 1fr; gap: 0;">
        <img src="<?php echo htmlspecialchars($featured['image'] ?? './IMG/logo.png'); ?>" 
             alt="<?php echo htmlspecialchars($featured['title']); ?>"
             style="width: 100%; height: 300px; object-fit: cover;">
        <div style="padding: 30px; display: flex; flex-direction: column; justify-content: center;">
            <span style="display: inline-block; background: var(--fn-yellow); color: black; padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; width: fit-content; margin-bottom: 15px;">
                ⭐ DESTAQUE PRINCIPAL
            </span>
            <h2 style="font-size: 1.8rem; margin-bottom: 15px;"><?php echo htmlspecialchars($featured['title']); ?></h2>
            <p style="color: var(--text-secondary); line-height: 1.6;"><?php echo htmlspecialchars($featured['body']); ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- All News Grid -->
    <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
        <?php foreach($brNews as $index => $newsItem): 
            if($newsItem['hidden'] ?? false) continue;
            // Skip featured in grid if already shown above
            if(($newsItem['sortingPriority'] ?? 0) >= 100 && !empty($featuredNews)) continue;
            
            $imageUrl = $newsItem['tileImage'] ?? $newsItem['image'] ?? './IMG/logo.png';
            $title = $newsItem['title'] ?? 'Notícia';
            $body = $newsItem['body'] ?? '';
            $priority = $newsItem['sortingPriority'] ?? 0;
        ?>
        <div class="item-card" style="border-top: 3px solid var(--fn-blue); animation-delay: <?php echo $index * 0.1; ?>s;">
            <?php if($priority >= 80 && $priority < 100): ?>
            <div style="position: absolute; top: 10px; left: 10px; background: var(--fn-blue); color: white; padding: 4px 12px; border-radius: 15px; font-size: 0.7rem; font-weight: bold; z-index: 10;">
                🔥 HOT
            </div>
            <?php endif; ?>
            <img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>" 
                 alt="<?php echo htmlspecialchars($title); ?>" 
                 style="height: 200px; object-fit: cover;"
                 onerror="this.src='./IMG/logo.png'">
            <div class="card-body">
                <h5 class="card-title" style="font-size: 1.1rem; margin-bottom: 10px;"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h5>
                <p class="card-text" style="font-size: 0.9rem; line-height: 1.5; color: var(--text-secondary);">
                    <?php echo htmlspecialchars(mb_substr($body, 0, 150) . (mb_strlen($body) > 150 ? '...' : '')); ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <?php else: ?>
    <div style="text-align: center; padding: 60px;">
        <p style="font-size: 1.2rem;">😕 Não há notícias Battle Royale disponíveis no momento.</p>
        <p style="color: var(--text-secondary);">Tente novamente mais tarde.</p>
    </div>
    <?php endif; ?>
</div>

<style>
.item-card {
    position: relative;
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

.item-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 170, 255, 0.3);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .feature-card {
        grid-template-columns: 1fr !important;
    }
    .feature-card img {
        height: 200px !important;
    }
}
</style>

<?php include 'footer.php'; ?>
<?php 
include 'apiConfig.php'; 
$pageTitle = 'Notícias - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">📰 Últimas Notícias</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Fique por dentro das novidades do Fortnite</p>
        
        <!-- Category Tabs -->
        <div style="display: flex; justify-content: center; gap: 15px; margin-top: 30px; flex-wrap: wrap;">
            <a href="noticias.php" class="btn-fn" style="padding: 10px 25px;">📰 Todas</a>
            <a href="noticias_br.php" class="btn-fn btn-fn-outline" style="padding: 10px 25px;">🎮 Battle Royale</a>
            <a href="noticias_stw.php" class="btn-fn btn-fn-outline" style="padding: 10px 25px;">⚔️ Salve o Mundo</a>
        </div>
    </div>
    
    <?php
    $newsData = callFortniteAPI('news');
    
    // Debug: uncomment to see the response structure
    // echo "<pre>" . print_r($newsData, true) . "</pre>";
    
    if($newsData && $newsData['status'] == 200):
        
        // Show last update date
        $brDate = $newsData['data']['br']['date'] ?? '';
        if($brDate){
            $date = new DateTime($brDate);
            echo "<p style='text-align: center; color: var(--fn-yellow); margin-bottom: 30px;'>";
            echo "📅 Última atualização: " . $date->format('d/m/Y H:i') . " UTC";
            echo "</p>";
        }
        
        // BR News Section
        if(!empty($newsData['data']['br']['motds'])):
            // Sort by priority
            $brNews = $newsData['data']['br']['motds'];
            usort($brNews, function($a, $b) {
                return ($b['sortingPriority'] ?? 0) - ($a['sortingPriority'] ?? 0);
            });
    ?>
    
    <div style="margin-bottom: 60px;">
        <h2 style="margin-bottom: 25px; display: flex; align-items: center; gap: 15px;">
            <span style="background: linear-gradient(135deg, var(--fn-purple), var(--fn-blue)); padding: 10px 20px; border-radius: 12px; font-size: 1rem;">🎮 Battle Royale</span>
            <span style="color: var(--text-secondary); font-size: 0.9rem;"><?php echo count($brNews); ?> notícias</span>
        </h2>
        
        <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
            <?php foreach($brNews as $index => $newsItem): 
                if($newsItem['hidden'] ?? false) continue;
                $imageUrl = $newsItem['tileImage'] ?? $newsItem['image'] ?? './IMG/logo.png';
                $title = $newsItem['title'] ?? 'Notícia';
                $body = $newsItem['body'] ?? '';
                $priority = $newsItem['sortingPriority'] ?? 0;
            ?>
            <div class="item-card news-card" style="border-top: 3px solid var(--fn-purple); animation-delay: <?php echo $index * 0.1; ?>s;">
                <?php if($priority >= 90): ?>
                <div style="position: absolute; top: 10px; left: 10px; background: var(--fn-yellow); color: black; padding: 4px 12px; border-radius: 15px; font-size: 0.7rem; font-weight: bold; z-index: 10;">
                    ⭐ DESTAQUE
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
    </div>
    
    <?php endif; ?>
    
    <?php 
        // STW News Section
        if(!empty($newsData['data']['stw']['messages'])):
            $stwNews = $newsData['data']['stw']['messages'];
    ?>
    
    <div style="margin-bottom: 60px;">
        <h2 style="margin-bottom: 25px; display: flex; align-items: center; gap: 15px;">
            <span style="background: linear-gradient(135deg, var(--fn-orange), #ff6b35); padding: 10px 20px; border-radius: 12px; font-size: 1rem;">⚔️ Salve o Mundo</span>
            <span style="color: var(--text-secondary); font-size: 0.9rem;"><?php echo count($stwNews); ?> notícia(s)</span>
        </h2>
        
        <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
            <?php foreach($stwNews as $index => $newsItem): 
                $imageUrl = $newsItem['image'] ?? './IMG/logo.png';
                $title = $newsItem['title'] ?? 'Notícia';
                $body = $newsItem['body'] ?? '';
            ?>
            <div class="item-card" style="border-top: 3px solid var(--fn-orange); animation-delay: <?php echo $index * 0.1; ?>s;">
                <img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>" 
                     alt="<?php echo htmlspecialchars($title); ?>" 
                     style="height: 200px; object-fit: cover;"
                     onerror="this.style.display='none'">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 1.1rem; margin-bottom: 10px;"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h5>
                    <p class="card-text" style="font-size: 0.9rem; line-height: 1.5; color: var(--text-secondary);">
                        <?php echo htmlspecialchars($body); ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php endif; ?>
    
    <?php else: ?>
    <div style="text-align: center; padding: 60px;">
        <p style="font-size: 1.2rem;">😕 Não foi possível carregar as notícias.</p>
        <p style="color: var(--text-secondary);">Tente novamente mais tarde.</p>
        <p style="color: var(--fn-yellow); margin-top: 20px; font-size: 0.9rem;">
            Debug: Status = <?php echo $newsData['status'] ?? 'null'; ?>
        </p>
    </div>
    <?php endif; ?>
</div>

<style>
.news-card {
    position: relative;
    transition: all 0.3s ease;
}

.news-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(157, 78, 221, 0.3);
}

.item-card {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
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
</style>

<?php include 'footer.php'; ?>
<?php 
include 'apiConfig.php'; 
$pageTitle = 'Notícias STW - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">⚔️ Notícias Salve o Mundo</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Atualizações do modo Save the World</p>
        
        <!-- Category Tabs -->
        <div style="display: flex; justify-content: center; gap: 15px; margin-top: 30px; flex-wrap: wrap;">
            <a href="noticias.php" class="btn-fn btn-fn-outline" style="padding: 10px 25px;">📰 Todas</a>
            <a href="noticias_br.php" class="btn-fn btn-fn-outline" style="padding: 10px 25px;">🎮 Battle Royale</a>
            <a href="noticias_stw.php" class="btn-fn" style="padding: 10px 25px;">⚔️ Salve o Mundo</a>
        </div>
    </div>
    
    <?php
    $newsData = callFortniteAPI('news/stw');
    
    if($newsData && $newsData['status'] == 200 && !empty($newsData['data']['messages'])):
        
        // Show last update date
        $stwDate = $newsData['data']['date'] ?? '';
        if($stwDate){
            $date = new DateTime($stwDate);
            echo "<p style='text-align: center; color: var(--fn-orange); margin-bottom: 30px;'>";
            echo "📅 Última atualização: " . $date->format('d/m/Y H:i') . " UTC";
            echo "</p>";
        }
        
        $stwNews = $newsData['data']['messages'];
    ?>
    
    <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));">
        <?php foreach($stwNews as $index => $newsItem): 
            $imageUrl = $newsItem['image'] ?? '';
            $title = $newsItem['title'] ?? 'Notícia';
            $body = $newsItem['body'] ?? '';
            $adspace = $newsItem['adspace'] ?? '';
        ?>
        <div class="item-card" style="border-top: 3px solid var(--fn-orange); animation-delay: <?php echo $index * 0.15; ?>s;">
            <?php if($imageUrl): ?>
            <img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>" 
                 alt="<?php echo htmlspecialchars($title); ?>" 
                 style="height: 200px; object-fit: cover;"
                 onerror="this.style.display='none'">
            <?php endif; ?>
            <div class="card-body" style="padding: 25px;">
                <h5 class="card-title" style="font-size: 1.2rem; margin-bottom: 15px; color: var(--fn-orange);">
                    ⚔️ <?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>
                </h5>
                <p class="card-text" style="font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                    <?php echo htmlspecialchars($body); ?>
                </p>
                <?php if($adspace): ?>
                <p style="margin-top: 15px; padding: 10px; background: rgba(255,136,0,0.1); border-radius: 8px; font-size: 0.85rem; color: var(--fn-yellow);">
                    📢 <?php echo htmlspecialchars($adspace); ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <?php else: ?>
    <div style="text-align: center; padding: 60px;">
        <div class="feature-card" style="max-width: 600px; margin: 0 auto; padding: 40px;">
            <p style="font-size: 3rem; margin-bottom: 20px;">🏚️</p>
            <p style="font-size: 1.2rem; margin-bottom: 15px;">Não há notícias do Salve o Mundo disponíveis.</p>
            <p style="color: var(--text-secondary);">O modo Save the World não recebe atualizações frequentes.</p>
            <a href="noticias_br.php" class="btn-fn" style="margin-top: 20px;">Ver notícias Battle Royale →</a>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
.item-card {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

.item-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(255, 136, 0, 0.3);
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
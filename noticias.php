<?php 
include 'apiConfig.php'; 
$pageTitle = 'Notícias - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">📰 Últimas Notícias</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Fique por dentro das novidades do Fortnite</p>
    </div>
    
    <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
        <?php
        $newsData = callFortniteAPI('news');
        if($newsData && $newsData['status'] == 200 && !empty($newsData['data']['br']['motds'])){
            foreach($newsData['data']['br']['motds'] as $newsItem){
                $imageUrl = $newsItem['image'] ?? './IMG/logo.png';
                $title = $newsItem['title'] ?? 'Notícia';
                $body = $newsItem['body'] ?? '';
                
                echo "<div class='item-card' style='border-top: 3px solid var(--fn-purple);'>";
                echo "<img src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($title) . "' style='height: 180px;'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($body, ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div style='text-align: center; grid-column: 1/-1; padding: 60px;'>";
            echo "<p style='font-size: 1.2rem;'>😕 Não foi possível carregar as notícias.</p>";
            echo "<p style='color: var(--text-secondary);'>Tente novamente mais tarde.</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
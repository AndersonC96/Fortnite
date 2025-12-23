<?php 
include 'apiConfig.php'; 
$pageTitle = 'Notícias BR - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🎮 Notícias Battle Royale</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Atualizações do modo Battle Royale</p>
    </div>
    
    <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">
        <?php
        $newsData = callFortniteAPI('news/br');
        if($newsData && $newsData['status'] == 200 && !empty($newsData['data']['motds'])){
            foreach($newsData['data']['motds'] as $newsItem){
                $imageUrl = $newsItem['image'] ?? './IMG/logo.png';
                $title = $newsItem['title'] ?? 'Notícia';
                $body = $newsItem['body'] ?? '';
                
                echo "<div class='item-card' style='border-top: 3px solid var(--fn-blue);'>";
                echo "<img src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($title) . "' style='height: 180px;'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($body, ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div style='text-align: center; grid-column: 1/-1; padding: 60px;'>";
            echo "<p style='font-size: 1.2rem;'>Não há notícias disponíveis no momento.</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
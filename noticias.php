<?php 
include 'apiConfig.php'; 
$pageTitle = 'Notícias Fortnite';
include 'header.php'; 
?>
<div class="container mt-5 pt-4">
            <div class="container mt-4">
                <h1>Notícias</h1>
                <div class="row">
                <?php
                    $newsData = callFortniteAPI('news');
                    if($newsData && $newsData['status'] == 200 && !empty($newsData['data']['br']['motds'])){
                        foreach($newsData['data']['br']['motds'] as $newsItem){
                            echo "<div class='col-md-6'>";
                            echo "<div class='card'>";
                            echo "<img class='card-img-top' src='" . htmlspecialchars($newsItem['image'], ENT_QUOTES, 'UTF-8') . "' alt='Imagem da notícia'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($newsItem['title'], ENT_QUOTES, 'UTF-8') . "</h5>";
                            echo "<p class='card-text'>" . htmlspecialchars($newsItem['body'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }else{
                        echo "<p>Não foi possível carregar as notícias.</p>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
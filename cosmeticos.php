<?php
    include 'apiConfig.php';
    $searchQuery = $_GET['query'] ?? '';
    $cosmeticsData = [];
    if(!empty($searchQuery)){
        $url = "https://fortnite-api.com/v2/cosmetics/br/search?name=" . urlencode($searchQuery);
        error_log("URL de busca: " . $url);
        $cosmeticsData = callFortniteAPI($url);
        error_log("Resposta da busca: " . print_r($cosmeticsData, true));
    }else{
        $cosmeticsData = callFortniteAPI('cosmetics/br/new');
    }
?>
<?php 
// include 'apiConfig.php'; // Included at top already
$pageTitle = 'Cosméticos Fortnite';
include 'header.php'; 
?>

<div class="container mt-5 pt-4">
    <!-- Search Bar Moved Here -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form class="input-group glass-card p-2" action="cosmeticos.php" method="GET">
                <input class="form-control bg-transparent border-0 text-white" type="search" name="query" placeholder="Buscar Cosmético..." aria-label="Buscar" value="<?php echo htmlspecialchars($searchQuery ?? ''); ?>">
                <div class="input-group-append">
                    <button class="btn btn-fn" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>
            <h1>Cosméticos</h1>
            <div class="row">
                <?php
                    $cosmeticsData = callFortniteAPI('cosmetics/br/new');
                    if($cosmeticsData && $cosmeticsData['status'] == 200 && !empty($cosmeticsData['data']['items'])){
                        foreach ($cosmeticsData['data']['items'] as $item){
                            echo "<div class='col-md-6'>";
                            echo "<div class='card'>";
                            echo "<img class='card-img-top' src='" . htmlspecialchars($item['images']['icon'], ENT_QUOTES, 'UTF-8') . "' alt='Imagem do cosmético'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') . "</h5>";
                            echo "<p class='card-text'>" . htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "<a href='detalhes_cosmetico.php?id=" . htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-primary'>Ler Mais</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }else{
                        echo "<p>Não foi possível carregar os cosméticos.</p>";
                    }
                ?>
            </div>
        </div>
</div>
<?php include 'footer.php'; ?>
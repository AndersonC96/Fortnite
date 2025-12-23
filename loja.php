<?php 
include 'apiConfig.php'; 
$pageTitle = 'Loja Fortnite';
include 'header.php'; 
?>
<div class="container mt-5 pt-4"> <!-- Added pt-4 for spacing under fixed/sticky header if needed -->
            <h1>Itens da Loja</h1>
            <div class="row">
                <?php
                    $storeData = callFortniteAPI('shop/br');
                    if($storeData && $storeData['status'] == 200 && !empty($storeData['data']['featured']['entries'])){
                        foreach($storeData['data']['featured']['entries'] as $entry){
                            $imageUrl = $entry['bundle']['image'] ?? 'URL para imagem placeholder';
                            $itemName = $entry['bundle']['name'] ?? 'Nome não disponível';
                            $itemInfo = $entry['bundle']['info'] ?? 'Informação não disponível';
                            $itemPrice = "Preço regular: {$entry['regularPrice']} | Preço final: {$entry['finalPrice']}";
                            echo "<div class='col-md-4 mb-4'>";
                            echo "<div class='card' style='width: 18rem;'>";
                            echo "<img class='card-img-top' src='" . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . "' alt='Imagem do item'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($itemName, ENT_QUOTES, 'UTF-8') . "</h5>";
                            echo "<p class='card-text'>" . htmlspecialchars($itemInfo, ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "<p class='card-text'>" . htmlspecialchars($itemPrice, ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }else{
                        echo "<p>Não foi possível carregar os itens da loja.</p>";
                    }
                ?>
            </div>
    </div>
</div>
<?php include 'footer.php'; ?>
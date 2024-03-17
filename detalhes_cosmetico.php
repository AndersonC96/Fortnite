<?php
    include 'apiConfig.php';
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $cosmeticId = $_GET['id'];
        $cosmeticData = callFortniteAPI("cosmetics/br/$cosmeticId");
    }else{
        header('Location: cosmeticos.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalhes do Cosmético</title>
        <link rel="icon" href="./IMG/favicon.png" type="image/x-icon" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
        <link href="./CSS/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <h1><?php echo htmlspecialchars($cosmeticData['data']['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo htmlspecialchars($cosmeticData['data']['images']['icon'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem do Cosmético" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h3 class="h3-cor">Descrição</h3>
                    <p><?php echo htmlspecialchars($cosmeticData['data']['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <h3 class="h3-cor">Tipo</h3>
                    <p><?php echo htmlspecialchars($cosmeticData['data']['type']['displayValue'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <h3 class="h3-cor">Raridade</h3>
                    <p><?php echo htmlspecialchars($cosmeticData['data']['rarity']['displayValue'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <h3 class="h3-cor">Set</h3>
                    <p><?php echo htmlspecialchars($cosmeticData['data']['set']['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <h3 class="h3-cor">Introdução</h3>
                    <p><?php echo "Capítulo" . " " . htmlspecialchars($cosmeticData['data']['introduction']['chapter'], ENT_QUOTES, 'UTF-8') . ", " . "Temporada" . " " . htmlspecialchars($cosmeticData['data']['introduction']['season'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <h3 class="h3-cor">Variantes</h3>
                    <?php if (!empty($cosmeticData['variants'])): ?>
                    <?php foreach ($cosmeticData['variants'] as $variant): ?>
                    <h4><?php echo htmlspecialchars($variant['channel'] . " - " . $variant['type'], ENT_QUOTES, 'UTF-8'); ?></h4>
                    <div class="options-container">
                        <?php foreach ($variant['options'] as $option): ?>
                        <div class="option">
                            <h5><?php echo htmlspecialchars($option['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <img src="<?php echo htmlspecialchars($option['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem da variante">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>Não há variantes disponíveis para este cosmético.</p>
                    <?php endif; ?>
                </div>
            </div>
            <a href="cosmeticos.php" class="btn btn-primary">Voltar aos Cosméticos</a>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
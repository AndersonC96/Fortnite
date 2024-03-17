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
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                    <h3>Descrição</h3>
                    <p><?php echo htmlspecialchars($cosmeticData['data']['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <!-- Adicione mais detalhes conforme necessário -->
                </div>
            </div>
            <a href="cosmeticos.php" class="btn btn-primary">Voltar aos Cosméticos</a>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
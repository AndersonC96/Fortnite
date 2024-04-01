<?php include 'apiConfig.php'; ?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Status do Fortnite</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="./CSS/style.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">
                <img src="./IMG/logo.png" alt="Logo do Fortnite">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notícias</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="noticias.php">Notícias Gerais</a>
                            <a class="dropdown-item" href="noticias_br.php">Notícias BR</a>
                            <a class="dropdown-item" href="noticias_stw.php">Notícias STW</a>
                            <a class="dropdown-item" href="noticias_creative.php">Notícias Creative</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="cosmeticos.php">Cosméticos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loja.php">Loja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="status.php">Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="plataformas.php">Plataformas</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-4">
            <h1>Status do Fortnite</h1>
            <?php
                $statusData = callFortniteAPI('status');
                if($statusData && $statusData['status'] == 200){
                    echo "<div class='alert alert-success' role='alert'>";
                    echo "O Fortnite está operando normalmente.";
                    echo "</div>";
                }else{
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Houve um problema ao recuperar o status do Fortnite.";
                    echo "</div>";
                }
            ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
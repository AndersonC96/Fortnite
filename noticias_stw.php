<?php
    include 'apiConfig.php';
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fortnite API</title>
        <link rel="icon" href="./IMG/favicon.png" type="image/x-icon" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
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
                        <a class="nav-link" href="mapa.php">Mapa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="playlists.php">Playlists</a>
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
        <div class="container mt-4">
    <h1>Notícias</h1>
    <div class="row">
        <?php
            $newsData = callFortniteAPI('news/stw');
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
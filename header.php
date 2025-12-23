<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Fortnite Project';
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="icon" href="./IMG/favicon.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Inter:wght@300;400;600&family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./CSS/design-system.css" rel="stylesheet"> <!-- New Design System -->
    <link href="./CSS/style.css" rel="stylesheet">
</head>
<body>
    <div class="video-background">
        <div class="video-overlay"></div> <!-- Added overlay for better text contrast -->
        <video autoplay loop muted playsinline>
            <source src="./Video/Video.mp4" type="video/mp4">
            Seu navegador não suporta vídeos.
        </video>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-glass sticky-top">
        <a class="navbar-brand" href="index.php">
            <img src="./IMG/logo.png" alt="Logo do Fortnite">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo ($currentPage == 'index.php' || $currentPage == 'Index.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown <?php echo (strpos($currentPage, 'noticias') !== false) ? 'active' : ''; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notícias</a>
                    <div class="dropdown-menu glass-card border-0 mt-2" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-white" href="noticias.php">Notícias Gerais</a>
                        <a class="dropdown-item text-white" href="noticias_br.php">Notícias BR</a>
                        <a class="dropdown-item text-white" href="noticias_stw.php">Notícias STW</a>
                        <a class="dropdown-item text-white" href="noticias_creative.php">Notícias Creative</a>
                    </div>
                </li>
                <li class="nav-item <?php echo ($currentPage == 'cosmeticos.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="cosmeticos.php">Cosméticos</a>
                </li>
                <li class="nav-item <?php echo ($currentPage == 'loja.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="loja.php">Loja</a>
                </li>
                <li class="nav-item <?php echo ($currentPage == 'status.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="status.php">Status</a>
                </li>
                <li class="nav-item <?php echo ($currentPage == 'plataformas.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="plataformas.php">Plataformas</a>
                </li>
            </ul>
        </div>
    </nav>

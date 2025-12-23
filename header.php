<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Fortnite Hub';
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
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./CSS/design-system.css" rel="stylesheet">
    <link href="./CSS/style.css" rel="stylesheet">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Premium Navbar -->
    <nav class="navbar navbar-expand-lg navbar-fn">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./IMG/logo.png" alt="Fortnite Hub">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'index.php' || $currentPage == 'Index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo (strpos($currentPage, 'noticias') !== false) ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            Notícias
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="noticias.php">📰 Notícias Gerais</a>
                            <a class="dropdown-item" href="noticias_br.php">🎮 Battle Royale</a>
                            <a class="dropdown-item" href="noticias_stw.php">⚔️ Salve o Mundo</a>
                            <a class="dropdown-item" href="noticias_creative.php">🎨 Criativo</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'cosmeticos.php') ? 'active' : ''; ?>" href="cosmeticos.php">Cosméticos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'loja.php') ? 'active' : ''; ?>" href="loja.php">Loja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'status.php') ? 'active' : ''; ?>" href="status.php">Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'plataformas.php') ? 'active' : ''; ?>" href="plataformas.php">Plataformas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

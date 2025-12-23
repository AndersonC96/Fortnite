<?php $pageTitle = 'Home - Fortnite Tracker'; include 'header.php'; ?>

<div class="container mt-5 pt-5">
    <div class="text-center mb-5">
        <h1 class="display-3 text-white" style="text-shadow: 0 0 20px rgba(0,0,0,0.8);">Bem-vindo ao <span class="text-gradient">Fortnite Hub</span></h1>
        <p class="lead text-light">Sua fonte definitiva para Loja, Notícias e Status.</p>
    </div>

    <!-- Multi-Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <form class="input-group glass-card p-2" action="cosmeticos.php" method="GET">
                <input type="text" name="query" class="form-control bg-transparent border-0 text-white" placeholder="Buscar cosmético..." style="font-family: 'Inter', sans-serif;">
                <div class="input-group-append">
                    <button class="btn btn-fn" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bento Grid Dashboard -->
    <div class="bento-grid">
        <!-- Featured Shop Item -->
        <div class="glass-card bento-item span-2">
            <h3 class="h3-cor">Item em Destaque</h3>
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <p>Confira a loja de hoje atualizada em tempo real.</p>
                    <a href="loja.php" class="btn btn-outline-light mt-3">Ver Loja Completa</a>
                </div>
                <!-- Placeholder for API image, using a static icon for now -->
                <img src="./IMG/logo.png" style="opacity: 0.8; height: 100px;" alt="Shop Icon">
            </div>
        </div>

        <!-- Latest News -->
        <div class="glass-card bento-item">
            <h3 class="text-primary">Últimas Notícias</h3>
            <p>Fique por dentro das atualizações e patch notes.</p>
            <a href="noticias.php" class="btn btn-sm btn-fn mt-auto">Ler Notícias</a>
        </div>

        <!-- Server Status -->
        <div class="glass-card bento-item">
            <h3 class="text-success">Status do Servidor</h3>
            <div class="d-flex align-items-center mt-2">
                <div style="width: 15px; height: 15px; background: #00ff00; border-radius: 50%; box-shadow: 0 0 10px #00ff00;"></div>
                <span class="ml-2">Online</span>
            </div>
            <a href="status.php" class="btn btn-sm btn-outline-light mt-4">Detalhes</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

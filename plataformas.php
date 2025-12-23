<?php 
$pageTitle = 'Plataformas - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🎮 Plataformas</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Baixe e jogue Fortnite em qualquer lugar</p>
    </div>
    
    <!-- Mobile -->
    <div style="margin-bottom: 60px;">
        <h2 style="text-align: center; margin-bottom: 30px; color: var(--fn-blue);">📱 Dispositivos Móveis</h2>
        <div class="features-grid" style="max-width: 1000px; margin: 0 auto;">
            <a href="https://luna.amazon.com/game/fortnite" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/amazon-luna.png" alt="Amazon Luna" style="height: 60px; margin-bottom: 15px;">
                <h3>Amazon Luna</h3>
                <p>Jogue no navegador</p>
            </a>
            <a href="https://www.fortnite.com/mobile/android/new-device" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/android.png" alt="Android" style="height: 60px; margin-bottom: 15px;">
                <h3>Android</h3>
                <p>Baixe via Epic Games</p>
            </a>
            <a href="https://www.nvidia.com/en-us/geforce-now/fortnite-mobile/" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/geforce-now.png" alt="GeForce Now" style="height: 60px; margin-bottom: 15px;">
                <h3>GeForce NOW</h3>
                <p>Streaming via nuvem</p>
            </a>
            <a href="https://apps.apple.com/us/app/fortnite/id6483539426" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/ios.png" alt="iOS" style="height: 60px; margin-bottom: 15px;">
                <h3>iOS</h3>
                <p>Baixe via App Store</p>
            </a>
            <a href="https://www.xbox.com/pt-BR/play/launch/fortnite/BT5P2X999VH2" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/xcloud.png" alt="Xbox Cloud" style="height: 60px; margin-bottom: 15px;">
                <h3>Xbox Cloud</h3>
                <p>Jogue no navegador</p>
            </a>
        </div>
    </div>
    
    <!-- Console -->
    <div style="margin-bottom: 60px;">
        <h2 style="text-align: center; margin-bottom: 30px; color: var(--fn-purple);">🕹️ Consoles</h2>
        <div class="features-grid" style="max-width: 1200px; margin: 0 auto;">
            <a href="https://www.nintendo.com/us/store/products/fortnite-switch/" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/nintendo.png" alt="Nintendo Switch" style="height: 60px; margin-bottom: 15px;">
                <h3>Nintendo</h3>
                <p>NS1 & NS2</p>
            </a>
            <a href="https://store.playstation.com/pt-br/product/UP1477-PPSA01922_00-FNBNDL0000000000" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/playstation.png" alt="PlayStation" style="height: 60px; margin-bottom: 15px;">
                <h3>PlayStation</h3>
                <p>PS4 & PS5</p>
            </a>
            <a href="https://www.xbox.com/pt-BR/games/store/fortnite/BT5P2X999VH2" target="_blank" class="feature-card" style="text-decoration: none;">
                <img src="./IMG/xbox.png" alt="Xbox" style="height: 60px; margin-bottom: 15px;">
                <h3>Xbox</h3>
                <p>One & Series X|S</p>
            </a>
        </div>
    </div>
    
    <!-- PC -->
    <div>
        <h2 style="text-align: center; margin-bottom: 30px; color: var(--fn-yellow);">💻 PC</h2>
        <div style="max-width: 400px; margin: 0 auto;">
            <a href="https://store.epicgames.com/pt-BR/p/fortnite" target="_blank" class="feature-card" style="text-decoration: none; display: block;">
                <img src="./IMG/epic-games.png" alt="Epic Games" style="height: 70px; margin-bottom: 15px;">
                <h3>Epic Games Store</h3>
                <p>Baixe grátis para Windows</p>
                <span class="btn-fn" style="margin-top: 15px;">Baixar Agora</span>
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
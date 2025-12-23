<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🗺️ Mapa do Fortnite</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Visualize o mapa atual do Battle Royale</p>
    </div>
    
    <!-- Map Options -->
    <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 30px; flex-wrap: wrap;">
        <button class="btn-fn" onclick="showMap('poi')" id="btn-poi">🏷️ Com POIs</button>
        <button class="btn-fn btn-fn-outline" onclick="showMap('blank')" id="btn-blank">🗺️ Limpo</button>
    </div>
    
    <!-- Map Display -->
    <div class="feature-card" style="padding: 20px; max-width: 1000px; margin: 0 auto;">
        <div style="position: relative; text-align: center;">
            <img id="map-image" 
                 src="<?= htmlspecialchars($mapUrl) ?>" 
                 alt="Mapa do Fortnite"
                 style="width: 100%; max-width: 900px; height: auto; border-radius: 12px; cursor: zoom-in;"
                 onclick="openFullscreen()"
                 onerror="this.src='https://fortnite-api.com/images/map.png'">
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <p style="color: var(--text-secondary);">💡 Clique no mapa para ver em tela cheia</p>
        </div>
    </div>
    
    <!-- Season Info -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 40px; max-width: 1000px; margin-left: auto; margin-right: auto;">
        <div class="feature-card" style="padding: 25px; text-align: center;">
            <span style="font-size: 2.5rem;">🏝️</span>
            <h3 style="margin: 15px 0 10px;">Capítulo 6</h3>
            <p style="color: var(--text-secondary);">Pacific Break</p>
        </div>
        <div class="feature-card" style="padding: 25px; text-align: center;">
            <span style="font-size: 2.5rem;">❄️</span>
            <h3 style="margin: 15px 0 10px;">Temporada 1</h3>
            <p style="color: var(--text-secondary);">Inverno 2024/2025</p>
        </div>
        <div class="feature-card" style="padding: 25px; text-align: center;">
            <span style="font-size: 2.5rem;">📍</span>
            <h3 style="margin: 15px 0 10px;">Novo Mapa</h3>
            <p style="color: var(--text-secondary);">Ilha renovada</p>
        </div>
    </div>
    
    <!-- POI List -->
    <div style="margin-top: 50px; max-width: 1000px; margin-left: auto; margin-right: auto;">
        <h2 style="text-align: center; margin-bottom: 30px;">
            <span class="text-gradient">📍 Pontos de Interesse (POIs)</span>
        </h2>
        
        <div class="items-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
            <?php foreach ($pois as $poi): ?>
            <div class="feature-card poi-card" style="padding: 15px; text-align: center;">
                <span style="font-size: 1.8rem;"><?= $poi['icon'] ?></span>
                <p style="margin-top: 10px; font-weight: 600;"><?= htmlspecialchars($poi['name']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Fullscreen Modal -->
<div id="fullscreen-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 9999; cursor: zoom-out;" onclick="closeFullscreen()">
    <img id="fullscreen-image" src="" alt="Mapa em tela cheia" style="max-width: 95%; max-height: 95%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <button style="position: absolute; top: 20px; right: 30px; background: none; border: none; color: white; font-size: 40px; cursor: pointer;" onclick="closeFullscreen()">×</button>
</div>

<style>
.poi-card {
    transition: all 0.3s ease;
}

.poi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(157, 78, 221, 0.3);
}
</style>

<script>
const mapUrlPoi = '<?= addslashes($mapUrl) ?>';
const mapUrlBlank = '<?= addslashes($mapUrlBlank) ?>';

function showMap(type) {
    const mapImg = document.getElementById('map-image');
    const btnPoi = document.getElementById('btn-poi');
    const btnBlank = document.getElementById('btn-blank');
    
    if (type === 'poi') {
        mapImg.src = mapUrlPoi;
        btnPoi.classList.remove('btn-fn-outline');
        btnBlank.classList.add('btn-fn-outline');
    } else {
        mapImg.src = mapUrlBlank;
        btnBlank.classList.remove('btn-fn-outline');
        btnPoi.classList.add('btn-fn-outline');
    }
}

function openFullscreen() {
    const modal = document.getElementById('fullscreen-modal');
    const fullImg = document.getElementById('fullscreen-image');
    const mapImg = document.getElementById('map-image');
    
    fullImg.src = mapImg.src;
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeFullscreen() {
    document.getElementById('fullscreen-modal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeFullscreen();
});
</script>

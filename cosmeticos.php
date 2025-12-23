<?php 
include 'apiConfig.php'; 
$pageTitle = 'Cosméticos - Fortnite Hub';
$searchQuery = $_GET['query'] ?? '';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">✨ Cosméticos</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Explore todos os cosméticos do Fortnite</p>
        
        <!-- Search Box -->
        <form class="search-box" action="cosmeticos.php" method="GET" style="margin-top: 30px;" id="search-form">
            <input type="text" name="query" id="search-input" placeholder="🔍 Buscar cosmético..." value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>
    
    <div id="results-info" style="text-align: center; margin-bottom: 20px; color: var(--fn-yellow);"></div>
    
    <div class="items-grid" id="cosmetics-grid">
        <!-- Items will be loaded here via JavaScript -->
    </div>
    
    <!-- Loading indicator -->
    <div id="loading-indicator" style="text-align: center; padding: 40px; display: none;">
        <div class="loading-spinner"></div>
        <p style="color: var(--text-secondary); margin-top: 15px;">Carregando mais cosméticos...</p>
    </div>
    
    <!-- End message -->
    <div id="end-message" style="text-align: center; padding: 40px; display: none;">
        <p style="color: var(--text-secondary);">🎮 Você viu todos os cosméticos!</p>
    </div>
</div>

<style>
.loading-spinner {
    width: 50px;
    height: 50px;
    border: 4px solid rgba(157, 78, 221, 0.3);
    border-top: 4px solid var(--fn-purple);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.item-card {
    opacity: 0;
    animation: fadeInUp 0.5s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
// Configuration
const ITEMS_PER_PAGE = 12;
let currentPage = 0;
let isLoading = false;
let hasMoreItems = true;
let allCosmetics = [];
let filteredCosmetics = [];
const searchQuery = '<?php echo addslashes($searchQuery); ?>'.toLowerCase();

// Popular skins to show when no search
const popularSkins = ['Drift', 'Raven', 'Skull Trooper', 'Midas', 'Peely', 'Fishstick', 'Aura', 'Omega', 'Lynx', 'Black Knight', 'Catalyst', 'Meowscles', 'Jonesy', 'The Reaper', 'Spider-Man', 'Kratos', 'Master Chief', 'Lara Croft', 'Deadpool', 'Wolverine', 'Iron Man', 'Thor', 'Batman', 'Harley Quinn'];

// Elements
const grid = document.getElementById('cosmetics-grid');
const loadingIndicator = document.getElementById('loading-indicator');
const endMessage = document.getElementById('end-message');
const resultsInfo = document.getElementById('results-info');

// Create item card HTML
function createItemCard(item) {
    const imageUrl = item.images?.icon || item.images?.smallIcon || item.images?.featured || './IMG/logo.png';
    const name = item.name || 'Cosmético';
    const type = item.type?.displayValue || '';
    const rarity = (item.rarity?.value || 'common').toLowerCase();
    const series = item.series?.value || '';
    
    let seriesBadge = '';
    if(series) {
        seriesBadge = `<div style="position: absolute; top: 10px; right: 10px; background: linear-gradient(135deg, #5cf2f3, #004c71); color: white; padding: 4px 8px; border-radius: 8px; font-size: 0.6rem; font-weight: bold; z-index: 10; max-width: 80px; text-align: center; line-height: 1.2;">${series}</div>`;
    }
    
    return `
        <a href="detalhes_cosmetico.php?id=${encodeURIComponent(item.id)}" style="text-decoration: none; animation-delay: ${Math.random() * 0.3}s;">
            <div class="item-card rarity-${rarity}" style="position: relative;">
                ${seriesBadge}
                <img src="${imageUrl}" alt="${name}" onerror="this.src='./IMG/logo.png'" loading="lazy">
                <div class="card-body">
                    <h5 class="card-title">${name}</h5>
                    <p class="card-text">${type}</p>
                    <span style="display: inline-block; padding: 4px 12px; background: rgba(255,255,255,0.1); border-radius: 20px; font-size: 0.75rem; text-transform: capitalize;">${rarity}</span>
                </div>
            </div>
        </a>
    `;
}

// Load items for current page
function loadItems() {
    if(isLoading || !hasMoreItems) return;
    
    isLoading = true;
    loadingIndicator.style.display = 'block';
    
    const startIndex = currentPage * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;
    const itemsToShow = filteredCosmetics.slice(startIndex, endIndex);
    
    if(itemsToShow.length === 0) {
        hasMoreItems = false;
        loadingIndicator.style.display = 'none';
        if(currentPage === 0) {
            grid.innerHTML = `
                <div style="text-align: center; grid-column: 1/-1; padding: 60px;">
                    <p style="font-size: 1.2rem;">😕 Nenhum cosmético encontrado${searchQuery ? ' para: <strong>' + searchQuery + '</strong>' : ''}.</p>
                    <p style="color: var(--text-secondary);">Tente outro termo de busca.</p>
                </div>
            `;
        } else {
            endMessage.style.display = 'block';
        }
        return;
    }
    
    // Simulate small delay for smooth UX
    setTimeout(() => {
        itemsToShow.forEach(item => {
            grid.insertAdjacentHTML('beforeend', createItemCard(item));
        });
        
        currentPage++;
        isLoading = false;
        loadingIndicator.style.display = 'none';
        
        // Check if there are more items
        if(endIndex >= filteredCosmetics.length) {
            hasMoreItems = false;
            endMessage.style.display = 'block';
        }
    }, 300);
}

// Fetch cosmetics from API
async function fetchCosmetics() {
    loadingIndicator.style.display = 'block';
    
    try {
        if(searchQuery) {
            // Search for specific items
            const response = await fetch(`https://fortnite-api.com/v2/cosmetics/br/search/all?name=${encodeURIComponent(searchQuery)}&matchMethod=contains`);
            const data = await response.json();
            
            if(data.status === 200 && data.data) {
                allCosmetics = Array.isArray(data.data) ? data.data : [data.data];
                filteredCosmetics = allCosmetics;
                resultsInfo.innerHTML = `🔍 ${filteredCosmetics.length} resultado(s) para: <strong>"${searchQuery}"</strong>`;
            } else {
                filteredCosmetics = [];
            }
        } else {
            // Load popular skins when no search query
            const promises = popularSkins.map(async (skinName) => {
                try {
                    const response = await fetch(`https://fortnite-api.com/v2/cosmetics/br/search?name=${encodeURIComponent(skinName)}`);
                    const data = await response.json();
                    if(data.status === 200 && data.data) {
                        return data.data;
                    }
                    return null;
                } catch(e) {
                    return null;
                }
            });
            
            const results = await Promise.all(promises);
            allCosmetics = results.filter(item => item !== null);
            
            // Remove duplicates
            const seen = new Set();
            filteredCosmetics = allCosmetics.filter(item => {
                if(seen.has(item.id)) return false;
                seen.add(item.id);
                return true;
            });
            
            resultsInfo.innerHTML = `💡 Mostrando ${filteredCosmetics.length} cosméticos populares. Use a busca para encontrar mais!`;
        }
        
        loadingIndicator.style.display = 'none';
        loadItems();
        
    } catch(error) {
        console.error('Error fetching cosmetics:', error);
        loadingIndicator.style.display = 'none';
        grid.innerHTML = `
            <div style="text-align: center; grid-column: 1/-1; padding: 60px;">
                <p style="font-size: 1.2rem;">😕 Erro ao carregar cosméticos.</p>
                <p style="color: var(--text-secondary);">Tente novamente mais tarde.</p>
            </div>
        `;
    }
}

// Infinite scroll detection
function handleScroll() {
    const scrollPosition = window.innerHeight + window.scrollY;
    const threshold = document.body.offsetHeight - 500;
    
    if(scrollPosition >= threshold && !isLoading && hasMoreItems) {
        loadItems();
    }
}

// Initialize
window.addEventListener('scroll', handleScroll);
window.addEventListener('load', fetchCosmetics);
</script>

<?php include 'footer.php'; ?>
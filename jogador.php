<?php 
include 'apiConfig.php'; 
$pageTitle = 'Buscar Jogador - Fortnite Hub';

$playerName = $_GET['player'] ?? '';
$platform = $_GET['platform'] ?? 'epic';
$playerData = null;
$error = null;

if(!empty($playerName)) {
    // The stats endpoint requires account type
    $statsData = callFortniteAPI("stats/br/v2?name=" . urlencode($playerName) . "&accountType=" . $platform);
    
    if($statsData && $statsData['status'] == 200) {
        $playerData = $statsData['data'];
    } else {
        $error = $statsData['error'] ?? 'Jogador não encontrado ou perfil privado.';
    }
}

include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">🔍 Buscar Jogador</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Pesquise estatísticas de qualquer jogador do Fortnite</p>
    </div>
    
    <!-- Search Form -->
    <form class="search-box" action="jogador.php" method="GET" style="max-width: 600px; margin: 0 auto 40px;">
        <div style="display: flex; flex-wrap: wrap; gap: 15px; justify-content: center; width: 100%;">
            <input type="text" name="player" placeholder="🎮 Digite o nome do jogador..." 
                   value="<?php echo htmlspecialchars($playerName); ?>" 
                   style="flex: 1; min-width: 250px;" required>
            <select name="platform" style="padding: 12px 20px; border-radius: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; cursor: pointer;">
                <option value="epic" <?php echo $platform == 'epic' ? 'selected' : ''; ?>>Epic Games</option>
                <option value="psn" <?php echo $platform == 'psn' ? 'selected' : ''; ?>>PlayStation</option>
                <option value="xbl" <?php echo $platform == 'xbl' ? 'selected' : ''; ?>>Xbox</option>
            </select>
            <button type="submit">Buscar</button>
        </div>
    </form>
    
    <?php if($error): ?>
    <div class="feature-card" style="max-width: 600px; margin: 0 auto; padding: 40px; text-align: center; border: 1px solid var(--fn-orange);">
        <span style="font-size: 3rem;">😕</span>
        <h3 style="margin: 20px 0 10px; color: var(--fn-orange);">Jogador não encontrado</h3>
        <p style="color: var(--text-secondary);"><?php echo htmlspecialchars($error); ?></p>
        <p style="color: var(--text-secondary); margin-top: 15px; font-size: 0.9rem;">
            Verifique se o nome está correto e se o perfil é público.
        </p>
    </div>
    
    <?php elseif($playerData): ?>
    
    <!-- Player Info -->
    <div style="max-width: 1000px; margin: 0 auto;">
        <!-- Header Card -->
        <div class="feature-card" style="padding: 30px; margin-bottom: 30px;">
            <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--fn-purple), var(--fn-blue)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    🎮
                </div>
                <div style="flex: 1;">
                    <h2 style="font-size: 2rem; margin-bottom: 5px;"><?php echo htmlspecialchars($playerData['account']['name'] ?? $playerName); ?></h2>
                    <p style="color: var(--text-secondary);">
                        ID: <?php echo htmlspecialchars($playerData['account']['id'] ?? 'N/A'); ?>
                    </p>
                </div>
                <div style="text-align: right;">
                    <p style="color: var(--fn-yellow);">🏆 Level <?php echo $playerData['battlePass']['level'] ?? '0'; ?></p>
                    <p style="color: var(--text-secondary); font-size: 0.85rem;">Battle Pass</p>
                </div>
            </div>
        </div>
        
        <!-- Overall Stats -->
        <?php if(isset($playerData['stats']['all']['overall'])): 
            $overall = $playerData['stats']['all']['overall'];
        ?>
        <h3 style="margin-bottom: 20px;">
            <span class="text-gradient">📊 Estatísticas Gerais</span>
        </h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-bottom: 40px;">
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <p style="color: var(--text-secondary); font-size: 0.8rem;">Partidas</p>
                <p style="font-size: 1.8rem; font-weight: bold; color: var(--fn-blue);"><?php echo number_format($overall['matches'] ?? 0); ?></p>
            </div>
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <p style="color: var(--text-secondary); font-size: 0.8rem;">Vitórias</p>
                <p style="font-size: 1.8rem; font-weight: bold; color: var(--fn-green);"><?php echo number_format($overall['wins'] ?? 0); ?></p>
            </div>
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <p style="color: var(--text-secondary); font-size: 0.8rem;">Eliminações</p>
                <p style="font-size: 1.8rem; font-weight: bold; color: var(--fn-orange);"><?php echo number_format($overall['kills'] ?? 0); ?></p>
            </div>
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <p style="color: var(--text-secondary); font-size: 0.8rem;">Mortes</p>
                <p style="font-size: 1.8rem; font-weight: bold; color: var(--fn-pink);"><?php echo number_format($overall['deaths'] ?? 0); ?></p>
            </div>
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <p style="color: var(--text-secondary); font-size: 0.8rem;">K/D Ratio</p>
                <p style="font-size: 1.8rem; font-weight: bold; color: var(--fn-purple);"><?php echo number_format($overall['kd'] ?? 0, 2); ?></p>
            </div>
            <div class="feature-card" style="padding: 20px; text-align: center;">
                <p style="color: var(--text-secondary); font-size: 0.8rem;">Taxa de Vitória</p>
                <p style="font-size: 1.8rem; font-weight: bold; color: var(--fn-yellow);"><?php echo number_format($overall['winRate'] ?? 0, 1); ?>%</p>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Stats by Mode -->
        <?php 
        $modes = ['solo' => 'Solo', 'duo' => 'Duos', 'squad' => 'Squads'];
        $modeIcons = ['solo' => '🎯', 'duo' => '👥', 'squad' => '👨‍👩‍👧‍👦'];
        $modeColors = ['solo' => 'var(--fn-blue)', 'duo' => 'var(--fn-green)', 'squad' => 'var(--fn-purple)'];
        ?>
        
        <h3 style="margin-bottom: 20px;">
            <span class="text-gradient">🎮 Estatísticas por Modo</span>
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach($modes as $key => $label): 
                $modeStats = $playerData['stats']['all'][$key] ?? null;
                if(!$modeStats) continue;
            ?>
            <div class="feature-card" style="padding: 25px; border-top: 3px solid <?php echo $modeColors[$key]; ?>;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <span style="font-size: 1.5rem;"><?php echo $modeIcons[$key]; ?></span>
                    <h4 style="margin: 0; color: <?php echo $modeColors[$key]; ?>;"><?php echo $label; ?></h4>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <p style="color: var(--text-secondary); font-size: 0.75rem;">Partidas</p>
                        <p style="font-weight: bold;"><?php echo number_format($modeStats['matches'] ?? 0); ?></p>
                    </div>
                    <div>
                        <p style="color: var(--text-secondary); font-size: 0.75rem;">Vitórias</p>
                        <p style="font-weight: bold; color: var(--fn-green);"><?php echo number_format($modeStats['wins'] ?? 0); ?></p>
                    </div>
                    <div>
                        <p style="color: var(--text-secondary); font-size: 0.75rem;">K/D</p>
                        <p style="font-weight: bold;"><?php echo number_format($modeStats['kd'] ?? 0, 2); ?></p>
                    </div>
                    <div>
                        <p style="color: var(--text-secondary); font-size: 0.75rem;">Taxa Vitória</p>
                        <p style="font-weight: bold;"><?php echo number_format($modeStats['winRate'] ?? 0, 1); ?>%</p>
                    </div>
                    <div>
                        <p style="color: var(--text-secondary); font-size: 0.75rem;">Top 10</p>
                        <p style="font-weight: bold;"><?php echo number_format($modeStats['top10'] ?? $modeStats['top12'] ?? $modeStats['top6'] ?? 0); ?></p>
                    </div>
                    <div>
                        <p style="color: var(--text-secondary); font-size: 0.75rem;">Top 25</p>
                        <p style="font-weight: bold;"><?php echo number_format($modeStats['top25'] ?? 0); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php else: ?>
    <!-- Empty State -->
    <div style="text-align: center; padding: 60px;">
        <div style="font-size: 5rem; margin-bottom: 30px;">🎮</div>
        <h3 style="margin-bottom: 15px;">Pesquise um jogador</h3>
        <p style="color: var(--text-secondary); max-width: 400px; margin: 0 auto;">
            Digite o nome de usuário Epic Games, PlayStation ou Xbox para ver as estatísticas do jogador.
        </p>
        
        <!-- Popular Players -->
        <div style="margin-top: 40px;">
            <p style="color: var(--text-secondary); margin-bottom: 20px;">💡 Jogadores populares para testar:</p>
            <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
                <a href="jogador.php?player=Ninja" class="btn-fn btn-fn-outline" style="padding: 8px 16px;">Ninja</a>
                <a href="jogador.php?player=Tfue" class="btn-fn btn-fn-outline" style="padding: 8px 16px;">Tfue</a>
                <a href="jogador.php?player=Bugha" class="btn-fn btn-fn-outline" style="padding: 8px 16px;">Bugha</a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

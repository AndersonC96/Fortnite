<?php 
include 'apiConfig.php'; 
$pageTitle = 'Status - Fortnite Hub';
include 'header.php'; 
?>

<div class="page-container container-fn">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="text-gradient">📊 Status do Servidor</h1>
        <p style="color: var(--text-secondary); margin-top: 15px;">Verifique o status dos servidores do Fortnite</p>
    </div>
    
    <div style="max-width: 600px; margin: 0 auto;">
        <?php
        $statusData = callFortniteAPI('status');
        if($statusData && $statusData['status'] == 200){
            echo "<div class='feature-card' style='border: 2px solid var(--fn-green);'>";
            echo "<div class='feature-icon' style='background: rgba(0, 255, 136, 0.2);'>✅</div>";
            echo "<h3 style='color: var(--fn-green);'>Servidores Online</h3>";
            echo "<p>O Fortnite está operando normalmente.</p>";
            echo "<div class='status-indicator' style='margin-top: 20px;'>";
            echo "<span class='status-dot'></span>";
            echo "<span>Todos os sistemas operacionais</span>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='feature-card' style='border: 2px solid #ff4444;'>";
            echo "<div class='feature-icon' style='background: rgba(255, 68, 68, 0.2);'>⚠️</div>";
            echo "<h3 style='color: #ff4444;'>Verificando Status...</h3>";
            echo "<p>Não foi possível obter o status atual dos servidores.</p>";
            echo "</div>";
        }
        ?>
        
        <div style="margin-top: 40px; text-align: center;">
            <a href="https://status.epicgames.com/" target="_blank" class="btn-fn btn-fn-outline">
                Ver Status Oficial da Epic →
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
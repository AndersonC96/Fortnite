<?php 
include 'apiConfig.php'; 
$pageTitle = 'Status do Fortnite';
include 'header.php'; 
?>
<div class="container mt-5 pt-4">
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
<?php include 'footer.php'; ?>
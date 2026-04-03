<?php        
    include("Utilitaire/start.php");    
    $_SESSION['momentCommande'] = $_POST['momentCommande'];
    $_SESSION['dateCommande'] = $_POST['dateCommande'];
    $_SESSION['heureCommande'] = $_POST['heureCommande'];
    header("Location: panier.php?payer=1");
?>
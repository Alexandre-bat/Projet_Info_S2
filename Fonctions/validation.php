<?php        
    include("Utilitaire/start.php");    
    $_SESSION['momentCommande'] = $_POST['momentCommande'];
    $_SESSION['dateCommande'] = $_POST['dateCommande'];
    $_SESSION['heureCommande'] = $_POST['heureCommande'];
    header("Location: Panier.php?payer=1");
    //passer dans la session les informations utiles a la commande pour le fichier 
?>
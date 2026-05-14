<?php
    include("../Utilitaire/start.php");
    if(!isset($_SESSION['id'])){
        echo "non_connecte";
        exit();
    }
    if(isset($_POST['produit'])){
        $id = $_POST['produit'];
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = [];
        }
        $_SESSION['panier'][] = $id;
        echo "ok";
    }
?>
<?php
include("../Utilitaire/start.php");

if(isset($_POST["action"])){
    // suppr panier
    if($_POST["action"] == "supprimer"){
        $produit = $_POST["produit"];
        if(($index = array_search($produit, $_SESSION["panier"])) !== false){
            unset($_SESSION["panier"][$index]);
        }
        $_SESSION["panier"] = array_values($_SESSION["panier"]);
        echo 'ok';
    }
    // vider panier
    if($_POST["action"] == "vider"){
        unset($_SESSION["panier"]);
        echo 'ok';
    }
}
?>
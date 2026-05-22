<?php
// ajout panier et verif si commande active déjà là ou non
include("../Utilitaire/start.php");
if(!isset($_SESSION['id'])){
    echo "non_connecte";
    exit();
}
if(!isset($_POST['produit'])){
    exit();
}
$idProduit = $_POST['produit'];
$commande = recupCommandeActive($_SESSION['id']);
if($commande){
    echo "commande_active";
    exit();
}
if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = [];
}
$_SESSION['panier'][] = $idProduit;
echo "ok";
?>
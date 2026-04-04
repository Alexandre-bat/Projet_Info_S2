<?php

if (isset($_POST["priseEnCharge"])) {
    attenteToPrepa($_POST["priseEnCharge"]);
}
else if(isset($_POST["priseEnLivraison"])){
    prepaToLivraison($_POST["priseEnLivraison"]);
}

function attenteToPrepa($idCommande){
    $contenu = file_get_contents("commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) {
        $data = [];
    }
    foreach ($data as &$commande) {
        if ($commande["idCommande"] == $idCommande) {
            $commande["Statut"] = "preparation";
        }
    }
    file_put_contents("commandes.json", json_encode($data, JSON_PRETTY_PRINT));
    header("Location: Commandes.php"); 
    exit();
}

function prepaToLivraison($idCommande){
    $contenu = file_get_contents("commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) {
        $data = [];
    }
    foreach ($data as &$commande) {
        if ($commande["idCommande"] == $idCommande) {
            $commande["Statut"] = "livraison";
        }
    }
    file_put_contents("commandes.json", json_encode($data, JSON_PRETTY_PRINT));
    header("Location: Commandes.php"); 
    exit();
}
?>
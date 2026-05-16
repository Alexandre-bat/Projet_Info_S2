<?php
    session_start();

    date_default_timezone_set('Europe/Paris');

    if(isset($_GET['deco'])) {
        session_destroy();
        header("Location: Accueil.php");
        exit();
    }
    //deconnexion 

    $role = null;
    $fichier_id = __DIR__ . "/../.json/id.json";

    if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
        $json = file_get_contents("$fichier_id");
        $users = json_decode($json, true);
        foreach ($users as $user) {
            if ($user['nom'] == $_SESSION['nom'] && $user['prenom'] == $_SESSION['prenom']) {
                $role = $user['role'];
                if(isset($user['bloquer']) && $user['bloquer'] == 1) {
                    session_destroy();
                    header("Location: ../Connexion.php?bloquer=1");
                    exit();
                }
                break;
            }
        }
    }

    function getProduit($produits, $id){
        foreach($produits as $p){
            if($p['id'] == $id){
                return $p;
            }
        }
        return null;
    }//Récupère les produits envoyées dans le panier

    if (isset($_POST['livre'])) {
        header("Location: Livraison.php?Livre=1");
        exit();
    }

    if (isset($_POST['abandone'])) {
        header("Location: Livraison.php?Abandon=1");
        exit();
    }

    function recupCommandeActive($idUtilisateur){
        $json = file_get_contents(__DIR__ . "/../.json/commandes.json");
        $commandes = json_decode($json, true);
        foreach($commandes as $commande){
            if($commande["idUtilisateur"] == $idUtilisateur && $commande["Statut"] == "Attente"){
                return $commande;
            }
        }
        return null;
    }
    //fonction nécessaire pour savoir si commande en attente
?>
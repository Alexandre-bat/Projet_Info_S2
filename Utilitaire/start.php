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
    $fichier_id = __DIR__ . "/../json/id.json";

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
        $json = file_get_contents(__DIR__ . "/../json/commandes.json");
        $commandes = json_decode($json, true);
        if(!is_array($commandes)){
            return null;
        }
        foreach($commandes as $commande){
            if($commande["idUtilisateur"] == $idUtilisateur && $commande["Statut"] == "Attente"){
                return $commande;
            }
        }
        return null;
    }
    //fonction nécessaire pour savoir si commande en attente

    if(isset($_POST["action"]) && $_POST["action"] == "reduction"){
        $id = $_POST["id"];
        $reduction = $_POST["reduction"];
        $fichier = __DIR__ . "/../json/id.json";
        if($id == null || $reduction == null || !file_exists($fichier)){
            exit("erreur");
        }
        $contenu = file_get_contents($fichier);
        $data = json_decode($contenu, true);
        if(!is_array($data)){
            exit("erreur");
        }
        foreach($data as &$user){
            if($user["id"] == $id){
                $user["reduction"] += (int)$reduction;
                file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                exit("ok");
            }   
        }
        exit("erreur");
    }
    //mettre les réductions dans les fichiers

    if(isset($_POST["action"]) && $_POST["action"] == "majPrix"){
        $nouveauPrix = floatval($_POST["nouveauPrix"]);
        $fichier = __DIR__ . "/../json/commandes.json";
        if(!file_exists($fichier)){
            exit("erreur");
        }
        $contenu = file_get_contents($fichier);
        $commandes = json_decode($contenu, true);
        if(!is_array($commandes)){
            exit("erreur");
        }
        foreach($commandes as $i => &$commande){
            if($commande["idUtilisateur"] == $_SESSION["id"] && $commande["Statut"] == "Attente"){
                $commande["Prix"] = $nouveauPrix;
                if($nouveauPrix <= 0){
                    unset($commandes[$i]);
                    $commandes = array_values($commandes);
                }
                file_put_contents($fichier, json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                if($nouveauPrix <= 0){
                    exit("supprime");
                }
                exit("ok");
            }
        }
        exit("erreur");
    }
    //mettre à jour les prix dans les fichiers
?>
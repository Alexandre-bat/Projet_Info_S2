<?php
    session_start();

    // Vérifie que l'utilisateur est connecté et qu'une commande lui est atttribué
    if (!isset($_SESSION["id"]) || !isset($_POST["idCommande"])) {
        header("Location:  ../Livraison.php");
        exit();
    }

    $idCommande = $_POST["idCommande"];

    // Fichier JSON
    $contenu = file_get_contents(__DIR__ ."/../json/commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) { $data = []; }

    // Modifie la commande correspondante
    foreach ($data as &$commande) {
        if ($commande["idCommande"] == $idCommande && $commande["idLivreur"] == $_SESSION["id"]) {
            if (isset($_POST["livre"])) {
                $commande["Statut"] = "livree";
            } elseif (isset($_POST["abandone"])) {
                $commande["idLivreur"] = "";
                $commande["Statut"] = "abandonnee";
            }
            break;
        }
    }

    // Sauvegarder le fichier JSON
    file_put_contents(__DIR__ ."/../json/commandes.json", json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirection selon le choix
    if (isset($_POST["livre"])) {
        header("Location:  ../Livraison.php?Livre=1");
    } elseif (isset($_POST["abandone"])) {
        header("Location:  ../Livraison.php?Abandon=1");
    } else {
        header("Location:  ../Livraison.php");
    }
    exit();
?>
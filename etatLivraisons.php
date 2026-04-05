<?php
    session_start();

    // Vérifier que l'utilisateur est connecté et qu'une commande est ciblée
    if (!isset($_SESSION["id"]) || !isset($_POST["idCommande"])) {
        header("Location: Livraison.php");
        exit();
    }

    $idCommande = $_POST["idCommande"];

    // Lire le fichier JSON
    $contenu = file_get_contents("commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) { $data = []; }

    // Trouver et modifier la commande correspondante
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
    file_put_contents("commandes.json", json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirection selon l'action
    if (isset($_POST["livre"])) {
        header("Location: Livraison.php?Livre=1");
    } elseif (isset($_POST["abandone"])) {
        header("Location: Livraison.php?Abandon=1");
    } else {
        header("Location: Livraison.php");
    }
    exit();
?>
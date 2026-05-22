<?php
    // Ici on pert de récupérer les informations et de les actualiser dans le fichier JSON
    include(__DIR__ . "/../Utilitaire/start.php");

    if (!isset($_POST['idUtilisateur'], $_POST['nom'], $_POST['prenom'], $_POST['tel'])) {
        echo json_encode(["success" => false, "message" => "Données manquantes."]);
        exit();
    }

    $idCible = $_POST['idUtilisateur'];

    $fichier = __DIR__ . "/../json/id.json";
    $json    = file_get_contents($fichier);
    $users   = json_decode($json, true);

    // Récupère l'id de l'utilisateur connecté
    $idConnecte = null;
    foreach ($users as $user) {
        if ($user["nom"] === ($_SESSION["nom"] ?? "") && $user["prenom"] === ($_SESSION["prenom"] ?? "")) {
            $idConnecte = $user["id"];
            break;
        }
    }

    // Sécurité niveau autorisation
    if ($role !== "admin" && $idConnecte !== $idCible) {
        echo json_encode(["success" => false, "message" => "Action non autorisée."]);
        exit();
    }

    // Sécurité niveau téléphone ( si le numéro de tel est déjà utilisé )
    $telExistant = false;
    foreach ($users as $user) {
        if ($user["tel"] === trim($_POST['tel']) && $user["id"] !== $idCible) {
            $telExistant = true;
            break;
        }
    }
    if ($telExistant) {
        echo json_encode(["success" => false, "message" => "Ce numéro de téléphone est déjà utilisé par un autre compte."]);
        exit();
    }


    // Mise à jour des données dans le fichier JSON
    $trouve = false;
    foreach ($users as &$user) {
        if ($user["id"] === $idCible) {
            $user["nom"] = trim($_POST['nom']);
            $user["prenom"] = trim($_POST['prenom']);
            $user["adresse"] = trim($_POST['adresse'] ?? "");
            $user["tel"] = trim($_POST['tel']);
            $user["mdp"] = trim($_POST['mdp']);
            $trouve = true;
            break;
        }
    }

    if (!$trouve) {
        echo json_encode(["success" => false, "message" => "Utilisateur introuvable. ID reçu : " . $idCible]);
        exit();
    }

    file_put_contents($fichier, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $_SESSION["nom"]    = trim($_POST['nom']);
    $_SESSION["prenom"] = trim($_POST['prenom']);

    echo json_encode(["success" => true]);
?>
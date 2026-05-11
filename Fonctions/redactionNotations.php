<?php
    session_start();
    header("Content-Type: application/json");

    // Vérification que la session existe
    if (!isset($_SESSION["id"])) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Non connecté."]);
        exit();
    }

    // Récupérer les données JSON envoyées
    $data = json_decode(file_get_contents("php://input"), true);

    $fichier = __DIR__ . "/../.json/notations.json";

    // Vérifie si le fichier existe
    if(file_exists($fichier)){

        // Lire les anciennes données
        $ancienContenu = file_get_contents($fichier);
        $tableau = json_decode($ancienContenu, true);

        // Si le fichier est vide ou invalide
        if(!$tableau){
            $tableau = [];
        }

    }else{
        $tableau = [];
    }

    // Ajouter la nouvelle notation
    $tableau[] = $data;

    // Réécriture dans le fichier JSON
    file_put_contents(
        $fichier,
        json_encode($tableau, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    echo json_encode([
        "success" => true,
        "message" => "Merci pour votre avis !"
    ]);
    ?>
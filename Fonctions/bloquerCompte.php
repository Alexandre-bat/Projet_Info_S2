<?php
    session_start();
    header("Content-Type: application/json");

    // Vérification que la session existe
    if (!isset($_SESSION["id"])) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Non connecté."]);
        exit();
    }

    $fichierUsers = __DIR__ . "/../json/id.json";

    if (!file_exists($fichierUsers)) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Fichier utilisateurs introuvable."]);
        exit();
    }

    $contenuUsers = file_get_contents($fichierUsers);
    $dataUsers    = json_decode($contenuUsers, true);

    if (!is_array($dataUsers)) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Données corrompues."]);
        exit();
    }

    $estAdmin = false;
    foreach ($dataUsers as $u) {
        if ($u["id"] == $_SESSION["id"] && $u["role"] === "admin") {
            $estAdmin = true;
            break;
        }
    }

    if (!$estAdmin) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Accès refusé."]);
        exit();
    }

    // Lecture du corps JSON
    $body   = file_get_contents("php://input");
    $params = json_decode($body, true);

    $userId = $params["userId"] ?? null;
    $action = $params["action"] ?? null;

    // Validation
    if (!$userId || !in_array($action, ["bloquer", "debloquer"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Paramètres invalides."]);
        exit();
    }

    // Empêcher un admin de se bloquer lui-même
    if ((string)$userId === (string)$_SESSION["id"]) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Impossible de vous bloquer vous-même."]);
        exit();
    }

    if (!file_exists($fichierUsers)) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Fichier introuvable."]);
        exit();
    }

    $contenu = file_get_contents($fichierUsers);
    $data    = json_decode($contenu, true);

    if (!is_array($data)) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Données corrompues."]);
        exit();
    }

    // Mise à jour de l'utilisateur
    $trouve = false;
    foreach ($data as &$user) {
        if ((string)$user["id"] === (string)$userId) {
            if( $action === "bloquer" ){
                $user["bloquer"] = 1;
            }
            else {
                $user["bloquer"] = 0;
            }
            $trouve = true;
            break;
        }
    }
    unset($user);

    if (!$trouve) {
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Utilisateur introuvable."]);
        exit();
    }

    // Sauvegarde
    file_put_contents($fichierUsers, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["success" => true, "message" => "Compte mis à jour.", "action" => $action]);
    exit();
?>
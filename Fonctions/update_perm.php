<?php 
    session_start();
    header("Content-Type: application/json");
    // Session
    if (!isset($_SESSION["id"])) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Non connecté"]);
        exit();
    }
    $fichier = __DIR__ . "/../json/id.json";
    if (!file_exists($fichier)) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Fichier introuvable"]);
        exit();
    }
    $users = json_decode(file_get_contents($fichier), true);
    if (!is_array($users)) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "JSON invalide"]);
        exit();
    }
    // Admin
    $sessionId = $_SESSION["id"];
    $isAdmin = false;
    foreach ($users as $u) {
        if ($u["id"] === $sessionId && $u["role"] === "admin") {
            $isAdmin = true;
            break;
        }
    }
    if (!$isAdmin) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Accès refusé"]);
        exit();
    }
    // Input 
    if (!isset($_POST["id"]) || !isset($_POST["role"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Données manquantes"]);
        exit();
    }
    $id = $_POST["id"];
    $nouveau_role = $_POST["role"];
    // protection self-role
    if ($id === $sessionId && $nouveau_role !== "admin") {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Action interdite"]);
        exit();
    }
    // update 
    $updated = false;
    foreach ($users as &$user) {
        if ($user["id"] === $id) {
            $user["role"] = $nouveau_role;
            $updated = true;
            break;
        }
    }
    if (!$updated) {
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Utilisateur introuvable"]);
        exit();
    }
    $ok = file_put_contents(
        $fichier,
        json_encode($users, JSON_PRETTY_PRINT),
        LOCK_EX
    );
    if ($ok === false) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Erreur écriture"]);
        exit();
    }
    echo json_encode(["success" => true]);
?>
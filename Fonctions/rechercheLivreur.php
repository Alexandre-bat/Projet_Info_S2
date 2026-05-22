<?php
include("../Utilitaire/start.php");
header('Content-Type: application/json');

$contenu = file_get_contents("../json/id.json");
$data = json_decode($contenu, true);

if (!is_array($data)) {
    echo json_encode([]);
    exit();
}

$livreurs = array_values(array_filter($data, fn($u) => $u["role"] === "Livreur"));

echo json_encode($livreurs);
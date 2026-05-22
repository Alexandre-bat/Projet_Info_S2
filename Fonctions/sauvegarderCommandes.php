<?php

$data = json_decode(file_get_contents("php://input"), true);

$commandeLivraison = $data["commandeLivraison"];
$commandeAbandonnee = $data["commandeAbandonnee"];

// Fusionner les tableaux
$commandes = array_merge(
    $commandeLivraison,
    $commandeAbandonnee
);

// Sauvegarder
file_put_contents(
    "../json/commandes.json",
    json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo json_encode([
    "success" => true
]);
?>
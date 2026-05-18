<?php
include("../Utilitaire/start.php");
header('Content-Type: application/json');

$contenu = file_get_contents("../.json/commandes.json");
$data = json_decode($contenu, true);
if (!is_array($data)) $data = [];

$result = [
    "commandeAtt" => [],
    "commandeImmediate" => [],
    "commandeLivraison" => [],
    "commandeAbandonnee" => [],
    "commandeLivree" => []
];

foreach ($data as $commande) {
    if ($commande["Paiement"] === "Payee") {
        switch ($commande["Statut"]) {
            case "Attente": $result["commandeAtt"][]        = $commande; break;
            case "En preparation": $result["commandeImmediate"][]  = $commande; break;
            case "En livraison": $result["commandeLivraison"][]  = $commande; break;
            case "abandonnee": $result["commandeAbandonnee"][] = $commande; break;
            case "livree": $result["commandeLivree"][]     = $commande; break;
        }
    }
}

echo json_encode($result);
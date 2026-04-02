<?php
include("Utilitaire/start.php");

$json     = file_get_contents("carte.json");
$produits = json_decode($json, true);

function getProduit($produits, $id) {
    foreach ($produits as $p) {
        if ($p['id'] == $id) {
            return $p;
        }
    }
    return null;
}

function mettre_fichier($id, $fichier, $panier, $produits) {
    if (empty($panier)) {
        exit("Panier vide.");
    }

    if (!file_exists($fichier)) {
        file_put_contents($fichier, "[]");
    }

    $contenu = file_get_contents($fichier);
    $data    = json_decode($contenu, true);

    if (!is_array($data)) {
        $data = [];
    }

    $nbr = array_count_values($panier);
    $produitsCommandes = [];

    foreach ($nbr as $produit_id => $quantite) {
        $produit = getProduit($produits, $produit_id);
        if ($produit) {
            $produitsCommandes[] = [
                "nom"      => $produit["nom"],
                "quantite" => $quantite,
                "prix"     => $produit["prix"] * $quantite
            ];
        }
    }

    $data[] = [
        "id"       => $id,
        "Date"     => date("Y-m-d H:i"),
        "Produits" => $produitsCommandes
    ];

    file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));

    $_SESSION['panier'] = [];

    header("Location: Transaction.php");
    exit();
}

if (!isset($_SESSION["id"]) || !isset($_SESSION["panier"]) || empty($_SESSION["panier"])) {
    header("Location: panier.php");
    exit();
}

mettre_fichier($_SESSION["id"], "commandes.json", $_SESSION["panier"], $produits);
?>
<?php
include("Utilitaire/start.php");
include("getapikey.php");

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
$moment = $_POST['momentCommande'];
$date = $_POST['dateCommande'];
$heure = $_POST['heureCommande'];

$transaction = $_GET['transaction'];
$montant = $_GET['montant'];
$vendeur = $_GET['vendeur'];
$status = $_GET['status'];
$control = $_GET['control'];


$api_key = getAPIKey($vendeur);

if ($status == "accepted") {
    $statutCommande = "Payée";
} else {
    $statutCommande = "Paiement échoué";
}

$control_verif = md5($api_key
    . "#" . $transaction
    . "#" . $montant
    . "#" . $vendeur
    . "#" . $status . "#");

if ($control != $control_verif) {
    exit("Erreur : paiement invalide");
}


function mettre_fichier($fichier, $panier, $produits, $transaction, $montant, $vendeur, $statutCommande, $moment, $date, $heure) {
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
        "id" => $transaction,
        "Date" => date("Y-m-d H:i"),
        "Produits" => $produitsCommandes,
        "Prix" => $montant,
        "Vendeur" => $vendeur,
        "Status" => $statutCommande,
        "Moment" => $moment,
        "Date prevue" => $date,
        "Heure prevue" => $heure,
    ];

    file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));

    $_SESSION['panier'] = [];

    header("Location: Accueil.php");
    exit();
}

if (!isset($_SESSION["panier"]) || empty($_SESSION["panier"])) {
    header("Location: panier.php");
    exit();
}

mettre_fichier("commandes.json", $_SESSION["panier"], $produits, $transaction, $montant, $vendeur, $statutCommande, $moment, $date, $heure);
?>
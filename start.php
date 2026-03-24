<?php
session_start();

if(isset($_GET['deco'])) {
    session_destroy();
    header("Location: Accueil.php");
    exit();
}

$role = null;

if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {

    $json = file_get_contents("id.json");
    $users = json_decode($json, true);

    foreach ($users as $user) {
        if ($user['nom'] == $_SESSION['nom'] && $user['prenom'] == $_SESSION['prenom']) {
            $role = $user['role'];
            break;
        }
    }
}

$nbr = 0;

if(isset($_SESSION['panier'])){
    $nbr = count($_SESSION['panier']);
}

if(isset($_GET['produit'])){
    $_SESSION['panier'][] = $_GET['produit'];
    header("Location: panier.php");
    exit();
}

if(isset($_GET['supprimer'])){
    $produit = $_GET['supprimer'];
    if(($rechercheIndex = array_search($produit, $_SESSION['panier'])) !== false){
        unset($_SESSION['panier'][$rechercheIndex]);
    }
    $_SESSION['panier'] = array_values($_SESSION['panier']);
    header("Location: panier.php");
    exit();
}

?>
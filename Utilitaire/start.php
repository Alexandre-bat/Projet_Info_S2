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
if(isset($_POST['produit'])){
    $id = $_POST['produit'];
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = [];
    }
    $_SESSION['panier'][] = $id;
    header("Location: Carte.php");
    exit();
}

if(isset($_POST['supprimer'])){
    $produit = $_POST['supprimer'];
    if(($rechercheIndex = array_search($produit, $_SESSION['panier'])) !== false){
        unset($_SESSION['panier'][$rechercheIndex]);
    }
    $_SESSION['panier'] = array_values($_SESSION['panier']);
    header("Location: Panier.php");
    exit();
}

if(isset($_POST['vider'])){
    unset($_SESSION['panier']); // supprime tout le panier

    header("Location: panier.php");
    exit();
}

function montrer_utilisateurs($fichier){
    if(!file_exists($fichier)){
        header("Location: Connexion.php?error=1");
        exit();
    }
    $contenu = file_get_contents($fichier);
    $data = json_decode($contenu, true);
    if(!is_array($data)){
        header("Location: Connexion.php?error=1");
        exit();
    }
    foreach($data as $user){
        echo '<div class="admin_who">
                <h2 class="write">' 
                    . htmlspecialchars($user["nom"]) . ' ' . htmlspecialchars($user["prenom"]) . 
                '</h2>
                <form action="update_perm.php" method="post">
                    <input type="hidden" name="nom" value="'. htmlspecialchars($user["nom"]) .'">
                    <input type="hidden" name="prenom" value="'. htmlspecialchars($user["prenom"]) .'">
                    <label class="perm-label">PERM</label>
                    <select class="perm-select" name="perm">
                        <option value="Client" ' . ($user["role"] == "Client" ? "selected" : "") . '>Client</option>
                        <option value="Livreur" ' . ($user["role"] == "Livreur" ? "selected" : "") . '>Livreur</option>
                        <option value="admin" ' . ($user["role"] == "admin" ? "selected" : "") . '>Admin</option>
                    </select>
                    <button type="submit">Valider</button>
                </form>
                <a href="Profil.php?nom=' . urlencode($user["nom"]) . '&prenom=' . urlencode($user["prenom"]) . '" class="adminProfil">PROFIL</a>
            </div>';
    }
}

if (isset($_POST['livre'])) {
    header("Location: Livraison.php?Livre=1");
    exit();
}

if (isset($_POST['abandone'])) {
    header("Location: Livraison.php?Abandon=1");
    exit();
}
?>
<?php
session_start();

date_default_timezone_set('Europe/Paris');

if(isset($_GET['deco'])) {
    session_destroy();
    header("Location: Accueil.php");
    exit();
}
//deconnexion 

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

    // Vérifie si connecté
    if(!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])){
        header("Location: Connexion.php");
        exit();
    }

    // Si connecté, ajout panier
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
//supprime un element du panier

if(isset($_POST['vider'])){
    unset($_SESSION['panier']); 

    header("Location: panier.php");
    exit();
}
// supprime tout le panier

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
        echo '<div class="adminUtilisateurs">
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
                        <option value="restaurateur" ' . ($user["role"] == "restaurateur" ? "selected" : "") . '>Restaurateur</option>
                        <option value="admin" ' . ($user["role"] == "admin" ? "selected" : "") . '>Admin</option>
                    </select>
                    <button class="bouttonclassique" type="submit">Valider</button>
                </form>
                <div id=remise>
                    <button class="bouttonclassique">Accorder une remise</button>
                </div>
                <form action="SupprCompte.php" method="post">
                    <input type="hidden" name="supprimerCompte" value="'. $user["id"] .'">
                    <button class="bouttonclassique">Supprimer le compte</button>
                </form>
                <a href="Profil.php?nom=' . urlencode($user["nom"]) . '&prenom=' . urlencode($user["prenom"]) . '" class="adminProfil">PROFIL</a>
            </div>';
    }
}

function getProduit($produits, $id){
    foreach($produits as $p){
        if($p['id'] == $id){
            return $p;
        }
    }
    return null;
}//Récupère les produits envoyées dans le panier

if (isset($_POST['livre'])) {
    header("Location: Livraison.php?Livre=1");
    exit();
}

if (isset($_POST['abandone'])) {
    header("Location: Livraison.php?Abandon=1");
    exit();
}
?>
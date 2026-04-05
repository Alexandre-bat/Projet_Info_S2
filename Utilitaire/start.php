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

     $fichier_id = __DIR__ . "/../.json/id.json";

    if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {


        $json = file_get_contents("$fichier_id");
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
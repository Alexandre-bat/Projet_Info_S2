<!DOCTYPE html>
<html>

<?php
session_start();

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

<head>
    <title>SIUUSHI - MENU</title>
    <link rel="icon" href="Img/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>

<body>
    <div class="navbar">
        <div class="nav1">
            <a href="Accueil.html" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo">
                Accueil
            </a>
        </div>

        <div class="nav2">
            <a href="Admin.html">Admin</a>
            <a href="Commandes.html">Commandes</a>
            <a href="Livraison.html">Livraison</a>
            <a href="Notation.html">Notation</a>
            <a href="Menu.php">Menu</a>
            <a href="Connexion.html">Connexion</a>
            <a href="Inscription.html">Inscription</a>
            <a href="Profil.html">Profil</a>
        </div>
    </div>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
    <main>
        <div class="blocTitre">
            <div class="titreMenu">
                <h1>Panier</h1>
            </div>
            <?php
                if(isset($_SESSION['panier'])){
                    $nbr = array_count_values($_SESSION['panier']);
                    foreach($nbr as $produit => $quantite){
                    if($produit=="gyoza"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/gyoza.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Bol de Gyoza x<?php echo $quantite; ?></h2>
                        <p>Notre bol de gyoza fait maison </p>
                        <p>Porc haché, chou chinois, ail, gingembre, sauce soja, huile de sésame, pâte à gyoza</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 9*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "rolls"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/rolls.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Rona-roll-do x<?php echo $quantite; ?></h2>
                        <p>Nos rolls signatures</p>
                        <p>Riz vinaigré, algue nori, saumon, thon, avocat, concombre, fromage frais</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 10*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
?>
</div>
</main>
                    
    <!-- Pied de page -->


    <footer>
        <div class="f-container">
            <div class="f-section">
                <h4>À PROPOS</h4>
                <p>SIUUSHI - Restaurant traditionnel depuis 1967</p>
                <p>Une expérience culinaire traditionnel</p>
            </div>

            <div class="f-section">
                <h4>CONTACT</h4>
                <p>📍 Parc des princes</p>
                <p>📞 +33 1 23 45 67 89</p>
            </div>

            <div class="f-section">
                <h4>HORAIRES</h4>
                <p>Lun - Sam: 11h00 - 14h00 / 18h00 - 23h00</p>
                <p> Livraison disponible</p>
            </div>
        </div>

        <div class="f-bottom">
            <p>&copy; 2026 SIUUSHI - Tous droits réservés | Mentions légales | Politique de confidentialité</p>
        </div>
    </footer>
</body>

</html>
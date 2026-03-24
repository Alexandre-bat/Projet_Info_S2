<?php include("start.php"); 
$json = file_get_contents("carte.json");
$produits = json_decode($json, true);

function getProduit($produits, $id){
    foreach($produits as $p){
        if($p['id'] == $id){
            return $p;
        }
    }
    return null;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>SIUUSHI - MENU</title>
    <link rel="icon" href="Img/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>

<body>
    <div class="navbar">
        <div class="nav1">
            <a href="Accueil.php" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo_nav">
                SIUUSHI
            </a>
        </div>

        <div class="nav2">
            <a href="Admin.php">Admin</a>
            <a href="Commandes.php">Commandes</a>
            <a href="Livraison.php">Livraison</a>
            <a href="Notation.php">Notation</a>
            <a href="Menu.php">Carte</a>
            
            <?php 
                if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                    echo '<a href="Profil.php">' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' '. '<img src="Img/profil.png" alt="Logo" class="profil_nav">' .'</a>';
                    echo '<a href=Accueil.php?deco=1>Déconnexion</a>';
                } else {
                    echo '<a href="Connexion.php">Connexion</a>';
                    echo '<a href="Inscription.php">Inscription</a>';
                    
                }
            ?>
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
        <div class="controlBox">
            <?php
                if(isset($_SESSION['panier']) && !empty($_SESSION['panier'])){
                    $nbr = array_count_values($_SESSION['panier']);
                    $total = 0;
                    foreach($nbr as $id => $quantite){
                        $produit = getProduit($produits, $id);
                        if($produit){ 
                            $prixTotal = $produit['prix'] * $quantite;
                            $total += $prixTotal;
                            if($produit['categorie'] == "menu"){
            ?>
            <div class="box">
                <img src="Img/Imagesmenu/<?php echo $produit['img']; ?>" class="imgBox">
                <div class="contenuBox">
                    <h2><?php echo $produit['nom']; ?></h2>
                        <p><?php echo $produit['description']; ?></p>
                        <p><?php echo $produit['personnes_min']; ?> personnes minimum</p>
                        <p><?php echo $produit['plats'][0] . " | " . $produit['plats'][1] . " | " . $produit['plats'][2]; ?></p>
                </div>
                <div class="basBox">
                    <span id="prix">Prix : <?php echo $prixTotal; ?>€</span>
                    <a href="panier.php?supprimer=<?php echo $id; ?>">
                        <button class="bouttonclassique">Supprimer</button>
                    </a>
                </div>
            </div>
            <?php
                            } else {
            ?>
            <div class="box">
                <img src="Img/Imagesmenu/<?php echo $produit['img']; ?>" class="imgBox">
                <div class="contenuBox">
                    <h2><?php echo $produit['nom']; ?> x<?php echo $quantite; ?></h2>
                    <p><?php echo $produit['description']; ?></p>
                    <p><?php echo $produit['ingredients']; ?></p>
                </div>
                <div class="basBox">
                    <span id="prix">Prix : <?php echo $prixTotal; ?>€</span>
                    <a href="panier.php?supprimer=<?php echo $id; ?>">
                        <button class="bouttonclassique">Supprimer</button>
                    </a>
                </div>
            </div>
        <?php
            }
            }
            }
        ?>
        </div>
        <div class="blocTotal">
            <h2 style="text-align:center; color:white;">Total : <?php echo $total; ?>€</h2>
            <a href="panier.php?supprimer=<?php echo $id; ?>">
                <button class="bouttonclassique">Payer</button>
            </a>
        </div>
        <?php
            } else {
                echo "<p style='color:white; text-align:center;'>Votre panier est vide</p>";
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

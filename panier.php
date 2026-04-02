<?php include("Utilitaire/start.php");
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
    <title>SIUUSHI - Panier</title>
    <link rel="icon" href="Img/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>

<body>

    <?php include("Utilitaire/nav.php"); ?>

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
                    <h2><?php echo $produit['nom'];
                        if($quantite > 1){ ?>
                            <span class="quantite">x<?php echo $quantite; ?></span>
                        <?php } ?>
                    </h2>
                        <p><?php echo $produit['description']; ?></p>
                        <p><?php echo $produit['personnes_min']; ?> personnes minimum</p>
                        <p><?php echo $produit['plats'][0] . " | " . $produit['plats'][1] . " | " . $produit['plats'][2]; ?></p>
                </div>
                <div class="basBox">
                    <span id="prix">Prix : <?php echo $prixTotal; ?>€</span>
                    <form action="panier.php" method="post">
                        <input type="hidden" name="supprimer" value="<?php echo $id; ?>">
                        <button class="bouttonclassique">Supprimer</button>
                    </form>
                </div>
            </div>
            <?php
                            } else {
            ?>
            <div class="box">
                <img src="Img/Imagesmenu/<?php echo $produit['img']; ?>" class="imgBox">
                <div class="contenuBox">
                    <h2><?php echo $produit['nom'];
                        if($quantite > 1){ ?>
                            <span class="quantite">x<?php echo $quantite; ?></span>
                        <?php } ?>
                    </h2>
                    <p><?php echo $produit['description']; ?></p>
                    <p><?php echo $produit['ingredients']; ?></p>
                </div>
                <div class="basBox">
                    <span id="prix">Prix : <?php echo $prixTotal; ?>€</span>
                    <form action="panier.php" method="post">
                        <input type="hidden" name="supprimer" value="<?php echo $id; ?>">
                        <button class="bouttonclassique">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php
            }
            }
            }
        ?>
        </div>
        <div class="blocTotal">
            <h2>Total : <?php echo $total; ?>€</h2>
            <?php  $_SESSION['prix'] = $total; ?>
            <form action="panier.php" method="post">
                <button class="bouttonclassique" name="vider">Vider le panier</button>
            </form>
            <form action="Payer.php" method="post">
                <button class="bouttonclassique">Payer</button>
            </form>
        </div>
        <?php
            } else {
                echo "<p class='paniervide'>Votre panier est vide</p>";
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

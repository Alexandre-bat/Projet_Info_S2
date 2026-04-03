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
        <div class="blocTotalPanier">
            <div class="blocGauchePanier">
            <h2>Total : <?php echo $total; ?>€</h2>
            <?php  $_SESSION['prix'] = $total; ?>
            <form action="panier.php" method="post">
                <button class="bouttonclassique" name="vider">Vider le panier</button>
            </form>
            </div>
            <div class="blocDroitPanier">
            <?php if(!isset($_GET['payer'])){ ?>
                <form action='validation.php' method='POST'>
                    <input type="radio" name="momentCommande" value="immediate" checked> Immédiat 
                    <input type="radio" name="momentCommande" value="emporter"> Emporter 
                    <input type="radio" name="momentCommande" value="livraison"> Livraison 
                    <input type="date" name="dateCommande" required> 
                    <input type="time" name="heureCommande" required>
                    <button type="submit" class="bouttonclassique">Valider</button>
                </form>
            <?php };?>
                <?php 
                if(isset($_GET['payer'])){
                    require('getapikey.php');

                    $transaction = uniqid();
                    $montant = $_SESSION["prix"];
                    $vendeur = "MI-3_A";
                    $retour = "http://localhost:3000/Payer.php";

                    $api_key = getAPIKey($vendeur);

                    $control = md5($api_key
                            . "#" . $transaction
                            . "#" . $montant
                            . "#" . $vendeur
                            . "#" . $retour . "#" );
                ?>

                <form action='https://www.plateforme-smc.fr/cybank/index.php' method='POST'>

                    <input type='hidden' name='transaction' value="<?php echo $transaction ?>">
                    <input type='hidden' name='montant' value="<?php echo $montant ?>">
                    <input type='hidden' name='vendeur' value="<?php echo $vendeur ?>">
                    <input type='hidden' name='retour' value="<?php echo $retour ?>">
                    <input type='hidden' name='control' value="<?php echo $control ?>">
                    <button type="submit" class="bouttonclassique">Payer</button>
                </form>
                <?php }?>
        </div>
        <?php
            } else {
                echo "<p class='paniervide'>Votre panier est vide</p>";
            }
        ?>
    </div>
</main>
                    
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

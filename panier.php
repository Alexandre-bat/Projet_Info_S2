<?php include("Utilitaire/start.php");
    $json = file_get_contents(".json/carte.json");
    $produits = json_decode($json, true);
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
                                        //défini les variables nécessaires dans l'affichage plus bas
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
                                                <form action="Panier.php" method="post">
                                                    <input type="hidden" name="supprimer" value="<?php echo $id; ?>">
                                                    <button class="bouttonclassique">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Affichages des menus -->
                                    <?php } 
                                    else {?>
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
                                                <form action="Panier.php" method="post">
                                                    <input type="hidden" name="supprimer" value="<?php echo $id; ?>">
                                                    <button class="bouttonclassique">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Affichage de ce qui n'est pas menu -->
                                    <?php }
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
                        <!-- Total plus bouton pour vider le panier -->
                        <div class="blocDroitPanier">
                            <?php if(!isset($_GET['payer'])){ ?>
                                <form action='Fonctions/validation.php' method='POST'>
                                    <label class="radioBox"> 
                                        <input class="momentPanier" type="radio" name="momentCommande" value="immediate" checked>
                                        <span>Immédiat</span>
                                    </label>
                                    <label class="radioBox">
                                        <input class="momentPanier" type="radio" name="momentCommande" value="emporter">
                                        <span>Emporter</span>
                                    </label>
                                    <label class="radioBox">
                                        <input class="momentPanier" type="radio" name="momentCommande" value="livraison">
                                        <span>Livraison</span>
                                    </label>
                                    <input class="bouttondate" type="date" min="<?php echo date("Y-m-d") ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" name="dateCommande" required>
                                    <input class="bouttonheure" type="time" min="11:00" max="23:00" name="heureCommande" required>                    
                                    <button type="submit" class="bouttonclassique">Valider</button>
                                </form>
                                <!-- formulaire pour avoir l'heure ou le mode de la commande (on supprimera la date et l'heure quand on appuiera sur immediat quand on aura le JS)-->
                            <?php } ?>
                            <?php 
                                if(isset($_GET['payer'])){
                                require('getapikey.php');

                                $transaction = uniqid();
                                $montant = $_SESSION["prix"];
                                $vendeur = "MI-3_A";
                                $retour = "http://localhost:8080/Fonctions/payer.php";

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
                            <!-- envoie des information a l'api cybank-->
                            <?php }?>
                        </div>
                        <?php
                            } else {
                                echo "<p class='paniervide'>Votre panier est vide</p>";
                            }
                            // cas ou le panier est vide 
                        ?>
                </div>
            </main>
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>

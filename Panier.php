<?php include("Utilitaire/start.php");
    $json = file_get_contents(".json/carte.json");
    $produits = json_decode($json, true);
    $contenu = file_get_contents(".json/id.json");
    $data = json_decode($contenu, true);
    if(!is_array($data)){
        header("Location: Connexion.php?error=1");
        exit();
    }
    if (!isset($_SESSION["id"])) {
        header("Location: Connexion.php");
        exit();
    }
?>    


<!DOCTYPE html>
    <html>

        <head>
            <title>SIUUSHI - Panier</title>
            <link rel="icon" href="Img/logo.png" type="image/png">
            <link rel="stylesheet" type="text/css" href="Dark_Style.css">
        </head>
        <body>
            <?php include("Utilitaire/nav.php"); ?>
            <main>
                <div class="blocTitre">
                    <div class="titreMenu">
                        <h1>Panier</h1>
                    </div>
                    <div class="controlBox">
                        <p id="panierVide" style="display:none;"> Votre panier est vide </p>
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
                                                        <span class="quantite" data-quantite="<?php echo $quantite; ?>">x<?php echo $quantite; ?></span>
                                                    <?php } ?>
                                                </h2>
                                                <p><?php echo $produit['description']; ?></p>
                                                <p><?php echo $produit['personnes_min']; ?> personnes minimum</p>
                                                <p><?php echo $produit['plats'][0] . " | " . $produit['plats'][1] . " | " . $produit['plats'][2]; ?></p>
                                            </div>
                                            <div class="basBox">
                                                <span class="prix" data-prix-unitaire="<?php echo $produit['prix']; ?>"> Prix : <?php echo $prixTotal; ?>€ </span>
                                                <form class="formSupprimer">
                                                    <input type="hidden" name="produit" value="<?php echo $id; ?>">
                                                    <input type="hidden" name="action" value="supprimer">
                                                    <button class="bouttonclassique">
                                                        Supprimer
                                                    </button>
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
                                                        <span class="quantite" data-quantite="<?php echo $quantite; ?>">x<?php echo $quantite; ?></span>
                                                    <?php } ?>
                                                </h2>
                                                <p><?php echo $produit['description']; ?></p>
                                                <p><?php echo $produit['ingredients']; ?></p>
                                            </div>
                                            <div class="basBox">
                                                <span class="prix" data-prix-unitaire="<?php echo $produit['prix']; ?>"> Prix : <?php echo $prixTotal; ?>€ </span>
                                                <form class="formSupprimer">
                                                    <input type="hidden" name="produit" value="<?php echo $id; ?>">
                                                    <input type="hidden" name="action" value="supprimer">
                                                    <button class="bouttonclassique">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Affichage de ce qui n'est pas menu -->
                                    <?php }
                                    }
                                } 
                            }
                        ?>
                    </div>
                    <div class="blocTotalPanier" id="blocTotalPanier">
                        <div class="blocGauchePanier">
                            <h2 id="totalPanier">Total : <?php echo $total; ?>€</h2>
                            <?php  $_SESSION['prix'] = $total; ?>
                            <form id="formVider">
                                <input type="hidden" name="action" value="vider">
                                <button class="bouttonclassique">
                                    Vider le panier
                                </button>
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
                                require(__DIR__ . "/Fonctions/getapikey.php");

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
                </div>
            </main>
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
            <script>
                // suppr produit
                document.querySelectorAll(".formSupprimer").forEach(function(form){
                    form.addEventListener("submit", async function(e){
                        e.preventDefault();
                        let formData = new FormData(form);
                        try{
                            let response = await fetch("Fonctions/supprPanier.php", {
                                method: "POST",
                                body: formData
                            });
                            let data = await response.text();
                            if(data == "ok"){
                                let box = form.closest(".box");
                                let quantiteSpan = box.querySelector(".quantite");
                                let prixSpan = box.querySelector(".prix");
                                let quantite = 1;
                                if(quantiteSpan){
                                    quantite = parseInt(quantiteSpan.dataset.quantite);
                                }
                                if(quantite > 1){
                                    quantite--;
                                    quantiteSpan.dataset.quantite = quantite;
                                    quantiteSpan.textContent = "x" + quantite;
                                    let prixUnitaire = parseFloat(prixSpan.dataset.prixUnitaire);
                                    prixSpan.textContent = "Prix : " + (prixUnitaire * quantite) + "€";
                                    let totalPanier = document.getElementById("totalPanier");
                                    let totalActuel = parseFloat(totalPanier.textContent.replace("Total : ", "").replace("€", ""));
                                    totalPanier.textContent = "Total : " + (totalActuel - prixUnitaire) + "€";
                                }
                                else{
                                    box.remove();
                                    let prixUnitaire = parseFloat(prixSpan.dataset.prixUnitaire);
                                    let totalPanier = document.getElementById("totalPanier");
                                    let totalActuel = parseFloat(totalPanier.textContent.replace("Total : ", "").replace("€", ""));
                                    totalPanier.textContent = "Total : " + (totalActuel - prixUnitaire) + "€";
                                }
                                let compteur = document.getElementById("compteurPanier");
                                let valeur = parseInt(compteur.textContent);
                                compteur.textContent = valeur - 1;
                                if(valeur - 1 <= 0){
                                    document.getElementById("lienPanier").style.display = "none";
                                    document.getElementById("blocTotalPanier").style.display = "none";
                                    document.getElementById("panierVide").style.display = "block";
                                }
                            }
                        }
                        catch(error){
                            console.log(error);
                        }
                    })
                });
                // vider panier
                document.getElementById("formVider").addEventListener("submit", async function(e){
                    e.preventDefault();
                    let formData = new FormData(this);
                    try{
                        let response = await fetch("Fonctions/supprPanier.php", {
                            method: "POST",
                            body: formData
                        });
                        let data = await response.text();
                        if(data == "ok"){
                            document.querySelectorAll(".box").forEach(function(box){
                                box.remove();
                            });
                            document.getElementById("compteurPanier").textContent = 0;
                            document.getElementById("lienPanier").style.display = "none";
                            document.getElementById("blocTotalPanier").style.display = "none";
                            document.getElementById("panierVide").style.display = "block";
                        }
                    }
                    catch(error){
                        console.log(error);
                    }
                });
            </script>
        </body>
    </html>

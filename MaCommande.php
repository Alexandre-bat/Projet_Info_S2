<?php
    include("Utilitaire/start.php");
    if (!isset($_SESSION["id"])) {
        header("Location: Connexion.php");
        exit();
    }
    $jsonProduits = file_get_contents("json/carte.json");
    $produits = json_decode($jsonProduits, true);
    $jsonCommandes = file_get_contents("json/commandes.json");
    $commandes = json_decode($jsonCommandes, true);
    $commande = null;
    // initialisation et récupération des json
    foreach($commandes as $c){
        if($c["idUtilisateur"] == $_SESSION['id'] && $c["Statut"] == "Attente"){
            $commande = $c;
            break;
        }
    }
    if(!$commande){
        exit("Aucune commande modifiable.");
    }
    $ancienPrix = floatval($commande["Prix"]);
    $nouveauPrix = 0;
    // vérification de la commande en attente
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>SIUUSHI - Ma commande</title>
            <link rel="stylesheet" href="Style.css">
        </head>
        <body>
            <?php include("Utilitaire/nav.php"); ?>
            <div class="blocTitre">
                <div class="titreMenu">
                    <h1>Ma commande</h1>
                </div>
                <div class="controlBox" id="zoneCommande">
                    <?php
                        foreach($commande["Produits"] as $prodCommande){
                            $produit = null;
                            foreach($produits as $p){
                                if($p["nom"] == $prodCommande["nom"]){
                                    $produit = $p;
                                    break;
                                }
                            }
                            if($produit){
                                $quantite = $prodCommande["quantite"];
                                $prixTotal = $produit["prix"] * $quantite;
                                $nouveauPrix += $prixTotal;
                                ?>
                                <div class="box" data-prix="<?php echo $produit["prix"]; ?>">
                                    <img src="Img/Imagesmenu/<?php echo $produit['img']; ?>" class="imgBox">
                                    <div class="contenuBox">
                                        <h2>
                                            <?php 
                                                echo $produit["nom"]; 
                                                if($quantite > 1){ 
                                            ?>
                                            <span class="quantite" data-quantite="<?php echo $quantite; ?>">
                                                x<?php echo $quantite; ?>
                                            </span>
                                            <?php 
                                                } 
                                            ?>
                                        </h2>
                                        <p> <?php echo $produit["description"]; ?> </p>
                                        <?php 
                                            if($produit["categorie"] == "menu"){ 
                                        ?>
                                        <p> <?php echo $produit["personnes_min"]; ?> personnes minimum </p>
                                        <p>
                                            <?php
                                                echo $produit["plats"][0] ." | ". $produit["plats"][1] ." | ". $produit["plats"][2];
                                            ?>
                                        </p>
                                        <?php 
                                            } 
                                            else { 
                                        ?>
                                        <p> <?php echo $produit["ingredients"]; ?> </p>
                                        <?php 
                                            } 
                                        ?>
                                    </div>
                                    <div class="basBox">
                                        <span class="prix" data-prix-unitaire="<?php echo $produit["prix"]; ?>">
                                            Prix : <?php echo $prixTotal; ?>€
                                        </span>
                                        <button class="bouttonclassique supprimer">
                                            Supprimer
                                        </button>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                                ?>
                </div>
            </div>
            <?php
                $difference = $nouveauPrix - $ancienPrix;
            ?>
            <!-- affichage de tous les produits (ceux de la commande originale et ceux rajoutés via carte.php) -->
            <div class="blocTotalPanier">
                <div class="blocGauchePanier">
                    <h2> Ancien prix : <?php echo $ancienPrix; ?>€ </h2>
                    <h2 id="nouveauPrix"> Nouveau prix : <?php echo $nouveauPrix; ?>€ </h2>
                    <h2 id="difference">
                        <?php
                            if($difference > 0){
                                echo "Supplément à payer : ".$difference."€";
                            }
                            else if($difference < 0){
                                echo "Différence : ".abs($difference)."€";
                            }
                            else{
                                echo "Aucune différence";
                            }
                        ?>
                    </h2>
                </div>
                <!-- affichage des différents prix (ancien nouveau et diff) -->
                <div class="blocDroitPanier" id="blocDroit">
                    <button id="validerSuppr" class="bouttonclassique">
                        Valider suppressions
                    </button>
                    <?php 
                        if($difference > 0){
                            require(__DIR__ . "/Fonctions/getapikey.php");
                            $transaction = uniqid();
                            $montant = $difference;
                            $vendeur = "MI-3_A";
                            $retour = "http://localhost:8080/Fonctions/payer.php?modif=1";
                            $api_key = getAPIKey($vendeur);
                            $control = md5(
                                $api_key
                                . "#" . $transaction
                                . "#" . $montant
                                . "#" . $vendeur
                                . "#" . $retour . "#"
                            );
                            $_SESSION["modif_commande"] = true;
                    ?>
                    <form id="formpaiement" action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">

                        <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
                        <input type="hidden" id="montantPaiement" name="montant" value="<?php echo $montant; ?>">
                        <input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
                        <input type="hidden" name="retour" value="<?php echo $retour; ?>">
                        <input type="hidden" name="control" value="<?php echo $control; ?>">
                        <button class="bouttonclassique">
                            Payer la différence
                        </button>
                    </form>
                    <?php } ?>
                    <?php 
                        if($difference < 0){ 
                    ?>
                    <div>
                        <button class="bouttonclassique recevoirTicket" data-ticket="<?php echo abs($difference); ?>"> Recevoir un ticket </button>
                        <button class="bouttonclassique rienRecevoir"> Ne rien recevoir </button>
                    </div>
                    <?php 
                        } 
                    ?>
                </div>
            </div>
            <!-- si ancien prix>nouveau prix alors on peut prendre un ticket ou rien et si ancien prix< nouveau prix alors on peut payer
            important de cliquer sur valider supressions pour supprimer des produits -->
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
            <script>
                let ancienPrix = <?php echo $ancienPrix; ?>;
                let nouveauPrix = <?php echo $nouveauPrix; ?>;
                document.querySelectorAll(".supprimer").forEach(function(btn){
                    btn.addEventListener("click", function(){
                        let box = this.closest(".box");
                        let prixSpan = box.querySelector(".prix");
                        let quantiteSpan = box.querySelector(".quantite");
                        let quantite = 1;
                        if(quantiteSpan){
                            quantite = parseInt(quantiteSpan.dataset.quantite);
                        }
                        let prixUnitaire = parseFloat(prixSpan.dataset.prixUnitaire);
                        if(quantite > 1){
                            quantite--;
                            quantiteSpan.dataset.quantite = quantite;
                            quantiteSpan.textContent = "x" + quantite;
                            prixSpan.textContent = "Prix : " + (prixUnitaire * quantite) + "€";
                        }
                        else{
                            box.remove();
                        }
                        nouveauPrix -= prixUnitaire;
                        mettreAJourPrix();
                    });
                });
                //gestion de la suppression des produits
                function mettreAJourPrix(){
                    document.getElementById("nouveauPrix").textContent = "Nouveau prix : " + nouveauPrix + "€";
                    let difference = nouveauPrix - ancienPrix;
                    let texte = "";
                    if(difference > 0){
                        texte = "Supplément à payer : " + difference + "€";
                    }
                    else if(difference < 0){
                        texte = "Différence : " + Math.abs(difference) + "€";
                    }
                    else{
                        texte = "Aucune différence";
                    }
                    document.getElementById("difference").textContent = texte;
                    let inputMontant = document.getElementById("montantPaiement");
                    if(inputMontant){
                        if(difference > 0){
                            inputMontant.value = difference;
                        }
                    }
                }
                // fonction qui remet a jour nouveau prix et différence
                document.getElementById("validerSuppr").addEventListener("click", async function(){
                    let produits = [];
                    document.querySelectorAll(".box").forEach(function(box){
                        let nom = box.querySelector("h2").childNodes[0].textContent.trim();
                        let quantiteSpan = box.querySelector(".quantite");
                        let quantite = 1;
                        if(quantiteSpan){
                            quantite = parseInt(quantiteSpan.dataset.quantite);
                        }
                        let prixUnitaire = parseFloat(box.querySelector(".prix").dataset.prixUnitaire);
                        produits.push({
                            nom: nom,
                            quantite: quantite,
                            prix: prixUnitaire * quantite
                        });
                    });
                    let response = await fetch("Fonctions/modifsCommandeAttente.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            produits: produits,
                            nouveauPrix: nouveauPrix
                        })
                    });
                    let data = await response.text();
                    if(data == "ok"){
                        location.reload();
                    }
                });
                // gère validation de suppression
                document.querySelector(".recevoirTicket")?.addEventListener("click", async function(){
                    let ticket = this.dataset.ticket;
                    let id = "<?php echo $_SESSION["id"]; ?>";
                    await fetch("Utilitaire/start.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "action=reduction&id=" + id + "&reduction=" + ticket
                    });
                    let response = await fetch("Utilitaire/start.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "action=majPrix&nouveauPrix=" + nouveauPrix
                    });
                    let data = await response.text();
                    if(data == "supprime"){
                        window.location.href = "Accueil.php";
                    }
                    else{
                        location.reload();
                    }
                });
                document.querySelector(".rienRecevoir")?.addEventListener("click", async function(){
                    let response = await fetch("Utilitaire/start.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "action=majPrix&nouveauPrix=" + nouveauPrix
                    });
                    let data = await response.text();
                    if(data == "supprime"){
                        window.location.href = "Accueil.php";
                    }
                    else{
                        location.reload();
                    }
                });
                // boutons lorsque nouveau prix < ancien prix
            </script>
        </body>
    </html>
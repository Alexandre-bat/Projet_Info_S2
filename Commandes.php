<?php 
    include("Utilitaire/start.php"); 
    // Modif Status des commandes quand un livreur est séléctionné par le restorateur
    if(isset($_POST['livreur']) && isset($_POST['idCommande'])){
        $idLivreur = $_POST['livreur'];
        $idCommande = $_POST['idCommande'];

        $contenu = file_get_contents('.json/commandes.json');
        $data = json_decode($contenu, true);

        foreach($data as &$commande){
            if($commande["idCommande"] == $idCommande){
                $commande["idLivreur"] = $idLivreur;
                $commande["Statut"] = "En livraison";
                break;
            }
        }

        file_put_contents('.json/commandes.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: Commandes.php");
        exit();
    }

    // Fichier JSON
    $contenu = file_get_contents(".json/commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) { $data = []; }

    // Fonction qui permet d'afficher/séléctionner les livreurs
    function choisir_livreur($fichier, $Commande){
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

        echo '<select class="perm-select" name="livreur">';
        echo '<option value="" "selected" : "" >  </option>';
        foreach($data as $user){
            if($user["role"] == "Livreur"){
                $selected = (isset($Commande["idLivreur"]) && $Commande["idLivreur"] == $user["id"]) ? "selected" : "";
                echo '<option value="' . $user["id"] . '" ' . $selected . '>'
                . $user["prenom"] . ' ' . $user["nom"]
                . '</option>';
            }
        }
        echo '</select>';
        echo '<input type="hidden" name="idCommande" value="'.$Commande["idCommande"].'">';
        echo '<button type="submit">Valider</button>';
    }
?>
<!DOCTYPE html>
    <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>SIUUSHI - Commandes</title>
            <link rel="stylesheet" type="text/css" href="Style.css">
            <link rel="icon" href="Img/logo.png" type="image/png">
        </head>

        <!-- Trie des Status pour l'affichage -->
        <?php
            $contenu = file_get_contents(".json/commandes.json");
            $data = json_decode($contenu, true);
            if (!is_array($data)) {
                $data = [];
            }
            $commandeImmediate = [];
            $commandeAttente = [];
            $commandeLivraison = [];
            $commandeLivree=[];
            $commandeAbandonnee=[];
            foreach ($data as $commande) {
                if($commande["Paiement"]=="Payee"){
                    if ($commande["Statut"] == "En preparation") {
                        $commandeImmediate[] = $commande;
                    } else if($commande["Statut"]=="Attente"){
                        $commandeAttente[] = $commande;
                    }
                    else if($commande["Statut"]=="En livraison"){
                        $commandeLivraison[] = $commande;
                    }else if($commande["Statut"] == "abandonnee"){
                        $commandeAbandonnee[] = $commande;
                    }else if($commande["Statut"] == "livree"){
                        $commandeLivree[] = $commande;
                    }
                }
            }
        ?>

        <body>
            <?php include("Utilitaire/nav.php"); ?>

            <!-- Affiche les différentes commandes -->
            <div class="en_attente">
                <h2>Commandes en attente</h2>
                <div class="liste_commandes">
                    <?php if(empty($commandeAttente)){ ?>
                        <p>Il n'y a pas de commande à cette étape</p>
                    <?php } else{ 
                        foreach ($commandeAttente as $commande) { ?>
                            <div class="commande">
                                <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
                                <?php foreach ($commande["Produits"] as $produit) { ?>
                                    <p>
                                        <?php echo "Plats =" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                                    </p>
                                <?php } ?>
                                <p>Date: <?php echo $commande["Date prevue"]; ?> </p>
                                <p>Date: <?php echo $commande["Heure prevue"]; ?> </p>
                                <p>Total: <?php echo $commande["Prix"]; ?>€</p>

                                <div class="bouttonsCommandes">
                                    <a href="DetailCommande.php?id=<?php echo $commande["idCommande"]; ?>">
                                        <button class="bouttonclassique">Détails</button>
                                    </a>
                                    <form action="Fonctions/CommandesModifs.php" method="post">
                                        <input type="hidden" name="priseEnCharge" value="<?php echo $commande["idCommande"]; ?>">
                                        <button class="bouttonclassique">Prise en charge</button>
                                    </form>
                                </div>
                            </div>
                        <?php }  
                    } ?>
                </div>
            </div>

            <div class="en_attente">
                <h2>Commandes en préparation</h2>
                <div class="liste_commandes">
                    <?php if(empty($commandeImmediate)){ ?>
                        <p>Il n'y a pas de commande à cette étape</p>
                    <?php } else{ ?>
                        <?php foreach ($commandeImmediate as $commande) { ?>
                            <div class="commande">
                                <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
                                <?php foreach ($commande["Produits"] as $produit) { ?>
                                    <p>
                                        <?php echo "Plats =" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                                    </p>
                                <?php } ?>
                                <p>Date: <?php echo $commande["Date prevue"]; ?> </p>
                                <p>Date: <?php echo $commande["Heure prevue"]; ?> </p>
                                <p>Total: <?php echo $commande["Prix"]; ?>€</p>

                                <div class="bouttonsCommandes">
                                    <a href="DetailCommande.php?id=<?php echo $commande["idCommande"]; ?>">
                                        <button class="bouttonclassique">Détails</button>
                                    </a>
                                    <form action="Fonctions/CommandesModifs.php" method="post">
                                        <input type="hidden" name="priseEnLivraison" value="<?php echo $commande["idCommande"]; ?>">
                                        <button class="bouttonclassique">Attribuer aux livreurs</button>
                                    </form>
                                </div>
                            </div>
                        <?php } 
                    } ?>
                </div>
            </div>

            <div class="en_attente">
                <h2>Commandes en livraison</h2>
                <div class="liste_commandes">
                    <?php if(empty($commandeLivraison)){ ?>
                        <p>Il n'y a pas de commande à cette étape</p>
                    <?php   } else {  ?>
                        <?php foreach ($commandeLivraison as $commande) { ?>
                            <div class="commande">
                                <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
                                <?php foreach ($commande["Produits"] as $produit) { ?>
                                    <p>
                                        <?php echo "Plats =" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                                    </p>
                                <?php } ?>
                                <p>Date: <?php echo $commande["Date prevue"]; ?> </p>
                                <p>Date: <?php echo $commande["Heure prevue"]; ?> </p>
                                <p>Total: <?php echo $commande["Prix"]; ?>€</p>

                                <div class="bouttonsCommandes">
                                    <a href="DetailCommande.php?id=<?php echo $commande["idCommande"]; ?>">
                                        <button class="bouttonclassique">Détails</button>
                                    </a>
                                    <form action="Commandes.php" method="post">
                                        <?php choisir_livreur('.json/id.json', $commande); ?>
                                    </form>
                                </div>
                            </div>
                        <?php }  
                    } ?>
                </div>
            </div>

            <div class="en_attente">
                <h2>Commandes Abandonnee</h2>
                <div class="liste_commandes">
                    <?php if(empty($commandeAbandonnee)){ ?>
                        <p>Il n'y a pas de commande à cette étape</p>
                    <?php } else{ ?>
                        <?php foreach ($commandeAbandonnee as $commande) { ?>
                            <div class="commande">
                                <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
                                <?php foreach ($commande["Produits"] as $produit) { ?>
                                    <p>
                                        <?php echo "Plats =" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                                    </p>
                                <?php } ?>
                                <p>Date: <?php echo $commande["Date prevue"]; ?> </p>
                                <p>Date: <?php echo $commande["Heure prevue"]; ?> </p>
                                <p>Total: <?php echo $commande["Prix"]; ?>€</p>

                                <div class="bouttonsCommandes">
                                    <a href="DetailCommande.php?id=<?php echo $commande["idCommande"]; ?>">
                                        <button class="bouttonclassique">Détails</button>
                                    </a>
                                    <form action="Commandes.php" method="post">
                                        <?php choisir_livreur('.json/id.json', $commande); ?>
                                    </form>
                                </div>
                            </div>
                        <?php } 
                    } ?>
                </div>
            </div>

            <div class="en_attente">
                <h2>Commandes Livrées</h2>
                <div class="liste_commandes">
                <?php if(empty($commandeLivree)){ ?>
                    <p>Il n'y a pas de commande à cette étape</p>
                <?php } else{ ?>
                    <?php foreach ($commandeLivree as $commande) { ?>
                        <div class="commande">
                            <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
                            <?php foreach ($commande["Produits"] as $produit) { ?>
                                <p>
                                    <?php echo "Plats =" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                                </p>
                            <?php } ?>
                            <p>Date: <?php echo $commande["Date prevue"]; ?> </p>
                            <p>Date: <?php echo $commande["Heure prevue"]; ?> </p>
                            <p>Total: <?php echo $commande["Prix"]; ?>€</p>
                        </div>
                    <?php } 
                } ?>
                </div>
            </div>

            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>
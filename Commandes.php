<?php include("Utilitaire/start.php"); 

function choisir_livreur($fichier){
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

    echo '<select class="perm-select" name="perm">';

    foreach($data as $user){
        if($user["role"] == "Livreur"){
            echo '<option value="'.$user["id"].'">'
                .$user["prenom"].' '.$user["nom"].
                '</option>';
        }
    }

    echo '</select>';
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

<?php
    $contenu = file_get_contents("commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) {
        $data = [];
    }
    $commandeImmediate = [];
    $commandeAttente = [];
    $commandeLivraison = [];
    foreach ($data as $commande) {
        if($commande["Paiement"]=="Payee"){
            if ($commande["Statut"] == "preparation") {
                $commandeImmediate[] = $commande;
            } else if($commande["Statut"]=="attente"){
                $commandeAttente[] = $commande;
            }
            else if($commande["Statut"]=="En livraison"){
                $commandeLivraison[] = $commande;
            }
        }
    }
?>

<body>
<?php include("Utilitaire/nav.php"); ?>

<div class="en_attente">
    <h2>Commandes pour plus tard</h2>
    <div class="liste_commandes">
    <?php foreach ($commandeAttente as $commande) { ?>
        <div class="commande">
            <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
            <?php foreach ($commande["Produits"] as $produit) { ?>
                <p>
                    <?php echo "Plats=" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                </p>
            <?php } ?>
            <p>Total: <?php echo $commande["Prix"]; ?>€</p>

            <div class="bouttonsCommandes">
                <a href="details_commande.php?id=<?php echo $commande["idCommande"]; ?>">
                    <button class="bouttonclassique">Détails</button>
                </a>
                <form action="CommandesModifs.php" method="post">
                    <input type="hidden" name="priseEnCharge" value="<?php echo $commande["idCommande"]; ?>">
                    <button class="bouttonclassique">Prise en charge</button>
                </form>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

<div class="en_attente">
    <h2>Commandes en préparation</h2>
<div class="liste_commandes">
    <?php foreach ($commandeImmediate as $commande) { ?>
        <div class="commande">
            <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
            <?php foreach ($commande["Produits"] as $produit) { ?>
                <p>
                    <?php echo "Plats=" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                </p>
            <?php } ?>
            <p>Total: <?php echo $commande["Prix"]; ?>€</p>

            <div class="bouttonsCommandes">
                <a href="details_commande.php?id=<?php echo $commande["idCommande"]; ?>">
                    <button class="bouttonclassique">Détails</button>
                </a>
                <form action="CommandesModifs.php" method="post">
                    <input type="hidden" name="priseEnLivraison" value="<?php echo $commande["idCommande"]; ?>">
                    <button class="bouttonclassique">Attribuer aux livreurs</button>
                </form>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

<div class="en_attente">
    <h2>Commandes en livraison</h2>
<div class="liste_commandes">
    <?php foreach ($commandeLivraison as $commande) { ?>
        <div class="commande">
            <h4>Commande n° <?php echo $commande["idCommande"]; ?></h4>
            <?php foreach ($commande["Produits"] as $produit) { ?>
                <p>
                    <?php echo "Plats=" . $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?>
                </p>
            <?php } ?>
            <p>Total: <?php echo $commande["Prix"]; ?>€</p>

            <div class="bouttonsCommandes">
                <a href="details_commande.php?id=<?php echo $commande["idCommande"]; ?>">
                    <button class="bouttonclassique">Détails</button>
                </a>
                <?php choisir_livreur('id.json'); ?>
                <button type="submit">Valider</button>';
            </div>
        </div>
    <?php } ?>
    </div>
</div>

    <footer>
        <?php include("Utilitaire/footer.php"); ?>
    </footer>
</body>

</html>
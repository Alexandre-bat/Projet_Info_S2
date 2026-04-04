<?php include("Utilitaire/start.php"); 

if(isset($_POST['livreur']) && isset($_POST['idCommande'])){
    $idLivreur = $_POST['livreur'];
    $idCommande = $_POST['idCommande'];

    $contenu = file_get_contents('commandes.json');
    $data = json_decode($contenu, true);

    foreach($data as &$commande){
        if($commande["idCommande"] == $idCommande){
            $commande["idLivreur"] = $idLivreur;
            $commande["Statut"] = "En livraison";
            break;
        }
    }

    file_put_contents('commandes.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: Commandes.php");
    exit();
}

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
                <form action="Commandes.php" method="post">
                    <?php choisir_livreur('id.json', $commande); ?>
                </form>
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
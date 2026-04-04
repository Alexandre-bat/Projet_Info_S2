<?php
include("Utilitaire/start.php");

if (!isset($_GET['id'])) {
    echo "Commande introuvable";
    exit();
}

$idCommande = $_GET['id'];

if (!file_exists("commandes.json")) {
    echo "Aucune commande";
    exit();
}

$contenu = file_get_contents("commandes.json");
$data = json_decode($contenu, true);

if (!is_array($data)) {
        $data = [];
}

$commandeTrouvee = null;

foreach ($data as $commande) {
    if ($commande["idCommande"] == $idCommande) {
        $commandeTrouvee = $commande;
        break;
    }
}

?>
<!DOCTYPE html>
<html>

<body id="accueilBody">
    <head>
        <title>SIUUSHI - DetailCommande</title>
        <link rel="icon" href="Img/logo.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="Style.css">
    </head>
    <body>
    <?php include("Utilitaire/nav.php"); ?>

<main>
    <div class="blocDetail">
        <h1 id="titreBarreDetail">Détails de la commande :</h1>

        <div class="commande">
            <p>ID de la Commande : <?php echo $commandeTrouvee["idCommande"]; ?></p>
            <p>ID de l'Utilisateur : <?php echo $commandeTrouvee["idUtilisateur"]; ?></p>
            <p>Date de commande : <?php echo $commandeTrouvee["Date"]; ?></p>
            <p>Type de commande : <?php echo $commandeTrouvee["Moment"]; ?></p>
            <p>Date demandée : <?php echo $commandeTrouvee["Date prevue"]; ?></p>
            <p><strong>Heure demandée :</strong> <?php echo $commandeTrouvee["Heure prevue"]; ?></p>
            <p><strong>Paiement :</strong> <?php echo $commandeTrouvee["Paiement"]; ?></p>
            <p><strong>Statut :</strong> <?php echo $commandeTrouvee["Statut"]; ?></p>

            <h1>Produits :</h1>

            <?php foreach ($commandeTrouvee["Produits"] as $produit) { ?>
                <div class="produitCommande">
                    <p>Nom : <?php echo $produit["nom"]; ?></p>
                    <p>Quantité : x<?php echo $produit["quantite"]; ?></p>
                    <p>Prix : <?php echo $produit["prix"]; ?> €</p>
                </div>
            <?php } ?>

            <h3>Total : <?php echo $commandeTrouvee["Prix"]; ?> €</h3>
        </div>
    </div>
</main>

</body>
</html>
<?php include("Utilitaire/start.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Profil-Modifs</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>

<body>

<?php include("Utilitaire/nav.php"); ?>

    <div class="blocProfil">
        <h1>Profil</h1>
        <div class="infoPerso">
            <div class="modifsPersos">
                <h3>Mes informations personnelles</h3>
                <form action="Profil.php" method="post">
                    <input type="image" src="Img/ok_edit.png" alt="crayon pour modifier" class="crayon">
                </form>
            </div>
            <form action="edit.php" method="post">
                <input type="txt" id="nom" placeholder=<?php echo $_SESSION['nom'] ; ?>>
                <input type="txt" id="prenom" placeholder=<?php echo $_SESSION['prenom']; ?>>
                <input type="txt" id="adresse" placeholder=<?php echo $_SESSION['adresse']; ?>>
                <input type="txt" id="telephone" placeholder=<?php echo $_SESSION['telephone']; ?>>
            <form action="crayon.php" method="post">
        </div>
        <div class="histoCommandes">
            <h2>Commandes</h2>
            <?php
                $contenu = file_get_contents("commandes.json");
                $data    = json_decode($contenu, true);
                if (!is_array($data)) {
                    $data = [];
                }
                $commandeUtilisateur = [];
                foreach ($data as $commande) {
                    if ($commande["idUtilisateur"] == $_SESSION["id"]) {
                        $commandeUtilisateur[] = $commande;
                    }
                }
                if (empty($commandeUtilisateur)) {
                    echo "<p>Vous n'avez pas encore de commandes.</p>";
                } 
                else {
                    foreach ($commandeUtilisateur as $commande) {
                        echo "<div class='histoUnique'>";
                            echo "<div class='histoHeader'>
                                <span>" . $commande["Date"] . "</span>
                            </div>";
                            echo "<span>" . $commande["Paiement"] . "</span><br>";
                            echo "<span>" ." ". $commande["Statut"] . "</span>";
                            echo "<div class='histoCorps'>";
                                foreach ($commande["Produits"] as $produit) {
                                    echo "<p>" . $produit["nom"] . " x" . $produit["quantite"] . "</p>";
                                }
                            echo "</div>";
                            echo "<div class='histoFooter'>
                                <span>Total : " . $commande["Prix"] . "€</span>
                                <span>" . $commande["Moment"] . "</span>
                            </div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>

    <footer>
        <?php include("Utilitaire/footer.php"); ?>
    </footer>
</body>

</html>
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
            <div class="commandesProfil">
                <h3>Commande #1267</h3>
                <p>10/02/2026</p>
                <p>Statut : Livrée</p>
                <p>Total : 67,00€</p>
                <p>Plat : Supreme Ronaldo</p>
            </div>
            <div class="commandesProfil">
                <h3>Commande #6321</h3>
                <p>15/01/2026</p>
                <p>Statut : Livrée</p>
                <p>Total : 45,00€</p>
                <p>Plat : Siuuushimi,
                    Rona-roll-do
                </p>
            </div>
        </div>
    </div>

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
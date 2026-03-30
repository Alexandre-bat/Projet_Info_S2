<?php include("Utilitaire/start.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Administrateur</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>
<body>
<?php include("Utilitaire/nav.php"); ?>

    <div class="admin">
        <div class="adminTitre">
            <h1>ESPACE ADMINISTRATEUR</h1>
            <p>Gérez les utilisateurs et leurs permissions</p>
        </div>
        <div class="adminGestion">

            <?php montrer_utilisateurs("id.json"); ?>

        </div>
    </div>

    <footer>
        <div class="f-container">
            <div class="f-section">
                <h3>À PROPOS</h3>
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
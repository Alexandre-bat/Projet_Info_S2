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
        <?php include("Utilitaire/footer.php"); ?>
    </footer>
</body>

</html>
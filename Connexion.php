<?php include("Utilitaire/start.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Connexion</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>
<body>

<?php include("Utilitaire/nav.php"); ?>

    <div class="form">
        <h2>Connexion</h2>
        <?php if(isset($_GET['error'])){echo "<p class='connexion'> Id ou Mot de Passe incorrect </p>";}?>
        <form action="login.php" method="post">

            <div class="input-group">
                <label class="lb">Téléphone</label>
                <input class="ip" type="tel" name="tel" required>
            </div>

            <div class="input-group">
                <label class="lb">Mot de passe</label>
                <input class="ip" type="password" name="mdp" required>
            </div>

            <button class="boutons" type="submit">Se connecter</button>

        </form>

        <p class="inscrire">
            Pas encore de compte ?
            <a href="Inscription.php" class="lien">S'inscrire</a>
        </p>
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
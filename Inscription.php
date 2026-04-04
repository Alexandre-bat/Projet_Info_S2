<?php include("Utilitaire/start.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Inscription</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>
<body>

<?php include("Utilitaire/nav.php"); ?>

    <div class="form">
        <?php
            if(isset($_GET['erreur'])){
                echo "<p class='connexion'> Utilisateur déjà utilisé</p>";
            }
        ?>

        <h2>Inscription</h2>

        <form action="proce.php" method="post">

            <div class="input-group">
                <label class="lb">Prénom</label>
                <input class="ip" type="text" name="prenom" required>
            </div>

            <div class="input-group">
                <label class="lb">Nom</label>
                <input class="ip" type="text" name="nom" required>
            </div>

            <div class="input-group">
                <label class="lb">Téléphone</label>
                <input class="ip" type="tel" name="tel" required>
            </div>

            <div class="input-group">
                <label class="lb">Adresse</label>
                <input class="ip" type="text" name="adresse" required>
            </div>

            <div class="input-group">
                <label class="lb">Mot de Passe</label>
                <input class="ip" type="password" name="mdp" required>
            </div>

            <button class="boutons" type="submit">S'inscrire</button>

        </form>
        <p class="connexion">
            Vous avez déjà un compte ?
            <a href="Connexion.php" class="lien">Se connecter</a>
        </p>
    </div>
    </div>
    
    <footer>
        <?php include("Utilitaire/footer.php"); ?>
    </footer>
</body>

</html>

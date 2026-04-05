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
                <!-- Message d'erreur dans le cas ou le compte n'est pas dans id.json-->

                <form action="Fonctions/login.php" method="post"> 

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
                <!-- Formulaire pour verifier que l'utilisateur existe dans id.json-->

                <p class="inscrire">
                    Pas encore de compte ?
                    <a href="Inscription.php" class="lien">S'inscrire</a>
                </p>
                <!-- Lien vers inscription -->
            </div>

            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>
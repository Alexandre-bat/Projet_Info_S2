<?php include("Utilitaire/start.php"); ?>
<!DOCTYPE html>
    <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>SIUUSHI - Connexion</title>
            <link rel="stylesheet" type="text/css" href="Dark_Style.css">
            <link rel="icon" href="Img/logo.png" type="image/png">
        </head>
        <body>
        <?php include("Utilitaire/nav.php"); ?>
            <div class="form">
                <h2>Connexion</h2>
                <?php if(isset($_GET['error'])){echo "<p class='connexion'> Id ou Mot de Passe incorrect </p>";}?>
                <?php if(isset($_GET['bloquer'])){echo "<p class='connexion'> Le compte est bloqué </p>";}?>
                <!-- Message d'erreur dans le cas ou le compte n'est pas dans id.json-->

                <form action="Fonctions/login.php" method="post"> 

                    <div class="input-group">
                        <label class="lb">Téléphone</label>
                         <input class="ip" type="tel" name="tel" id="tel" maxlength="14" required oninput="compteurTel()">
                        <small id="resteTel"></small>
                    </div>

                    <div class="input-group">
                        <label class="lb">Mot de passe</label>
                        <input class="ip" type="password" name="mdp" id="mdp" required>

                        <label class="lb">
                            <input type="checkbox" onclick="togglePassword()"> Afficher le mot de passe
                        </label>
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
            <script>
                function togglePassword() {
                    var mdp = document.getElementById("mdp");
                    if (mdp.type === "password") {
                        mdp.type = "text";
                    } else {
                        mdp.type = "password";
                    }
                }
                function compteurTel() {
                    const tel = document.getElementById("tel");
                    const reste = document.getElementById("resteTel");

                    let restant = 14 - tel.value.length;

                    reste.textContent = "Il reste " + restant + " caractères";
                }
            </script>
            <script src="JS/validation.js"></script>
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>

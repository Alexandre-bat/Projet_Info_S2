<?php include("Utilitaire/start.php"); ?>
<!DOCTYPE html>
    <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>SIUUSHI - Inscription</title>
            <link rel="stylesheet" type="text/css" href="Dark_Style.css">
            <link rel="icon" href="Img/logo.png" type="image/png">
        </head>
        <body>

            <?php include("Utilitaire/nav.php"); ?>

            <div class="form">
                <?php
                    if(isset($_GET['erreur'])){
                        echo "<p class='connexion'> Utilisateur déjà utilisé</p>";
                    }
                    // message d'erreur dans le cas ou l'id(numéro de tel) est deja utilisé
                ?>

                <h2>Inscription</h2>

                <form action="Fonctions/proce.php" method="post">

                    <div class="input-group">
                        <label class="lb">Prénom</label>
                        <input class="ip" type="text" name="prenom" id="prenom" oninput="compteur('prenom',50,'restePn')" required>
                        <small id="restePn"></small>
                    </div>

                    <div class="input-group">
                        <label class="lb">Nom</label>
                        <input class="ip" type="text" name="nom" id="nom" oninput="compteur('nom',50,'resteN')" required>
                        <small id="resteN"></small>
                    </div>

                    <div class="input-group">
                        <label class="lb">Téléphone</label>
                         <input class="ip" type="tel" name="tel" id="tel" maxlength="14" required oninput="compteur('tel',14,'resteTel')">
                        <small id="resteTel"></small>
                    </div>

                    <div class="input-group">
                        <label class="lb">Adresse</label>
                        <input class="ip" type="text" name="adresse" id="ad" oninput="compteur('ad',200,'resteA')" required>
                        <small id="resteA"></small>
                    </div>

                    <div class="input-group">
                        <label class="lb">Mot de Passe</label>
                        <input class="ip" type="password" name="mdp" id="mdp" required>

                        <label class="lb">
                            <input type="checkbox" onclick="togglePassword()"> Afficher le mot de passe
                        </label>
                    </div>

                    <button class="boutons" type="submit">S'inscrire</button>
                    <!-- formulaire d'inscription-->
                </form>
                <p class="connexion">
                    Vous avez déjà un compte ?
                    <a href="Connexion.php" class="lien">Se connecter</a>
                </p>
                <!-- bouton pour se connecter-->
            </div>
            <script src="JS/validation.js"></script>
            <script>
                        function togglePassword() {
                            var mdp = document.getElementById("mdp");
                            if (mdp.type === "password") {
                                mdp.type = "text";
                            } else {
                                mdp.type = "password";
                            }
                        }

                        function compteur(id,number,id2) {
                            const tel = document.getElementById(id);
                            const reste = document.getElementById(id2);

                            let restant = number - tel.value.length;

                            reste.textContent = "Il reste " + restant + " caractères";
                        }
                    </script>
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>

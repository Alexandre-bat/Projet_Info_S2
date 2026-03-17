<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Inscription</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>

<body>
    <div class="navbar">
        <div class="nav1">
            <a href="Accueil.php" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo">
                Accueil
            </a>
        </div>

        <div class="nav2">
            <a href="Admin.php">Admin</a>
            <a href="Commandes.php">Commandes</a>
            <a href="Livraison.php">Livraison</a>
            <a href="Notation.php">Notation</a>
            <a href="Menu.php">Carte</a>
            <a href="Connexion.php">Connexion</a>
            <a href="Profil.php">Profil</a>
        </div>
    </div>

    <video autoplay loop muted playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
    </video>

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

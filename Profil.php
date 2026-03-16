<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Profil</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>

<body>
    <div class="navbar">
        <div class="nav1">
            <a href="Accueil.html" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo_nav">
                Accueil
            </a>
        </div>

        <div class="nav2">
            <a href="Admin.html">Admin</a>
            <a href="Commandes.html">Commandes</a>
            <a href="Livraison.html">Livraison</a>
            <a href="Notation.html">Notation</a>
            <a href="Menu.html">Carte</a>
            <a href="Connexion.php">Connexion</a>
            <a href="Inscription.html">Inscription</a>
        </div>
    </div>

    <video autoplay loop muted playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
    </video>

    <?php session_start();?>
    <div class="blocProfil">
        <h1>Profil</h1>
        <div class="infoPerso">
            <div class="modifsPersos">
                <h3>Mes informations personnelles</h3>
                <img src="Img/crayon.png" alt="crayon pour modifier" class="crayon">
            </div>
            <p>Nom : <?php echo $_SESSION['nom']; ?></p>
            <p>Prénom : <?php echo $_SESSION['prenom']; ?></p>
            <p>Adresse : <?php echo $_SESSION['adresse']; ?></p>
            <p>Téléphone : <?php echo $_SESSION['telephone']; ?></p>
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
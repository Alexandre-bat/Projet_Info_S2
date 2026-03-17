<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Administrateur</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>


<body>
    <div class="navbar">
        <div class="nav1">
            <a href="Accueil.php" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo_nav">
                Accueil
            </a>
        </div>

        <div class="nav2">
            <a href="Commandes.php">Commandes</a>
            <a href="Livraison.php">Livraison</a>
            <a href="Notation.php">Notation</a>
            <a href="Menu.php">Carte</a>
            <a href="Connexion.php">Connexion</a>
            <a href="Inscription.php">Inscription</a>
            <a href="Profil.php">Profil</a>
        </div>
    </div>

    <video autoplay loop muted playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
    </video>

    <div class="admin">
        <div class="adminTitre">
            <h1>ESPACE ADMINISTRATEUR</h1>
            <p>Gérez les utilisateurs et leurs permissions</p>
        </div>
        <div class="adminGestion">
            <div class="admin_who">
                <h2 class="write">Ronaldo Cristiano</h2>
                <form id="perms" action="Profil.php" method="get">
                    <label class="perm-label">PERM</label>
                    <select class="perm-select">
                        <option value="Client">Client</option>
                        <option value="Livreur">Livreur</option>
                    </select>
                </form>
                <a href="Profil.php" class="adminProfil">PROFIL
                </a>
            </div>

            <div class="admin_who">
                <h2 class="write">Messi Lionel</h2>
                <form id="perms" action="Profil.php" method="get">
                    <label class="perm-label">PERM</label>
                    <select class="perm-select">
                        <option value="Client">Client</option>
                        <option value="Livreur">Livreur</option>
                    </select>
                </form>
                <a href="Profil.php" class="adminProfil">PROFIL
                </a>
            </div>
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
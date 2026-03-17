<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Notation</title>
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
            <a href="Admin.php">Admin</a>
            <a href="Commandes.php">Commandes</a>
            <a href="Livraison.php">Livraison</a>
            <a href="Menu.php">Carte</a>
            <a href="Connexion.php">Connexion</a>
            <a href="Inscription.php">Inscription</a>
            <a href="Profil.php">Profil</a>
        </div>
    </div>

    <video autoplay loop muted playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
    </video>

    <div class="blocnotation">
        <div class="blocGaucheNotation">
            <h1 id="titre">Notez-nous !</h1>
            <p>Votre avis compte pour nous !</p>
            <form action="submit_rating.php" method="POST" class="rating-form">
                <p>Plat :</p>
                <div class="etoiles">
                    <input class="ip" type="radio" id="platEtoile5" name="plat" value="5"><label class="lb" for="platEtoile5">★</label>
                    <input class="ip" type="radio" id="platEtoile4" name="plat" value="4"><label class="lb" for="platEtoile4">★</label>
                    <input class="ip" type="radio" id="platEtoile3" name="plat" value="3"><label class="lb" for="platEtoile3">★</label>
                    <input class="ip" type="radio" id="platEtoile2" name="plat" value="2"><label class="lb" for="platEtoile2">★</label>
                    <input class="ip" type="radio" id="platEtoile1" name="plat" value="1"><label class="lb" for="platEtoile1">★</label>
                </div>

                <p>Livraison :</p>
                <div class="etoiles">
                    <input class="ip" type="radio" id="livraisonEtoile5" name="livraison" value="5"><label class="lb"
                        for="livraisonEtoile5">★</label>
                    <input class="ip" type="radio" id="livraisonEtoile4" name="livraison" value="4"><label class="lb"
                        for="livraisonEtoile4">★</label>
                    <input class="ip" type="radio" id="livraisonEtoile3" name="livraison" value="3"><label class="lb"
                        for="livraisonEtoile3">★</label>
                    <input class="ip" type="radio" id="livraisonEtoile2" name="livraison" value="2"><label class="lb"
                        for="livraisonEtoile2">★</label>
                    <input class="ip" type="radio" id="livraisonEtoile1" name="livraison" value="1"><label class="lb"
                        for="livraisonEtoile1">★</label>
                </div>

                <p>Accessibilité :</p>
                <div class="etoiles">
                    <input class="ip" type="radio" id="accessibiliteEtoile5" name="accessibilite" value="5"><label class="lb"
                        for="accessibiliteEtoile5">★</label>
                    <input class="ip" type="radio" id="accessibiliteEtoile4" name="accessibilite" value="4"><label class="lb"
                        for="accessibiliteEtoile4">★</label>
                    <input class="ip" type="radio" id="accessibiliteEtoile3" name="accessibilite" value="3"><label class="lb"
                        for="accessibiliteEtoile3">★</label>
                    <input class="ip" type="radio" id="accessibiliteEtoile2" name="accessibilite" value="2"><label class="lb"
                        for="accessibiliteEtoile2">★</label>
                    <input class="ip" type="radio" id="accessibiliteEtoile1" name="accessibilite" value="1"><label class="lb"
                        for="accessibiliteEtoile1">★</label>
                </div>

                <div class="groupeInputs">
                    <label class="lb">Avis supplémentaire</label>
                    <input class="ip" type="text" name="avis" required>
                </div>
                <button class="boutons" type="submit">Envoyer</button>
            </form>
        </div>
        <div class="blocDroitInfos">
            <h2>Pourquoi nous noter ?</h2>
            <p>Votre avis nous aide à améliorer notre service et à offrir une meilleure expérience culinaire. En
                partageant votre opinion, vous contribuez à faire de SIUUSHI un endroit encore meilleur pour tous nos
                clients.</p>
            <h2>Merci de votre soutien !</h2>
        </div>
    </div>

    <div class="fauxAvis">
        <h2>Avis de nos clients</h2>
        <div class="avis">
            <div class="avis-item">
                <p><strong>Anonyme</strong></p>
                <p>⭐⭐⭐⭐⭐</p>
                <p>Excellent restaurant ! Les plats sont délicieux et le service est impeccable.</p>
            </div>
            <div class="avis-item">
                <p><strong>Anonyme</strong></p>
                <p>⭐⭐⭐⭐</p>
                <p>Très bon rapport qualité-prix. J'ai adoré la variété du menu.</p>
            </div>
            <div class="avis-item">
                <p><strong>Anonyme</strong></p>
                <p>⭐</p>
                <p>J'ai commandé Ronaldo il est jamais arrivé chez moi. Bref je déconseille vivement ce restaurant.</p>
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
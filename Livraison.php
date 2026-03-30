<!DOCTYPE html>
<?php

if (isset($_POST['livre'])) {
    header("Location: Livraison.php?Livre=1");
    exit();
}

if (isset($_POST['abandone'])) {
    header("Location: Livraison.php?Abandon=1");
    exit();
}

?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Livraison</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>

<body id="liv_body">

    <?php include("Utilitaire/nav.php"); ?>

<div class="cours_livraison">
        <h2>Livraison</h2>
        <div class="info">
            <h3>Info</h3>
            <p><span class="surligner">Commande :</span> n° X</p>
            <p><span class="surligner">Nom :</span> Mr. Cristiano Ronaldo</p>
            <p><span class="surligner">Adresse :</span> Av. du Parc, 95000 Cergy</p>
            <p><span class="surligner">Numero :</span> +33 6 XX XX XX XX</p>
            <p><span class="surligner">Code Interphone :</span> XXXX</p>
            <p><span class="surligner">Commentaires :</span> SIUUUUUUUU</p>
            <div class="adresse">
                <a href="https://www.google.com/maps?q=49.034695, 2.070082" target="_blank">
                <img src="Img\map.jpg" alt="Ouvrir dans Google Maps">
                </a>
                <a href="https://waze.com/ul?q=49.034695, 2.070082" target="_blank">
                <img src="Img\waze.png" alt="Ouvrir dans Waze">
                </a>
            </div>
        </div>
    <div class="validation">
        <form method="post" action="Livraison.php">
            <button class="bouttonclassique" type="submit" name="livre" value="1">
                Commande Livrée
            </button>
            <button class="bouttonclassique" type="submit" name="abandone" value="1">
                Abandonner la Commande
            </button>
        </form>
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
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

    <?php
    require('getapikey.php');
    $transaction = uniqid();
    $montant = $_SESSION["prix"];
    $vendeur = "MI-3_A";
    $retour = "Retour_paiement.php";
    $api_key = getAPIKey($vendeur);
    $control = md5($api_key
                . "#" . $transaction
                . "#" . $montant
                . "#" . $vendeur
                . "#" . $statut . "#" );
    ?>
    <div class="form">
        <?php echo $_SESSION[prix]?>
        <form action='https://www.plateforme-smc.fr/cybank/index.php' method='POST'>
            <input type='hidden' name='transaction' value="<?php echo $transaction?>">
            <input type='hidden' name='montant' value="<?php echo $montant?>">
            <input type='hidden' name='vendeur' value="<?php echo $vendeur?>">
            <input type='hidden' name='retour' value="<?php echo $retour?>">
            <input type='hidden' name='control' value="<?php echo $control?>">
            <button class="boutons" type="submit">Payer maintenant</button>
        </form>
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
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
            <a href="Accueil.html" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo">
                Accueil
            </a>
        </div>

        <div class="nav2">
            <a href="Admin.html">Admin</a>
            <a href="Commandes.html">Commandes</a>
            <a href="Livraison.html">Livraison</a>
            <a href="Notation.html">Notation</a>
            <a href="Menu.html">Carte</a>
            <a href="Connexion.html">Connexion</a>
            <a href="Profil.html">Profil</a>
        </div>
    </div>

    <video autoplay loop muted playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
    </video>
    
    <?php
        function traiter_fichier($fichier){

            $f = fopen($fichier,"a+");
            if(!$f){
                echo "Pb fichier";
                exit();
            }

            $contenu = file_get_contents($fichier);
            $contenu = str_replace("\n", " ", $contenu);
            $tab = explode(" ", $contenu);

            $f_name = $_POST["prenom"];
            $l_name  = $_POST["nom"];
            $contact = $_POST["tel"];
            $security = $_POST["mdp"];

            $id = [];

            for($i=0; $i < count($tab); $i+=4){

                $id[$i][0] = $tab[$i];
                $id[$i][1] = $tab[$i+1];
                $id[$i][2] = $tab[$i+2];
                $id[$i][3] = $tab[$i+3];

                if($contact == $id[$i][2] && $security == $id[$i][3]){
                    fclose($f);
                    header("Location:Inscription.php?erreur=1");
                    exit();
                }
            }

            fwrite($f, "$f_name $l_name $contact $security\n");
            fclose($f);
    }

    traiter_fichier("id.txt");
    ?>

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

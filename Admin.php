<?php include("Utilitaire/start.php"); 
    $contenu = file_get_contents("id.json");
    $data = json_decode($contenu, true);
    if(!is_array($data)){
        header("Location: Connexion.php?error=1");
        exit();
    }
    if (!isset($_SESSION["id"])) {
        header("Location: Connexion.php");
        exit();
    }
    foreach($data as $user){
        if($_SESSION["id"] == $user["id"]){
            if ($user["role"]!="admin"){
                header("Location: Accueil.php");
                exit();
            }
        }
    }
//verifie le role de l'admin et renvoie sur connexion si pas de compte
?>
<!DOCTYPE html>
    <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>SIUUSHI - Administrateur</title>
            <link rel="stylesheet" type="text/css" href="Style.css">
            <link rel="icon" href="Img/logo.png" type="image/png">
        </head>
        <body>
            <?php include("Utilitaire/nav.php"); ?>

            <div class="admin">
                <div class="adminTitre">
                    <h1>ESPACE ADMINISTRATEUR</h1>
                    <p>Gérez les utilisateurs et leurs permissions</p>
                </div>
                <div class="adminGestion">

                    <?php montrer_utilisateurs("id.json"); ?> <!-- Appel la fonction montrer_utilisateurs pour pouvoir gérer les utilisateurs via l'admin --> 

                </div>
            </div>

            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>
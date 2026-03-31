<?php 
    include("Utilitaire/start.php"); 
    
    if (isset($_GET["nom"]) && isset($_GET["prenom"]) && $role === "admin") {
        $nomCible    = $_GET["nom"];
        $prenomCible = $_GET["prenom"];
    } else {
        $nomCible    = $_SESSION["nom"]    ?? null;
        $prenomCible = $_SESSION["prenom"] ?? null;
    }

    $profilUser = null;
    if ($nomCible && $prenomCible) {
        $json  = file_get_contents("id.json");
        $users = json_decode($json, true);
        foreach ($users as $user) {
            if ($user["nom"] === $nomCible && $user["prenom"] === $prenomCible) {
                $profilUser = $user;
                break;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SIUUSHI - Profil</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="icon" href="Img/logo.png" type="image/png">
</head>

<body>

    <?php include("Utilitaire/nav.php"); ?>
    
    <div class="blocProfil">
        <h1>Profil</h1>
        <div class="infoPerso">
            <div class="modifsPersos">
                <h3>Mes informations personnelles</h3>
                <form action="" method="post">
                    <input type="image" src="Img/crayon.png" alt="crayon pour modifier" class="crayon">
                </form>
            </div>
            <p>Nom : <?php echo htmlspecialchars($profilUser["nom"]); ?></p>
            <p>Prénom : <?php echo htmlspecialchars($profilUser["prenom"]); ?></p>
            <p>Adresse : <?php echo htmlspecialchars($profilUser["adresse"] ?? "Non renseignée"); ?></p>
            <p>Téléphone : <?php echo htmlspecialchars($profilUser["tel"] ?? "Non renseigné"); ?></p>
        </div>
        <div class="histoCommandes">
            <h2>Commandes</h2>
            <?php
                $contenu = file_get_contents("commandes.json");
                $data    = json_decode($contenu, true);

                if (!is_array($data)) {
                    $data = [];
                }

                $commandesUtilisateur = [];
                foreach ($data as $commande) {
                    if ($commande["id"] == $_SESSION["id"]) {
                        $commandesUtilisateur[] = $commande;
                    }
                }

                if (empty($commandesUtilisateur)) {
                    echo "<p>Vous n'avez pas encore de commandes.</p>";
                } 
                else {
                    foreach ($commandesUtilisateur as $commande) {
                        $total = 0;
                        $plats = [];

                        foreach ($commande["Produits"] as $produit) {
                            $total  += $produit["prix"];
                            $plats[] = $produit["nom"] . " x" . $produit["quantite"];
                        }
                        
                        echo "
                        <div class='commandesProfil'>
                        <p>" . htmlspecialchars($commande["Date"]) . "</p>
                        <p>Statut : Livrée</p>
                        <p>Total : " . number_format($total, 2) . "€</p>
                        <p>Plats : " . htmlspecialchars(implode(", ", $plats)) . "</p>
                        </div>";
                    }
                }
            ?>
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

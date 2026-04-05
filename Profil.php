<?php 
    include(__DIR__ . "/Utilitaire/start.php"); 
    
    // Affiche soit l'utilisateur où l'on souhaite voir le profil via Admin.php ou son profil
    if (isset($_GET["nom"]) && isset($_GET["prenom"]) && $role === "admin") {
        $nomCible    = $_GET["nom"];
        $prenomCible = $_GET["prenom"];
        $idCible = $_GET["id"];
    } else {
        $nomCible    = $_SESSION["nom"]    ?? null;
        $prenomCible = $_SESSION["prenom"] ?? null;
        $idCible = $_SESSION["id"] ?? null;
    }

    $profilUser = null;
    if ($nomCible && $prenomCible) {
        $json  = file_get_contents(__DIR__ . "/.json/id.json");
        $users = json_decode($json, true);
        foreach ($users as $user) {
            if ($user["nom"] === $nomCible && $user["prenom"] === $prenomCible && (string)$user["id"] === (string)$idCible) {
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
                    <!-- Affiche les données personnelles -->
                    <div class="modifsPersos">
                        <h3>Mes informations personnelles</h3>
                        <form action="" method="post">
                            <input type="image" src="Img/crayon.png" alt="crayon pour modifier" class="crayon">
                        </form>
                    </div>
                    <?php if ($profilUser): ?>
                        <p>Nom : <?php echo htmlspecialchars($profilUser["nom"]); ?></p>
                        <p>Prénom : <?php echo htmlspecialchars($profilUser["prenom"]); ?></p>
                        <p>Adresse : <?php echo htmlspecialchars($profilUser["adresse"] ?? ""); ?></p>
                        <p>Téléphone : <?php echo htmlspecialchars($profilUser["tel"]); ?></p>
                    <?php else: ?>
                        <p>Utilisateur introuvable.</p>
                    <?php endif; ?>
                </div>
                <div class="histoCommandes">
                    <h2>Commandes</h2>
                    <!-- Affiche l'historique des commandes -->
                    <?php
                        $contenu = file_get_contents(__DIR__ . "/.json/commandes.json");
                        $data    = json_decode($contenu, true);
                        if (!is_array($data)) {
                            $data = [];
                        }
                        $commandeUtilisateur = [];
                        foreach ($data as $commande) {
                            if ($commande["idUtilisateur"] == $idCible) {
                                $commandeUtilisateur[] = $commande;
                            }
                        }
                        if (empty($commandeUtilisateur)) {
                            echo "<p>Vous n'avez pas encore de commandes.</p>";
                        } 
                        else {
                            foreach ($commandeUtilisateur as $commande) {
                                echo "<div class='histoUnique'>";
                                    echo "<div class='histoHeader'>
                                        <span>" . $commande["Date"] . "</span>
                                    </div>";
                                    echo "<span>" . $commande["Paiement"] . "</span><br>";
                                    echo "<span>" ." ". $commande["Statut"] . "</span>";
                                    echo "<div class='histoCorps'>";
                                        foreach ($commande["Produits"] as $produit) {
                                            echo "<p>" . $produit["nom"] . " x" . $produit["quantite"] . "</p>";
                                        }
                                    echo "</div>";
                                    echo "<div class='histoFooter'>
                                        <span>Total : " . $commande["Prix"] . "€</span>
                                        <span>" . $commande["Moment"] . "</span>
                                    </div>";
                                echo "</div>";
                            }
                        }
                    ?>
                </div>
            </div>

            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>

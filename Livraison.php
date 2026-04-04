<?php 
    include("Utilitaire/start.php");

    if (isset($_POST['livre'])) {
        header("Location: Livraison.php?Livre=1");
        exit();
    }
    if (isset($_POST['abandone'])) {
        header("Location: Livraison.php?Abandon=1");
        exit();
    }

    // Lecture des fichiers JSON
    $contenu = file_get_contents("commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) { $data = []; }

    $contenuUtilisateurs = file_get_contents("id.json");
    $users = json_decode($contenuUtilisateurs, true);
    if (!is_array($users)) { $users = []; }

    // Trouver un utilisateur par son id
    function trouver_user($users, $id) {
        foreach ($users as $user) {
            if ($user["id"] == $id) {
                return $user;
            }
        }
        return null;
    }

    // Filtrer les commandes du livreur connecté
    $aLivrer = [];
    foreach ($data as $commande) {
        if (isset($commande["idLivreur"]) && $commande["idLivreur"] == $_SESSION["id"]) {
            $aLivrer[] = $commande;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>SIUUSHI - Livraison</title>
        <link rel="stylesheet" type="text/css" href="Style.css">
        <link rel="icon" href="Img/logo.png" type="image/png">
    </head>
    <body id="liv_body">

        <?php include("Utilitaire/nav.php"); ?>

        <?php if(empty($aLivrer)): ?>
            <div class="cours_livraison">
                <h2>Il n'y a pas de livraison pour le moment</h2>
            </div>
        <?php else: ?>
            <?php foreach ($aLivrer as $commande): ?>
                <?php $client = trouver_user($users, $commande["idUtilisateur"]); ?>
                <div class="cours_livraison">
                    <h2>Livraison — Commande <?php echo $commande["idCommande"]; ?></h2>
                    <div class="info">
                        <p>
                            <span class="surligner">Nom :</span>
                            <?php echo $client ? $client["prenom"] . " " . $client["nom"] : "Inconnu"; ?>
                        </p>
                        <p>
                            <span class="surligner">Adresse :</span>
                            <?php echo $client ? $client["adresse"] : "Inconnue"; ?>
                        </p>
                        <p>
                            <span class="surligner">Numéro :</span>
                            <?php echo $client ? $client["tel"] : "Inconnu"; ?>
                        </p>
                        <p>
                            <span class="surligner">Heure prévue :</span>
                            <?php echo $commande["Heure prevue"]; ?>
                        </p>
                        <p>
                            <span class="surligner">Total :</span>
                            <?php echo $commande["Prix"]; ?>€
                        </p>
                        <h4>Produits :</h4>
                        <?php foreach ($commande["Produits"] as $produit): ?>
                            <p><?php echo $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?></p>
                        <?php endforeach; ?>
                    </div>

                    <div class="validation">
                        <form method="post" action="Livraison.php">
                            <input type="hidden" name="idCommande" value="<?php echo $commande["idCommande"]; ?>">
                            <button class="bouttonclassique" type="submit" name="livre" value="1">
                                Commande Livrée
                            </button>
                            <button class="bouttonclassique" type="submit" name="abandone" value="1">
                                Abandonner la Commande
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <footer>
            <?php include("Utilitaire/footer.php"); ?>
        </footer>
    </body>
</html>
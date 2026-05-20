<?php 
    include("Utilitaire/start.php");
    $contenu = file_get_contents(".json/id.json");
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
            if ($user["role"]!="Livraison" && $user["role"]!="admin"){
                header("Location: Accueil.php");
                exit();
            }
        }
    }

    // Lecture des fichiers JSON
    $contenu = file_get_contents(".json/commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) { $data = []; }

    $contenuUtilisateurs = file_get_contents(".json/id.json");
    $utilisateurs = json_decode($contenuUtilisateurs, true);
    if (!is_array($utilisateurs)) { $utilisateurs = []; }

    // Trouver un utilisateur par son id
    function trouver_utilisateur($utilisateurs, $id) {
        foreach ($utilisateurs as $utilisateur) {
            if ($utilisateur["id"] == $id) {
                return $utilisateur;
            }
        }
        return null;
    }

    // Filtrer les commandes du livreur connecté
    $aLivrer = [];
    foreach ($data as $commande) {
        if (isset($commande["idLivreur"]) 
            && $commande["idLivreur"] == $_SESSION["id"]
            && ($commande["Statut"] ?? "") !== "livree"
            && ($commande["Statut"] ?? "") !== "abandonnee") {
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

            <?php if(empty($aLivrer)){ ?>
                <div class="cours_livraison">
                    <h2>Il n'y a pas de livraison pour le moment</h2>
                </div>
            <?php } else{ ?>
                <?php foreach ($aLivrer as $commande){ ?>
                    <?php $client = trouver_utilisateur($utilisateurs, $commande["idUtilisateur"]); ?>
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
                            <?php foreach ($commande["Produits"] as $produit){ ?>
                                <p><?php echo $produit["nom"]; ?> x<?php echo $produit["quantite"]; ?></p>
                            <?php } ?>
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
                            <form action="Fonctions/etatLivraisons.php" method="post">
                                <input type="hidden" name="idCommande" value="<?php echo $commande["idCommande"]; ?>">
                                <button class="bouttonclassique" type="submit" name="livre" value="1">
                                    Commande Livrée
                                </button>
                                <button class="bouttonclassique" type="submit" name="abandone" value="1">
                                    Abandonner la Commande
                                </button>
                            </form>
                            <a href="DetailCommande.php?id=<?php echo $commande["idCommande"]; ?>">
                                <button class="bouttonclassique">Détails</button>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>

            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>
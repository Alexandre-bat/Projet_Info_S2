<?php include("Utilitaire/start.php"); ?>
<!-- Comme Accueil.php quasi que du html donc plutôt clair -->
<!DOCTYPE html>
    <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>SIUUSHI - Notation</title>
            <link rel="stylesheet" type="text/css" href="Dark_Style.css">
            <link rel="icon" href="Img/logo.png" type="image/png">
        </head>
        <body>

            <?php include("Utilitaire/nav.php"); ?>

            <div class="blocnotation">
                <div class="blocGaucheNotation">
                    <h1 id="titre">Notez-nous !</h1>
                    <p>Votre avis compte pour nous !</p>
                    <form action="Notation.php" method="POST" class="rating-form">
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
                            <input class="ip" type="radio" id="livraisonEtoile5" name="livraison" value="5"><label class="lb" for="livraisonEtoile5">★</label>
                            <input class="ip" type="radio" id="livraisonEtoile4" name="livraison" value="4"><label class="lb" for="livraisonEtoile4">★</label>
                            <input class="ip" type="radio" id="livraisonEtoile3" name="livraison" value="3"><label class="lb" for="livraisonEtoile3">★</label>
                            <input class="ip" type="radio" id="livraisonEtoile2" name="livraison" value="2"><label class="lb" for="livraisonEtoile2">★</label>
                            <input class="ip" type="radio" id="livraisonEtoile1" name="livraison" value="1"><label class="lb" for="livraisonEtoile1">★</label>
                        </div>

                        <p>Accessibilité :</p>
                        <div class="etoiles">
                            <input class="ip" type="radio" id="accessibiliteEtoile5" name="accessibilite" value="5"><label class="lb" for="accessibiliteEtoile5">★</label>
                            <input class="ip" type="radio" id="accessibiliteEtoile4" name="accessibilite" value="4"><label class="lb" for="accessibiliteEtoile4">★</label>
                            <input class="ip" type="radio" id="accessibiliteEtoile3" name="accessibilite" value="3"><label class="lb" for="accessibiliteEtoile3">★</label>
                            <input class="ip" type="radio" id="accessibiliteEtoile2" name="accessibilite" value="2"><label class="lb" for="accessibiliteEtoile2">★</label>
                            <input class="ip" type="radio" id="accessibiliteEtoile1" name="accessibilite" value="1"><label class="lb" for="accessibiliteEtoile1">★</label>
                        </div>

                        <div class="groupeInputs">
                            <label class="lb">Avis supplémentaire</label>
                            <input class="ip" type="text" name="avis">
                        </div>
                        <button class="boutons" type="submit" onclick="GET_Notations(event)"> 
                            Envoyer
                        </button>
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
                <?php
                    $fichier = __DIR__ . "/json/notations.json";

                    if(!file_exists($fichier)){
                        echo "<p>Impossible de charger les avis.</p>";
                        exit();
                    }
                    
                    $contenu = file_get_contents($fichier);
                    $data = json_decode($contenu, true);
                    
                    if(!is_array($data)){
                        echo "<p> Aucun avis à été donné </p>";
                    }else{
                        foreach($data as $user){
                            $nom = htmlspecialchars($user["nom"]);
                            $prenom = htmlspecialchars($user["prenom"]);

                            $plat = (int)$user["notes"]["plat"];
                            $etoilesPlat = "";
                            for ($i = 0; $i < $plat; $i++) {
                                $etoilesPlat .= "⭐";
                            }

                            $livraison = (int)$user["notes"]["livraison"];
                            $etoilesLivraison = "";
                            for ($j = 0; $j < $livraison; $j++) {
                                $etoilesLivraison .= "⭐";                              
                            }

                            $accessibilite = (int)$user["notes"]["accessibilite"];
                            $etoilesAccessibilite = "";
                            for ($k = 0; $k < $accessibilite; $k++) {
                                $etoilesAccessibilite .= "⭐";
                            }

                            $avis = htmlspecialchars($user["avis"]);
                            if( trim($avis) == ""){
                                $avis = "None";
                            }
                            $date = htmlspecialchars($user["date"]);

                            echo "
                            <div>
                                <h2 class='write'>$nom $prenom</h2>
                                    <p>$date</p>
                                    <p> Avis : $avis </p>   
                                    <p> Plat : $etoilesPlat</p>
                                    <p> Livraison : $etoilesLivraison</p>                                
                                    <p> Accessibilite : $etoilesAccessibilite</p>                
                            </div>";
                        }
                    }
                ?>
            </div>

            <script>
                async function GET_Notations(event){
                    // Empêche le rechargement du formulaire
                    event.preventDefault();

                    try{
                        // Récupération des infos
                        const plat = document.querySelector('input[name="plat"]:checked')?.value;
                        const livraison = document.querySelector('input[name="livraison"]:checked')?.value;
                        const accessibilite = document.querySelector('input[name="accessibilite"]:checked')?.value;
                        const avis = document.querySelector('input[name="avis"]').value;
                        
                        // Vérification
                        if(!plat || !livraison || !accessibilite){
                            alert("Veuillez remplir toutes les notes.");
                            return;
                        }

                        const nom = <?php echo json_encode($_SESSION["nom"]); ?>;
                        const p_nom = <?php echo json_encode($_SESSION["prenom"]); ?>;

                        const date = new Date().toLocaleString();

                        // Structuration du .json
                        const informations = {
                            nom: nom,
                            prenom: p_nom,
                            date: date,
                            notes:{
                                plat: plat,
                                livraison: livraison,
                                accessibilite: accessibilite
                            },
                            avis: avis
                        };

                        // On attend laréponse de la fonctions php
                        const response = await fetch("Fonctions/redactionNotations.php", {
                            method: "POST",
                            headers: {"Content-Type": "application/json"},
                            body: JSON.stringify(informations)
                        });

                        //Affiche le résultat
                        const result = await response.json();
                        alert(result.message);

                        window.location.replace("Accueil.php");

                    }catch(error){
                        console.error("Erreur réseau :", error);
                        alert("Erreur réseau, veuillez réessayer.");
                    }
                    
                }
            </script>

            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>

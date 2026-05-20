<?php 
    include("Utilitaire/start.php");     // Modif Status des commandes quand un livreur est séléctionné par le restorateur
    if(isset($_POST['livreur']) && isset($_POST['idCommande'])){
        $idLivreur = $_POST['livreur'];
        $idCommande = $_POST['idCommande'];
        $contenu = file_get_contents('.json/commandes.json');
        $data = json_decode($contenu, true);
        foreach($data as &$commande){
            if($commande["idCommande"] == $idCommande){
                $commande["idLivreur"] = $idLivreur;
                $commande["Statut"] = "En livraison";
                break;
            }
        }
        file_put_contents('.json/commandes.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: Commandes.php");
        exit();
    }
    // Fichier JSON
    $contenu = file_get_contents(".json/commandes.json");
    $data = json_decode($contenu, true);
    if (!is_array($data)) { $data = []; }
    // Fonction qui permet d'afficher/séléctionner les livreurs
    function choisir_livreur($fichier, $Commande, $idCommande){
        if(!file_exists($fichier)){
            header("Location: Connexion.php?error=1");
            exit();
        }
        $contenu = file_get_contents($fichier);
        $data = json_decode($contenu, true);
        if(!is_array($data)){
            header("Location: Connexion.php?error=1");
            exit();
        }
        $idLivreur = $Commande["idLivreur"];
        echo "<select class='perm-select' onchange=\"modifierCommande('$idCommande','Livreur', this.value)\">";
        echo '<option value="">-- choisir livreur --</option>';
        foreach($data as $user){
            if($user["role"] == "Livreur"){
                $selected = (isset($Commande["idLivreur"]) && $Commande["idLivreur"] == $user["id"]) ? "selected" : "";
                echo '<option value="'.$user["id"].'" '.$selected.'>'
                    .$user["prenom"].' '.$user["nom"].
                '</option>';
            }
        }
        echo '</select>';
    }
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>SIUUSHI - Commandes</title>
            <link rel="stylesheet" type="text/css" href="Light_Style.css">
            <link rel="icon" href="Img/logo.png" type="image/png">
        </head>
        <body>
            <?php include("Utilitaire/nav.php"); ?>

            <!-- Affiche les différentes commandes -->
            <div class="en_attente">
                <h2>Commandes en attente</h2>
                <div class="liste_commandes" id="liste-attente">
                    <p>Chargement...</p>
                </div>
            </div>
            <div class="en_attente">
                <h2>Commandes en préparation</h2>
                <div class="liste_commandes" id="liste-preparation">
                    <p>Chargement...</p>
                </div>
            </div>
            <div class="en_attente">
                <h2>Commandes en livraison</h2>
                <div class="liste_commandes" id="liste-livraison">
                    <p>Chargement...</p>
                </div>
            </div>
            <div class="en_attente">
                <h2>Commandes Abandonnées</h2>
                <div class="liste_commandes" id="liste-abandonnee">
                    <p>Chargement...</p>
                </div>
            </div>
            <div class="en_attente">
                <h2>Commandes Livrées</h2>
                <div class="liste_commandes" id="liste-livree">
                    <p>Chargement...</p>
                </div>
            </div>
            <script>
                //  Commandes 
                function genererCarteCommande(commande, boutons = "") {
                    const produits = commande.Produits.map(p =>
                        `<p>Plats = ${p.nom} x${p.quantite}</p>`
                    ).join("");

                    return `
                        <div class="commande">
                            <h4>Commande n° ${commande.idCommande}</h4>
                            ${produits}
                            <p>Date: ${commande["Date prevue"]}</p>
                            <p>Heure: ${commande["Heure prevue"]}</p>
                            <p>Total: ${commande.Prix}€</p>
                            <div class="bouttonsCommandes">
                                <a href="DetailCommande.php?id=${commande.idCommande}">
                                    <button class="bouttonclassique">Détails</button>
                                </a>
                                ${boutons}
                            </div>
                        </div>`;
                }
                //  Select livreur
                function genererSelectLivreur(livreurs, commande) {
                    const options = livreurs.map(l => {
                        const selected = commande.idLivreur == l.id ? "selected" : "";
                        return `<option value="${l.id}" ${selected}>${l.prenom} ${l.nom}</option>`;
                    }).join("");

                    return `
                        <select class="perm-select" onchange="modifierCommande('${commande.idCommande}', 'Livreur', this.value)">
                            <option value="">-- choisir livreur --</option>
                            ${options}
                        </select>`;
                }
                //  Fonction intermédiaire pour facilité l'affichage
                function afficherListe(conteneurId, commandes, genererBoutons) {
                    const el = document.getElementById(conteneurId);
                    if (commandes.length === 0) {
                        el.innerHTML = "<p>Il n'y a pas de commande à cette étape</p>";
                        return;
                    }
                    el.innerHTML = commandes.map(c => genererCarteCommande(c, genererBoutons(c))).join("");
                }
                // Affiche commandes
                async function chargerCommandes() {
                    try {
                        const [resCommandes, resLivreurs] = await Promise.all([
                            fetch("Fonctions/rechercheCommandes.php"),
                            fetch("Fonctions/rechercheLivreur.php")
                        ]);
                        const { commandeAtt, commandeImmediate, commandeLivraison, commandeAbandonnee, commandeLivree } = await resCommandes.json();
                        const livreurs = await resLivreurs.json();
                        afficherListe("liste-attente", commandeAtt, c => `
                            <button class="bouttonclassique" onclick="modifierCommande('${c.idCommande}', 'priseEnCharge', null)">
                                Prise en charge
                            </button>`
                        );
                        afficherListe("liste-preparation", commandeImmediate, c => `
                            <button class="bouttonclassique" onclick="modifierCommande('${c.idCommande}', 'priseEnLivraison', null)">
                                Attribuer aux livreurs
                            </button>`
                        );
                        afficherListe("liste-livraison", commandeLivraison, c =>
                            genererSelectLivreur(livreurs, c)
                        );
                        afficherListe("liste-abandonnee", commandeAbandonnee, c =>
                            genererSelectLivreur(livreurs, c)
                        );
                        afficherListe("liste-livree", commandeLivree, () => "");
                    } catch (err) {
                        console.error("Erreur chargement commandes :", err);
                    }
                }
                // Modif une commande 
                async function modifierCommande(idCommande, action, idLivreur) {
                    try {
                        const response = await fetch("Fonctions/commandesModifs.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ idCommande, action, idLivreur })
                        });

                        const text = await response.text();
                        console.log("RAW RESPONSE:", text);

                        let result;
                        try {
                            result = JSON.parse(text);
                        } catch (e) {
                            console.error("Réponse non JSON :", text);
                            alert("Erreur serveur (réponse invalide)");
                            return;
                        }

                        if (result.success) {
                            await chargerCommandes();
                        } else {
                            alert(result.message || "Erreur inconnue");
                        }

                    } catch (error) {
                        console.error(error);
                        alert("Erreur réseau");
                    }
                }
                // Lancement
                chargerCommandes();
            </script>
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>
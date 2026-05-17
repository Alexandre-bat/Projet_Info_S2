<?php 
    include(__DIR__ . "/Utilitaire/start.php"); 
    
    // Affiche soit l'utilisateur où l'on souhaite voir le profil via Admin.php ou son profil
    if (isset($_GET["nom"]) && isset($_GET["prenom"]) && $role === "admin") {
    $nomCible    = $_GET["nom"];
    $prenomCible = $_GET["prenom"];
    $idCible     = $_GET["id"];
    } else {
        $nomCible    = $_SESSION["nom"]    ?? null;
        $prenomCible = $_SESSION["prenom"] ?? null;
        $idCible     = null;

        // Récupère l'id depuis le JSON via le nom et le prenom de la cible
        if ($nomCible && $prenomCible) {
            $json  = file_get_contents(__DIR__ . "/.json/id.json");
            $users = json_decode($json, true);
            foreach ($users as $user) {
                if ($user["nom"] === $nomCible && $user["prenom"] === $prenomCible) {
                    $idCible = $user["id"];
                    break;
                }
            }
        }
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
<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
                    <div class="modifsPersos">
                                <h3>Mes informations personnelles</h3>

                                <!-- Mode affichage -->
                                <div id="vue_profil">
                                    <?php if ($profilUser): ?>
                                        <p>Nom : <span id="afficher_nom"><?php echo htmlspecialchars($profilUser["nom"]); ?></span></p>
                                        <p>Prénom : <span id="afficher_prenom"><?php echo htmlspecialchars($profilUser["prenom"]); ?></span></p>
                                        <p>Adresse : <span id="afficher_adresse"><?php echo htmlspecialchars($profilUser["adresse"] ?? ""); ?></span></p>
                                        <p>Téléphone : <span id="afficher_tel"><?php echo htmlspecialchars($profilUser["tel"]); ?></span></p>
                                    <?php else: ?>
                                        <p>Utilisateur introuvable.</p>
                                    <?php endif; ?>
                                    <button class="bouttonclassique" onclick="modif()"> Modifier </button>
                                </div>

                                <!-- Mode édition (caché par défaut) -->
                                <div id="form_profil" style="display:none;">
                                    <label>Nom :
                                        <input type="text" id="intput_nom" maxlength="50" value="<?php echo htmlspecialchars($profilUser["nom"] ?? ''); ?>" oninput="compteur('intput_nom',50,'restePn')" required>
                                        <span id="restePn"></span>
                                    </label><br>
                                    <label>Prénom :
                                        <input type="text" id="intput_prenom" maxlength="50" value="<?php echo htmlspecialchars($profilUser["prenom"] ?? ''); ?>" oninput="compteur('intput_prenom',50,'resteN')" required>
                                        <span id="resteN"></span>
                                    </label><br>
                                    <label>Adresse :
                                        <input type="text" id="intput_adresse" value="<?php echo htmlspecialchars($profilUser["adresse"] ?? ''); ?>" oninput="compteur('intput_adresse',200,'resteA')" required>
                                        <span id="resteA"></span>
                                    </label><br>
                                    <label>Téléphone :
                                        <input type="text" name="tel" id="intput_tel" maxlength="14" value="<?php echo htmlspecialchars($profilUser["tel"] ?? ''); ?>" oninput="compteur('intput_tel',14,'resteTel')" required><br>
                                        <span id="resteTel"></span>
                                    </label><br>

                                    <label>Mot de passe :
                                        <input type="password" name="mdp" id="intput_mdp" value="<?php echo htmlspecialchars($profilUser["mdp"] ?? ''); ?>" required><br>
                                        <input type="checkbox" onclick="togglePassword()"> Afficher le mot de passe </input>
                                    </label><br>

                                    <button class="bouttonclassique" id="btn_sauvegarder" onclick="sauvegarder()" data-id="<?= htmlspecialchars($idCible ?? '') ?>"> Sauvegarder </button>
                                    <button class="bouttonclassique" onclick="annuler()"> Annuler </button>
                                    <p id="feedback_profil" style="font-size:0.85em; min-height:18px;"></p>
                                </div>
                            </div>
                            <script>
                                function togglePassword() {
                                    var mdp = document.getElementById("intput_mdp");
                                    if (mdp.type === "password") {
                                        mdp.type = "text";
                                    } else {
                                        mdp.type = "password";
                                    }
                                }
                                function compteur(id,number,id2) {
                                    const tel = document.getElementById(id);
                                    const reste = document.getElementById(id2);

                                    let restant = number - tel.value.length;

                                    reste.textContent = "Il reste " + restant + " caractères";
                                }
                                function modif() {
                                    document.getElementById("vue_profil").style.display = "none";
                                    document.getElementById("form_profil").style.display = "block";
                                }
                                function annuler() {
                                    document.getElementById("form_profil").style.display = "none";
                                    document.getElementById("vue_profil").style.display = "block";
                                    document.getElementById("feedback_profil").textContent = "";
                                }
                                async function sauvegarder() {
                                    const idUtilisateur = document.getElementById("btn_sauvegarder").dataset.id;
                                    const nom = document.getElementById("intput_nom").value.trim();
                                    const prenom = document.getElementById("intput_prenom").value.trim();
                                    const adresse = document.getElementById("intput_adresse").value.trim();
                                    const tel = document.getElementById("intput_tel").value.trim();
                                    const mdp = document.getElementById("intput_mdp").value.trim();
                                    const feedback = document.getElementById("feedback_profil");

                                    if (!idUtilisateur) {
                                        feedback.textContent = "Utilisateur non identifié.";
                                        feedback.style.color = "red";
                                        return;
                                    }
                                    if (!nom || !prenom || !tel || !adresse) {
                                        feedback.textContent = "Nom, prénom, adresse et téléphone sont obligatoires.";
                                        feedback.style.color = "red";
                                        return;
                                    }

                                    const formData = new FormData();
                                    formData.append("idUtilisateur", idUtilisateur);
                                    formData.append("nom", nom);
                                    formData.append("prenom", prenom);
                                    formData.append("adresse", adresse);
                                    formData.append("tel", tel);
                                     formData.append("mdp", mdp);

                                    try {
                                        const response = await fetch("Fonctions/modifierProfil.php", {
                                            method: "POST",
                                            body: formData
                                        });

                                        const texte = await response.text();
                                        console.log("Statut HTTP :", response.status);
                                        console.log("Réponse brute :", texte);

                                        const result = JSON.parse(texte);

                                        if (result.success) {
                                            document.getElementById("afficher_nom").textContent     = nom;
                                            document.getElementById("afficher_prenom").textContent  = prenom;
                                            document.getElementById("afficher_adresse").textContent = adresse;
                                            document.getElementById("afficher_tel").textContent     = tel;
                                            annuler();
                                        } else {
                                            feedback.textContent = result.message;
                                            feedback.style.color = "red";
                                        }
                                    } catch (e) {
                                        console.log("Erreur catch :", e);
                                        feedback.textContent = "Erreur réseau.";
                                        feedback.style.color = "red";
                                    }
                                }
                            </script>
                            <script src="JS/validation.js"></script>
<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
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

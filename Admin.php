<?php include("Utilitaire/start.php");
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
            <link rel="stylesheet" type="text/css" href="Dark_Style.css">
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
                    <?php
                        $fichier = ".json/id.json";
                        if(!file_exists($fichier)){
                            header("Location: ../Connexion.php?error=1");
                            exit();
                        }
                        $contenu = file_get_contents($fichier);
                        $data = json_decode($contenu, true);
                        if(!is_array($data)){
                            header("Location: ../Connexion.php?error=1");
                            exit();
                        }
                        foreach($data as $user){
                            $estBloquer        = isset($user["bloquer"]) && $user["bloquer"] == 1;
                            $id                = htmlspecialchars($user["id"]);
                            $nom               = htmlspecialchars($user["nom"]);
                            $prenom            = htmlspecialchars($user["prenom"]);
                            $role              = $user["role"];
                            $statut            = $estBloquer ? "Bloqué" : "Actif";
                            $disabledBloquer   = $estBloquer  ? "disabled" : "";
                            $disabledDebloquer = !$estBloquer ? "disabled" : "";
                            echo "
                            <div class='adminUtilisateurs' data-id='$id'>
                                <h2 class='write'>$nom $prenom</h2>
                                <input type='hidden' name='nom'    value='$nom'>
                                <input type='hidden' name='prenom' value='$prenom'>
                                <label class='perm-label'>PERM</label>
                                <select class='perm-select' name='perm'  onchange=\"updateRole('$id', '.this.value.');\">
                                    <option value='Client'      " . ($role == "Client"       ? "selected" : "") . ">Client</option>
                                    <option value='Livreur'      " . ($role == "Livreur"      ? "selected" : "") . ">Livreur</option>
                                    <option value='restaurateur' " . ($role == "restaurateur" ? "selected" : "") . ">Restaurateur</option>
                                    <option value='admin'        " . ($role == "admin"        ? "selected" : "") . ">Admin</option>
                                </select>
                                <span class='statut-compte'>$statut</span>
                                <span id='role-msg-$id'></span>
                                <div id='remise-$id'>
                                    <button class='bouttonclassique'>Accorder une remise</button>
                                </div>
                                <form action='Fonctions/supprCompte.php' method='post'>
                                    <input type='hidden' name='supprimerCompte' value='$id'>
                                    <button class='bouttonclassique' type='submit'>Supprimer le compte</button>
                                </form>
                                <button type='button' class='bouttonclassique btn-bloquer' onclick=\"Blockage('$id', 'bloquer');\">
                                    Bloquer le compte
                                </button>
                                <button type='button' class='bouttonclassique btn-debloquer' onclick=\"Blockage('$id', 'debloquer');\">
                                    Débloquer le compte
                                </button>
                                <a href='Profil.php?nom=" . urlencode($user["nom"]) . "&prenom=" . urlencode($user["prenom"]) . "&id=" . urlencode($user["id"]) . "' class='adminProfil'>PROFIL</a>
                            </div>";
                        }
                    ?>
                </div>
            </div>
            <script>
                async function Blockage(userId, action) {
                    try {
                        const response = await fetch("Fonctions/bloquerCompte.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ userId, action })
                        });
                        const result = await response.json();
                        if (!response.ok || !result.success) {
                            alert("Erreur : " + (result.message ?? "Une erreur est survenue."));
                            return;
                        }
                        const card         = document.querySelector(`.adminUtilisateurs[data-id="${userId}"]`);
                        const btnBloquer   = card.querySelector(".btn-bloquer");
                        const btnDebloquer = card.querySelector(".btn-debloquer");
                        const statut       = card.querySelector(".statut-compte");
                        const estBloquer = (action === "bloquer");
                        btnBloquer.disabled   =  estBloquer;
                        btnDebloquer.disabled = !estBloquer;
                        statut.textContent    =  estBloquer ? "Bloqué" : "Actif";
                    } catch (error) {
                        console.error("Erreur réseau :", error);
                        alert("Erreur réseau, veuillez réessayer.");
                    }
                }
                async function updateRole(id, role) {
                    try {
                        const formData = new FormData();
                        formData.append("id", id);
                        formData.append("role", role);
                        const response = await fetch("Fonctions/update_perm.php", {
                            method: "POST",
                            body: formData
                        });
                        const data = await response.json();
                        const message = document.getElementById(`role-msg-${id}`);
                        if (message) {
                            message.innerHTML = data.success
                                ? "Mis à jour"
                                : (data.message ?? "Erreur");
                        }
                    } catch (error) {
                        console.error(error);
                        const message = document.getElementById(`role-msg-${id}`);
                        if (message) {
                            message.innerHTML = "Erreur serveur";
                        }
                    }
                }
            </script>
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>

<?php
    function montrer_utilisateurs($fichier){
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
                
                <form action='Fonctions/update_perm.php' method='post'>
                    <input type='hidden' name='nom'    value='$nom'>
                    <input type='hidden' name='prenom' value='$prenom'>
                    <label class='perm-label'>PERM</label>
                    <select class='perm-select' name='perm'>
                        <option value='Client'      " . ($role == "Client"       ? "selected" : "") . ">Client</option>
                        <option value='Livreur'      " . ($role == "Livreur"      ? "selected" : "") . ">Livreur</option>
                        <option value='restaurateur' " . ($role == "restaurateur" ? "selected" : "") . ">Restaurateur</option>
                        <option value='admin'        " . ($role == "admin"        ? "selected" : "") . ">Admin</option>
                    </select>
                    <button class='bouttonclassique' type='submit'>Valider</button>
                </form>

                <span class='statut-compte'>$statut</span>

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
    }
?>

<?php
    function montrer_utilisateurs($fichier){
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
        foreach($data as $user){
            echo '<div class="adminUtilisateurs">
                    <h2 class="write">' 
                        . htmlspecialchars($user["nom"]) . ' ' . htmlspecialchars($user["prenom"]) . 
                    '</h2>
                    <form action="Fonctions/update_perm.php" method="post">
                        <input type="hidden" name="nom" value="'. htmlspecialchars($user["nom"]) .'">
                        <input type="hidden" name="prenom" value="'. htmlspecialchars($user["prenom"]) .'">
                        <label class="perm-label">PERM</label>
                        <select class="perm-select" name="perm">
                            <option value="Client" ' . ($user["role"] == "Client" ? "selected" : "") . '>Client</option>
                            <option value="Livreur" ' . ($user["role"] == "Livreur" ? "selected" : "") . '>Livreur</option>
                            <option value="restaurateur" ' . ($user["role"] == "restaurateur" ? "selected" : "") . '>Restaurateur</option>
                            <option value="admin" ' . ($user["role"] == "admin" ? "selected" : "") . '>Admin</option>
                        </select>
                        <button class="bouttonclassique" type="submit">Valider</button>
                    </form>
                    <div id=remise>
                        <button class="bouttonclassique">Accorder une remise</button>
                    </div>
                    <form action="Fonctions/supprCompte.php" method="post">
                        <input type="hidden" name="supprimerCompte" value="'. $user["id"] .'">
                        <button class="bouttonclassique">Supprimer le compte</button>
                    </form>
                    <a href="Profil.php?nom=' . urlencode($user["nom"]) . '&prenom=' . urlencode($user["prenom"]) . '" class="adminProfil">PROFIL</a>
                </div>';
        }
    }
?>
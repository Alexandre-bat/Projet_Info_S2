<?php    
    if (isset($_POST['supprimerCompte'])) {
        supprimerCompte($_POST['supprimerCompte']);
        header("Location:  ../Admin.php");
        exit();
    }
    //verification de l'information appel fct puis renvoie sur Admin.php

    function supprimerCompte($idSupprimer) {

        if (!file_exists(__DIR__ . "/../.json/id.json")) {
            return;
        }

        $contenu = file_get_contents(__DIR__ . "/../.json/id.json");
        $data = json_decode($contenu, true);

        if (!is_array($data)) {
            $data = [];
        }

        foreach ($data as $i => $user) {
            if ($user["id"] == $idSupprimer) {
                unset($data[$i]);
                break;
            }
        }

        $data = array_values($data);
        file_put_contents(__DIR__ . "/../.json/id.json", json_encode($data, JSON_PRETTY_PRINT));

        //verifications, recuperation id.json et suppression du compte

        $fichierCommandes = __DIR__ . "/../.json/commandes.json";
        if (file_exists($fichierCommandes)) {
            $contenu = file_get_contents($fichierCommandes);
            $commandes = json_decode($contenu, true);

            if (is_array($commandes)) {
                foreach ($commandes as &$commande) {
                    if ($commande["idUtilisateur"] == $idSupprimer) {
                        $commande["idUtilisateur"] = "utilisateurSuppr";
                    }
                }
                file_put_contents($fichierCommandes, json_encode($commandes, JSON_PRETTY_PRINT));
            }
        }
    //verifications, recuperation commandes.json et non suppression de ses commandes juste infos pour dire qu'il à été suppr
    }
?>

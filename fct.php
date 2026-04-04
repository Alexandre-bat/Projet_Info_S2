<?php
if (isset($_POST['supprimerCompte'])) {
    supprimerCompte($_POST['supprimerCompte']);
    header("Location: admin.php");
    exit();
}

function supprimerCompte($idSupprimer) {

    if (!file_exists("id.json")) {
        return;
    }

    $contenu = file_get_contents("id.json");
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
    file_put_contents("id.json", json_encode($data, JSON_PRETTY_PRINT));

    $fichierCommandes = "commandes.json";
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
}
?>
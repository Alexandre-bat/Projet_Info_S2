<?php
    header("Content-Type: application/json");

    $data = json_decode(file_get_contents("php://input"), true);

    $idCommande = $data['idCommande'] ?? null;
    $action = $data['action'] ?? null;
    $idLivreur = $data['idLivreur'] ?? null;
    if(!$idCommande || !$action){
        echo json_encode([
            "success" => false,
            "message" => "Paramètres manquants"
        ]);
        exit();
    }
    $fichier = "../json/commandes.json";
    if(!file_exists($fichier)){
        echo json_encode([
            "success" => false,
            "message" => "Fichier introuvable"
        ]);
        exit();
    }
    $commandes = json_decode(file_get_contents($fichier), true);
    if(!is_array($commandes)){
        echo json_encode([
            "success" => false,
            "message" => "JSON invalide"
        ]);
        exit();
    }
    $found = false;
    foreach($commandes as &$commande){
        if($commande["idCommande"] == $idCommande){
            if($action == "priseEnCharge"){
                $commande["Statut"] = "En preparation";
            } elseif($action == "priseEnLivraison"){
                $commande["Statut"] = "En livraison";
                if($idLivreur){
                    $commande["idLivreur"] = $idLivreur;
                }
            } elseif($action == "Livreur"){
                if($idLivreur){
                    $commande["idLivreur"] = $idLivreur;
                }else{
                    $commande["idLivreur"] = null;
                }
            }
            $found = true;
            break;
        }
    }
    if($found){
        file_put_contents(
            $fichier,
            json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );
    echo json_encode(["success" => true]);
    exit();
    }
?>
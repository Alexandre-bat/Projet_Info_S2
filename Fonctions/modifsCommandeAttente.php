<?php
    include("../Utilitaire/start.php");
    if(!isset($_SESSION['id'])){
        exit();
    }
    $data = json_decode(file_get_contents("php://input"), true);
    $jsonProduits = file_get_contents("../json/carte.json");
    $produits = json_decode($jsonProduits, true);
    $jsonCommandes = file_get_contents("../json/commandes.json");
    $commandes = json_decode($jsonCommandes, true);
    // recuperation des jsons
    foreach($commandes as &$commande){
        if($commande["idUtilisateur"] == $_SESSION['id'] && $commande["Statut"] == "Attente"){
            if(isset($_POST["ajoutCarte"])){
                $idProduit = $_POST["ajoutCarte"];
                foreach($produits as $p){
                    if($p["id"] == $idProduit){
                        $trouve = false;
                        foreach($commande["Produits"] as &$prodCommande){
                            if($prodCommande["nom"] == $p["nom"]){
                                $prodCommande["quantite"]++;
                                $prodCommande["prix"] += $p["prix"];
                                $trouve = true;
                                break;
                            }
                        }
                        if(!$trouve){
                            $commande["Produits"][] = [
                                "nom" => $p["nom"],
                                "quantite" => 1,
                                "prix" => $p["prix"]
                            ];
                        }
                        break;
                    }
                }
            }
            if(isset($data["produits"])){
                $nouveauxProduits = [];
                foreach($data["produits"] as $prod){
                    foreach($produits as $p){
                        if($p["nom"] == $prod["nom"]){
                            $nouveauxProduits[] = [
                                "nom" => $p["nom"],
                                "quantite" => $prod["quantite"],
                                "prix" => $p["prix"] * $prod["quantite"]
                            ];
                        }
                    }
                }
                $commande["Produits"] = $nouveauxProduits;
            }
            //recuperation des produits a rajouter
            if(isset($_POST["choix"])){
                if($_POST["choix"] == "ticket"){
                    $_SESSION["ticketReduction"] = $_POST["ticket"];
                }
            }
            $nouveauPrix = 0;
            foreach($commande["Produits"] as $p){
                $nouveauPrix += $p["prix"];
            }
            $commande["NouveauPrix"] = $nouveauPrix;
            $_SESSION["produits_modifies"] = $commande["Produits"];
            $_SESSION["nouveau_prix_commande"] = $nouveauPrix;
            //recuperation des prix et choix pour MaCommande.php
        }
    }
    file_put_contents("../json/commandes.json", json_encode($commandes, JSON_PRETTY_PRINT));
    echo "ok";
?>
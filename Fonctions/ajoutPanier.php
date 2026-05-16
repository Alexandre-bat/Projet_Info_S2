<?php
    include("../Utilitaire/start.php");
    if(!isset($_SESSION['id'])){
        echo "non_connecte";
        exit();
    }
    if(!isset($_POST['produit'])){
        exit();
    }
    $idProduit = $_POST['produit'];
    $commande = recupCommandeActive($_SESSION['id']);
    if($commande){
        $jsonProduits = file_get_contents("../.json/carte.json");
        $produits = json_decode($jsonProduits, true);
        $jsonCommandes = file_get_contents("../.json/commandes.json");
        $commandes = json_decode($jsonCommandes, true);
        foreach($commandes as &$c){
            if($c["idUtilisateur"] == $_SESSION['id'] && $c["Statut"] == "Attente"){
                $produitTrouve = getProduit($produits, $idProduit);
                if($produitTrouve){
                    $dejaPresent = false;
                    foreach($c["Produits"] as &$prod){
                        if($prod["nom"] == $produitTrouve["nom"]){
                            $prod["quantite"]++;
                            $prod["prix"] += $produitTrouve["prix"];
                            $dejaPresent = true;
                        }
                    }
                    if(!$dejaPresent){
                        $c["Produits"][] = [
                            "nom" => $produitTrouve["nom"],
                            "quantite" => 1,
                            "prix" => $produitTrouve["prix"]
                        ];
                    }
                    $c["NouveauPrix"] += $produitTrouve["prix"];
                }
            }
        }
        // ajoute produit dans le panier
        file_put_contents("../.json/commandes.json", json_encode($commandes, JSON_PRETTY_PRINT));
        echo "commande_active";
        exit();
    }
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = [];
    }
    $_SESSION['panier'][] = $idProduit;
    echo "ok";
?>
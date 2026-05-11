<?php
    $json = file_get_contents(".json/carte.json");
    $produits = json_decode($json, true);
    if(isset($_GET["filtre"])){
        $filtre = $_GET["filtre"];
    }
    else{
        $filtre = "tous";
    }
    $allergenes = [];
    if(isset($_GET["allergenes"]) && $_GET["allergenes"] != ""){
        $allergenes = explode(",", $_GET["allergenes"]);
    }
    $recherche = "";
    if(isset($_GET["recherche"])){
        $recherche = strtolower($_GET["recherche"]);
    }
    $categories = [
        "menu" => "Menus",
        "entree" => "Entrées",
        "plat" => "Plats",
        "dessert" => "Desserts"
    ];
    foreach($categories as $cat => $titre){
        if($filtre == "tous" || $filtre == $cat){
            echo '
            <div class="blocMenu">
                <div class="titreMenu">
                    <h1>'.$titre.'</h1>
                </div>
                <div class="controlBox">
                ';
            foreach($produits as $p){
                if($p["categorie"] == $cat){
                    $verifAllergene = false;
                    foreach($allergenes as $aller){
                        if(in_array($aller, $p["allergenes"])){
                            $verifAllergene = true;
                            break;
                        }
                    }
                    if(!$verifAllergene){
                        if($recherche == "" || stripos($p["nom"], $recherche) === 0){
                            echo '
                                <div class="box">
                                    <img src="Img/Imagesmenu/'.$p['img'].'" class="imgBox">
                                    <div class="contenuBox">
                                        <h2>'.$p['nom'].'</h2>
                                        <p>'.$p['description'].'</p>
                                        <p>'.$p['ingredients'].'</p>
                                    </div>
                                    <div class="basBox">
                                        <span id="prix">Prix : '.$p['prix'].'€</span>
                                        <form action="'.((isset($_SESSION['nom']) && isset($_SESSION['prenom'])) ? 'Panier.php' : 'Connexion.php').'" method="post">
                                            <input type="hidden" name="produit" value="'.$p['id'].'">
                                            <button class="bouttonclassique">
                                                Commander
                                            </button>
                                        </form>
                                    </div>
                                </div>';
                        }
                    }
                }
            }
            echo '
                </div>
            </div>';
        }
    }
?>
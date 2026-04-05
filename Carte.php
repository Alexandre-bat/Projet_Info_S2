<?php include("Utilitaire/start.php"); 
    $json = file_get_contents("carte.json");
    $produits = json_decode($json, true);
    $filtres = null;
    if(isset($_GET['filtres'])){
        $filtres = $_GET['filtres'];
    }
?>
<!-- Récupère le fichier et verifie si des filtres sont présents -->
<!DOCTYPE html>
    <html>
        <head>
            <title>SIUUSHI - Accueil</title>
            <link rel="icon" href="Img/logo.png" type="image/png">
            <link rel="stylesheet" type="text/css" href="Style.css">
        </head>
        <body>
        <?php include("Utilitaire/nav.php"); ?>

            <main>
                <div class="blocTitre">
                    <h1 class="grandTitre">Carte</h1>
                </div>
                <div class="blocRecherche">
                    <h2 class="moyenTitre">Recherche</h2>
                    <div>
                        <input type="search" id="rechercheInput" placeholder="Rechercher un plat...">
                        <button id="rechercheBouton">Rechercher</button>
                    </div>
                    <div class="cadreBoutonFiltres">
                        <form method="get">
                            <button class= bouttonclassique type="submit" name="filtres" value="menu">Menus</button>
                            <button class= bouttonclassique type="submit" name="filtres" value="entree">Entrées</button>
                            <button class= bouttonclassique type="submit" name="filtres" value="plat">Plats</button>
                            <button class= bouttonclassique type="submit" name="filtres" value="dessert">Desserts</button>
                            <button class= bouttonclassique type="submit" name="filtres" value="tous">Tous</button>
                        </form>
                        <button class= bouttonclassique id="allergènes">Allergènes</button>
                    </div>
                </div>
                <?php if($filtres == "menu" || !isset($filtres) || $filtres == "tous") { ?>
                    <!-- Les bouttons de filtres servent à gérer les différentes types de commandes que l'on veut (les allergenes marcheront en JS)-->
                    <div class="blocMenu">
                        <div class="titreMenu">
                            <h1>Menus</h1>
                        </div>
                        <div class="controlBox">
                            <?php foreach($produits as $p){
                                if($p['categorie'] == "menu"){
                            ?>
                            <div class="box">
                                <img src="Img/Imagesmenu/<?php echo $p['img']; ?>" alt="<?php echo $p['nom']; ?>" class="imgBox">
                                <div class="contenuBox">
                                    <h2><?php echo $p['nom']; ?></h2>
                                    <p><?php echo $p['description']; ?></p>
                                    <p><?php echo $p['personnes_min']; ?> personnes minimum</p>
                                    <p><?php echo $p['plats'][0] . " | " . $p['plats'][1] . " | " . $p['plats'][2]; ?></p>
                                </div>
                                <div class="basBox">
                                    <span id="prix">Prix : <?php echo $p['prix']; ?>€</span>
                                    <form action="<?php if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                                        echo 'panier.php';
                                    } else {
                                        echo 'Connexion.php';
                                    }
                                    ?>" method="post">
                                        <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                                        <button class="bouttonclassique">Commander</button>
                                    </form>
                                </div>
                            </div>
                            <?php }  } ?>
                        </div>
                    </div>
                    <!-- Type d'affichage classique (comme phase1) lorsque le code récupère un menu dans le fichier carte.json -->
                    <?php } 
                        if($filtres == "entree" || !isset($filtres) || $filtres == "tous") {
                    ?>
                    <div class="blocMenu">
                        <div class="titreMenu">
                            <h1>Entrées</h1>
                        </div>
                        <div class="controlBox">
                            <?php foreach($produits as $p){
                                if($p['categorie'] == "entree"){
                            ?>
                            <div class="box">
                                <img src="Img/Imagesmenu/<?php echo $p['img']; ?>" alt="<?php echo $p['nom']; ?>" class="imgBox">
                                <div class="contenuBox">
                                    <h2><?php echo $p['nom']; ?></h2>
                                    <p><?php echo $p['description']; ?></p>
                                    <p><?php echo $p['ingredients']; ?></p>
                                </div>
                                <div class="basBox">
                                    <span id="prix">Prix : <?php echo $p['prix']; ?>€</span>
                                    <form action="<?php if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                                        echo 'panier.php';
                                    } else {
                                        echo 'Connexion.php';
                                    }
                                    ?>" method="post">
                                        <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                                        <button class="bouttonclassique">Commander</button>
                                    </form>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>
                    <!-- La meme mais pour les entrées dans le fichier carte.json -->
                    <?php } 
                        if($filtres == "plat" || !isset($filtres) || $filtres == "tous") {
                    ?>
                    <div class="blocMenu">
                        <div class="titreMenu">
                            <h3>Plats</h3>
                        </div>
                        <div class="controlBox">
                            <?php foreach($produits as $p){
                                if($p['categorie'] == "plat"){
                            ?>
                            <div class="box">
                                <img src="Img/Imagesmenu/<?php echo $p['img']; ?>" alt="<?php echo $p['nom']; ?>" class="imgBox">
                                <div class="contenuBox">
                                    <h2><?php echo $p['nom']; ?></h2>
                                    <p><?php echo $p['description']; ?></p>
                                    <p><?php echo $p['ingredients']; ?></p>
                                </div>
                                <div class="basBox">
                                    <span id="prix">Prix : <?php echo $p['prix']; ?>€</span>
                                    <form action="<?php if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                                        echo 'panier.php';
                                    } else {
                                        echo 'Connexion.php';
                                    }
                                    ?>" method="post">
                                        <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                                        <button class="bouttonclassique">Commander</button>
                                    </form>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>
                    <!-- La meme mais pour les plats dans le fichier carte.json -->
                    <?php } 
                        if($filtres == "dessert" || !isset($filtres) || $filtres == "tous") {
                    ?>
                    <div class="blocMenu">
                        <div class="titreMenu">
                            <h3>Desserts</h3>
                        </div>
                        <div class="controlBox">
                            <?php foreach($produits as $p){
                                if($p['categorie'] == "dessert"){
                            ?>
                            <div class="box">
                                <img src="Img/Imagesmenu/<?php echo $p['img']; ?>" alt="<?php echo $p['nom']; ?>" class="imgBox">
                                <div class="contenuBox">
                                    <h2><?php echo $p['nom']; ?></h2>
                                    <p><?php echo $p['description']; ?></p>
                                    <p><?php echo $p['ingredients']; ?></p>
                                </div>
                                <div class="basBox">
                                    <span id="prix">Prix : <?php echo $p['prix']; ?>€</span>
                                    <form action="<?php if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                                        echo 'panier.php';
                                    } else {
                                        echo 'Connexion.php';
                                    }
                                    ?>" method="post">
                                        <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                                        <button class="bouttonclassique">Commander</button>
                                    </form>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>
        <!-- La meme mais pour les desserts dans le fichier carte.json -->
                    <?php } ?>
                </main>
                <!-- Pied de page -->
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
        </body>
    </html>

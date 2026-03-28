<?php include("start.php"); ?>
<?php
$json = file_get_contents("carte.json");
$produits = json_decode($json, true);
?>
<!DOCTYPE html>
<html>

<head>
    <title>SIUUSHI - MENU</title>
    <link rel="icon" href="Img/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>

<body>
    <div class="navbar">
        <div class="nav1">
            <a href="Accueil.php" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo_nav">
                SIUUSHI
            </a>
        </div>

        <div class="nav2">
            <a href="Admin.php">Admin</a>
            <a href="Commandes.php">Commandes</a>
            <a href="Livraison.php">Livraison</a>
            <a href="Notation.php">Notation</a>
            
            <?php 
                if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                    echo '<a href="Profil.php">' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' '. '<img src="Img/profil.png" alt="Logo" class="profil_nav">' .'</a>';
                    echo '<a href=Accueil.php?deco=1>Déconnexion</a>';
                } else {
                    echo '<a href="Connexion.php">Connexion</a>';
                    echo '<a href="Inscription.php">Inscription</a>';

                }
            ?>
            <?php
                $nbrsession = 0;
                if(isset($_SESSION['panier'])){
                    $nbrsession = count($_SESSION['panier']);
                }
            ?>
            <a href="panier.php">
                <img src="Img/panier.png" alt="Panier" id="logoPanier"><?php echo $nbrsession;?>
            </a>
        </div>
    </div>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
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
                <button class="bouttonclassique">Plats</button>
                <button class="bouttonclassique">Entrées</button>
                <button class="bouttonclassique">Desserts</button>
                <button class="bouttonclassique">Allergènes</button>
            </div>
        </div>
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
                        <form action="panier.php" method="post">
                            <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                            <button class="bouttonclassique">Commander</button>
                    </form>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
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
                        <form action="panier.php" method="post">
                            <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                            <button class="bouttonclassique">Commander</button>
                        </form>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
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
                        <form action="panier.php" method="post">
                            <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                            <button class="bouttonclassique">Commander</button>
                        </form>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
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
                        <form action="panier.php" method="post">
                            <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                            <button class="bouttonclassique">Commander</button>
                        </form>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </main>

    <!-- Pied de page -->


    <footer>
        <div class="f-container">
            <div class="f-section">
                <h4>À PROPOS</h4>
                <p>SIUUSHI - Restaurant traditionnel depuis 1967</p>
                <p>Une expérience culinaire traditionnel</p>
            </div>

            <div class="f-section">
                <h4>CONTACT</h4>
                <p>📍 Parc des princes</p>
                <p>📞 +33 1 23 45 67 89</p>
            </div>

            <div class="f-section">
                <h4>HORAIRES</h4>
                <p>Lun - Sam: 11h00 - 14h00 / 18h00 - 23h00</p>
                <p> Livraison disponible</p>
            </div>
        </div>

        <div class="f-bottom">
            <p>&copy; 2026 SIUUSHI - Tous droits réservés | Mentions légales | Politique de confidentialité</p>
        </div>
    </footer>
</body>

</html>

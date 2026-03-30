<?php include("Utilitaire/start.php"); ?>
<?php
$json = file_get_contents("carte.json");
$produits = json_decode($json, true);
?>
<?php
$filtres = null;
if(isset($_GET['filtres'])){
    $filtres = $_GET['filtres'];
}
?>
<!DOCTYPE html>
<html>

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
                        <form action="panier.php" method="post">
                            <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                            <button class="bouttonclassique">Commander</button>
                        </form>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
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
                        <form action="panier.php" method="post">
                            <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                            <button class="bouttonclassique">Commander</button>
                        </form>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
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
                        <form action="panier.php" method="post">
                            <input type="hidden" name="produit" value="<?php echo $p['id']; ?>">
                            <button class="bouttonclassique">Commander</button>
                        </form>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
        <?php } ?>
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

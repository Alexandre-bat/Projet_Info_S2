    <div class="navbar">
        <div class="nav1">
            <a href="Accueil.php" class="menu">
                <img src="Img/logo.png" alt="Logo" class="logo_nav">
                SIUUSHI
            </a>
        </div>

        <div class="nav2">
            <?php
                if($role === "admin") {
                    echo '<a href="Admin.php">Admin</a>';
                    echo '<a href="Livraison.php">Livraison</a>';
                    echo '<a href="Commandes.php">Commandes</a>';
                }
                if($role === "Livreur") {
                    echo '<a href="Livraison.php">Livraison</a>';
                }
            ?>
            <a href="Carte.php">Carte</a>
            <?php 
                if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                    echo '<a href="Profil.php">' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' '. '<img src="Img/profil.png" alt="Logo" class="profil_nav">' .'</a>';
                    echo '<a href="Accueil.php?deco=1">Déconnexion</a>';
                    $nbrsession = 0;
                    if(isset($_SESSION['panier'])){
                    $nbrsession = count($_SESSION['panier']);
                    ?>
                    <a href="panier.php">
                        <img src="Img/panier.png" alt="Panier" id="logoPanier"><?php echo $nbrsession;?>
                    </a>
                    <?php
                }
                } else {
                    echo '<a href="Connexion.php">Connexion</a>';
                    echo '<a href="Inscription.php">Inscription</a>';
                }
            ?>
        </div>
    </div>


    <video autoplay muted loop class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
<link id="theme-style" rel="stylesheet" href="Dark_Style.css">

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
            else if($role === "Livreur") {
                echo '<a href="Livraison.php">Livraison</a>';
            }
            else if($role === "restaurateur"){
                echo '<a href="Commandes.php">Commandes</a>';
            }
        ?>

        <a href="Carte.php">Carte</a>

        <?php 
            if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {

                echo '<a href="Profil.php">' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' '. '<img src="Img/profil.png" alt="Logo" class="profil_nav">' .'</a>';

                echo '<a href="Accueil.php?deco=1">Déconnexion</a>';

                $commandeAttente = false;

                $jsonCommandes = file_get_contents("json/commandes.json");
                $commandes = json_decode($jsonCommandes, true);

                foreach($commandes as $commande){
                    if($commande["idUtilisateur"] == $_SESSION["id"] && $commande["Statut"] == "Attente"){
                        $commandeAttente = true;
                        break;
                    }
                }

                if($commandeAttente){
                ?>
                    <a href="MaCommande.php" id="lienCommande">
                        Ma Commande
                    </a>
                <?php
                }
                //si commande en attente affichage MaCommande
                else{
                    $nbrsession = 0;

                    if(isset($_SESSION['panier'])){
                        $nbrsession = count($_SESSION['panier']);
                    }
                ?>

                    <!-- affichage panier si connecté et si pas de commande en cours -->
                    <a href="Panier.php" id="lienPanier"
                        style="<?php if($nbrsession == 0){ echo 'display:none;'; } ?>">
                        
                        <img src="Img/panier.png" alt="Panier" id="logoPanier">

                        <span id="compteurPanier">
                            <?php echo $nbrsession; ?>
                        </span>
                    </a>

                <?php 
                    } 
                ?>

                <?php
                    } 
                    else {
                        echo '<a href="Connexion.php">Connexion</a>';
                        echo '<a href="Inscription.php">Inscription</a>';
                    }
                ?>

            <button id="theme-btn" class="theme"></button>

    </div>
</div>

<video autoplay muted loop class="video-bg">
    <source src="Img/fond.mp4" type="video/mp4">
    Votre navigateur ne supporte pas la vidéo.
</video>

<script>

// création du cookie
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// récupération du cookie
function getCookie(name) {
    const cookieName = name + "=";
    const cookies = document.cookie.split(";");
    for(let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if(cookie.indexOf(cookieName) === 0) {

            return cookie.substring(cookieName.length);
        }
    }
    return null;
}

// changement du thème
function setTheme(theme) {
    document.getElementById("theme-style").href = theme;
    setCookie("theme", theme, 30);
    updateThemeBtn(theme);
}

// changement du bouton
function updateThemeBtn(theme) {
    const btn = document.getElementById("theme-btn");
    if(theme === "Dark_Style.css") {
        btn.innerHTML = "Light";
        btn.onclick = () => setTheme("Light_Style.css");

    } 
    else {
        btn.innerHTML = "Dark";
        btn.onclick = () => setTheme("Dark_Style.css");

    }
}

// chargement du thème au lancement de la page
window.onload = function () {
    const savedTheme = getCookie("theme") || "Dark_Style.css";
    document.getElementById("theme-style").href = savedTheme;
    updateThemeBtn(savedTheme);
}
</script>
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
                <img src="Img/logo.png" alt="Logo" class="logo">
                Accueil
            </a>
        </div>

        <div class="nav2">
            <a href="Admin.php">Admin</a>
            <a href="Commandes.php">Commandes</a>
            <a href="Livraison.php">Livraison</a>
            <a href="Notation.php">Notation</a>
            <a href="Connexion.php">Connexion</a>
            <a href="Inscription.php">Inscription</a>
            <a href="Profil.php">Profil</a>
        </div>
    </div>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="Img/fond.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
    <main>
        <div class="blocTitre">
            <h1 class="grandTitre">Menu</h1>
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
                <h1>Entrées</h1>
            </div>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/gyoza.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Bol de Gyoza</h2>
                        <p>Notre bol de gyoza fait maison </p>
                        <p>Porc haché, chou chinois, ail, gingembre, sauce soja, huile de sésame, pâte à gyoza</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 9€</span>
                        <a href="panier.php?produit=gyoza">
                            <button class="bouttonclassique">Commander</button>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/rolls.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Rona-roll-do</h2>
                        <p>Nos rolls signatures</p>
                        <p>Riz vinaigré, algue nori, saumon, thon, avocat, concombre, fromage frais</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 10€</span>
                        <a href="panier.php?produit=rolls">
                            <button class="bouttonclassique">Commander</button>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/sashimi.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Bol de Siuuushimi</h2>
                        <p>Notre bol de sashimi préparer à la main</p>
                        <p>Saumon cru, thon cru, daurade, sauce soja, wasabi, gingembre mariné</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 12€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/petitsSushi.jpeg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Assortiment de delicieux Siuuushi</h2>
                        <p>Un assortiment de nos meilleurs sushis préparés par le chef en personne</p>
                        <p>Riz vinaigré, saumon, thon, crevette, avocat, algue nori, fromage frais, concombre</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 10€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/maki.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Notre Ball (bol) de Maki et sa sauce</h2>
                        <p>Notre bol de maki à déguster en famille ou entre amis</p>
                        <p>Riz vinaigré, algue nori, saumon, thon, avocat, concombre, fromage frais</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 9€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/brochettes.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Panenka (brochette) de boeuf</h2>
                        <p>Un ensemble de brochettes de boeuf cuites à la perfection</p>
                        <p>Boeuf, fromage, sauce teriyaki, sucre, sauce soja, mirin</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 11€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="blocMenu">
            <div class="titreMenu">
                <h3>Plats</h3>
            </div>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/SR.jpeg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Supreme ronaldo</h2>
                        <p>Le plat ultime de ronaldo à partager</p>
                        <p>Riz vinaigré, saumon, thon, avocat, concombre, algue nori, fromage frais, crevette</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 67€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/chirashi.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Chirashi</h2>
                        <p>Notre plat de chirashi fait maison</p>
                        <p>Riz vinaigré, saumon, thon, concombre, graines de sésame, sauce soja</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 17€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/chirashiAvocat.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Chirashi avocat</h2>
                        <p>Notre plat de chirashi revisité avec des avocats</p>
                        <p>Riz vinaigré, saumon, avocat, concombre, graines de sésame, sauce soja</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 18€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/grosSushi.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Assiette de sushi</h2>
                        <p>Notre belle assiette de sushi complète avec plusieurs variétés de poissons</p>
                        <p>Riz vinaigré, saumon, thon, crevette, avocat, algue nori, fromage frais, concombre</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 21€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/pokeBowl.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Poke GOAL</h2>
                        <p>Notre poke (bowl) ball jouée (presque) officiellement par Ronaldo</p>
                        <p>Riz, saumon cru, avocat, concombre, carotte, graines de sésame, sauce soja, mangue</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 15€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/bobun.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Ballbun</h2>
                        <p>Notre Bobun au poulet et au nems végétariens</p>
                        <p>Vermicelles de riz, boeuf sauté, nems, carotte, concombre, salade, menthe, cacahuètes, sauce
                            nuoc-mâm</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 12€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="blocMenu">
            <div class="titreMenu">
                <h3>Desserts</h3>
            </div>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/mochinutella.png" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>mochi au nutella</h2>
                        <p>Notre mocchi nutella au coeur glacé</p>
                        <p>Pâte de riz gluant, Nutella, sucre, eau</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 5€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/mochisCoco.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Mochi coco</h2>
                        <p>Notre mochi coco au coeur glacé</p>
                        <p>Pâte de riz gluant, noix de coco, sucre, lait de coco</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 5€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/cheesecake.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Cheesecake japonais</h2>
                        <p>Notre cheesecake japonais moelleux à souhait</p>
                        <p>Fromage frais, oeufs, sucre, lait, farine, beurre, vanille</P>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 7€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/perlesCoco.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Perles coco</h2>
                        <p>Nos perles coco faites mains</p>
                        <p>Farine de riz gluant, noix de coco râpée, sucre, haricot mungo, lait de coco</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 5€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
                <div class="box">
                    <img src="Img/Imagesmenu/sake.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Verre de sake</h2>
                        <p>Un verre de sake traditionnel</p>
                        <p>Riz fermenté, eau, koji, levure</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : 6€</span>
                        <button class="bouttonclassique">Commander</button>
                    </div>
                </div>
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
<!DOCTYPE html>
<html>

<?php
session_start();

if(isset($_GET['produit'])){
    $_SESSION['panier'][] = $_GET['produit'];
    header("Location: panier.php");
    exit();
}

if(isset($_GET['supprimer'])){
    $produit = $_GET['supprimer'];
    if(($rechercheIndex = array_search($produit, $_SESSION['panier'])) !== false){
        unset($_SESSION['panier'][$rechercheIndex]);
    }
    $_SESSION['panier'] = array_values($_SESSION['panier']);
    header("Location: panier.php");
    exit();
}
?>

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
            <a href="Menu.php">Menu</a>
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
            <div class="titreMenu">
                <h1>Panier</h1>
            </div>
            <?php
                if(isset($_SESSION['panier'])){
                    $nbr = array_count_values($_SESSION['panier']);
                    foreach($nbr as $produit => $quantite){
                    if($produit=="gyoza"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/gyoza.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Bol de Gyoza x<?php echo $quantite; ?></h2>
                        <p>Notre bol de gyoza fait maison </p>
                        <p>Porc haché, chou chinois, ail, gingembre, sauce soja, huile de sésame, pâte à gyoza</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 9*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "rolls"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/rolls.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Rona-roll-do x<?php echo $quantite; ?></h2>
                        <p>Nos rolls signatures</p>
                        <p>Riz vinaigré, algue nori, saumon, thon, avocat, concombre, fromage frais</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 10*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "sashimi"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/sashimi.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Bol de Siuuushimi</h2>
                        <p>Notre bol de sashimi préparer à la main</p>
                        <p>Saumon cru, thon cru, daurade, sauce soja, wasabi, gingembre mariné</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 12*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "petitsSushi"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/petitsSushi.jpeg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Assortiment de delicieux Siuuushi</h2>
                        <p>Un assortiment de nos meilleurs sushis préparés par le chef en personne</p>
                        <p>Riz vinaigré, saumon, thon, crevette, avocat, algue nori, fromage frais, concombre</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 10*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "maki"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/maki.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Notre Ball (bol) de Maki et sa sauce</h2>
                        <p>Notre bol de maki à déguster en famille ou entre amis</p>
                        <p>Riz vinaigré, algue nori, saumon, thon, avocat, concombre, fromage frais</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 9*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "brochettes"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/brochettes.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Panenka (brochette) de boeuf</h2>
                        <p>Un ensemble de brochettes de boeuf cuites à la perfection</p>
                        <p>Boeuf, fromage, sauce teriyaki, sucre, sauce soja, mirin</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 11*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "supremeRonaldo"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/SR.jpeg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Supreme ronaldo</h2>
                        <p>Le plat ultime de ronaldo à partager</p>
                        <p>Riz vinaigré, saumon, thon, avocat, concombre, algue nori, fromage frais, crevette</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 67*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "chirashi"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/chirashi.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Chirashi</h2>
                        <p>Notre plat de chirashi fait maison</p>
                        <p>Riz vinaigré, saumon, thon, concombre, graines de sésame, sauce soja</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 17*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "chirashiAvocat"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/chirashiAvocat.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Chirashi avocat</h2>
                        <p>Notre plat de chirashi revisité avec des avocats</p>
                        <p>Riz vinaigré, saumon, avocat, concombre, graines de sésame, sauce soja</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 18*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "grosSushi"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/grosSushi.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Assiette de sushi</h2>
                        <p>Notre belle assiette de sushi complète avec plusieurs variétés de poissons</p>
                        <p>Riz vinaigré, saumon, thon, crevette, avocat, algue nori, fromage frais, concombre</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 21*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "pokeBowl"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/pokeBowl.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Poke GOAL</h2>
                        <p>Notre poke (bowl) ball jouée (presque) officiellement par Ronaldo</p>
                        <p>Riz, saumon cru, avocat, concombre, carotte, graines de sésame, sauce soja, mangue</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 15*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "bobun"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/bobun.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Ballbun</h2>
                        <p>Notre Bobun au poulet et au nems végétariens</p>
                        <p>Vermicelles de riz, boeuf sauté, nems, carotte, concombre, salade, menthe, cacahuètes, sauce
                            nuoc-mâm</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 12*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "mochiNutella"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/mochinutella.png" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>mochi au nutella</h2>
                        <p>Notre mocchi nutella au coeur glacé</p>
                        <p>Pâte de riz gluant, Nutella, sucre, eau</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 5*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "mochiCoco"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/mochisCoco.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Mochi coco</h2>
                        <p>Notre mochi coco au coeur glacé</p>
                        <p>Pâte de riz gluant, noix de coco, sucre, lait de coco</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 5*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "cheesecake"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/cheesecake.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Cheesecake japonais</h2>
                        <p>Notre cheesecake japonais moelleux à souhait</p>
                        <p>Fromage frais, oeufs, sucre, lait, farine, beurre, vanille</P>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 7*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "perlesCoco"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/perlesCoco.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Perles coco</h2>
                        <p>Nos perles coco faites mains</p>
                        <p>Farine de riz gluant, noix de coco râpée, sucre, haricot mungo, lait de coco</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 5*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            }
            if($produit == "sake"){
            ?>
            <div class="controlBox">
                <div class="box">
                    <img src="Img/Imagesmenu/sake.jpg" alt="Image du Supreme Ronaldo" class="imgBox">
                    <div class="contenuBox">
                        <h2>Verre de sake</h2>
                        <p>Un verre de sake traditionnel</p>
                        <p>Riz fermenté, eau, koji, levure</p>
                    </div>
                    <div class="basBox">
                        <span id="prix">Prix : <?php echo 6*$quantite; ?>€</span>
                        <a href="panier.php?supprimer=<?php echo $produit; ?>">
                            <button class="bouttonclassique">Supprimer</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
?>
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

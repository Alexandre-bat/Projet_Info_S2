<?php include("Utilitaire/start.php"); 
    $json = file_get_contents(".json/carte.json");
    $produits = json_decode($json, true);
    $filtres = null;
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
                        <button class="bouttonclassique filtres" data-filtres="menu">Menus</button>
                        <button class="bouttonclassique filtres" data-filtres="entree">Entrées</button>
                        <button class="bouttonclassique filtres" data-filtres="plat">Plats</button>
                        <button class="bouttonclassique filtres" data-filtres="dessert">Desserts</button>
                        <button class="bouttonclassique filtres" data-filtres="tous">Tous</button>
                        <button class= bouttonclassique id="allergenes">Allergènes</button>
                    </div>

                    <div id="popupAllergenes" class="popupAllergenes">
                        <div class="contenuPopup">
                            <h2>Choisissez des allergènes</h2>
                            <label>
                                <input type="checkbox" value="poisson">Poisson
                            </label>
                            <label>
                                <input type="checkbox" value="crustaces">Crustacés
                            </label>
                            <label>
                                <input type="checkbox" value="gluten">Gluten
                            </label>
                            <label>
                                <input type="checkbox" value="lactose">Lactose
                            </label>
                            <label>
                                <input type="checkbox" value="oeufs">Oeufs
                            </label>
                            <label>
                                <input type="checkbox" value="sesame">Sésame
                            </label>
                            <label>
                                <input type="checkbox" value="fruitsCoque">Fruits à coque
                            </label>
                            <button id="fermerPopup" class="bouttonclassique">Fermer
                            </button>
                        </div>
                    </div>
                </div>
                <div id="zoneProduits">
                </div>
            </main>
                <!-- Pied de page -->
            <footer>
                <?php include("Utilitaire/footer.php"); ?>
            </footer>
            <script>
                const boutons = document.querySelectorAll(".filtres");
                const zone = document.getElementById("zoneProduits");
                boutons.forEach(function(bouton){
                    bouton.addEventListener("click", async function(){
                        let filtre = this.dataset.filtres;
                        let requete = new XMLHttpRequest();
                        requete.open("GET", "afficheProduits.php?filtre=" + filtre);
                        requete.onload = function(){

                            if(requete.status == 200){
                                zone.innerHTML = requete.responseText;
                            }

                        };
                        requete.send();
                    });
                });
                let requete = new XMLHttpRequest();
                requete.open("GET", "afficheProduits.php?filtre=tous");
                requete.onload = function(){
                    if(requete.status == 200){
                        zone.innerHTML = requete.responseText;
                    }
                };
                requete.send();

                // Java pour pop up
                
                const boutonAllergenes = document.getElementById("allergenes");
                const popup = document.getElementById("popupAllergenes");
                const fermerPopup = document.getElementById("fermerPopup");
                boutonAllergenes.addEventListener("click", function(){
                    popup.style.display = "flex";
                });
                fermerPopup.addEventListener("click", function(){
                    popup.style.display = "none";
                });
            </script>
        </body>
    </html>

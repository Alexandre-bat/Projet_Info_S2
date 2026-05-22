<?php include("Utilitaire/start.php"); 
    $json = file_get_contents("json/carte.json");
    $produits = json_decode($json, true);
?>
<!-- Récupère le fichier et remet les filtres à null -->
<!DOCTYPE html>
    <html>
        <head>
            <title>SIUUSHI - Accueil</title>
            <link rel="icon" href="Img/logo.png" type="image/png">
            <link rel="stylesheet" type="text/css" href="Dark_Style.css">
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
                        <button class="bouttonclassique" id="allergenes">Allergènes</button>
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
                //Js pour la commande async
                document.addEventListener("click", async function(e){
                    if(e.target.classList.contains("boutonCommander")){
                        let idProduit = e.target.dataset.id;
                        try{
                            let response = await fetch("Fonctions/ajoutPanier.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: "produit=" + idProduit
                            });
                            let data = await response.text();
                            if(data == "ok"){
                                let compteur = document.getElementById("compteurPanier");
                                let lienPanier = document.getElementById("lienPanier");
                                compteur.textContent = parseInt(compteur.textContent) + 1;
                                lienPanier.style.display = "inline-flex";
                            }
                            else if(data == "non_connecte"){
                                window.location.href = "Connexion.php";
                            }
                            else if(data == "commande_active"){
                                let modifier = confirm("Vous avez déjà une commande en attente.\n\nVoulez-vous modifier votre commande ?");
                                if(modifier){
                                    await fetch("Fonctions/modifsCommandeAttente.php", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/x-www-form-urlencoded"
                                        },
                                        body: "ajoutCarte=" + idProduit
                                    });
                                    alert("Produit ajouté à votre commande.");
                                }
                            }
                        }
                        catch(error){
                            console.log(error);
                        }
                    }
                });
                // JS pour les filtres/allergènes/recherche
                const boutons = document.querySelectorAll(".filtres");
                const zone = document.getElementById("zoneProduits");
                const barreRecherche = document.getElementById("rechercheInput");
                //Recuperation des elements html pour filtre/recherche
                let allergenesSelectionnes = [];
                async function chargerProduits(filtre){
                    let allergenes = allergenesSelectionnes.join(",");
                    let recherche = barreRecherche.value;
                    try{
                        let response = await fetch("Fonctions/afficheProduits.php?filtre=" + filtre + "&allergenes=" + allergenes + "&recherche=" + recherche);
                        let data = await response.text();
                        zone.innerHTML = data;
                    }
                    catch(error){
                        console.log("Erreur :", error);
                    }
                }
                //fonction asynchrone pour recuperer les filtres de afficheProduits.php
                barreRecherche.addEventListener("input", function(){
                    chargerProduits(localStorage.getItem("filtreActuel"));
                });
                boutons.forEach(function (bouton) {
                    bouton.addEventListener("click", function () {
                        let filtre = this.dataset.filtres;
                        localStorage.setItem("filtreActuel", filtre);
                        chargerProduits(filtre);
                    });
                });
                let filtreActuel = "tous";
                localStorage.setItem("filtreActuel", filtreActuel);
                chargerProduits(filtreActuel);
                const checkboxes = document.querySelectorAll('#popupAllergenes input[type="checkbox"]');
                checkboxes.forEach(function(checkbox){
                    checkbox.addEventListener("change", function(){
                        allergenesSelectionnes = [];
                        checkboxes.forEach(function(cb){
                            if(cb.checked){
                                allergenesSelectionnes.push(cb.value);
                            }
                        })
                        chargerProduits(localStorage.getItem("filtreActuel"));
                    });
                });
                // gestion des evenements

                // JS pour afficher pop up
                const boutonAllergenes = document.getElementById("allergenes");
                const popup = document.getElementById("popupAllergenes");
                const fermerPopup = document.getElementById("fermerPopup");
                //recuperation des elements pour la pop up
                boutonAllergenes.addEventListener("click", function(){
                    popup.style.display = "flex";
                });
                fermerPopup.addEventListener("click", function(){
                    popup.style.display = "none";
                });
                // affichage ou non
            </script>
        </body>
    </html>

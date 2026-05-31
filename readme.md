🍔 Creative-Yumland-PreING2

Développement de l’interface web d’un site de restauration

Projet de développement Web — Pré-Ingénieur CY Tech, Semestre 4

👥 Collaborateurs

• Bernard Alexandre
• Cordero Mathias
• Therin Achille

📄 Description du projet

📌 Objectifs

Ce projet consiste à créer le site web d'un restaurant. Consultable autant par le restaurateur, que le livreur, que les clients souhaitant commander à manger.

🖥️ Création des pages web

Dans un premier temps, nous avons créé différentes pages HTML basées sur :

🎨 Une charte graphique définie en amont, permettant d’assurer une cohérence visuelle entre toutes les pages du site.

https://paletton.com/#uid=1000u0klExijAPMkTH6lTs0lqmA


À partir de cette charte graphique, plusieurs pages statiques ont été développées :

• Page d’accueil : affichage des plats populaires et barre de recherche
• Page menu : affichage des plats avec système de filtrage
• Page inscription : formulaire de création de compte
• Page connexion : authentification utilisateur
• Page profil : accès aux informations personnelles et commandes
• Page administrateur : affichage des utilisateurs du site
• Page des commandes : prise en charge des commandes
• Page de livraison : prise en charge des livraisons
• Page de notation : notation par les utilisateurs après la livraison

📂 Organisation des fichiers

Le projet est structuré de la manière suivante :

Pages php principales visibles
Fichier CSS unique partagé par toutes les pages
Dossier "Img" contenant les images nécessaires
Dossier "Utilitaire" contenant les fonctions utilisées par toutes les pages
Dossier "Fonctions" contenant les fonctions utilisées par qu'une ou deux pages
Dossier "Rapports" contenant les rapports de projet

🛠️ Lancement du site

Tout d’abord, assurez-vous d’avoir un navigateur web installé sur votre machine.

Téléchargez les fichiers depuis le github
N'oubliez pas le localhost8080! (Très important que ce soit 8080!)

Hébergez le serveur sur votre pc avec :
php -S localhost:8080 routeur.php (Important de rajouter "routeur.php" pour plus de sécurité !)

Ensuite, ouvrez le fichier principal du site avec :
localhost:8080/Accueil.php

📱 Il ne vous reste plus qu’à naviguer sur le site et découvrir ses fonctionnalités !


⚠️ ATTENTION !

Certaines fonctionnalités ne sont pas encore disponible et le serons qu'à la phase 4 !

• Les différents profils bien répartis
• Des options de retour a la page precedente (quand on regarde le détail d'une commande)

💡 Comment marche la gestion des commandes

Lorsqu'un utilisateur commande la commande à le statut "En preparation" si elle à été commandé comme "Immediate"
Sinon elle à le statut "Attente".

Le restaurateur peut choisir de changer le statut des commandes de "Attente" à "En preparation" puis "En livraison"
si elle doit être livrée.

Enfin le livreur la prends en charge et peux choisir de l'abandonner ou de l'avoir livrée.
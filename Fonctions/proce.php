<?php
    session_start();

    // Fonction qui permet d'inscrire un utilisateur et ecriture dans fichier json
    function traiter_fichier($fichier){

        if(!file_exists($fichier)){
            file_put_contents($fichier, "[]");
        }

        // Récéption infos
        $prenom = htmlspecialchars(trim($_POST["prenom"]));
        $nom = htmlspecialchars(trim($_POST["nom"]));
        $tel = htmlspecialchars(trim($_POST["tel"]));
        $adresse = htmlspecialchars(trim($_POST["adresse"]));
        $mdp = htmlspecialchars(trim($_POST["mdp"]));

        $contenu = file_get_contents($fichier);
        $data = json_decode($contenu, true);

        if(!is_array($data)){
            $data = [];
        }

        foreach($data as $user){
            if($user["tel"] === $tel){
                header("Location:  ../Inscription.php?erreur=1");
                exit();
            }
        }

        $id = uniqid("user_", true);

        $data[] = [
            "id" => $id,               
            "prenom" => $prenom,
            "nom" => $nom,
            "tel" => $tel,
            "adresse" => $adresse,
            "mdp" => $mdp,
            "role" => "client",
            "inscription" => date("Y-m-d H:i:s"),
            "bloquer" => 0
        ];

        file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));

        $_SESSION['id'] = $id;        
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['adresse'] = $adresse;
        $_SESSION['telephone'] = $tel;

        header("Location:  ../Profil.php");
        exit();
    }

    traiter_fichier(__DIR__ . "/../.json/id.json");
?>
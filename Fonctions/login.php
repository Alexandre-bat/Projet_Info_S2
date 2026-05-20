<?php
    session_start(); 

    $numtel = trim($_POST['tel'] ?? "");
    $password = trim($_POST['mdp'] ?? "");

    $fichier = __DIR__ . "/../.json/id.json";

    if(!file_exists($fichier)){
        header("Location: ../Connexion.php?error=1");
        exit();
    }

    $contenu = file_get_contents($fichier);
    $data = json_decode($contenu, true);

    if(!is_array($data)){
        header("Location: ../Connexion.php?error=2");
        exit();
    }

    $trouve = false;

    foreach($data as $user){

        if(isset($user["tel"], $user["mdp"])){

            if($numtel === $user["tel"] && $password === $user["mdp"]){
                if( $user["bloquer"] == 1 ){
                    header("Location: ../Connexion.php?bloquer=1");
                    exit();
                }

                $trouve = true;

                $_SESSION['id'] = $user["id"] ?? null;
                $_SESSION['nom'] = $user["nom"];
                $_SESSION['prenom'] = $user["prenom"];
                $_SESSION['telephone'] = $user["tel"];
                $_SESSION['adresse'] = $user["adresse"] ?? "";
                $_SESSION['bloquer'] = 0;
                $_SESSION['reduction'] = 0;

                break;
            }
        }
    }
    //chercher l'utilisateur dans le fichier id.json 

    if($trouve){
        header("Location:  ../Accueil.php");
        exit();
    }else{
        header("Location: ../Connexion.php?error=3");
        exit();
    }
    //renvoie sur accueil si ca marche sinon sur connexion
?>

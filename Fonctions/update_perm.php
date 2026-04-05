<?php 
    session_start();

    // Permet de changer les perm des utilisateurs dans le fichier JSON
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['perm'])){

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $nouveau_role = $_POST['perm'];

        $fichier = __DIR__ . "/../.json/id.json";

        if(!file_exists($fichier)){
            header("Location:  ../Admin.php");
            exit();
        }

        $json = file_get_contents($fichier);
        $users = json_decode($json, true);

        foreach($users as &$user){
            if($user['nom'] == $nom && $user['prenom'] == $prenom){
                $user['role'] = $nouveau_role;
                break;
            }
        }

        file_put_contents($fichier, json_encode($users, JSON_PRETTY_PRINT));

        header("Location:  ../Admin.php");
        exit();
    }
?>
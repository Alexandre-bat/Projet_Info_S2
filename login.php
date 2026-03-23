<?php
session_start();

$numtel = trim($_POST['tel'] ?? "");
$password = trim($_POST['mdp'] ?? "");

$fichier = "id.json";

if(!file_exists($fichier)){
    header("Location: Connexion.php?error=1");
    exit();
}

$contenu = file_get_contents($fichier);
$data = json_decode($contenu, true);

if(!is_array($data)){
    header("Location: Connexion.php?error=1");
    exit();
}

$trouve = false;

foreach($data as $user){

    if(isset($user["tel"], $user["mdp"])){

        if($numtel === $user["tel"] && $password === $user["mdp"]){
            $trouve = true;

            $_SESSION['id'] = $user["id"] ?? null;
            $_SESSION['nom'] = $user["nom"];
            $_SESSION['prenom'] = $user["prenom"];
            $_SESSION['telephone'] = $user["tel"];
            $_SESSION['adresse'] = $user["adresse"] ?? "";

            break;
        }
    }
}

if($trouve){
    header("Location: Profil.php");
    exit();
}else{
    header("Location: Connexion.php?error=1");
    exit();
}
?>
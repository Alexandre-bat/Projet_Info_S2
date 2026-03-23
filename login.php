<?php

$numtel = $_POST['tel'];
$password = $_POST['mdp'];

$fichier = fopen("id.txt", "r");

$trouve = false;

while(($ligne = fgets($fichier)) !== false){

    $infos = explode(" ", trim($ligne));

    $tel = $infos[2];
    $mdp = $infos[3];
    $nom = $infos[1];
    $prenom = $infos[0];
    $adresse = $infos[4];

    if($numtel == $tel && $password == $mdp){
        $trouve = true;
        break;
    }
}

fclose($fichier);

if($trouve){
    session_start();
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['adresse'] = $adresse;
    $_SESSION['telephone'] = $tel;
    header("Location: Accueil.php");
    exit();
}else{
    header("Location: Connexion.php?error=1");
}

?>
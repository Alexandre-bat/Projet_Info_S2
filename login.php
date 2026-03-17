<?php
session_start();

$numtel = $_POST['tel'];
$password = $_POST['mdp'];

$fichier = fopen("id.txt", "r");

$trouve = false;

while(($ligne = fgets($fichier)) !== false){

    $infos = explode(" ", trim($ligne));
    $prenom = $infos[0];
    $nom = $infos[1];
    $tel = $infos[2];
    $mdp = $infos[3];
    if( isset($infos[4])){ $adresse = $infos[4];}

    if($numtel == $tel && $password == $mdp){
        $trouve = true;
        break;
    }
}

fclose($fichier);

if($trouve){
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    if( isset($infos[4])){ $_SESSION['adresse'] = $adresse; }
    $_SESSION['telephone'] = $tel;
    header("Location: Profil.php");
    exit();
}else{
    header("Location: Connexion.php?error=1");
}

?>
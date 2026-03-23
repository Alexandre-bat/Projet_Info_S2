<?php
session_start();

function traiter_fichier($fichier){

    if(!file_exists($fichier)){
        file_put_contents($fichier, "[]");
    }

    $f_name = trim($_POST["prenom"]);
    $l_name = trim($_POST["nom"]);
    $contact = trim($_POST["tel"]);
    $security = trim($_POST["mdp"]);

    $contenu = file_get_contents($fichier);
    $data = json_decode($contenu, true);

    if(!is_array($data)){
        $data = [];
    }

    foreach($data as $user){
        if($user["tel"] === $contact){
            header("Location: Inscription.php?erreur=1");
            exit();
        }
    }

    $id = uniqid("user_", true);

    $data[] = [
        "id" => $id,               
        "prenom" => $f_name,
        "nom" => $l_name,
        "tel" => $contact,
        "mdp" => $security
    ];

    file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));

    $_SESSION['id'] = $id;        
    $_SESSION['nom'] = $l_name;
    $_SESSION['prenom'] = $f_name;
    $_SESSION['adresse'] = "";
    $_SESSION['telephone'] = $contact;

    header("Location: Profil.php");
    exit();
}

traiter_fichier("id.json");
?>
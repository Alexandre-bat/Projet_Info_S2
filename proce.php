<?php
 session_start();
    function traiter_fichier($fichier){
        
        $f = fopen($fichier,"a");
        if(!$f){
            echo "Pb fichier";
            exit();
        }

        $f_name = $_POST["prenom"];
        $l_name  = $_POST["nom"];
        $contact = $_POST["tel"];
        $security = $_POST["mdp"];

        $contenu = file_get_contents($fichier);
        $lignes = explode("\n", trim($contenu));

        foreach($lignes as $ligne){

            if(empty($ligne)) continue;

            $infos = explode(" ", $ligne);

            if(count($infos) < 4) continue;

            $tel = $infos[2];
            $mdp = $infos[3];

            if($contact == $tel && $security == $mdp){
                header("Location: Inscription.php?erreur=1");
                exit();
            }
        }

        fwrite($f, "$f_name $l_name $contact $security\n");
        fclose($f);

        $_SESSION['nom'] = $l_name;
        $_SESSION['prenom'] = $f_name;
        $_SESSION['adresse'] = "";
        $_SESSION['telephone'] = $contact;

        header("Location: Profil.php");
        exit();
}

traiter_fichier("id.txt");
?>
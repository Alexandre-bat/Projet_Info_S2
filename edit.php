<?php
    function traiter_fichier($fichier){

        $f = fopen($fichier,"a+");
        if(!$f){
            echo "Pb fichier";
            exit();
        }

        $contenu = file_get_contents($fichier);
        $contenu = str_replace("\n", " ", $contenu);
        $tab = explode(" ", $contenu);

        $nom = $_POST["nom"];
        $prenom  = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $tel = $_POST["telephone"];

        $id = [];

        for($i=0; $i < count($tab); $i+=4){

            $id[$i][0] = $tab[$i];
            $id[$i][1] = $tab[$i+1];
            $id[$i][2] = $tab[$i+2];
            $id[$i][3] = $tab[$i+3];

            if($tel == $id[$i][2]){

                $nom = $id[$i][0];
                $prenom  = $id[$i][1];

                fwrite($f, "$f_name $l_name $contact $security \n");
                fclose($f);
                exit();
            }
        }
}

    traiter_fichier("id.txt");
?>
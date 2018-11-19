<?php

if($action=='ajouter'){
    echo 'on va ajouter';
}
elseif($action=='supprimer'){
    echo 'on vas supprimer';
}
elseif($action=='update'){
    echo 'on vas mettre a jours';
}
else{
    echo " <script type='text/javascript'> 
    document.location.replace('redirection.php');
    alert('Cette action est interdite !!! ');
</script>";
}

echo $action;


//recuperation des valeurs des champ dans le fromulaire add_user
$user=$_POST['id_user'];
$mp=$_POST['mp_user'];
$mpc=$_POST['mpc_user'];

//affichage des valeur des variables declarer
echo 'user : '.$user.'<br> mp : '.$mp.'<br> mpc : '.$mpc.'<br><br>';

//inspecter les valeurs de la variable $_post
//var_dump($_POST);

//verification du MP communiquer par l'utilisateur 
if($mp!=$mpc){
    echo " <script type='text/javascript'> 
    document.location.replace('redirection.php');
    alert('Veuillez saisire deux mots de passes identique !!! ');
</script>";
}
else{
     //declaration de la requete sql avec parametre (:param)
    echo 'Vous avez communiquer : <br>-Identifiant : '.$user.'<br>-Mot de passe : '.$mp.'<br>';

    //preparation de la requete sql en utilisant la variable $connection
    $sql='select * from nortech.utilisateur where identifiant=:id';
    $requete=$connection->prepare($sql);

    //execution de la requte avec enregistrement des resultat dans la variable $reponse (boolean qui prend 2 valeur 1 pour execute=ok et 
                                                                                                                //0 pour execute = KO)
    $reponse=$requete->execute(array('id'=>$user));

    $resultat=$requete->fetch();//permet de pointer sur la premiere ligne des resultats

    //enregistrement des valeur retourner dans la variable $resultat
    if($resultat){
        echo " <script type='text/javascript'> 
        document.location.replace('redirection.php');
        alert('Identtifiant deja utilisé par un autre utilisateur !!! ');
        </script>";
    }
    else{
        
       //requete insertion des donnes 
        $sql='INSERT INTO utilisateur (identifiant, motdePasse) VALUES (:id,:mp)';
        
        $requete=$connection->prepare($sql);
        
        $reponse=$requete->execute(array('id'=>$user,'mp'=>$mp));

        if(!$reponse){
            echo " <script type='text/javascript'> 
            document.location.replace('redirection.php');
            alert('L'enregistrement de l'utilisateur a echoué !!! ');
            </script>";
        }
        else{
            echo " <script type='text/javascript'> 
        document.location.replace('redirection.php');
        alert('Utilisateur enregistré avec succé !!! ');
        </script>";
        }
    }
    /*
    if(!$reponse){
        echo '<br>Requete a échoué<br>';
    }
    else{
        echo '<br>Requete OK<br>';
    }*/
    /*echo " <script type='text/javascript'> 
    document.location.replace('redirection.php');
    alert('erreur de connection a la base de donné');
    </script>";*/
}
echo "----------------------------------------------<br>";
echo '  <a href="redirection.php">Accueil</a>';

?>
<?php
include('db_connect.php');
session_start();
$utilisateur=$_SESSION['pseudo'];
$nomO=$_FILES['joinCV']['name'];
$type=$_FILES['joinCV']['type'];
$size=$_FILES['joinCV']['size'];
$adrTmp=$_FILES['joinCV']['tmp_name'];
$erreur=$_FILES['joinCV']['error'];
$maxSize=10000000;
$extensions_valides=array('pdf');
$extension_upload=strtolower(substr(strrchr($nomO,'.'),1));



if($_FILES['joinCV']['error']>0){
    echo "<script type='text/javascript'>document.location.replace('redirection.php');
       alert('Erreur lors du transfert');
        </script>";
}
else if($size>$maxSize){
    echo "<script type='text/javascript'>document.location.replace('redirection.php');
       alert('Le Fichier est trop gros');
        </script>";
}
else if(!in_array($extension_upload,$extensions_valides)){
    echo "<script type='text/javascript'>document.location.replace('redirection.php');
       alert('Type de fichier incorrect! Seul les \"PDF\" sont admis!');
        </script>";
}
else{

    $sql='select e.noEmp, e.nom, e.prenom from nortech.employe e, nortech.utilisateur u where e.identifiant=u.identifiant and u.identifiant like "'.$_SESSION['pseudo'].'"';
    //Préparation de la requête SQL en utilisant la variable $connexion
    $req=$connexion->prepare($sql);
    //execuction de la requête avec enregistrement des résultats dans la variable $reponse
    //(boolean qui prend deux valeurs : 1 pour execute=ok et 0 pour execute=ko)
    $reponse=$req->execute(array());

    $resultat=$req->fetch();

    $nomF= $resultat['noEmp'].'_'.$resultat['nom'].'_'.$resultat['prenom'].'.pdf';
    $fichier="CV/$nomF";
    
    $test=move_uploaded_file($adrTmp,$fichier);
    if($test){
        echo "<script type='text/javascript'>document.location.replace('redirection.php');
       alert('Votre CV à été mis à jour!');
        </script>";
    }
    else{
        echo "<script type='text/javascript'>//document.location.replace('redirection.php');
       alert('Erreur lors de l\'enregistrement');
        </script>";
    }
}
?>
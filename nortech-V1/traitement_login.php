<?php
//-- --------------------------------------------------------

/*Traitement :Authentification */

//-- --------------------------------------------------------
//demarrage de la session
session_start();

//connexion à la bdd
include('db_connect.php');

//vérification de l'existance et non vide 
if(isset($_POST['id_user'])&& isset($_POST['mp_user'])){
if(!empty($_POST['id_user']) && !empty($_POST['mp_user'])){

//récupération de identifiant et motPasse avec la methode post
$id_user=$_POST['id_user'];
$mp_user=$_POST['mp_user'];


//preparation de la rqt sql on utilisant la variable $connexion
//séléctionné l'identifiant et le motPasse
$req=$connexion->prepare("SELECT * from utilisateur where identifiant=:id_user AND  motPasse =:mp_user");

//execution de la rqt avec eregistrement de resulat de la variable $reponse
$reponse=$req->execute(array( 
        'id_user'=>$id_user,
        'mp_user'=>$mp_user

));

//pointer sur la prmiére colonne 
$resultat= $req ->fetch();
if(!$resultat){
    //Affichage d'un message d'erreur si l'identifiant ou le motPasse est incorrecte
    echo"<script type='text/javascript'>document.location.replace('loger.php');
             alert('l\'Identifiant ou le mot de passe sont incorrectes  !!');</script>";
}else{

    //séléctionné l'identifiant et le motPasse de la BD
    $sql="SELECT droits FROM utilisateur where identifiant = :id_user AND  motPasse =:mp_user ";
    $req=$connexion->prepare($sql);
    $rep=$req->execute(array( 
        'id_user'=>$id_user,
        'mp_user'=>$mp_user
));

//pointer sur la premiére colonne avec une récupération de plusieurs données 
while ($resultat=$req ->fetch()){

    //redirection selon les droit de l'utilisateur 
    if($resultat['droits']==1){
        header('Location: redirection.php');

    }else if($resultat['droits']==2){
        header('Location: http://localhost/nord/droit2.php');
    }else if($resultat['droits']==3){
        header('Location: http://localhost/nord/droit3.php');
    }else{
        header('Location: http://localhost/nord/droit4.php');
    }
}
}
}
}else{
    //Affichage d'un message d'erreur si l'identifiant ou le motPasse est incorrecte
    echo"<script type='text/javascript'>document.location.replace('loger.php');
             alert('l\'Identifiant ou le mot pass sans incorrecte  !!');</script>";
}


//-- --------------------------------------------------------

/*Traitement et affichage :la dérniére connexion et le nom et le prenom pour chaque utilisateur  */

//-- --------------------------------------------------------

//récupération de identifiant et le mot Passe avec la methode post pour l'affichage et l'insertion 
$id=$_POST['id_user'];
$mp_user=$_POST['mp_user'];

//date & heure locale 
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

//date au format français
$temps = strftime("%A %d %B %Y  %H:%M");

//fonction de l'adresse IP
$host= gethostname();
$ip = gethostbyname($host);
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);

//recuperation de identifiant et la connexion en session pour l'afficher dans employe.php
$_SESSION['dateConnection'] = $temps;
$_SESSION['pseudo'] = $id;

//si l'identifiant existe on le stocke ds la session  
if (isset($_SESSION['pseudo'])) $id=$_SESSION['pseudo'];

//séléctioné le nom et prenom de l'employe ds le bonjour
$sql="SELECT e.nom,e.prenom FROM employe e, utilisateur i WHERE i.identifiant=e.identifiant AND e.identifiant='$id'";

//preparation de la rqt sql on utilisant la variable $connexion
$requete=$connexion->prepare($sql);

//execution de la rqt avec eregistrement de resulat de la variable $reponse
$repp=$requete->execute();

//pointer sur la prmiére colonne 
$result=$requete->fetch();

    //stocké le resulta du nom et prénom dans la session 
    $_SESSION['nom']= $result['nom'];
    $_SESSION['prenom']=$result['prenom'];

    //séléctioné de la dateConnection
    $sql="SELECT dateConnection FROM historique where identifiant = '$id' ORDER BY dateConnection DESC";
    $requete=$connexion->prepare($sql);
    $rep=$requete->execute();
    $result=$requete->fetch();

    //stocké le resulta dateConnection dans la session 
    $_SESSION['dateConnection']= $result['dateConnection'];


//-- --------------------------------------------------------

/*Insertion dans la table Historique*/

//-- --------------------------------------------------------
   
    
    //séléctionné l'identifiant et le motPasse
    $req=$connexion->prepare("SELECT * from utilisateur where identifiant=:id_user AND  motPasse =:mp_user");
    
    //execution de la rqt avec eregistrement de resulat de la variable $reponse
    $reponse=$req->execute(array( 
            'id_user'=>$id,
            'mp_user'=>$mp_user
    
    ));
    
    //pointer sur la prmiére colonne 
    $resultat= $req ->fetch();
    if(!$resultat){
        console.log();
    }else{
        //insertion 
    $sql = "INSERT INTO historique (dateConnection, adresseIP, poste, identifiant) VALUES ('$temps', '$ip', '$hostname', '$id')";
    $request=$connexion->prepare($sql);
    $repe=$request->execute();
    }
?>







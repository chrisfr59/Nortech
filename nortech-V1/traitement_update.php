<?php
$Nom=$_POST['nom'];
$Prenom=$_POST['prenom'];
$fonction=$_POST['fonction'];
$embauche=$_POST['embauche'];
$sal=$_POST['sal'];
if(empty($_POST['comm'])){
    $comm='null';
}
else{
    $comm=$_POST['comm'];
}
if(empty($_POST['prime'])){
    $prime='null';
}
else{
    $prime=$_POST['prime'];
}
if (empty($_POST['sup'])){
    $sup = 'null';
}else{
    $sup=$_POST['sup'];
}
$dtn=$_POST['dtn'];
$mail=$_POST['mail'];
$Noserv=$_POST['Noserv'];
$tel=$_POST['tel'];

$req="update nortech.employe set fonction='$fonction', sup=$sup, embauche='$embauche', sal='$sal', comm=$comm, noServ='$Noserv', tel='$tel', mail='$mail', prime=$prime where nom='$Nom' and prenom='$Prenom'";
echo $req;
//connection bdd
try{
    $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
    $connexion->query($req);
    echo "<script type='text/javascript'>document.location.replace('Tableaux_Complet.php');
       alert('données bien modifié! Retour à la page employé ');
        </script>";
}
catch (PDOException $e){
    print "Erreur!:".$e->getMessage().'<br>';
    echo "<script type='text/javascript'>document.location.replace('update.php');
       alert('Erreur de connection à la base de données!');
        </script>";
}
?>
<?php 
require 'user.php';
require 'employe.php';
require 'stagiaire.php';
require 'ComonTraitement.php';

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$naissance=$_POST['nais'];
$tel=$_POST['tel'];
$adresse=$_POST['adresse'];
$embauche=$_POST['embauche'];
$fonction=$_POST['fonction'];
$noserv=$_POST['noserv'];



$employe = new employe($nom,$prenom,$naissance,$tel,$adresse,$embauche,$fonction,$noserv);
$noemp= ComonTraitement::createNoEmp($employe->getNoserv());
$email= ComonTraitement::CreateEmail($employe->getNom(),$employe->getPrenom(),$noemp);
$employe->setNoemp($noemp);
$employe->setMail($email);
var_dump($employe);

//echo $email;
//echo $employe->getNoserv();
$employe= ComonTraitement::insertEmploye($noemp, $nom, $prenom, $naissance, $tel, $adresse, $email, $embauche, $fonction, $noserv);

//var_dump($employe);
//echo $nom;




?>
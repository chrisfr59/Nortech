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
$var= ComonTraitement::CreateEmail($employe->getNom(),$employe->getPrenom(),$noemp);
echo $var;
//var_dump($employe);




?>
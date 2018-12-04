<?php

require('../common/modele/User.php');
require('../common/modele/Employe.php');
require('../common/modele/Email.php');
require('../common/factory/CommonTraitement.php');

/*
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$naissance = $_POST['nais'];
$tel = $_POST['tel'];
$adresse = $_POST['adresse'];
$embauche = $_POST['embauche'];
$fonction = $_POST['fonction'];
$noServ = $_POST['noserv'];
*/

$EmailType = $_POST['EmailType'];


/*
*voici le controller du fomulaire (répertoire des views) "AjoutEmp.html" 
*
*
*/

/*création d'une nouveau employé à partir des valeur du formulaire 
*/
$newEmploye = New Employe($_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['nais'],$_POST['tel'],$_POST['emb'],$_POST['service'],$_POST['fonction']);

/*Création du nomero d'employé à partir du numéro de service récuperé du formulaire
*appel de la methode de création du numéro employé
*/
var_dump($newEmploye->getNoServ());
$noEmp = CommonTraitement::createNoEmp($newEmploye->getNoServ());

//ajout du numéro d'employé dans l'objet "newEmploye" par la méthode "setNoEmp"
$newEmploye->setNoEmp($noEmp);

//création du mail de l'employé à partir de l'objet "newEmploye" 
$mail= CommonTraitement::createMail($newEmploye->getNom(),$newEmploye->getPrenom(),$newEmploye->getNoEmp(),$EmailType);

//ajout du mail de l'employé dans l'objet "newEmploye" par la méthode "setMail"
$newEmploye->setMail($mail);

/*
*L'objet "newEmploye" est maintenant enrichit avec les nouvelles propriétés 
* à l'aide des methode de la fabrique à savoir
*	createNoEmp --> pour créer le numero d'employé
*	createMail --> pour lui créer son nouveau mail
*l'objet est ainsi pret à etre inserer en BDD
*/
CommonTraitement::insertEmp($newEmploye);

CommonTraitement::createUserAccount($newEmploye);

?>
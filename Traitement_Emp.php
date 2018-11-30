<?php

require('User.php');
require('Employe.php');
require('Stagiaire.php');
require('CommonTraitement.php');

$newEmploye = New Employe($_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['nais'],$_POST['tel'],$_POST['emb'],$_POST['service'],$_POST['fonction']);
echo $newEmploye->lire().'<br>';
$noEmp = CommonTraitement::createNoEmp($newEmploye->getNoServ());
$newEmploye->setNoEmp($noEmp);
echo $newEmploye->lire().'<br>';
$mail= CommonTraitement::CreateEmail($newEmploye->getNom(),$newEmploye->getPrenom(),$newEmploye->getNoEmp());
$newEmploye->setMail($mail);
echo $newEmploye->lire().'<br>';
?>
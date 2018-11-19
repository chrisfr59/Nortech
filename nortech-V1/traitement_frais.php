<?php
include('db_connect.php');

    $noemp=$_POST['noemp'];
    $montant=$_POST['montant'];
    $date=$_POST['date'];
    $motif=$_POST['motif'];
    $autreMotif=$_POST['autreMotif'];

$sql='SELECT * FROM nortech.frais';
$req=$connexion->prepare($sql);
$reponse=$req->execute(array('id'=>$motif));
$sql='INSERT INTO `frais`(`motif`, `montant`, `dateFrais`, `noEmp`, `autreMotif`) VALUES (:id,:montant,:date,:noemp, :autreMotif)';
	$req=$connexion->prepare($sql);
$reponse=$req->execute(array('id'=>$motif,'montant'=>$montant, 'date'=>$date,'noemp'=>$noemp ,'autreMotif'=>$autreMotif));
    
   if(!$reponse){
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                    alert('l\'enregistrement de la note de frais a échoué ! Veuillez vérifier vos saisies.');
                    </script>";
        }else{
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                    alert('Note de frais enregistrée avec succès !');
                    </script>";
        }


?>
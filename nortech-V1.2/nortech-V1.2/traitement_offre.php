<?php
$nav_en_cours ='offreemploi';
include('header.php');


if($action=='ajouter'){
    
$titre=$_POST['titre'];
$serv=$_POST['service'];
$dat=$_POST['dat'];
$ville=$_POST['ville'];
$descrip=$_POST['descrip'];

$sql='SELECT * FROM nortech.annonce where noannonce=:id';
$req=$connexion->prepare($sql);
$reponse=$req->execute(array('id'=>$titre));
$resultat=$req->fetch();

$sql="INSERT INTO nortech.annonce(`titre`, `service`, `dateAnnonce`, `ville`, `description`) VALUES (:id,:serv,:dat,:ville,:descrip)";
$req=$connexion->prepare($sql);
$reponse=$req->execute(array('id'=>$titre,'serv'=>$serv,'dat'=>$dat,'ville'=>$ville,  'descrip'=>$descrip));

if(!$reponse){
    echo "<script type='text/javascript'>document.location.replace('ajouter_annonce.php?section=offre');
                    alert('l\'enregistrement de l\'annonce a échoué ! Veuillez vérifier vos saisies.');
                    </script>";
        }else{
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=offreemploi');
                    alert('Annonce enregistrée avec succès !');
                    </script>";

}
}
elseif($action=='supprimer'){
    $noannonce=$_POST['noannonce'];
$sql='SELECT * from nortech.annonce where noannonce= :id';
$req=$connexion->prepare($sql);
$reponse=$req->execute(array('id'=>$noannonce));
$resultat=$req->fetch();
if(!$resultat){
    echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                    alert('Ce numéro ne correspond à aucune annonce de la BDD!');
                    </script>";
        }else{
            $sql='DELETE FROM nortech.annonce WHERE noannonce=:id';

            $req=$connexion->prepare($sql);
            $reponse=$req->execute(array('id'=>$noannonce));
            if(!$reponse){
                echo "<script type='text/javascript'>document.location.replace('supprimer_annonce.php?section=offre');
                            alert('La suppression de cette annonce a échoué!');
                            </script>";
                }else{
            
                    echo "<script type='text/javascript'>document.location.replace('redirection.php?section=offreemploi');
                            alert('Annonce supprimée avec succès!');
                            </script>";
}
        }
}elseif($action=='update'){
    $id=$_GET['id'];	
    $noannonce=$_POST['noannonce'];
    $titre=$_POST['titre'];
    $serv=$_POST['service'];
    $dat=$_POST['dat'];
    $ville=$_POST['ville'];
    $descrip=$_POST['descrip'];
    
    $sql='SELECT * FROM nortech.annonce where noAnnonce=:id';
    $req=$connexion->prepare($sql);
    $reponse=$req->execute(array('id'=>$id));
    $resultat=$req->fetch();
    if(!$resultat){
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=offreemploi');
        alert('Impossible de mettre à jour, l'offre est inconnue !');
                    </script>"; 
                }else{

                    $sql='SELECT * FROM nortech.annonce where noAnnonce=:id';
                    $req=$connexion->prepare($sql);
                    $reponse=$req->execute(array('id'=>$noannonce));
                    $resultat=$req->fetch();
                    if(!$resultat){
                        echo "<script type='text/javascript'>document.location.replace('update.php?section=offreemploi&id=".$id."');
                                alert('Vous ne pouvez pas prendre ce numéro d'offre !');
                                </script>";
                    }else{
            
                    $sql="UPDATE nortech.annonce SET titre=:titre,service=:serv,dateAnnonce=:dat,ville=:ville,description=:descrip WHERE noAnnonce=:id";
               
                    
                    $req=$connexion->prepare($sql);
                    $reponse=$req->execute(array('titre'=>$titre,'serv'=>$serv,'dat'=>$dat,'ville'=>$ville,  'descrip'=>$descrip,'id'=>$noannonce));
                
                        if(!$reponse){
                            echo "<script type='text/javascript'>document.location.replace('update.php?section=offre&noffre=24');
                                    alert('la mise a jour de l\'annonce a échoué ! Veuillez vérifier vos saisies.');
                                    </script>";
                        }else{

                            echo "<script type='text/javascript'>document.location.replace('redirection.php?section=offreemploi');
                                    alert('Annonce mise a jour avec succès !');
                                    </script>";
                                    /*var_dump($id);
                                    var_dump($noannonce);
                                    var_dump($titre);
                                    var_dump($serv);
                                    var_dump($dat);
                                    var_dump($ville);
                                    var_dump($descrip);*/
                        }
                        
                    }
                }
}
else{
    echo " <script type='text/javascript'> 
    //document.location.replace('redirection.php');
    alert('Cette action est interdite !!! ');
</script>";
}







echo "----------------------------------------------<br>";
echo '  <a href="redirection.php">Accueil</a>';

?>
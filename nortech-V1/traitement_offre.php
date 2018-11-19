<?php
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
if($resultat){
	echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                alert('Identifiant déja utilisé par un autre utilisateur !');
                </script>";
}else{
$sql="INSERT INTO nortech.annonce(`titre`,`service`, `dateAnnonce`,`ville`, `description`) VALUES ('{$id}','{$serv}','{$dat}','{$ville}','{$descrip}')";
$req=$connexion->query($sql);
//$reponse=$req->execute(array('id'=>$titre,'service'=>$serv,'dat'=>$dat,'ville'=>$ville,  'descrip'=>$descrip));

if(/*!$reponse*/!$req){
    echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                    alert('l\'enregistrement de l\'annonce2 a échoué ! Veuillez vérifier vos saisies.');
                    </script>";
        }else{
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                    alert('Annonce enregistrée avec succès !');
                    </script>";
}
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
                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                            alert('La suppression de cet utilisateur a échoué!');
                            </script>";
                }else{
            
                    echo "<script type='text/javascript'>document.location.replace('redirection.php?section=".$section."');
                            alert('Utilisateur supprimé avec succè!');
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
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=Offre_d_emploi');
        alert('Impossible de mettre à jour l'offre inconnu !');
                    </script>"; 
                }else{

                    $sql='SELECT * FROM nortech.annonce where noAnnonce=:id';
                    $req=$connexion->prepare($sql);
                    $reponse=$req->execute(array('id'=>$noannonce));
                    $resultat=$req->fetch();
                    if(!$resultat){
                        echo "<script type='text/javascript'>document.location.replace('update.php?section=Offre_d_emploi&id=".$id."');
                                alert('Vous ne pouvez prendre cet N°offre !');
                                </script>";
                    }else{
            
                    $sql="UPDATE nortech.annonce SET titre='{$titre}',service='{$serv}',dateAnnonce='{$dat}',ville='{$ville}',description='{$descrip}' WHERE `noAnnonce`={$id}";
               
                    
                    $reponse=$connexion->query($sql);
                
                        if(!$reponse){
                            echo "<script type='text/javascript'>document.location.replace('redirection.php?section=Offre_d_emploi');
                                    alert('la mise a jour de l\'annonce2 a échoué ! Veuillez vérifier vos saisies.');
                                    </script>";
                        }else{
                            echo "<script type='text/javascript'>document.location.replace('redirection.php?section=Offre_d_emploi');
                                    alert('Annonce mise a jour avec succès !');
                                    </script>";
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
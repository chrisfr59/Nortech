<?php
//
include('db_connect.php');

//-- --------------------------------------------------------

/*Ajouter Utilisateur */

//-- --------------------------------------------------------
if($action=='ajouter'){
    $id=$_POST['id_user'];
    $mp=$_POST['mp_user'];
    $droits=$_POST['dr'];
    $mpc=$_POST['mpc_user'];
    /*vérification de 2 champs qui doivent etres identique  */
    if($mp != $mpc){
        echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
             alert('Veuiller saisir un mot de passe identique!!!');</script>";
    }else{
    //declaration e la requete sql avec parametre
        $sql="SELECT * from utilisateur where  identifiant=:id ";
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$id));

    //enregistrement des valeur retourner par la req ds  $result
        $result=$req->fetch();//fetch() pointer sur la 1er ligne du resultats
        if($result){
            echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
             alert('Identifiant déjà existant!!');</script>";
             
        }
        else{
            echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
            alert('Enregistrement effectué avec succès!!');</script>";

        //insertion des données
        $sql='INSERT INTO utilisateur (identifiant, motPasse,droits) VALUES (:id,:mp,:dr)';
        $req=$connexion->prepare($sql);
        $reponse=$req->execute(array('id'=>$id,'mp'=>$mp,'dr'=>$droits));
    
        }if(!$reponse){
            echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
             alert('l\'enregistrement de l\'utilisateur a echoué!!!');</script>";
        }else{
           console.log();
        }  
    }
 }
 
 //-- --------------------------------------------------------

/*Supprimer Utilisateur*/

//-- --------------------------------------------------------
else if($action=='supprimer'){
    @$id=$_GET['id'];
    //$id=$_POST['id_user'];
    $sql='select * from utilisateur where  identifiant=:id';
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$id));

        $result=$req->fetch();//fetch() pointer sur la 1er ligne du resultats
       if(!$result){
            echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
             alert(' Utilisateur n\'existe pas ds la bdd !!');</script>";
             
        }else{
            
            $sql='DELETE FROM utilisateur WHERE  identifiant=:id';
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$id));

        //$result=$req->fetch();//fetch() pointer sur la 1er ligne du resultats
       if(!$reponse){
            echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
             alert('la supression a echouée !!');</script>";
             
        }else{
            
            echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
            alert('Utilisateur supprimé avec succès !!');</script>";
        }
        }
}
//-- --------------------------------------------------------

/*Modifier Utilisateur */

//-- --------------------------------------------------------


else if($action=='update'){

    @$id=$_GET['id'];
    @$user=$_POST['id_user'];
    @$droits=$_POST['droits'];
    @$droitsM=$_POST['droitsM'];

        $sql="SELECT * FROM utilisateur WHERE  identifiant=:id ";
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$id));
       //enregistrement des valeur retourner par la req ds  $result
        $result=$req->fetch();
    if(!$result){
            echo"<script type='text/javascript'>document.location.replace('index.php?section=".$section."');
             alert('impossible de mettre à jour un utilisateur inconu!!');</script>";
        }else{
            $sql='select * from utilisateur where  identifiant=:id';
            //preparation de la rqt sql on utilisant la variable $connexion
            $req=$connexion->prepare($sql);
            //execution de la rqt avec eregistrement de resulat de la variable $reponse
            $reponse=$req->execute(array('id'=>$user));
           //enregistrement des valeur retourner par la req ds  $result
            $result=$req->fetch();
        }if($result){
                echo"<script type='text/javascript'>document.location.replace('updateUser.php?section=".$section."&id=".$id."');
                 alert('cette identifiant existe déjà!!');</script>";
            }else{
            $sql='UPDATE utilisateur SET droits=:droitsM WHERE identifiant=:id';
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$id,'droitsM'=>$droitsM));

        //$result=$req->fetch();//fetch() pointer sur la 1er ligne du resultats
       if(!$reponse){
            echo"<script type='text/javascript'>document.location.replace('index.php?section=".$section."');
             alert('la modification à echouer !!');</script>";
             
        }else{
            
            echo"<script type='text/javascript'>document.location.replace('user.php?section=".$section."');
            alert('Utilisateur modifier avec succé !!');</script>";
        }
        }
}

//-- --------------------------------------------------------

/*Modifier Mot de Pässe */

//-- --------------------------------------------------------

else if($action=='update1'){

    @$ide=$_GET['id'];
    @$userr=$_POST['id_user'];
    @$mp=$_POST['mp'];
    @$mpc=$_POST['mpc'];
    //echo $user.'<br>'.$mp.'<br>'.$mpc.'<br>';
    
    //inspecter lles valeur de la variable $_POST
    /*vardump ($_POST);*/
    
    /*vérification de 2 champs qui doivent etres identique  */
    
    //if($mp != $mpc){
        //echo"<script type='text/javascript'>document.location.replace('update_user.php?section=".$section."&id=".$id."');
         //    alert('Veuiller saisir un mot de passe identique!!!');</script>";
   // }else{
        $sql="SELECT * FROM utilisateur WHERE  identifiant=:id ";
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$ide));
       //enregistrement des valeur retourner par la req ds  $result
        $result=$req->fetch();
    //}
    if(!$result){
            echo"<script type='text/javascript'>document.location.replace('login.php?section=".$section."');
             alert('impossible de mettre à jour un utilisateur inconu!!');</script>";
        }else{
            $sql='select * from utilisateur where  identifiant=:id';
            //preparation de la rqt sql on utilisant la variable $connexion
            $req=$connexion->prepare($sql);
            //execution de la rqt avec eregistrement de resulat de la variable $reponse
            $reponse=$req->execute(array('id'=>$userr));
           //enregistrement des valeur retourner par la req ds  $result
            $result=$req->fetch();
        }if($result){
                echo"<script type='text/javascript'>document.location.replace('updateUser.php?section=".$section."&id=".$ide."');
                 alert('cette identifiant existe déjà!!');</script>";
            }else{
                $sql='UPDATE utilisateur SET motPasse=:mp WHERE identifiant=:id';
        //preparation de la rqt sql on utilisant la variable $connexion
        $req=$connexion->prepare($sql);
        //execution de la rqt avec eregistrement de resulat de la variable $reponse
        $reponse=$req->execute(array('id'=>$ide,'mp'=>$mp));

        //$result=$req->fetch();//fetch() pointer sur la 1er ligne du resultats
       if(!$reponse){
            echo"<script type='text/javascript'>document.location.replace('login.php?section=".$section."');
             alert('la modification à echouer !!');</script>";
             
        }else{
            
            echo"<script type='text/javascript'>document.location.replace('login.php?section=".$section."');
            alert('Utilisateur modifier avec succé !!');</script>";
        }
        }
}

        
       


?>

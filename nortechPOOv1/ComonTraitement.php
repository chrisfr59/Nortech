<?php 
//La classe finale aucune classe ne pt etre ériver de celle ci 
final class ComonTraitement{

    public static function createNoEmp($noServ){
        $connexion= new PDO ('mysql:host=localhost;dbname=nortechc','root','');
        $sql="select max(noEmp) from employe where noServ = $noServ";
        $req=$connexion->query($sql);
        $reponse=$req->fetch();
        if($reponse['max(noEmp)']==0){
            $noEmp=$noServ.'000';
        }
        else{
            $noEmp=$reponse['max(noEmp)'];
            $noEmp++;
        }
        return $noEmp;
    }
    public static function CreateEmail($nom,$prenom,$noemp){
        $email=$nom.'.'.$prenom.'.' .$noemp.'@nortech.com';
        return $email; 
        
    }

    public static function insertEmploye($noemp, $nom, $prenom, $naissance, $tel, $adresse, $email, $embauche, $fonction, $noserv){
        
        /*Connexion à la base de données  */
$connexion= new PDO("mysql:host=localhost;dbname=nortechc","root","");

/*test de connexion à la base de données */
try{
$connexion= new PDO("mysql:host=localhost;dbname=nortechc","root","");
}catch(PDOException $e){
    echo "Erreur!:".$e->getMessage()."<br/>";
    echo"<script type='text/javascript'>document.location.replace('index.php');
    alert('erreur de connexion à la base de donnees!!!');</script>";
   /* die();*/
}
        $sql="INSERT INTO employe(noEmp, nom, prenom, fonction, sup, sal, comm, naissance, tel, mail, prime, embauche, depense, identifiant, noServ, active)
         VALUES ('$noemp','$nom','$prenom','$fonction','','','','$naissance','$tel','$email','','$embauche','','','$noserv','')";
        $requete=$connexion->prepare($sql);
        $reponse=$requete->execute(array(
        'noEmp'=>$noemp,
        'nom'=>$nom,
        'prenom'=>$prenom,
        'fonction'=>$fonction,
        'sup'=>'',
        'sal'=>'',
        'comm'=>'',
        'naissance'=>$naissance,
        'tel'=>$tel,
        'mail'=>$email,
        'prime'=>'',
        'embauche'=>$embauche,
        'depense'=>'',
        'identifiant'=>'',
        'noServ'=>$noserv,
        'active'=>'',

    ));
    
if(!$reponse){
    echo"<script type='text/javascript'>
    alert('l\'enregistrement de l\'utilisateur a echoué!!!');</script>";
}else{
   echo 'ok';
}  

}

}

?>
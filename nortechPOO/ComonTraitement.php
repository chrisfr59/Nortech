<?php 
//La classe finale aucune classe ne pt etre ériver de celle ci 
final class ComonTraitement{

    public static function createNoEmp($noServ){
        $connexion= new PDO ('mysql:host=localhost;dbname=nortech','root','');
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
}

?>
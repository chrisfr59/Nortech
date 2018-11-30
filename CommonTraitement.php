<?php
final class CommonTraitement{
    
    /**
    *   Création du numéro d'employé 
    *   Paramètre d'entrée : $noServ
    *   Récupération du dernière employé du service $noServ
    *   Incrémentation du résultat de la requête pour création du $noEmp
    *   Si le service ne contient pas d'employé, alors set de la valeur de base à : $noServ suivit de 3 "0"
    *   Retour du $noEmp
    **/
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

    /**
    *   Création du mail de l'employé 
    *   Paramètre d'entrée : $nom, $prenom, $noemp
    *   Concaténation de $nom,$prenom et $noemp avec un point "." comme sépartateur
    *   et suivit de "@nortech.com"
    *   Retour de $mail
    **/
    public static function CreateEmail($nom,$prenom,$noemp){
        $email=$nom.'.'.$prenom.'.' .$noemp.'@nortech.com';
        return $email;    
    }

    public static function createNoService(){

    }
}
?>
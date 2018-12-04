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
    public static function createMail($nom, $prenom, $noemp, $EmailType){
        $newEmail = new Email ($nom, $prenom, $noemp, $EmailType);
        return $newEmail->getEmail();    
    }


    /*
    *Insertion d'un employé en BDD
    *
    *
    */
    public static function insertEmp(Employe $newEmp){
        $connexion= new PDO ('mysql:host=localhost;dbname=nortech','root','');
        $sql="INSERT INTO nortech.employe VALUES(".$newEmp->getNoEmp().",'".$newEmp->getNom()."','".$newEmp->getPrenom()."','".$newEmp->getFonction()."',".$newEmp->getSup().",".$newEmp->getSal().",".$newEmp->getComm().",'".$newEmp->getNaiss()."','".$newEmp->getTel()."','".$newEmp->getMail()."',".$newEmp->getPrime().",'".$newEmp->getEmbauche()."',".$newEmp->getDepense().",".$newEmp->getNoServ().",".$newEmp->getActive().")"; 
        $req=$connexion->query($sql);

        //return $sql;
    }


    public static function createUserAccount(Employe $newEmp){
        $connexion= new PDO ('mysql:host=localhost;dbname=nortech','root','');
        $sql="INSERT INTO utilisateur (identifiant, motPasse,droits, noEmp) VALUES ('".$newEmp->getMail()."', '".$newEmp->getDefaultPwd()."',0, ".$newEmp->getNoEmp().")";
         $req=$connexion->query($sql);
    }
}
?>
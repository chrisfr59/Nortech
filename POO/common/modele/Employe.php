<?php
class Employe extends User{
    //Attributs
    private $noemp;
    private $sal;
    private $comm;
    private $prime;
    private $embauche;
    private $depense;
    
    //constructeur 
    public function __construct($nom,$prenom,$adresse,$naiss,$tel,$embauche,$noServ,$fonction){
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->naiss=$naiss;
        $this->tel=$tel;
        $this->adresse=$adresse;
        $this->embauche=$embauche;
        $this->fonction=$fonction;
        $this->noServ=$noServ;
        $this->sup='null';
        $this->sal='null';
        $this->comm='null';
        $this->prime='null';
        $this->depense='null';
        $this->active=1;
    }
    //setter
    public function setNoemp($noemp){
        $this ->noemp = $noemp;
    }
    public function setNom($nom){
        $this ->nom = $nom;
    }
    public function setPrenom($prenom){
        $this ->prenom = $prenom;
    }
    public function setnais($naiss){
        $this ->naiss = $naiss;
    }
    public function settel($tel){
        $this ->tel = $tel;
    }
    public function setmail($email){
        $this ->mail = $email;
    }
    public function setFonction($fonction){
        $this ->fonction = $fonction;
    }
    public function setSup($sup){
        $this ->sup = $sup;
    }
    public function setnoServ($noServ){
        $this ->noServ = $noServ;
    }
    public function setComm($comm){
        $this ->comm = $comm;
    }

    public function setPrime($prime){
        $this ->prime = $prime;
    }
    public function setEmbauche($embauche){
        $this ->embauche = $embauche;
    }
    public function setDepense($depense){
        $this ->depense = $depense;
    }
   
    //getter 
    public function getNoEmp(){
       return $this ->noemp;
    }
    public function getComm(){
        return $this ->comm;
    }
    
    public function getSal(){
        return $this->sal;
    }

    public function getPrime(){
        return $this ->prime;
    }
    public function getEmbauche(){
        return $this ->embauche;
    }
    public function getDepense(){
        return $this ->depense;
    }
    
    public function getNom(){
        return $this ->nom;
    }
    public function getPrenom(){
        return $this ->prenom;
    }
    public function getFonction(){
        return $this ->fonction;
    }
    public function getSup(){
        return $this ->sup;
    }
    public function getNaiss(){
        return $this ->naiss;
    }
    public function getTel(){
        return $this ->tel;
    }
    public function getMail(){
        return $this ->mail;
    }
    public function getNoServ(){
        return $this ->noServ;
    }
    public function getActive(){
        return $this ->active;
    }
    public function getAdresse(){
        return $this ->adresse;
    }

    //Methodes
    public function Ajouter(){

    }
    public function Modifier(){
        
    }
    public function Supprimer(){
        
    }
    public function chercher(){
        
    }

}

?>
<?php 
class user{

    //Attributs
    protected $idUser,$mdp,$droits,$nom,$prenom,$naiss,$tel,$mail,$fonction,$sup,$noserv,$active,$adresse;
    
    

    //constructeur
    public function __construct($idUser,$mdp,$droits,$nom,$prenom,$naiss,$tel,$mail,$fonction,$sup,$noserv,$active, $adresse){
        $this->idUser= $idUser;
        $this->mdp= $mdp;
        $this->droits= $droits;
        $this->nom= $nom;
        $this->prenom= $prenom;
        $this->mail= $mail;
        $this->fonction= $fonction;
        $this->sup= $sup;
        $this->noserv= $noserv;
        $this->active= $active;
        $this->adresse=$adresse;
    }
    //setters
    public function setidUser($idUser){
        $this ->idUser = $idUser;
    }
    public function setmdp($mdp){
        $this ->mdp = $mdp;
    }
    public function setdroits($droits){
        $this ->droits = $droits;
    }
    public function setNom($nom){
        $this ->nom = $nom;
    }
    public function setPrenom($prenom){
        $this ->prenom = $prenom;
    }
    public function setnaiss($naiss){
        $this ->naiss = $naiss;
    }
    public function settel($tel){
        $this ->tel = $tel;
    }
    public function setmail($mail){
        $this ->mail = $mail;
    }
    public function setFonction($fonction){
        $this ->fonction = $fonction;
    }
    public function setSup($sup){
        $this ->sup = $sup;
    }
    public function setNoserv($noserv){
        $this ->noserv = $noserv;
    }
    public function setActive($active){
        $this ->active = $active;
    }
    public function setAdresse($adresse){
        $this ->adresse = $adresse;
    }    
    //getters
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
    public function getNoserv(){
        return $this ->noserv;
    }
    public function getActive(){
        return $this ->active;
    }
    public function getAdresse(){
        return $this ->adresse;
    }
}

//$user1 = new user(1,12356,"rh","dfgh","gghj","12/12/1980","0606060606","hhhh@hh.com","directeur",1000,1,1);

?>
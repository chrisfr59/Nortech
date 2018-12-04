<?php 
class User{

    //Attributs
    protected $idUser,$mdp,$droits,$nom,$prenom,$naiss,$tel,$mail,$fonction,$sup,$noServ,$active,$adresse;
    
    const DEFAULT_PWD = "NORTECH";

    //constructeur
    public function __construct($idUser,$mdp,$droits,$nom,$prenom,$naiss,$tel,$mail,$fonction,$sup,$noServ,$active, $adresse){
        $this->idUser= $idUser;
        $this->mdp= $mdp;
        $this->droits= $droits;
        $this->nom= $nom;
        $this->prenom= $prenom;
        $this->mail= $mail;
        $this->fonction= $fonction;
        $this->sup= $sup;
        $this->noServ= $noServ;
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
    public function setnoServ($noServ){
        $this ->noServ = $noServ;
    }
    public function setActive($active){
        $this ->active = $active;
    }
    public function setAdresse($adresse){
        $this ->adresse = $adresse;
    }    
    //getters
    
    public function getDefaultPwd(){
            return User::DEFAULT_PWD;

        }
    }    



?>
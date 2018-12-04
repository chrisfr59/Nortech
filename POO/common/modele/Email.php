<?php 
class Email{

    //Attributs
    private $nom;
    private $prenom;
    private $noEmp;
    private $EmailType;

    //constantes
    const external = "@external.nortech.com"; //1
    const internal = "@nortech.com"; //0
    
    

    //constructeur
    public function __construct($nom,$prenom,$noEmp, $EmailType){
        $this->nom= $nom;
        $this->prenom= $prenom;
        $this->noEmp= $noEmp;
        $this->EmailType= $EmailType;
    }

    //setters

    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function setNoEmp($noEmp){
        $this->noEmp = $noEmp;
    }
    public function setType($EmailType){
        $this->EmailType = $EmailType;
    }

    //getters

    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getNoEmp(){
        return $this->noEmp;
    }
    public function getType(){
        return $this->EmailType;
    }

    public function getEmail(){
        if($this->EmailType==0){
            return $this->nom.'.'.$this->prenom.'.' .$this->noEmp.Email::internal;
        }else
        {
            return $this->nom.'.'.$this->prenom.'.' .$this->noEmp.Email::external;
        }
    }    

}



?>
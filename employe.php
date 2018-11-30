<?php
require_once 'user.php';
class employe extends user{
    //Attributs
    private $noemp;
    private $sal;
    private $comm;
    private $prime;
    private $embauche;
    private $depense;
    
    //constructeur 
    public function __construct($nom,$prenom,$naiss,$tel,$adresse,$embauche,$fonction,$noserv){
        //$this->noemp=$noemp;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->naiss=$naiss;
        $this->tel=$tel;
        $this->adresse=$adresse;
        $this->embauche=$embauche;
        $this->fonction=$fonction;
        $this->noserv=$noserv;
        //$this->sup=$sup;
        //$this->sal=$sal;
        
        //$this->comm=$comm;
        
        
        //$this->mail=$mail;
        //$this->prime=$prime;
        
        
        //$this->depense=$depense;
        
        //$this->active=$active;
        
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
    public function getNoemp(){
       return $this ->noemp;
    }
    public function getComm(){
        return $this ->comm;
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
    

    //Methodes
    public function Ajouter(){

    }
    public function Modifier(){
        
    }
    public function Supprimer(){
        
    }
    public function chercher(){
        
    }
    public function Afficher(){
        echo "Noemp :" .$this->noemp ."<br>";
        echo "Noemp :" .$this->sal ."<br>";
        echo "Noemp :" .$this->comm ."<br>";
        echo "Noemp :" .$this->prime ."<br>";
        echo "Noemp :" .$this->embauche ."<br>";
        echo "Noemp :" .$this->depense ."<br>";
    }
}
//$employe0 = new employe(1,12356,"rh","dfgh","gghj","12/12/1980","0606060606","hhhh@hh.com","directeur",1000,1,1,"","","");

//ComonTraitement::CreateEmail($employe0->nom,$employe0->prenom,$employe0->neomp);
//var_dump($employe0);

//$employe1->Afficher();
?>
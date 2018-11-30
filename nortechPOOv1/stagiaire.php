<?php
require_once 'user.php';
class stagiaire{
    //attribut
    private $nStg,$remuni,$periode;

    //constructeur
    public function __construct($nStg,$remuni,$periode,$nom,$prenom,$naiss){
        $this->nStg=$nStg;
        $this->remuni=$remuni;
        $this->periode=$periode;
    }
    //setter
    public function setnStg($nStg){
        $this ->nStg = $nStg;
    }
   
    public function setremuni($remuni){
        $this ->remuni = $remuni;
    }
 
    public function setperiode($periode){
        $this ->periode = $periode;
    }
    //getter 
    public function getnStg(){
        return $this ->nStg;
     }
     public function getremuni(){
         return $this ->remuni;
     }
     
     public function getperiode(){
         return $this ->periode;
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
        echo "Noemp :" .$this->nStg ."<br>";
        echo "Noemp :" .$this->remuni ."<br>";
        echo "Noemp :" .$this->periode ."<br>";
        echo "Noemp :" .$this->nom ."<br>";
        echo "Noemp :" .$this->prenom ."<br>";
        echo "Noemp :" .$this->naiss ."<br>";
    }
}

//$Stg1=new stagiaire(1,500,"10/20/2018","jhgjhg","jhgjhg","10/30/1992");
//var_dump($Stg1);
?>

<link href="css/perso.css" rel="stylesheet">

     <header>
     
  
     <img id="logo" src="img/nortechLogo.svg" alt="Logo">

     <h1>
       Bienvenue sur le site de <span class="letter" >Nor</span>tech
     </h1>
     <div class="connexion">   
     <button id="button" class="btn btn-success" type="submit" ><a class="connecter" href="login.php">Se connecter</a></button>
     <button id="button"><a class="connecter" href="index.html">Accueil</a></button>
     </div>
 </header> 

    <div class='recherche'>
        <h1>Recherche</h1>

        <form method="GET" action="">
            <input type="search" name="terme" />
            <input type="submit" name="s" value="Rechercher" />


    </div><br><br>
<?php
include('db_connect.php');

 try
 {
     echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>";
  $connexion = new PDO('mysql:host=localhost;dbname=nortech','root','');
  
 }
 catch(Exception $e)
 {
   die("Une erreur a été trouvée : " . $e->getMessage());
 }

 $connexion->query("SET NAMES UTF-8");
 
 if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
 {
        $_GET["terme"] = htmlentities($_GET["terme"]); //htmlspecialchars
        
        $terme = $_GET["terme"];
        $terme = trim($terme);
        $terme = strip_tags($terme);              
 
if (isset($terme)){
      
        $terme = strtolower($terme);
        $mots = explode(' ',$terme);//En separre lexpression en mots cles
    foreach($mots as $mot) {   
        $select_terme = $connexion->prepare('SELECT * from nortech.annonce where titre like "%'.$mot.'%" or description like "%'.$mot.'%" or ville like "%'.$mot.'%" order by dateAnnonce');
        $select_terme->execute(array("%".$terme."%","%".$terme."%"));
    }
}else{
        $message = "Vous devez entrer votre requete dans la barre de recherche";
}
}
?>
<!DOCTYPE html>
<html>

<body>
    <?php
  if(isset($terme)){

  while($terme_trouve = $select_terme->fetch()){
   

    if($terme){
        echo preg_replace('#('.str_replace(' ','|',preg_quote($terme)).')#i', '<mark><u><strong>$1</strong></u></mark>', $terme_trouve['titre']);
        //echo "<div><h2>".$terme_trouve['titre']."</h2>";
        echo "<h4>Service :  ".$terme_trouve['service']."</h4>";
        echo "<h4>Date :  ".$terme_trouve['dateAnnonce']."</h4>";
        echo "<h4>Ville:  ".$terme_trouve['ville']."</h4>";
        echo '<h4 class="entreprise"> Entreprise : </h4>
           <td ><div>
           Rejoignez les équipes de Nortech pour concevoir et intégrer les solutions innovantes de demain. <br><br>
           Nous accompagnons au quotidien les entreprises et les organisations dans leurs enjeux de transformation industrielle et digitale.<br> Notre ambition : le faire avec vous.

            Parce que l’humain est au cœur de notre stratégie, nous pouvons offrir à chacun un cadre professionnel stimulant, <br>collaboratif et ouvert sur l\'avenir.<br><br>

            Parce que votre talent mérite notre engagement, Créons ensemble la différence !
            </div></td><br><br>';
        //echo "<p> ".$terme_trouve['description']."</p>";
        echo preg_replace('#('.str_replace(' ','|',preg_quote($terme)).')#i', '<mark><u><strong>$1</strong></u></mark>', $terme_trouve['description']);//On surligne les mots cles de la recherche
        echo '<br><br><a href="postuler_ext.php?section=Offre_d_emploi"><input id="postuler" type="button" value="Postuler"></a><br><br>';
    }else{
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=Offreemploi');
                alert('Veuillez saisir quelque chose dans la barre de recherche !');
                </script>";
  }
}
  $select_terme->closeCursor();
}
  
 
   ?>

    


    <?php include('footer.php');?>
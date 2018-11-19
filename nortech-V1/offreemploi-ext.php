<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="offre.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="css/emploi.css" />
    

    <title>Document</title>
</head>


<body>

    <header>
     
  
     <img id="logo" src="img/nortechLogo.svg" alt="Logo">

     <h1>
       Bienvenue sur le site de <span class="letter" >Nor</span>tech
     </h1>   
     <button id="button" class="btn btn-success" type="submit" ><a  class="connecter" href="login.php">Se connecter</a></button>
     <button id="button"><a href="deconnexion.php">Déconnexion</a></button>
      <nav>
        <ul>
          <li>Emploi</li>
          <li>Acceuil</li>
        </ul>
      </nav>
 </header> 


    <div class="formulaire">
    <h2>Recherche</h2>
        <div class="recherche">
            
            <div class='motcle'>
                <label for="motcle">Mot-clés</label><br>
                <input type="search" name="motcle" id="motcle" required />
            </div><br>
           
            <div class="btn_recherche">
            <input class= "button1" type="submit" value="Rechercher" />
            <input class= "button1" type="reset" value="annuler" />
            </div>
        </div><br><br>       

        
    </div>
    <?php
    $connexion = new PDO('mysql:host=localhost;dbname=nortech','Dev','www');
      $sql='SELECT * FROM nortech.annonce';
      // préparation de la requête SQL en utilisant la variable $connexion
      $req=$connexion->prepare($sql);
      //execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
      $reponse=$req->execute(array());
        
        $nume=$reponse+1;
        $annonce='annonce';
        $numannonce=1;
        while($resultat=$req->fetch()){
            echo '<div class="offre"';
            echo '<tr>';
            echo '<td ><h5>Offre N° '.$resultat['noAnnonce'].'</h5><h2 class="titre">'.$resultat['titre'].'</h2><h5>Service : </h5>'.$resultat['service'].'</td><br>
            <h5 class="date">Date :</h5> 
            <td class="date">'.$resultat['dateAnnonce'].'</td><br>
            <h5 class="ville">Ville :</h5>
            <td class="ville">'.$resultat['ville'].'</td><br>
           <h5 class="entreprise"> Entreprise : </h5>
           <td ><div>
           Rejoignez les équipes de Nortech pour concevoir et intégrer les solutions innovantes de demain. <br><br>
           Nous accompagnons au quotidien les entreprises et les organisations dans leurs enjeux de transformation industrielle et digitale.<br> Notre ambition : le faire avec vous.

Parce que l’humain est au cœur de notre stratégie, nous pouvons offrir à chacun un cadre professionnel stimulant, <br>collaboratif et ouvert sur l\'avenir.<br><br>

Parce que votre talent mérite notre engagement, Créons ensemble la différence !
       </div></td><br><br>';
            echo '<button id="plus" title="Afficher le div" onclick="afficher_div_masque(',$numannonce,')">Plus d\'infos</button>
            <div id="',$numannonce,'"style="display:none;"><br> ';
            echo '<td><br><h5 class="entreprise">Description : </h5>',$resultat['description'],'</td></div>';
            echo '</tr><br><br>';
            echo '<a href="postuler.php?section=Offre_d_emploi"><input id="postuler" type="button" value="Postuler"></a>';
            echo '</div><br>';
            $numannonce++;
        }
        
    ?>
  


<?php
include('footer.php');
?>
<script type="text/javascript" src="nortechcommon.js"></script>
</body>

</html>








    
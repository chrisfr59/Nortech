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
  <link rel="stylesheet" type="text/css" media="screen" href="offre.css" />
    

    <title>Document</title>
</head>


<body>
    <?php
        include('header.php');
    ?>
     


    <div class=formulaire>

        <div class='recherche'>
            <h1>Recherche</h1>
        <form method ="GET" action="recherche.php">                                  
            <input type="search" name="terme" />                                  
            <input type= "submit" name="s" value="Rechercher"/>                          
        </form>
           

            <div class='Ville' >
                <h4>Choix de la ville</h4>
                <select name="noserv" id="noserv" >
                    <option value="">--Choisire la Ville--</option>
                    <option value="1">PARIS</option>
                    <option value="2">SECLIN</option>
                    <option value="3">ROUBAIX</option>
                    <option value="4">VILLENEUVE D'ASCQ</option>
                    <option value="5">LILLE</option>
                    <option value="6">ROUBAIX</option>

                </select>
            </div><br><br>

            <div class='service'>
                
                <h4>Choix du service</h4>
                <input type="checkbox" name="vehicle1" value="Direction"> Direction <br>
                <input type="checkbox" name="vehicle1" value="Logistique"> Logistique <br>
                <input type="checkbox" name="vehicle1" value="Vente"> Ventes <br>
                <input type="checkbox" name="vehicle1" value="Formation"> Formation <br>
                <input type="checkbox" name="vehicle1" value="Informatique"> Informatique <br>
                <input type="checkbox" name="vehicle1" value="Comptabilite"> Comptabilite <br>
                <input type="checkbox" name="vehicle1" value="Technique"> Technique <br>
            </div><br><br>

            

            <input type="submit" value="OK" />
            <input type="reset" value="annuler" />
        </div><br><br>
        
        <a  href="ajouter_annonce.php?section=offre"><input id="ajouter" type="button" value="Ajouter une offre d'emploi"></a><br><br>
        <a  href="supprimer_annonce.php?section=offre"><input id="supprimer" type="button" value="Supprimer une offre d'emploi"></a>
        

        
    </div>
    <?php

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
            echo '<td ><h4>Offre N° '.$resultat['noAnnonce'].'</h4><h1 class="titre">'.$resultat['titre'].'</h1><h4>Service : </h4>'.$resultat['service'].'</td><br>
            <h4 class="date">Date :</h4> 
            <td class="date">'.$resultat['dateAnnonce'].'</td><br>
            <h4 class="ville">Ville :</h4>
            <td class="ville">'.$resultat['ville'].'</td><br>
           <h4 class="entreprise"> Entreprise : </h4>
           <td ><div>
           Rejoignez les équipes de Nortech pour concevoir et intégrer les solutions innovantes de demain. <br><br>
           Nous accompagnons au quotidien les entreprises et les organisations dans leurs enjeux de transformation industrielle et digitale.<br> Notre ambition : le faire avec vous.

Parce que l’humain est au cœur de notre stratégie, nous pouvons offrir à chacun un cadre professionnel stimulant, <br>collaboratif et ouvert sur l\'avenir.<br><br>

Parce que votre talent mérite notre engagement, Créons ensemble la différence !
       </div></td><br><br>';
            echo '<button id="plus" title="Afficher le div" onclick="afficher_div_masque(',$numannonce,')" style="text-align: center; font-weight: bold;">Plus d\'infos</button>
            <div id="',$numannonce,'"style="display:none;"><br> ';
            echo '<td><br><h4 class="entreprise">Description : </h4>',$resultat['description'],'</td></div>';
            echo '</tr><br><br>';
            echo '<a href="postuler.php?section=Offre_d_emploi"><input id="postuler" type="button" value="Postuler"></a>';
            echo '<a href="update.php?section=offre&noffre='.$resultat['noAnnonce'].'"><input id="modifier" type="button" value="Moddifier une offre d\'emploi" ></a>';
            echo '</div><br>';
            $numannonce++;
        }
        
    ?>
  



<script type="text/javascript" src="nortechcommon.js"></script>
</body>

</html>








    
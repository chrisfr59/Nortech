<?php include('header.php');?>

<!---------------------------------------------------------------------------->
<?php
 try
 {
     echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>";
  $connexion = new PDO('mysql:host=localhost;dbname=nortech','Dev','www');
  
 }
 catch(Exception $e)
 {
   die("Une erreur a été trouvée : " . $e->getMessage());
 }
 $connexion->query("SET NAMES UTF8");
 


 if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
 {
    $_GET["terme"] = htmlspecialchars($_GET["terme"]); 
    $terme = $_GET["terme"];
     $terme = trim($terme);
     $terme = strip_tags($terme);
 
if (isset($terme)){
    $terme = strtolower($terme);
    $select_terme = $connexion->prepare("SELECT * from nortech.annonce where titre like ? or description like ?");
    $select_terme->execute(array("%".$terme."%","%".$terme."%"));
}else{
    $message = "Vous devez entrer votre requete dans la barre de recherche";
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Les résultats de recherche</title>

</head>

<body>
    <?php
  if(isset($terme)){


  while($terme_trouve = $select_terme->fetch()){
   
   /*$x=$terme_trouve['description'];
   $i=0;
   foreach($x as $terme_trouve){
       $x = str_ireplace($terme_trouve,'<span class="surlign">'.$terme_trouve.'</span>',$c);
   }*/
    if($terme){
        echo "<div><h2>".$terme_trouve['titre']."</h2>";
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
        echo "<p> ".$terme_trouve['description']."</p>";
    }else{
        echo "<script type='text/javascript'>document.location.replace('redirection.php?section=Offre_d_emploi');
                alert('Veuillez saisir quelque chose dans la barre de recherche !');
                </script>";
  }
}
  $select_terme->closeCursor();
}
  
 
   ?>

    <link href="offre.css" rel="stylesheet">
    <div class=formulaire>

        <div class='recherche'>
            <h1>Recherche</h1>


            <form method="GET" action="recherche.php">
                <input type="search" name="terme" />
                <input type="submit" name="s" value="Rechercher" />



                <div class='Ville'>
                    <h4>Choix de la ville</h4>
                    <select name="noserv" id="noserv" required>
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
                    <input type="checkbox" name="Direction" value="Direction"> Direction <br>
                    <input type="checkbox" name="Logistique" value="Logistique"> Logistique <br>
                    <input type="checkbox" name="Vente" value="Vente"> Ventes <br>
                    <input type="checkbox" name="Formation" value="Formation"> Formation <br>
                    <input type="checkbox" name="Informatique" value="Informatique"> Informatique <br>
                    <input type="checkbox" name="Comptabilite" value="Comptabilite"> Comptabilite <br>
                    <input type="checkbox" name="Technique" value="Technique"> Technique <br>
                </div><br><br>



                <input type="submit" value="OK" />
                <input type="reset" value="annuler" />
            </form>
        </div><br><br>

        <?php include('footer.php');?>
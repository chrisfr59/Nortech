<?php
/*if( !isset ($_GET['id'])){
    echo "<script type='text/javascript'>document.location.replace('index.php?section=employe');
       alert('id non trouvé!');
        </script>";
}*/

//$req="SELECT active FROM employe WHERE noemp='{$_GET['id']}'";
$req="update employe set active=0 where noEmp='{$_GET['id']}'";
header("location: redirection.php?section=employe");


try{
    $connexion= new PDO('mysql:host=localhost;dbname=nortech','root','');
    $test=$connexion->query($req);

}
catch (PDOException $e){
    print "Erreur!:".$e->getMessage().'<br>';
    echo "<script type='text/javascript'>document.location.replace('redirection.php?section=employe');
       alert('Erreur de connection à la base de données!');
        </script>";
}


$resultat=$test->fetch();
//echo "----".$resultat['active']."----";
?>
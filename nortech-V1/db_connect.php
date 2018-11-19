<?php
echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>";
$connexion= new PDO ('mysql:host=localhost;dbname=nortech','Dev','www');

/* //test de connexion à la base de données nortech
try{

$connexion= new PDO ('mysql:host=localhost;dbname=nortech','Dev1','www');
}catch  (PDOException $e){
print"Erreur !:". $e->getMessage()."<br />";
echo "<script type='text/javascript'>document.location.replace('index.php');
                alert('Erreur de connexion à la base de données!');
                </script>";
 
}



*/


?>
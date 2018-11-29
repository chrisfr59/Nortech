<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>mot de passe oublié</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/perso.css" />
    <script src="main.js"></script>
</head>
<body>

<?php
// envoi d'un email à webmaster@tutovisuel.com

//connexion à la bdd
include('db_connect.php');
$id=$_GET['modifmp'];
/*
1- appel au fichier de parametrage de la base de donée
*/

$headers = 'From: webmaster@example.com' . "\r\n" .
'Reply-To: webmaster@example.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();


$destinataires=$_GET["modifmp"];
/*
2- Lire (select) la base de donner pour voir si l'email $destinataire rentré exite bien, si non mettre un message de refus
*/
$sql='SELECT * FROM utilisateur';
// préparation de la requête SQL en utilisant la variable $connexion
$req=$connexion->prepare($sql);
//execution de la requête avec enregistrement des résultats dans la variable $reponse (boolean qui prend deux valeurs 1 pour execute=ok et 0 pour execute=ko)
$reponse=$req->execute(array());
 if(!$reponse){
     echo "ko";
 }else{
     //echo "ok";
 }   


$Sujet="mot de passe oublié";

// type de contenu HTML
$entetes = "Content-type: text/html; charset=utf-8\n";


$strNewPwd="http://localhost/nortech-V1.2/updateMP.php?section=user&id=$id";

$message = '<p><img src="img/nortechLogo.jpg" alt="" /> </p>
<P>Bonjour '.$_GET["modifmp"].'<p><br>

<p>Nous avons recu une demande de modification de mot de passe pour le compte associé à cette adresse mail. Veuillez cliquer sur lien ci dessous:
    <br><br>
 '.$strNewPwd.'

<p>Vous disposez d\'un délai de 24h pour modifier votre mot de passe .N\'oubliez pas de la changer à votre première connexion<br><br>

si vous n\'êtes pas à l\'origine de cette demande, ignorez cet e-mail, la sécurité de votre compte est préservée.<br><br>

A très bientot sur NORTECH.<p>';

mail($destinataires, $Sujet, $message, $entetes, $headers);
?>

<div><h1 class="title-page" >Mot de passe oublié</h1></div>
<img alt="mot de passe oublié" src="img/oublier-mot-de-pass.png">

<div class= " confirm renvoi mot de passe oublié">
    <p class='explication'>
    <strong>Un email vous a été envoyé à l'adresse <?php echo $_GET["modifmp"]; ?></strong><br>
    
    Vous y trouverez un lien pour réinitialiser votre mot de passe 
</p>

<p class='sous explication'>
<strong>Vous ne l'avez pas reçu ?</strong><br>
</p>    

<p class="sous-explication">
            1. Vérifiez votre dossier de courriers indésirables<br>
            2. Vous ne recevrez pas cet email si vous n'avez pas créé de compte 
        </p>
        <button type="button" class="btn btn-secondary btn-lg btn-block my-4"><a href="login.php">Retour</a></button>
</body>
</html>

<?php
if(isset($_GET["modifmp"])){
    $bouton=$_GET["modifmp"]; 
        echo '<script type="text/javascript">;
            alert("Votre demande a été prise en compte!");
            </script>';
}
?>
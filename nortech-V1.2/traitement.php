<?php
//appeler la connexion à la BDD
include('db_connect.php');
//récupération de l'action à faire : insertion/update ou delete
if(isset($_GET['action'])){
	$action=$_GET['action'];
}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Cette action est interdite !');
                </script>";
}



//récupération de la section : service/employé ou user
if(isset($_GET['section'])){
	$section=$_GET['section'];
}else{
	echo "<script type='text/javascript'>document.location.replace('redirection.php');
                alert('Cette est interdite !');
                </script>";
}


//appeler le bon fichier
if($section=='user'){
	include('traitement_user.php');
}else if($section=='employe'){
	include('traitement_emp.php');
}else if($section=='service'){
	include('traitement_serv.php');
}else if($section=='offre'){
	include('traitement_offre.php');
}else{//en cas de manipulation douteuse je redirige l'utilisateur vers redirection.php
	echo "<script type='text/javascript'>//document.location.replace('redirection.php');
                alert('Cette action est interdite2 !');
                </script>";
}
?>
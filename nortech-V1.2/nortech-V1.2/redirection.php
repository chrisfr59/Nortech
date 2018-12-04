<?php



if(isset($_GET['section'])){
$section=$_GET['section'];
}else{
$section='espace_perso';	
}

//récupération de la valeur $section renseignée dans URL
if($section=='espace_perso'){
	$mot='espace_perso';
	$fichier="espace_perso.php";
}else if($section=='service'){
	$mot='services';
	$fichier="service.php";	
}else if($section=='employe'){
	$mot='employés';
	$fichier="employe.php";	
}else if($section=='user'){
	$mot='utilisateurs';
	$fichier="user.php";	
}else if($section=='offreemploi'){
	$mot='offreemploi';
	$fichier="offreemploi.php";
}else {
	$mot='Accueil';
	$fichier="index.html";
}
?>

<?php

include($fichier);
?>

</body>
</html>
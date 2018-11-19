<?php

//récupération de la valeur $_GET

//vérifier si $_GET contient une valeur


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
	$fichier="Tableaux_Complet.php";	
}else if($section=='user'){
	$mot='utilisateurs';
	$fichier="user.php";	
}else if($section=='Offreemploi'){
	$mot='Offreemploi';
	$fichier="Offreemploi.php";
}else {
	$mot='services';
	$fichier="espace_perso.php";
}
?>

<?php

include($fichier);
include('footer.php');
?>

</body>
</html>
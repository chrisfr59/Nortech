<?php
// ce document html contient un formulaire avec un champ nommé `fichier` permettant de pousser (uploader) un fichier vers un serveur
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
</head>

<body>

    <?php // il faut utiliser l'attribut `enctype="multipart/form-data"` pour que le fichier puisse être envoyé ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div >
            <div >
                <label for="nom">Nom </label>
            </div>
            <div >
                <input type="text" name="nom" class='input' required>
            </div>
        </div>
        <div >
            <div >
                <label for="prenom"> Prénom </label>
            </div>
            <div>
                <input type="text" name="prenom" class='input' required>
            </div>
        </div>
        <label for="fichier">Votre CV </label><br />
        <input name="CV" type="file" /><br />
        <label for="fichier">Votre lettre de motivation</label><br />
        <input name="LM" type="file" /><br />
        <input type="submit" value="envoyer" />
    </form>

    <?php
// la variable `$_FILES` est un tableau
// avant que l'utilisateur ne valide le formulaire la variable `$_FILES` ne contient aucune donnée
// quand l'utilisateur valide le formulaire, on retrouve les information concernant le fichier uploadé dans la variable `$_FILES`

if(isset($_POST['nom'])){
//stock le nom et prenom 
$nom=$_POST['nom']; 
$prenom=$_POST['prenom']; 

$CV='CV'; 
$LM='lettre de motivation'; 
//recupère le CV et l'envoie dans le dossier files 
$file=$_FILES['CV']['name'];//recupère 
$fileextension=strrchr($file,".");
//recupère le format du fichier 
$filetmp=$_FILES['CV']['tmp_name'];
//le stock dans un dossier temporaire 
$filedest='CV/'.$file;
//donne le repertoire de stockage 
move_uploaded_file($filetmp,$filedest);
//le deplace dans le dossier files  
rename("$filedest", "CV/ $nom $prenom $CV $fileextension");//renome le CV

//recupère le CV et l'envoie dans le dossier files 
$file=$_FILES['LM']['name'];//recupère 
$fileextension=strrchr($file,".");
//recupère le format du fichier 
$filetmp=$_FILES['LM']['tmp_name'];
//le stock dans un dossier temporaire 
$filedest='LM/'.$file;
//donne le repertoire de stockage 
move_uploaded_file($filetmp,$filedest);
//le deplace dans le dossier files  
rename("$filedest", "LM/ $nom $prenom $LM $fileextension");//renome le CV

echo "<script type='text/javascript'>document.location.replace('redirection.php?section=Offre_d_emploi');
                    alert('l\'enregistrement de votre canditature a était enregistré.');
                    </script>";
}



?>

</body>

</html>
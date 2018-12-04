<?php
$nav_en_cours = 'espace_perso';
// ce document html contient un formulaire avec un champ nommé `fichier` permettant de pousser (uploader) un fichier vers un serveur
include('header.php');
//session_start();
$nom=$_SESSION['nom'];
$sql="SELECT e.noEmp FROM historique h,employe e where h.identifiant=e.identifiant AND e.nom=:nom group by e.nom";
$req=$connexion->prepare($sql);
$reponse=$req->execute(array('nom'=>$nom));
//$resultat=$reponse->fetch();
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
        <div>
            <div>
                <label for="nom">Nom </label>
            </div>
            <div>
                <input type="text" name="nom" class='input' required>
            </div>
        </div>
        <div>
            <div>
                <label for="prenom"> Prénom </label>
            </div>
            <div>
                <input type="text" name="prenom" class='input' required>
            </div>
        </div>

        <label for="fichier">Votre CV </label><br />
        <input name="CV" type="file" required/><br />

        <label for="fichier">Votre lettre de motivation</label><br />
        <input name="LM" type="file" required/><br />

        <input type="submit" value="envoyer" />
    </form><br>

<?php
    
    while($resultat=$req->fetch()){
   



    // la variable `$_FILES` est un tableau
    // avant que l'utilisateur ne valide le formulaire la variable `$_FILES` ne contient aucune donnée
    // quand l'utilisateur valide le formulaire, on retrouve les information concernant le fichier uploadé dans la variable `$_FILES`

    if(isset($_POST['nom'])){
        
        $nom=$_POST['nom']; 
        $prenom=$_POST['prenom']; 
        $anderscore='_';
        $noemp=$resultat['noEmp'];
        
            
            //recupère le CV et l'envoie dans le dossier files 
            $fileCV=$_FILES['CV']['name'];//recupère 
            $fileextensionCV=strrchr($fileCV,".");
                
            //recupère le CV et l'envoie dans le dossier files 
            $fileLM=$_FILES['LM']['name'];//recupère 
            $fileextension=strrchr($fileLM,".");
                
            if($fileextension == '.pdf' || $fileextension=='.odt' || $fileextension=='.docx'){

                //recupère le CV et l'envoie dans le dossier files 
            $fileCV=$_FILES['CV']['name'];//recupère 
            $fileextensionCV=strrchr($fileCV,".");
                
            //recupère le CV et l'envoie dans le dossier files 
            $fileLM=$_FILES['LM']['name'];//recupère 
            $fileextension=strrchr($fileLM,".");
                    
                //recupère le format du fichier 
                $filetmpCV=$_FILES['CV']['tmp_name'];
                //le stock dans un dossier temporaire 
                $filedestCV='CV/'.$fileCV;
                //donne le repertoire de stockage 
                move_uploaded_file($filetmpCV,$filedestCV);
                //le deplace dans le dossier files  
                rename("$filedestCV", "CV/ $noemp$anderscore$nom$anderscore$prenom$fileextensionCV");//renome le CV

                //recupère le format du fichier 
                $filetmp=$_FILES['LM']['tmp_name'];
                //le stock dans un dossier temporaire 
                $filedest='LM/'.$fileLM;
                //donne le repertoire de stockage 
                move_uploaded_file($filetmp,$filedest);
                //le deplace dans le dossier files  
                rename("$filedest", "LM/ $noemp$anderscore$nom$anderscore$prenom$fileextension");//renome le CV

             
                echo "<script type='text/javascript'>document.location.replace('redirection.php?section=offreemploi');alert('Votre canditature a été enregistrée avec succés.');</script>";
                
              
              

            }else{
                echo "<script type='text/javascript'>document.location.replace('postuler.php?section=Offre_d_emploi');alert('Veuillez mettre un fichier en format PDF ou WORD.');</script>";
            }
        
    }
}  
    include('footer.php');
?>

</body>

</html>
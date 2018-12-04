
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
</head>

<body>

       <header>
     
  
     <img id="logo" src="img/nortechLogo.svg" alt="Logo">

     <h1>
       Bienvenue sur le site de <span class="letter" >Nor</span>tech
     </h1>   
     
 </header> 

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
        <input name="CV" type="file" /><br />

        <label for="fichier">Votre lettre de motivation</label><br />
        <input name="LM" type="file" /><br />

        <input type="submit" value="envoyer" />
        <input type="reset" value="Effacer" />   
        <a href="offreemploi-ext.php"><input type="button" value="Retour" /></a>
    </form><br>

<?php
    
   
   



    // la variable `$_FILES` est un tableau
    // avant que l'utilisateur ne valide le formulaire la variable `$_FILES` ne contient aucune donnée
    // quand l'utilisateur valide le formulaire, on retrouve les information concernant le fichier uploadé dans la variable `$_FILES`

    if(isset($_POST['nom'])){
        
        $nom=$_POST['nom']; 
        $prenom=$_POST['prenom']; 
        $anderscore='_';
        $noemp='ext';
        
            
            //recupère le CV et l'envoie dans le dossier files 
            $fileCV=$_FILES['CV']['name'];//recupère 
            $fileextensionCV=strrchr($fileCV,".");
                
            //recupère le CV et l'envoie dans le dossier files 
            $fileLM=$_FILES['LM']['name'];//recupère 
            $fileextension=strrchr($fileLM,".");
                
            if($fileextension == '.pdf' || $fileextension=='.odt' || $fileextension=='.docx'){

               
                    
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

             
                echo "<script type='text/javascript'>document.location.replace('offreemploi-ext.php');alert('Votre canditature a été enregistrée avec succés.');</script>";
                
              
              

            }else{
                echo "<script type='text/javascript'>document.location.replace('postuler_ext.php?section=Offre_d_emploi&id=ext');alert('Veuillez mettre un fichier en format PDF ou WORD.');</script>";
            }
        
    }
 
    include('footer.php');
?>

</body>

</html>
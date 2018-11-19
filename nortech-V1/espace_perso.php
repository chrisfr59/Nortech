<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="offre.css" />
    <title>Document</title>
</head>

<body>
<?php
include('header.php');
?>

<section>

    <article class="espace_perso">
            <div class="row">
                <div class="offset-md-1 col-md-4">
                    <button><a class="btn btn-outline-light" href="" role="button">Fiche de paie</a></button>
                </div>
                <div class="offset-md-2 col-md-4 offset-md-1">
                    <button><a class="btn btn-outline-light" href="absence.php" role="button">Absences</a></button>
                </div>
            </div>

            <div class="row">
                <div class="offset-md-1 col-md-4">
                    Dépenses
                    <div class="row">
                        <div class="col-md-6">
                            <button><a class="btn btn-outline-light" href="Formulaire-depenses.php" role="button">Déclarer</a></button>
                        </div>
                        <div class="col-md-6">
                            <button><a class="btn btn-outline-light" href="" role="button">Consulter</a></button>
                        </div>
                    </div>
                </div>
    
                

                <div class="offset-md-2 col-md-4 offset-md-1">
                    CV
                    <div class="row">
                            <div class="col-md-6">
                                <button><a class="btn btn-outline-light" href="" role="button">Consulter</a></button>
                            </div>
                            <div class="col-md-6">
                                <button><a class="btn btn-outline-light" href="" role="button">Modifier</a></button>      
                            </div>
                    </div>
                </div>
            </div>
        
    </article>

    <article class="twitter">

        <div class="col-md-12">
            Fil d'actualité twitter
        </div>

    </article>

</section>


</body>

</html>
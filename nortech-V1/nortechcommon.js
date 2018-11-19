$annonce='annonce';
$n=2;
$n++;
$numannonce=$annonce+$n;

function afficher_div_masque($numannonce) {

    var $annonce = document.getElementById($numannonce);
    
    if($annonce.style.display === "none"){
        //alert(annonce.style.display)
        $annonce.style.display = "block";
    } else{
        $annonce.style.display = "none";
    }
    return;
   
}


     
    







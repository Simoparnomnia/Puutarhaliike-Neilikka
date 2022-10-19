<?php

if(isset($_GET["sisäänkirjautuminenonnistui"])){            
    if($_GET["sisäänkirjautuminenonnistui"] =="ei"){ 
        echo "<br><span class=\"errormessage\">Kirjautuminen epäonnistui, väärä käyttäjänimi tai salasana<a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
    }
    elseif($_GET['sisäänkirjautuminenonnistui'] =='tuntematonvirhe'){
        echo "<br><span class=\"errormessage\">Sisäänkirjautuminen epäonnistui, tuntematon virhe, yritä uudestaan <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET['uloskirjautuminenonnistui'])){
    if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
    }

    elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
        echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
    }         
}


?>
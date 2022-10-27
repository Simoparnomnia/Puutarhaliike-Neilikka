<?php

if(isset($_GET['uloskirjautuminenonnistui'])){
    if($_GET['uloskirjautuminenonnistui']=='kyllä'){
        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=työkalut\">PÄIVITÄ SIVU</a></span>";
    }

    elseif($_GET['uloskirjautuminenonnistui']=='ei'){
        echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=työkalut\">PÄIVITÄ SIVU</a></span>";
    }
}


?>
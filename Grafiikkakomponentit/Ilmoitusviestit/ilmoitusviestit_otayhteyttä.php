<?php

if(isset($_GET['uloskirjautuminenonnistui'])){
    if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
    }

    elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
        echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET['palautteenlähetysonnistui'])){
    if($_GET['palautteenlähetysonnistui'] =='kyllä'){
        echo "<br><span class=\"successmessage\">Palautteen lähetys onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
    }
    elseif($_GET['palautteenlähetysonnistui'] =='ei'){
        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
    }
}


?>
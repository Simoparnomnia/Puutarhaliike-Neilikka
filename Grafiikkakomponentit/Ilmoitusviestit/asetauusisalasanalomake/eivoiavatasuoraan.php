<?php

echo "<br><span class=\"errormessage\">Uuden salasanan vaihtolomaketta ei voida avata suoraan, menkää \"Oletko unohtanut salasanasi\"-sivustolle josta voidaan lähettää toimiva avauslinkki käyttäjän sähköpostiin <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                    
//echo "<h1>Asetauusisalasanalomake, GET-muuttujat:</h1>";
//foreach($_GET as $avain => $arvo){
//    echo "<br><h2>$avain : $arvo</h2>";
//}
echo "<h1>Asetauusisalasanalomake, SESSION-muuttujat:</h1>";
foreach($_SESSION as $avain => $arvo){
    echo "<br><h2>$avain : $arvo</h2>";
}
?>
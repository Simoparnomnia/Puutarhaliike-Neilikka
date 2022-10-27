<?php

if(!isset($_GET['tietokantavirhe'])){
    echo "<br><span class=\"errormessage\">Salasanan vaihtolinkin avaus epäonnistui, käyttäjää ei löydetty linkin perusteella <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";                   
}
else{
    echo "<br><span class=\"errormessage\">Salasanan vaihtolinkin avaus epäonnistui, tietokantavirhe käyttäjää haettaessa <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";     
}


?>
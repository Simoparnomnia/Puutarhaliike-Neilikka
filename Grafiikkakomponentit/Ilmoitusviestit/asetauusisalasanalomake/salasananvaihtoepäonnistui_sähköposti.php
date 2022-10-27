<?php


    if($_GET['oikeasähköposti']=="kyllä"){
        echo "<br><span class=\"errormessage\">Salasanan vaihto epäonnistui, uusi salasana ja uuden salasanan vahvistus eivät täsmää, avaa vaihtolinkki uudestaan <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";         
    }
    else{
        echo "<br><span class=\"errormessage\">Salasanan vaihto epäonnistui, lomakkeella syötettyä käyttäjän sähköpostia ei löytynyt, avaa vaihtolinkki uudestaan <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";                                   
    }
    



?>
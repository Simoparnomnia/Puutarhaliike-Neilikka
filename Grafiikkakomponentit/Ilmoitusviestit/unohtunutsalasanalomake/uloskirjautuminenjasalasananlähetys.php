<?php

if(isset($_GET['uloskirjautuminenonnistui'])){
    if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
    }

    elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
        echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET['salasananlähetysonnistui'])){ 
    if($_GET['salasananlähetysonnistui'] == 'kyllä'){
            echo "<br><span class=\"successmessage\">Unohtuneen salasanan vaihtolinkki sähköpostiosoitteeseen onnistui, tarkistakaa sähköpostinne <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
    }
    if($_GET['salasananlähetysonnistui'] == 'ei'){
        if(isset($_GET['virhe'])){
            if($_GET['virhe'] == "sähköpostiaeilöytynyt"){
                echo "<br><span class=\"errormessage\">Käyttäjän unohtuneen salasanan vaihtolinkin lähetys epäonnistui, käyttäjää ei löytynyt <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
            }  
            elseif($_GET['virhe'] == 'sähköpostivirhe'){
                echo "<br><span class=\"errormessage\">Unohtuneen salasanan lähetys sähköpostiosoitteeseen epäonnistui, sähköpostia ei löytynyt <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
            }
            elseif($_GET['virhe'] == 'tietokantavirhe'){
                echo "<br><span class=\"errormessage\">Unohtuneen salasanan lähetys sähköpostiosoitteeseen epäonnistui, tietokantavirhe <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
            } 
            elseif($_GET['virhe'] == 'sähköpostipalveluaeilöytynyt'){
                echo "<br><span class=\"errormessage\">Palautteen lähetys epäonnistui, palvelimella määritettyä sähköpostipalvelua ei ole olemassa! <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
            }
        }
    }

}




?>
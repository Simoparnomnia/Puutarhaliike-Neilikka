<?php

if(isset($_GET["sisäänkirjautuminenonnistui"])){  
    if($_GET["sisäänkirjautuminenonnistui"] =="kyllä"){
        echo "<br><span class=\"successmessage\">Kirjautuminen onnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET["automaattinensisäänkirjautuminenonnistui"])){  
    if($_GET["automaattinensisäänkirjautuminenonnistui"] =="kyllä"){
        echo "<br><span class=\"successmessage\">Muista minut-toiminto käytössä, käyttäjän automaattinen sisäänkirjautuminen onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
    }
    if($_GET["automaattinensisäänkirjautuminenonnistui"] =="ei"){
        echo "<br><span class=\"errormessage\">Muista minut-toiminto käytössä, käyttäjän automaattinen sisäänkirjautuminen epäonnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET['uloskirjautuminenonnistui'])){
    if($_GET['uloskirjautuminenonnistui']=='kyllä'){
        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
    }

    elseif($_GET['uloskirjautuminenonnistui']=='ei'){
        echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET['autentikaatiotokeninluontionnistui'])){
    if($_GET['autentikaatiotokeninluontionnistui']=='kyllä'){
        echo "<br><span class=\"successmessage\">Muista minut- tokenin luonti onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
    }

    elseif($_GET['autentikaatiotokeninluontionnistui']=='ei'){
        echo "<br><span class=\"errormessage\">Muista minut- tokenin epäonnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET['tietokantavirhe'])){
    echo "<br><span class=\"errormessage\">Tietokantavirhe käyttäjän muistamisen tarkistuksessa, käyttäjää ei saatu kirjattua <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
}


?>
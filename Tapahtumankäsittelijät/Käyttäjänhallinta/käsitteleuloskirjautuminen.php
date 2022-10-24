<?php

session_start();
if(isset($_GET["kirjauduulos"]) == "kyllä"){
    $_SESSION["kayttajanimi"]=$_POST["kayttajanimi"];
    $_SESSION["salasana"]=$_POST["salasana"];
    
    // poista  muista minut- ja autentikaatiotoken- evästeet
    if (isset($_COOKIE['muistaminut'])) {
        unset($_COOKIE['muistaminut']);
        setcookie('muistaminut', null, -1000);
    }

    // poista  muista minut- ja autentikaatiotoken- evästeet
    if (isset($_COOKIE['autentikaatiotoken'])) {
        unset($_COOKIE['autentikaatiotoken']);
        setcookie('autentikaatiotoken', null, -1000);
    }
    

    
    
    
    
    session_destroy();
    unset($_SESSION["kayttajanimi"]);
    //Ohjataan takaisin etusivulle
    //TODO: samalle sivulle?
    header('Location: ../../index.php?sivu=etusivu&uloskirjautuminenonnistui=kyllä');
    
}
else{
    //Ohjataan takaisin etusivulle
    //TODO: samalle sivulle?
    header('Location: ../../index.php?sivu=etusivu&uloskirjautuminenonnistui=ei');
}

?>
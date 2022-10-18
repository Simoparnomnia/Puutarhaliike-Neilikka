<?php

session_start();
if(isset($_GET["kirjauduulos"]) == "kyllä"){
    $_SESSION["kayttajanimi"]=$_POST["kayttajanimi"];
    $_SESSION["salasana"]=$_POST["salasana"];
    session_destroy();
    unset($_SESSION["kayttajanimi"]);
    //Ohjataan takaisin etusivulle
    //TODO: samalle sivulle?
    header('Location: ../index.php?sivu=etusivu&uloskirjautuminenonnistui=kyllä');
    
}
else{
    //Ohjataan takaisin etusivulle
    //TODO: samalle sivulle?
    header('Location: ../index.php?sivu=etusivu&uloskirjautuminenonnistui=ei');
}

?>
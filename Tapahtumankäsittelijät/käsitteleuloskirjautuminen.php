<?php
//TODO: keskeneräinen
session_start();
if(isset($_GET["kirjauduulos"]) == "kylla"){
    $_SESSION["kayttajanimi"]=$_POST["kayttajanimi"];
    $_SESSION["salasana"]=$_POST["salasana"];
    session_destroy();
    unset($_SESSION["kayttajanimi"]);
    //Ohjataan takaisin samalle sivulle
    header('Location: ../index.php?sivu=etusivu&uloskirjautuminen=kylla');
    
}
else{
    //Ohjataan takaisin samalle sivulle
    header('Location: ../index.php?sivu=etusivu&uloskirjautuminen=ei');
}

?>
<?php
//TODO: keskeneräinen
session_start();
if(isset($_GET["kirjauduulos"]) == "kylla"){
    $_SESSION["kayttajanimi"]=$_POST["kayttajanimi"];
    $_SESSION["salasana"]=$_POST["salasana"];
    session_destroy();
    //Tarvitaan ilmoitusviestiä varten kirjautumisen jälkeen
    header('Location: ../kirjautumislomake.php?oikeattunnukset=kylla');
}
else{
    //Tarvitaan ilmoitusviestiä varten kirjautumisen jälkeen
    header('Location: ../kirjautumislomake.php?oikeattunnukset=ei');
}

?>
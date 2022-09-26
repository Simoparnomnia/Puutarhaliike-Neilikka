<?php
//TODO: keskeneräinen
session_start();
if(isset($_POST["kayttajanimi"]) && isset($_POST["salasana"])){
    $_SESSION["kayttajanimi"]=$_POST["kayttajanimi"];
    $_SESSION["salasana"]=$_POST["salasana"];
    header('Location: ../kirjautumislomake.php?oikeattunnukset=kylla');
}
else{
    header('Location: ../kirjautumislomake.php?oikeattunnukset=ei');
}

?>
<?php
require_once('Tietokantayhteys.php');
$uusisalasana=$_POST["uusisalasana"];
$vahvistauusisalasana=$_POST["vahvistauusisalasana"];
$sähköposti=$_GET["sähköposti"];
if($uusisalasana == $vahvistauusisalasana){
    $salasanahash=password_hash($uusisalasana, PASSWORD_DEFAULT);
    $päivitäsalasanakysely="UPDATE kayttajatili SET salasanahash='$salasanahash' WHERE LCSE(TRIM(sahkoposti))='$sähköposti'";
    header('Location: ../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=kyllä');
}
else{
    header('Location: ../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=ei');
}
?>
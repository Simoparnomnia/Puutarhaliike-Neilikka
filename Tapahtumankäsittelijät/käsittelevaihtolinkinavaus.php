<?php

//Tätä ei tarvita koska tietokantayhteys muodostetaan jo index.php:ssä?
//require_once('Tapahtumankäsittelijät/Tietokantayhteys.php');

if(isset($_GET['sähköposti'])){
    $linkinsähköpostihash=$_GET['sähköposti'];
}
if(isset($_GET['käyttäjänimi'])){
    $linkinkäyttäjänimihash=$_GET['käyttäjänimi'];
}



$onkosähköpostiolemassakysely="SELECT sahkoposti FROM kayttajanimi";

if($kyselyntulos=$connection->query($onkosähköpostiolemassakysely)){
    while(list($sähköposti)=$kyselyntulos->fetch_row()){
        if(password_verify($sähköposti,$linkinsähköpostihash)){
            //viitataan nykyiseen kansioon, koska tapahtumankäsittelijää käytetään suoraan index.php:ssa eikä grafiikkakomponentin lomakkeen actionina
            header('Location: ./index.php?sivu=asetauusisalasanalomake&vaihtolinkinavausonnistui=kyllä');
        }
        else{
            header('Location: ./index.php?sivu=asetauusisalasanalomake&vaihtolinkinavausonnistui=ei');
        }
    }
}








?>
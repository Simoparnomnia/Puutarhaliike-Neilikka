<?php
require_once('../Tietokantayhteys.php');
//TODO: Session already started- varoitus, ei tarvita täällä?
//session_start();
$vanhasalasana=$_POST["vanhasalasana"];
$uusisalasana=$_POST["uusisalasana"];
$vahvistauusisalasana=$_POST["vahvistauusisalasana"];
$sähköposti=$_SESSION["vaihdettavansalasanansähköposti"];

$onkosalasanajoolemassakysely="SELECT salasanahash FROM kayttajatili";

try{
    if($kyselyntulos=$connection->query($onkosalasanajoolemassakysely)){
        while(list($salasanahash)=$kyselyntulos->fetch_row()){
            if(password_verify($vanhasalasana, $salasanahash)){
                if($uusisalasana == $vahvistauusisalasana){
                    $salasanahash=password_hash($uusisalasana, PASSWORD_DEFAULT);
                    $päivitäsalasanakysely="UPDATE kayttajatili SET salasanahash='$salasanahash' WHERE LCASE(TRIM(sahkoposti))='".strtolower(trim($sähköposti))."'";
                    if($kyselyntulos=$connection->query($päivitäsalasanakysely)){
                        header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=kyllä&oikeavanhasalasana=kyllä');
                        exit();
                    }
                }
                else{
                    //echo "virhe, uusi salasana ja uuden salasanan vahvistus eivät täsmää : ".$connection->$error;               
                    header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=ei&oikeavanhasalasana=kyllä');
                    exit();
                    
                }
            }
            else{
                header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=ei&oikeavanhasalasana=ei');
            }
        }
    }
}catch(Exception $e){
    echo "Tietokantavirhe: ".$e;  
    exit();             
    header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=ei&tietokantavirhe=kyllä');
    exit();
}
?>
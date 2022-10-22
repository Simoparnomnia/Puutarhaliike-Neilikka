<?php
require_once('../Tietokantayhteys.php');
//TODO: Session already started- varoitus, ei tarvita täällä?
//session_start();
$annettuvanhasalasana=$_POST["vanhasalasana"];
$uusisalasana=$_POST["uusisalasana"];
$annettusalasananvahvistus=$_POST["vahvistauusisalasana"];
$sähköposti=$_SESSION["vaihdettavansalasanansähköposti"];

//Sisäkkäiset kyselyt on pakko valmistella ennen yhdenkään suoritusta
$tietokantakysely1=$connection->prepare("SELECT salasanahash FROM kayttajatili");
$tietokantakysely2=$connection->prepare("UPDATE kayttajatili SET salasanahash=? WHERE sahkoposti=?");


try{
    if($tietokantakysely1->execute()){
        $tietokantakysely1->store_result();
        $tietokantakysely1->bind_result($salasanahash);
        while($tietokantakysely1->fetch()){
            if(password_verify($annettuvanhasalasana, $salasanahash)){
                if($uusisalasana == $annettusalasananvahvistus){
                    $salasanahash=password_hash($uusisalasana, PASSWORD_DEFAULT);
                    //päivitä jos sekä vanha salasana että uudet salasanat ovat oikein
                    $tietokantakysely2->bind_param("ss",$salasanahash,$sähköposti);
                    if($tietokantakysely2->execute()){
                        header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=kyllä&oikeavanhasalasana=kyllä');
                        exit();
                    }
                }
                else{
                    //Jos uusi salasana ja uuden salasanan vahvistus eivät täsmää 

                    header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=ei&oikeavanhasalasana=kyllä');
                    exit();
                    
                }
            }
        }
        $tietokantakysely1->free_result();
        
            header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=ei&oikeavanhasalasana=ei');
    }
        
    
}catch(Exception $e){
    echo "Tietokantavirhe: ".$e;  
    exit();             
    header('Location: ../../index.php?sivu=asetauusisalasanalomake&salasananvaihtoonnistui=ei&tietokantavirhe=kyllä');
    exit();
}
?>
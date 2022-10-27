<?php

if(!isset($_SESSION["käyttäjänimi"]) && !isset($_COOKIE["autentikaatiotoken"])){
    //Poistetaan vanhat tokenit tietokannasta
    $poistavanhaautentikaatiotokenkysely=$connection->prepare("DELETE FROM kayttajantoken WHERE umpeutumisaika < NOW()");
    try{
        $poistavanhaautentikaatiotokenkysely->execute();
            
    }catch(Exception $e){
        //Tietokantavirhe
        header('Location: ../../index.php?sivu=etusivu&tietokantavirhe=kyllä');
    }
}






?>
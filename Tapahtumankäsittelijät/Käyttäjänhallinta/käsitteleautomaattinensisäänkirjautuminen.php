<?php

require_once('Tapahtumankäsittelijät/Tietokantayhteys.php');

try{
//Jos ikkuna avataan uudestaan, kokeillaan automaattista kirjautumista muista minut- ja autentikaatiotoken-evästeillä
    if(isset($_COOKIE['muistaminut']) && isset($_COOKIE['autentikaatiotoken'])){
        $selektorijavalidaattori=explode('.',$_COOKIE['autentikaatiotoken']);
        $selektori=$selektorijavalidaattori[0];
        $tokeninkäyttäjäkysely=$connection->prepare("SELECT kayttajanimi FROM kayttajatili WHERE kayttajanimi= (SELECT kayttajanimi FROM kayttajantoken WHERE selektori=?)");
        $tokeninkäyttäjäkysely->bind_param("s",$selektori);
        if ($tokeninkäyttäjäkysely->execute()){
            $tokeninkäyttäjäkysely->bind_result($käyttäjänimi);
            while($tokeninkäyttäjäkysely->fetch()){
                if($käyttäjänimi){
                    session_start();
                    $_SESSION['käyttäjänimi']=$käyttäjänimi;
                    //Uudelleenohjataan etusivulle jos oikeat tunnukset löytyivät           
                    header('Location: ./index.php?sivu=etusivu&automaattinensisäänkirjautuminenonnistui=kyllä');
                    exit();
                }
            }
            //Jos tunnuksia ei löytynyt, uudelleenohjataan etusivulle
            header('Location: ./index.php?sivu=etusivu&automaattinensisäänkirjautuminenonnistui=ei');
        }
    }
    else{
        //Jos käyttäjänimeä ja salasanaa ei ole asetettu, ei periaatteessa tarvita, required-attribuutti kirjautumislomakkeella suojelee tältä tapaukselta
        header('Location: ./index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=ei');
    }
                
}catch(Exception $e){
    //Tietokantavirhe
    header('Location: ./index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=tuntematonvirhe');
}


?>
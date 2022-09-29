<?php
//TODO: katso myös kirjautumislomake.php
require('Tietokantayhteys.php');
session_start();
if(isset($_POST["kayttajanimi"]) && isset($_POST["salasana"])){
    //$sahkopostiregex="/^.{16,}";
    $annettukayttajanimi=$_POST["kayttajanimi"];
    $annettusalasana=$_POST["salasana"];
    $annettusalasanahash=md5($annettusalasana);
    $tunnuskysely="SELECT kayttajanimi, salasanahash FROM kayttajatili WHERE kayttajanimi='$annettukayttajanimi' AND salasanahash='$annettusalasanahash'";
    if ($kyselyntulos=$connection->query($tunnuskysely)){
        while(list($kayttajanimi, $salasanahash)=$kyselyntulos->fetch_row()){
            
        
            $oikeasalasana=password_verify($_POST["salasana"], $salasanahash);
        
            
            if($annettukayttajanimi==$kayttajanimi && $oikeasalasana){
                $_SESSION['kayttajanimi']=$kayttajanimi;
                session_start();
            

                //Uudelleenohjataan jos oikeat tunnukset löytyivät
            
                header('Location: ../index.php?sivu=kirjautumislomake&oikeattunnukset=kylla');
                break;
            }
        }
            
            //Jos oikeita tunnuksia ei löytynyt, uudelleenohjataan
            header('Location: ../sivu=kirjautumislomake&index.php?oikeattunnukset=ei');
            
        
        
    }

}
else{
    header('Location: ../kirjautumislomake.php?oikeattunnukset=ei');
}

?>
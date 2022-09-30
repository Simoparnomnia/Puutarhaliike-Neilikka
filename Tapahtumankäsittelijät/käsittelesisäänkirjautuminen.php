<?php
//TODO: katso myös kirjautumislomake.php
require('Tietokantayhteys.php');
session_start();
if(isset($_POST["käyttäjänimi"]) && isset($_POST["salasana"])){
    //$sahkopostiregex="/^.{16,}";
    $annettukäyttäjänimi=$_POST["käyttäjänimi"];
    $annettusalasana=$_POST["salasana"];
    $annettusalasanahash=md5($annettusalasana);
    $tunnuskysely="SELECT kayttajanimi, salasanahash FROM kayttajatili WHERE kayttajanimi='$annettukäyttäjänimi' AND salasanahash='$annettusalasanahash'";
    if ($kyselyntulos=$connection->query($tunnuskysely)){
        while(list($käyttäjänimi, $salasanahash)=$kyselyntulos->fetch_row()){
            
        
            $oikeasalasana=password_verify($_POST["salasana"], $salasanahash);
        
            
            if($annettukäyttäjänimi==$käyttäjänimi && $oikeasalasana){
                $_SESSION['käyttäjänimi']=$käyttäjänimi;
                
            

                //Uudelleenohjataan jos oikeat tunnukset löytyivät
            
                header('Location: ../index.php?sivu=kirjautumislomake');
                break;
            }
        }
            
            //Jos oikeita tunnuksia ei löytynyt, uudelleenohjataan
            header('Location: ../index.php?sivu=kirjautumislomake');
            
        
        
    }

}
else{
    header('Location: ../index.php?sivu=kirjautumislomake');
}

?>
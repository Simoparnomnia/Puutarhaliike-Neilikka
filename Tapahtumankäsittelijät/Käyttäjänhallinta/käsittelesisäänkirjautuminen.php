<?php
try{
    //TODO: katso myös kirjautumislomake.php
    require_once('../Tietokantayhteys.php');
    //Jos kirjaudutaan normaalisti
    if(isset($_POST["käyttäjänimi"]) && isset($_POST["salasana"])){
        //$sahkopostiregex="/^.{16,}";
        $annettukäyttäjänimi=$_POST["käyttäjänimi"];
        $annettusalasana=$_POST["salasana"];
        
        
        
        $tunnuskysely="SELECT kayttajanimi, salasanahash FROM kayttajatili WHERE kayttajanimi='$annettukäyttäjänimi'";
        
            if ($kyselyntulos=$connection->query($tunnuskysely)){
                while(list($käyttäjänimi, $salasanahash)=$kyselyntulos->fetch_row()){
                    
                
                    $oikeasalasana=password_verify($annettusalasana, $salasanahash);
                             
                    
                    if($annettukäyttäjänimi==$käyttäjänimi && $oikeasalasana==true){
                        session_start();
                        $_SESSION['käyttäjänimi']=$käyttäjänimi;
                        
                        if(isset($_POST["muistaminut"])){
                            require_once('luoautentikaatiotoken.php');
                        }
                    

                        //Uudelleenohjataan etusivulle jos oikeat tunnukset löytyivät           
                        header('Location: ../../index.php?sivu=etusivu&sisäänkirjautuminenonnistui=kyllä');
                        exit();
                    }
                }
                    
            }
                    //Jos oikeita tunnuksia ei löytynyt, uudelleenohjataan takaisin
                    header('Location: ../../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=ei');
                    
            
    }
    //Jos ikkuna avataan uudestaan, kokeillaan automaattisesta kirjautumista muista minut- ja autentikaatiotoken-evästeillä
    elseif(isset($_COOKIE['muistaminut']) && isset($_COOKIE['autentikaatiotoken'])){
        $selektorijavalidaattori=explode('.',$_COOKIE['autentikaatiotoken']);
        $selektori=$selektorijavalidaattori[0];
        $tokeninkäyttäjäkysely="SELECT kayttajanimi FROM kayttajatili WHERE kayttajanimi= (SELECT kayttajanimi FROM kayttajantoken WHERE selektori='$selektori')";
        if ($kyselyntulos=$connection->query($tokeninkäyttäjäkysely)){
            while(list($käyttäjänimi)=$kyselyntulos->fetch_row()){
                if($käyttäjänimi){
                    session_start();
                    $_SESSION['käyttäjänimi']=$käyttäjänimi;
                    //Uudelleenohjataan etusivulle jos oikeat tunnukset löytyivät           
                    header('Location: ../../index.php?sivu=etusivu&automaattinensisäänkirjautuminenonnistui=kyllä');
                    exit();
                }
            }
            //Jos tunnuksia ei löytynyt, uudelleenohjataan etusivulle
            header('Location: ../../index.php?sivu=etusivu&automaattinensisäänkirjautuminenonnistui=ei');
        }
    }
    else{
        //Jos käyttäjänimeä ja salasanaa ei ole asetettu, ei periaatteessa tarvita, required-attribuutti kirjautumislomakkeella suojelee tältä tapaukselta
        header('Location: ../../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=ei');
    }
                
}catch(Exception $e){
    //Tietokantavirhe
    header('Location: ./index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=tuntematonvirhe');
}



?>
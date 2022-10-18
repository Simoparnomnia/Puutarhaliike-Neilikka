<?php
try{
    //TODO: katso myös kirjautumislomake.php
    require_once('Tietokantayhteys.php');

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
                        require_once('luoautentikaatiotoken.php');
                    

                        //Uudelleenohjataan jos oikeat tunnukset löytyivät           
                        header('Location: ../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=kyllä');
                        exit();
                    }
                }
                    
            }
                    //Jos oikeita tunnuksia ei löytynyt, uudelleenohjataan
                    header('Location: ../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=ei');
                    
            
    }
    else{
        header('Location: ../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=ei');
    }
                
}catch(Exception $e){
    //Tietokantavirhe
    header('Location: ../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=tuntematonvirhe');
}



?>
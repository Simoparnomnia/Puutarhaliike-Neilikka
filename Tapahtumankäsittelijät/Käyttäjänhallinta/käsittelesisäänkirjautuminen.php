<?php
try{
    //TODO: katso myös kirjautumislomake.php
    require_once('../Tietokantayhteys.php');
    //Jos kirjaudutaan normaalisti
    if(isset($_POST["käyttäjänimi"]) && isset($_POST["salasana"])){
        //$sahkopostiregex="/^.{16,}";
        $annettukäyttäjänimi=$_POST["käyttäjänimi"];
        $annettusalasana=$_POST["salasana"];
        
        
        
        $tietokantakysely->prepare("SELECT kayttajanimi, salasanahash FROM kayttajatili WHERE kayttajanimi=?");
        $tietokantakysely->bind_param("s",$annettukäyttäjänimi);
        if ($tietokantakysely->execute()){

            $tietokantakysely->bind_result($käyttäjänimi, $salasanahash);
            while($tietokantakysely->fetch()){
                //echo "Sisäänkirjautumisen tietokantakyselyn tulokset:".$käyttäjänimi." ". $salasanahash;
                //exit();
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
                
        
                //Jos oikeita tunnuksia ei löytynyt, uudelleenohjataan takaisin
                header('Location: ../../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=ei');
                
        
        }
    }
               
}catch(Exception $e){
    //Tietokantavirhe
    header('Location: ./index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=tuntematonvirhe');
}



?>
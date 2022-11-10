<?php

    
require dirname(dirname((__DIR__))).'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$DOTENVDATA=$dotenv->load();
    
//foreach($DOTENVDATA as $key => $value){
//    echo $key.' '.$value;
//}
//exit();

try{


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
                    //TODO: tulee varoitusviesti että sessio on jo käynnissä, ei tarvita?
                    //session_start();
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
    //echo $e;
    //exit();
    header('Location: ../../index.php?sivu=kirjautumislomake&sisäänkirjautuminenonnistui=tuntematonvirhe');
}



?>
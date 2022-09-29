<?php

require('Tietokantayhteys.php');



if(isset($_POST["kayttajanimi"]) && isset($_POST["salasana"])){
    $annettukayttajanimi=$_POST['kayttajanimi'];
    $annettusalasana=$_POST['salasana'];
    $annettusalasanahash=password_hash($annettusalasana, PASSWORD_DEFAULT);

    

    $onkotunnusluotukysely="SELECT kayttajanimi, salasanahash FROM kayttajatili WHERE kayttajanimi='$annettukayttajanimi' AND salasanahash='$annettusalasanahash'";

    if($kyselyntulos=$connection->query($onkotunnusluotukysely)){
        while(list($kayttajanimi, $salasanahash)=$kyselyntulos->fetch_row()){
            
        
            $oikeasalasana=password_verify($_POST["salasana"], $salasanahash);
        
            
            if($annettukayttajanimi==$kayttajanimi && $oikeasalasana){
            

            //Uudelleenohjataan onnistumisella jos tunnukset ovat ainutlaatuisia
            
            header('Location: ./index.php?sivu=rekisteröintilomake.php&rekisterointionnistui=kylla');
                break;
            }
        }
            
        //Jos tunnukset ovat jo olemassa, uudelleenohjataan epäonnistumisella
        header('Location: ./index.php?sivu=rekisteröintilomake.php&rekisterointionnistui=ei');
    }
        
}
else{
    header('Location: ../index.php?sivu=rekisteröintilomake.php&rekisterointionnistui=ei');
}
    





?>
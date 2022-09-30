<?php

require('Tietokantayhteys.php');



if(isset($_POST["käyttäjänimi"]) && isset($_POST["salasana"]) && isset($_POST["vahvistasalasana"])){
    if($_POST["vahvistasalasana"]==$_POST["salasana"]){
        
        $annettukäyttäjänimi=$_POST['käyttäjänimi'];
        $annettusalasana=$_POST['salasana'];
        $annettusalasanahash=password_hash($annettusalasana, PASSWORD_DEFAULT);

        $onkotunnusluotukysely="SELECT kayttajanimi, salasanahash FROM kayttajatili WHERE kayttajanimi='$annettukäyttäjänimi' AND salasanahash='$annettusalasanahash'";

        if($kyselyntulos=$connection->query($onkotunnusluotukysely)){
            while(list($haettukäyttäjänimi, $haettusalasanahash)=$kyselyntulos->fetch_row()){
                
            
                $vääräsalasana=password_verify($_POST["salasana"], $haettusalasanahash);
            
                
                if($annettukäyttäjänimi==$haettukäyttäjänimi || $vääräsalasana){
                //Uudelleenohjataan epäonnistumisella jos tunnukset ovat jo olemassa
  
                    header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=käyttäjäonjoolemassa');
                    break;
                }
            }
            
            
            
            //Jos tunnuksia ei löytynyt, luodaan käyttäjätili ja uudelleenohjataan onnistumisella
            $nykypäivämäärä=(string)(date_format(date_create(), 'Y-m-d H:i:s'));
            $luokayttäjäkysely="INSERT INTO kayttajatili VALUES ('$annettukäyttäjänimi', '$annettusalasanahash', '$nykypäivämäärä',NULL,'$henkilö')";
            header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=kyllä');

        }
        else {
            echo "Tietokantavirhe: ".$connection->error;
            exit();
        }
    }

    else {
        //salasanat eivät täsmää
        header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=salasanateivättäsmää');
        

    }
        
}
else{
    
    header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=ei');
}
    





?>
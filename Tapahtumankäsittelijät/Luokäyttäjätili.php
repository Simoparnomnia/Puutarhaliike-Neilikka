<?php

require('Tietokantayhteys.php');



if(isset($_POST["käyttäjänimi"]) && isset($_POST["salasana"]) && isset($_POST["vahvistasalasana"])){
    if($_POST["vahvistasalasana"]==$_POST["salasana"]){
        
        $annettuetunimi=$_POST['etunimi'];
        $annettusukunimi=$_POST['sukunimi'];
        $annettupuhelinnumero=$_POST['puhelinnumero'];
        $annettusähköposti=$_POST['sähköposti'];
        $annettuosoite=$_POST['osoite'];
        $annettupostinumero=$_POST['postinumero'];
        $annettupostitoimipaikka=$_POST['postitoimipaikka'];
        $annettumaa=$_POST['maa'];
        $annettumaakunta=$_POST['maakunta'];
        $annettuosavaltio=$_POST['osavaltio'];
        $annettukäyttäjänimi=$_POST['käyttäjänimi'];
        $annettusalasana=$_POST['salasana'];
        $annettusalasanahash=password_hash($annettusalasana, PASSWORD_DEFAULT);

        $käyttäjäonjoolemassa=false;

        $onkotunnusluotukysely="SELECT kayttajanimi, salasanahash FROM kayttajatili WHERE kayttajanimi='$annettukäyttäjänimi' AND salasanahash='$annettusalasanahash'";

        if($kyselyntulos=$connection->query($onkotunnusluotukysely)){
            while(list($haettukäyttäjänimi, $haettusalasanahash)=$kyselyntulos->fetch_row()){
                
            
                $vääräsalasana=password_verify($_POST["salasana"], $haettusalasanahash);
            
                
                if($annettukäyttäjänimi==$haettukäyttäjänimi || $vääräsalasana){
                //Uudelleenohjataan epäonnistumisella jos tunnukset ovat jo olemassa
  
                    header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=käyttäjäonjoolemassa');
                    $käyttäjäonjoolemassa=true;
                    break;
                }
            }
            if($käyttäjäonjoolemassa==true){
                //Osoite on luotava ensin koska käyttäjässä on viiteavain osoitetauluun
                $luoosoitekysely="INSERT INTO osoite VALUES('$annettuosoite','$annettupostinumero','$annettupostitoimipaikka','$annettumaa','$annettumaakunta','$annettuosavaltio')";
                if($kyselyntulos=$connection->query($luoosoitekysely)){
                    
                        //Jos osoitteen luonti onnistui, luodaan käyttäjätili ja uudelleenohjataan onnistumisella
                        $nykypäivämäärä=(string)(date_format(date_create(), 'Y-m-d H:i:s'));
                        //TODO: Tarvitaan ehtotarkistukset työntekijän määrittämiseksi, jos uutta käyttäjää yritetään luoda ylläpitäjäksi kirjautuneena
                        $luokayttäjäkysely="INSERT INTO kayttajatili VALUES ('$annettukäyttäjänimi', '$annettusalasanahash', '$annettuetunimi', '$annettusukunimi','$annettupuhelinnumero','$annettusähköposti',TRUE,FALSE,'$nykypäivämäärä',NULL)";
                        header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=kyllä');
                    }
            }
              
            else{
                //Uudelleenohjataan epäonnistumisella jos henkilö on jo olemassa
                header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=henkilöonjoolemassa');             
            }          
        }       
        else {
            echo "Tietokantavirhe: ".$connection->error;
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
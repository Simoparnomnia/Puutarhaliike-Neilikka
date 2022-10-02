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
            
            
            //Jos tunnuksia ei löytynyt, tarkistetaan annetun henkilön olemassaolo tietokannasta
            $onkohenkilöolemassakysely="SELECT etunimi, sukunimi, sahkoposti FROM henkilo WHERE etunimi='$annettuetunimi' AND sukunimi='$annettusukunimi' AND sahkoposti='$sähköposti'";
            if($kyselyntulos=$connection->query($onkohenkilöolemassakysely)){
                if(mysqli_num_rows($kyselyntulos)==0){
                    //Jos tunnuksia ja henkilöä ei löytynyt, luodaan käyttäjätili ja uudelleenohjataan onnistumisella
                    $nykypäivämäärä=(string)(date_format(date_create(), 'Y-m-d H:i:s'));
                    $luokayttäjäkysely="INSERT INTO kayttajatili VALUES ('$annettukäyttäjänimi', '$annettusalasanahash', '$nykypäivämäärä',NULL,'$henkilö')";
                    header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=kyllä');
                }
                
                else{
                //Uudelleenohjataan epäonnistumisella jos henkilö on jo olemassa
                header('Location: ../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=henkilöonjoolemassa');
                break;
                }
            }
            }
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
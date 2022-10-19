<?php
require_once('../Tietokantayhteys.php');




if(isset($_POST["käyttäjänimi"]) && isset($_POST["salasana"]) && isset($_POST["vahvistasalasana"])){
    if($_POST["vahvistasalasana"]==$_POST["salasana"]){
        //foreach($_POST as $key => $value){
        //echo ' '.$value;
        //}
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
        $osoitteenid="";
        $osoiteonjoolemassa=false;

        $onkotunnusluotukysely="SELECT kayttajanimi FROM kayttajatili WHERE kayttajanimi='$annettukäyttäjänimi'";

        if($kyselyntulos=$connection->query($onkotunnusluotukysely)){
            while(list($kayttajanimi)=$kyselyntulos->fetch_row()){
                //$salasanajoolemassa=password_verify($_POST["salasana"], $salasanahash);
                
                
                
                if($annettukäyttäjänimi==$kayttajanimi){
                //Uudelleenohjataan epäonnistumisella jos tunnukset ovat jo olemassa
  
                    header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=käyttäjäonjoolemassa');
                    $käyttäjäonjoolemassa=true;
                    
                    break;
                    
                }
                
                
            }
            if($käyttäjäonjoolemassa==false){
                //echo '<br>Annettu käyttäjä:'.$annettukäyttäjänimi.' Haettu käyttäjä: '.$haettukäyttäjänimi.' Salasana on jo olemassa:'.$salasanajoolemassa.' rivit käyttäjäkyselysilumkassa:'.$rivit;
                
                //Osoite on luotava ensin koska käyttäjässä on viiteavain osoitetauluun
                //Tarkistetaan ensin annetun osoitteen olemassaolo
                $haeosoitekysely="SELECT osoite_id, osoite FROM osoite WHERE osoite='$annettuosoite'";
                if($kyselyntulos=$connection->query($haeosoitekysely)){
                    while(list($osoitteenid, $osoite)= $kyselyntulos->fetch_row()){
                        echo $osoitteenid.' '.$osoite;
                        if($osoite==$annettuosoite){
                            $osoitteenid=$osoitteenid;
                            $osoiteonjoolemassa=true;
                            break;
                        }
                    }
                }
                if($osoiteonjoolemassa==false){
                    
                    //Jos osavaltio on tyhjä, erillinen kysely
                    if($annettuosavaltio=="" || $annettuosavaltio==NULL){
                        $luoosoitekysely="INSERT INTO osoite (osoite,postinumero,postitoimipaikka,maa,maakunta,osavaltio) VALUES('$annettuosoite','$annettupostinumero','$annettupostitoimipaikka','$annettumaa','$annettumaakunta',NULL)";
                    }
                    else{
                        $luoosoitekysely="INSERT INTO osoite (osoite,postinumero,postitoimipaikka,maa,maakunta,osavaltio) VALUES('$annettuosoite','$annettupostinumero','$annettupostitoimipaikka','$annettumaa','$annettumaakunta','$annettuosavaltio')"; 
                    }
                    if($kyselyntulos=$connection->query($luoosoitekysely)){
                        
                            
                            //Jos osoitteen luonti onnistui, haetaan uuden osoitteen id, luodaan käyttäjätili ja uudelleenohjataan onnistumisella
                            $haeosoitteenidkysely="SELECT MAX(osoite_id) FROM osoite";
                            if($kyselyntulos = $connection->query($haeosoitteenidkysely)){
                                while(list($osoitteenid)= $kyselyntulos->fetch_row()){
                                    echo '<br>'.$osoitteenid; 
                                    $nykypäivämäärä=(string)(date_format(date_create(), 'Y-m-d H:i:s'));
                                    //TODO: Tarvitaan ehtotarkistukset työntekijän määrittämiseksi, jos uutta käyttäjää yritetään luoda ylläpitäjäksi kirjautuneena
                                    $luokäyttäjäkysely="INSERT INTO kayttajatili VALUES ('$annettukäyttäjänimi', '$annettusalasanahash', '$annettuetunimi', '$annettusukunimi','$annettupuhelinnumero','$annettusähköposti','$osoitteenid',TRUE,FALSE,'$nykypäivämäärä',NULL)";
                                }
                                try{
                                    if($kyselyntulos=$connection->query($luokäyttäjäkysely)){
                                        header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=kyllä');
                                    }
                                }catch(Exception $e){
                                    header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=ei');
                                }
                            }
                    }
                }
                else{
                    $nykypäivämäärä=(string)(date_format(date_create(), 'Y-m-d H:i:s'));
                    //TODO: Tarvitaan ehtotarkistukset työntekijän määrittämiseksi, jos uutta käyttäjää yritetään luoda ylläpitäjäksi kirjautuneena
                    $luokäyttäjäkysely="INSERT INTO kayttajatili VALUES ('$annettukäyttäjänimi', '$annettusalasanahash', '$annettuetunimi', '$annettusukunimi','$annettupuhelinnumero','$annettusähköposti','$osoitteenid',TRUE,FALSE,'$nykypäivämäärä',NULL)";
                
                    try{
                        if($kyselyntulos=$connection->query($luokäyttäjäkysely)){
                            header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=kyllä');
                        }
                    }catch(Exception $e){
                        header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=ei');
                    }
                }
            }
              
            else{
                //Uudelleenohjataan epäonnistumisella jos käyttäjä on jo olemassa
                header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=käyttäjäonjoolemassa');             
            }          
        }       
        else {
            echo "Tietokantavirhe: ".$connection->error;
        }
    }
    else {
        //salasana ja salasanan vahvistus eivät täsmää
        header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=salasanateivättäsmää');
    }
          
}
else{
    header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=ei');
}
    
?>
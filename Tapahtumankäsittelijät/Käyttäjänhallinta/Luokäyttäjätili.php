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
        $annettusähköposti=strtolower(trim($_POST['sähköposti']));
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

        
        $tietokantakysely->prepare("SELECT kayttajanimi FROM kayttajatili WHERE kayttajanimi=?");
        $tietokantakysely->bind_param("s",$annettukäyttäjänimi);

        if($tietokantakysely->execute()){
            while($tietokantakysely->fetch()){
                $tietokantakysely->bind_result($käyttäjänimi);
                
                
                
                if($annettukäyttäjänimi==$käyttäjänimi){
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
                $tietokantakysely->prepare("SELECT osoite_id, osoite FROM osoite WHERE osoite=?");
                $tietokantakysely->bind_param("s",$annettuosoite);
                if($tietokantakysely->execute()){
                    $tietokantakysely->bind_result($osoitteenid, $osoite);
                    while($tietokantakysely->fetch()){
                        
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
                        $asetaosoitetietokantakysely=$connection->prepare("INSERT INTO osoite (osoite,postinumero,postitoimipaikka,maa,maakunta,osavaltio) VALUES(?,?,?,?,?,NULL)");
                        $asetaosoitetietokantakysely->bind_param("sssss",$annettuosoite,$annettupostinumero,$annettupostitoimipaikka,$annettumaa,$annettumaakunta);
                    }
                    else{
                        $asetaosoitetietokantakysely=$connection->prepare("INSERT INTO osoite (osoite,postinumero,postitoimipaikka,maa,maakunta,osavaltio) VALUES(?,?,?,?,?,?)"); 
                        $asetaosoitetietokantakysely->bind_param("ssssss",$annettuosoite,$annettupostinumero,$annettupostitoimipaikka,$annettumaa,$annettumaakunta,$annettuosavaltio);
                    }
                    if($asetaosoitetietokantakysely->execute()){
                        
                            $asetaosoitetietokantakysely->store_result();
                            //Jos osoitteen luonti onnistui, haetaan uuden osoitteen id, luodaan käyttäjätili ja uudelleenohjataan onnistumisella
                            $haeosoitteenidkysely=$connection->prepare("SELECT MAX(osoite_id) FROM osoite");
                            if($haeosoitteenidkysely->execute()){
                                $haeosoitteenidkysely->store_result();
                                $haeosoitteenidkysely->bind_result($osoitteenid);
                                while($haeosoitteenidkysely->fetch()){
                                    echo '<br>'.$osoitteenid; 
                                    $nykypäivämäärä=(string)(date_format(date_create(), 'Y-m-d H:i:s'));
                                    //TODO: Tarvitaan ehtotarkistukset työntekijän määrittämiseksi, jos uutta käyttäjää yritetään luoda ylläpitäjäksi kirjautuneena
                                    $luokäyttäjäkysely=$connection->prepare("INSERT INTO kayttajatili VALUES (?,?,?,?,?,?,?,TRUE,FALSE,?,NULL)");
                                    $luokäyttäjäkysely->bind_param("ssssssid",$annettukäyttäjänimi,$annettusalasanahash,$annettuetunimi,$annettusukunimi,$annettupuhelinnumero,$annettusähköposti,$osoitteenid,$nykypäivämäärä);
                                }
                                try{
                                    if($luokäyttäjäkysely->execute()){
                                        header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=kyllä');
                                    }
                                }catch(Exception $e){
                                    header('Location: ../../index.php?sivu=rekisteröintilomake&rekisteröintionnistui=ei');
                                }
                                $haeosoitteenidkysely->free_result();
                            }
                            $asetaosoitetietokantakysely->free_result();
                    }
                }
                else{
                    $nykypäivämäärä=(string)(date_format(date_create(), 'Y-m-d H:i:s'));
                    //TODO: Tarvitaan ehtotarkistukset työntekijän määrittämiseksi, jos uutta käyttäjää yritetään luoda ylläpitäjäksi kirjautuneena
                    $luokäyttäjäkysely=$connection->prepare("INSERT INTO kayttajatili VALUES (?,?,?,?,?,?,?,TRUE,FALSE,?,NULL)");
                    $luokäyttäjäkysely->bind_param("ssssssid",$annettukäyttäjänimi,$annettusalasanahash,$annettuetunimi,$annettusukunimi,$annettupuhelinnumero,$annettusähköposti,$osoitteenid,$nykypäivämäärä);
                    try{
                        if($luokäyttäjäkysely->execute()){
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
            echo "Tietokantavirhe: käyttäjänimen etsintäkysely epäonnistui ".$connection->error;
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
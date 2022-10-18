<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<?php
    
    require_once('Tapahtumankäsittelijät/Tietokantayhteys.php');
    
    //muista minut- eväste
    if(isset($_COOKIE["muistaminut"])){
        require_once('Tapahtumankäsittelijät/tarkistaautentikaatiotoken.php');
    }
    
    require_once('Grafiikkakomponentit/header.php');
    
    //echo '<b>'.$_SERVER['PHP_SELF'].'</b>';
    //$currentdate=date_create();
    //echo (string)date_format($currentdate, 'Y-m-d H:i:s');
    
?>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>-->
<?php
    
    require_once('Grafiikkakomponentit/navigointipalkki.php');
    switch($_GET['sivu']){

        case 'etusivu':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                }
            }
            if(isset($_GET['autentikaatioonnistui'])){
                if($_GET['autentikaatioonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['autentikaatioonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                }
            }
            if(isset($_GET['tietokantavirhe'])){
                echo "<br><span class=\"errormessage\">Virhe käyttäjän muistamisen tarkistuksessa <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
            }
            require_once('Grafiikkakomponentit/Etusivu.php');       
            break;
        
        case 'tuotteet':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=tuotteet\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=tuotteet\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Tuotteet.php');
            break;
        
        case 'sisäkasvit':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=sisäkasvit\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=sisäkasvit\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Sisäkasvit.php');
            break;
        
        case 'ulkokasvit':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=ulkokasvit\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=ulkokasvit\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Ulkokasvit.php');
            break;
        
        case 'työkalut':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=työkalut\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=työkalut\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Työkalut.php');
            break;
        
        case 'kasvienhoito':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=kasvienhoito\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=kasvienhoito\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Kasvien hoito.php');
            break;
        
        case 'myymälät':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=myymälät\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=myymälät\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Myymälät.php');
            break;
        
        case 'tietoameistä':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=tietoameistä\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=tietoameistä\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Tietoa meistä.php');
            break;
        
        case 'otayhteyttä':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }
            }
            if(isset($_GET['palautteenlähetysonnistui'])){
                if($_GET['palautteenlähetysonnistui'] =='kyllä'){
                    echo "<br><span class=\"successmessage\">Palautteen lähetys onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }
                elseif($_GET['palautteenlähetysonnistui'] =='ei'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Ota yhteyttä.php');
            break;
        
        case 'kirjautumislomake': 
            if(isset($_GET["sisäänkirjautuminenonnistui"])){            
                if($_GET["sisäänkirjautuminenonnistui"] =="kyllä"){
                    echo "<br><span class=\"successmessage\">Kirjautuminen onnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                }
                elseif($_GET["sisäänkirjautuminenonnistui"] =="ei"){ 
                    echo "<br><span class=\"errormessage\">Kirjautuminen epäonnistui, väärä käyttäjänimi tai salasana<a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                }
                elseif($_GET['sisäänkirjautuminenonnistui'] =='tuntematonvirhe'){
                    echo "<br><span class=\"errormessage\">Sisäänkirjautuminen epäonnistui, tuntematon virhe, yritä uudestaan <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                }
            }
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                }         
            }
            require_once('Grafiikkakomponentit/kirjautumislomake.php');
            break;
        
        case 'unohtunutsalasanalomake':
            if(!isset($_SESSION['käyttäjänimi'])){
                if(isset($_GET['uloskirjautuminenonnistui'])){
                    if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
                        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                    }
                
                    elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
                        echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                    }
                }
                if(isset($_GET['salasananlähetysonnistui'])){ 
                    if($_GET['salasananlähetysonnistui'] == 'kyllä'){
                            echo "<br><span class=\"successmessage\">Unohtuneen salasanan vaihtolinkki sähköpostiosoitteeseen onnistui, tarkistakaa sähköpostinne <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                    }
                    elseif($_GET['salasananlähetysonnistui']=='ei' && $_GET['virhe'] == 'sähköpostivirhe'){
                        echo "<br><span class=\"errormessage\">Unohtuneen salasanan lähetys sähköpostiosoitteeseen epäonnistui, sähköpostia ei löytynyt <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                    }
                    elseif($_GET['salasananlähetysonnistui']=='ei' && $_GET['virhe'] == 'tietokantavirhe'){
                        echo "<br><span class=\"errormessage\">Unohtuneen salasanan lähetys sähköpostiosoitteeseen epäonnistui, tietokantavirhe <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                    }     
                }
                require_once('Grafiikkakomponentit/unohtunutsalasanalomake.php');
                echo "<h1>unohtunutsalasanalomake, GET-muuttujat:</h1>";
                    foreach($_GET as $avain => $arvo){
                        echo "<br><h2>$avain : $arvo</h2>";
                    }
            }
            else{
                echo "<br><span class=\"errormessage\">Unohtunutta salasanaa ei voida palauttaa sisäänkirjautuneena, kirjautukaa ulos ja yrittäkää uudelleen <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
            }
            break;
        
        case 'asetauusisalasanalomake':
            if(!isset($_SESSION['käyttäjänimi'])){
                if((isset($_GET['uloskirjautuminenonnistui']) || isset($_GET['sähköposti']) || isset($_GET['käyttäjänimi']) || isset($_SESSION["vaihtolinkinavausonnistui"]) || isset($_GET['salasananvaihtoonnistui']))){
                    if(isset($_GET['uloskirjautuminenonnistui'])){
                        if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                            echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                        }
                    
                        elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                            echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                        }
                    }
                    
                    if(isset($_GET['sähköposti']) && isset($_GET['käyttäjänimi'])){
                        //echo "<br><span class=\"errormessage\">Tarkistetaan sähköposti ja käyttäjänimi <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                        
                        require_once('Tapahtumankäsittelijät/käsittelevaihtolinkinavaus.php');
                    }
                    if(isset($_SESSION['vaihtolinkinavausonnistui'])){
                        
                        if($_SESSION['vaihtolinkinavausonnistui']==true){
                            if(isset($_SESSION["vaihdettavansalasanansähköposti"])){
                                echo "<br><span class=\"successmessage\">Salasanan vaihtolinkin avaus onnistui, avauslinkkisivu kannattaa poistaa salasanan asetuksen jälkeen sivuhistoriasta</span>";
                                require_once('Grafiikkakomponentit/asetauusisalasanalomake.php');
                                //header('Location: ./index.php?sivu=asetauusisalasanalomake');
                            }
                        }
                        elseif($_SESSION['vaihtolinkinavausonnistui']==false){
                            
                            if(!isset($_GET['tietokantavirhe'])){
                                echo "<br><span class=\"errormessage\">Salasanan vaihtolinkin avaus epäonnistui, käyttäjää ei löydetty linkin perusteella <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                                session_destroy();
                            }
                    
                            else{
                                echo "<br><span class=\"errormessage\">Salasanan vaihtolinkin avaus epäonnistui, tietokantavirhe käyttäjää haettaessa <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                                session_destroy();
                            }
                        }
                        unset($_SESSION['vaihtolinkinavausonnistui']);
                        
                    }

                    if(isset($_GET['salasananvaihtoonnistui'])){
                        if($_GET['salasananvaihtoonnistui']=="kyllä"){
                            echo "<br><span class=\"successmessage\">Salasanan vaihto onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                            session_destroy();
                        }
                        elseif($_GET['salasananvaihtoonnistui']=="ei"){
                            if(!isset($_GET['tietokantavirhe'])){
                                if(isset($_GET['oikeavanhasalasana'])){
                                    if($_GET['oikeavanhasalasana']=="kyllä"){
                                        echo "<br><span class=\"errormessage\">Salasanan vaihto epäonnistui, uusi salasana ja uuden salasanan vahvistus eivät täsmää <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                                        session_destroy();
                                    }
                                    else{
                                        echo "<br><span class=\"errormessage\">Salasanan vaihto epäonnistui, väärä vanha salasana <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                                        session_destroy();
                                    }
                                }
                            
                            }

                            else{
                                echo "<br><span class=\"errormessage\">Salasanan vaihto epäonnistui, tietokantavirhe <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                                session_destroy();
                            }
                        }
                    }
                        
                    /*echo "<h1>Asetauusisalasanalomake, GET-muuttujat:</h1>";
                    foreach($_GET as $avain => $arvo){
                        echo "<br><h2>$avain : $arvo</h2>";
                    }
                    echo "<h1>Asetauusisalasanalomake, SESSION-muuttujat:</h1>";
                    foreach($_SESSION as $avain => $arvo){
                        echo "<br><h2>$avain : $arvo</h2>";
                    }*/ 
                    unset($_SESSION['vaihtolinkinavausonnistui']);
                }
                else{
                    echo "<br><span class=\"errormessage\">Uuden salasanan vaihtolomaketta ei voida avata suoraan, menkää \"Oletko unohtanut salasanasi\"-sivustolle josta voidaan lähettää toimiva avauslinkki käyttäjän sähköpostiin <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                
                    //echo "<h1>Asetauusisalasanalomake, GET-muuttujat:</h1>";
                    //foreach($_GET as $avain => $arvo){
                    //    echo "<br><h2>$avain : $arvo</h2>";
                    //}
                    echo "<h1>Asetauusisalasanalomake, SESSION-muuttujat:</h1>";
                    foreach($_SESSION as $avain => $arvo){
                        echo "<br><h2>$avain : $arvo</h2>";
                    }
                }
            }
            else{
                echo "<br><span class=\"errormessage\">Uuden salasanan vaihtolomaketta ei voida avata sisäänkirjautuneena, kirjautukaa ulos ja yrittäkää uudelleen <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
            }     
            break;
            
        
        case 'rekisteröintilomake':
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=rekisteröintilomake\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=rekisteröintilomake\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/rekisteröintilomake.php');
            break;
        default:
            require_once('Grafiikkakomponentit/Etusivu.php');
    }
?>

</body>


<?php
    require_once('Grafiikkakomponentit/alatunniste.php');
?>
</html>
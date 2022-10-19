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
        require_once('Tapahtumankäsittelijät/Käyttäjänhallinta/tarkistaautentikaatiotoken.php');
    }

    echo "<h1> COOKIE-muuttujat:</h1>";
                    foreach($_COOKIE as $avain => $arvo){
                        echo "<br><h2>$avain : $arvo</h2>";
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
    if(isset($_GET['sivu'])){
        switch($_GET['sivu']){

            case 'etusivu':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_etusivu.php');
                require_once('Grafiikkakomponentit/Etusivu.php');       
                break;
            
            case 'tuotteet':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_tuotteet.php');
                require_once('Grafiikkakomponentit/Tuotteet.php');
                break;
            
            case 'sisäkasvit':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_sisäkasvit.php');
                require_once('Grafiikkakomponentit/Sisäkasvit.php');
                break;
            
            case 'ulkokasvit':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_ulkokasvit.php');
                require_once('Grafiikkakomponentit/Ulkokasvit.php');
                break;
            
            case 'työkalut':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_työkalut.php');
                require_once('Grafiikkakomponentit/Työkalut.php');
                break;
            
            case 'kasvienhoito':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_kasvienhoito.php');
                require_once('Grafiikkakomponentit/Kasvien hoito.php');
                break;
            
            case 'myymälät':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_myymälät.php');
                require_once('Grafiikkakomponentit/Myymälät.php');
                break;
            
            case 'tietoameistä':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_tietoameistä.php');
                require_once('Grafiikkakomponentit/Tietoa meistä.php');
                break;
            
            case 'otayhteyttä':
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_otayhteyttä.php');
                require_once('Grafiikkakomponentit/Ota yhteyttä.php');
                break;
            
            case 'kirjautumislomake': 
                if(!isset($_SESSION['käyttäjänimi'])){
                    require_once('Grafiikkakomponentit/Virheviestit/virheviestit_kirjautumislomake.php');
                    require_once('Grafiikkakomponentit/kirjautumislomake.php');
                }
                else{
                    echo "<br><span class=\"errormessage\">Olette jo kirjautuneet, kirjautumislomaketta ei voida näyttää, kirjautukaa ensin ulos <a href=\"./index.php?sivu=etusivu\">PALAA ETUSIVULLE</a></span>";
                }
                break;
            
            case 'unohtunutsalasanalomake':
                if(!isset($_SESSION['käyttäjänimi'])){
                    require_once('Grafiikkakomponentit/Virheviestit/virheviestit_unohtunutsalasanalomake.php');
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
                            
                            require_once('Tapahtumankäsittelijät/Käyttäjänhallinta/käsittelevaihtolinkinavaus.php');
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
                                }
                                else{
                                    echo "<br><span class=\"errormessage\">Salasanan vaihtolinkin avaus epäonnistui, tietokantavirhe käyttäjää haettaessa <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";     
                                }
                                session_destroy();
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
                                        }
                                        else{
                                            echo "<br><span class=\"errormessage\">Salasanan vaihto epäonnistui, väärä vanha salasana <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";                                   
                                        }
                                        session_destroy();
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
                require_once('Grafiikkakomponentit/Virheviestit/virheviestit_rekisteröintilomake.php');
                require_once('Grafiikkakomponentit/rekisteröintilomake.php');
                break;
            default:
                require_once('Grafiikkakomponentit/Etusivu.php');
        }
    }
    require_once('Grafiikkakomponentit/Etusivu.php');
?>

</body>


<?php
    require_once('Grafiikkakomponentit/alatunniste.php');
?>
</html>
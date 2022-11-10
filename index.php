<?php 
    require './vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $DOTENVDATA=$dotenv->load();
    //foreach($DOTENVDATA as $key => $value){
    //    echo $key.' '.$value;
    //}
    
    //foreach($_ENV as $key => $value){
    //   echo '<br>'.$key.' '.$value;
    //}

    //exit();
    
    require_once('Tapahtumankäsittelijät/Tietokantayhteys.php');
    
    
    //muista minut- eväste
    if(isset($_COOKIE['muistaminut'])){
        require_once('Tapahtumankäsittelijät/Käyttäjänhallinta/tarkistaautentikaatiotoken.php');
    }
    else{
        require_once('Tapahtumankäsittelijät/Käyttäjänhallinta/poistavanhatautentikaatiotokenit.php');
    }
    
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<?php
                     
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


    if(isset($_COOKIE['muistaminut'])){
        echo "Muista minut-eväste asetettu, tarkistetaan autentikaatiotoken";
    }
    /*echo "<h3> COOKIE-muuttujat:</h3>";
    foreach($_COOKIE as $avain => $arvo){
        echo "<br><h5>$avain : $arvo</h5>";
    }
    echo "<h3> SESSION-muuttujat:</h3>";
    foreach($_SESSION as $avain => $arvo){
        echo "<br><h5>$avain : $arvo</h5>";
    }*/
    
    require_once('Grafiikkakomponentit/navigointipalkki.php');
    if(isset($_GET['sivu'])){
        switch($_GET['sivu']){

            case 'etusivu':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_etusivu.php');
                require_once('Grafiikkakomponentit/Etusivu.php');       
                break;
            
            case 'tuotteet':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_tuotteet.php');
                require_once('Grafiikkakomponentit/Tuotteet.php');
                break;
            
            case 'sisäkasvit':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_sisäkasvit.php');
                require_once('Grafiikkakomponentit/Sisäkasvit.php');
                break;
            
            case 'ulkokasvit':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_ulkokasvit.php');
                require_once('Grafiikkakomponentit/Ulkokasvit.php');
                break;
            
            case 'työkalut':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_työkalut.php');
                require_once('Grafiikkakomponentit/Työkalut.php');
                break;
            
            case 'kasvienhoito':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_kasvienhoito.php');
                require_once('Grafiikkakomponentit/Kasvien hoito.php');
                break;
            
            case 'myymälät':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_myymälät.php');
                require_once('Grafiikkakomponentit/Myymälät.php');
                break;
            
            case 'tietoameistä':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_tietoameistä.php');
                require_once('Grafiikkakomponentit/Tietoa meistä.php');
                break;
            
            case 'otayhteyttä':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_otayhteyttä.php');
                require_once('Grafiikkakomponentit/Ota yhteyttä.php');
                break;
            
            case 'kirjautumislomake': 
                if(!isset($_SESSION['käyttäjänimi'])){
                    require_once('Grafiikkakomponentit/Ilmoitusviestit/kirjautumislomake/sisäänjauloskirjautuminen.php');
                    require_once('Grafiikkakomponentit/kirjautumislomake.php');
                }
                else{
                    require_once('Grafiikkakomponentit/Ilmoitusviestit/kirjautumislomake/sisäänkirjauduttu.php');
                }
                break;
            
            case 'unohtunutsalasanalomake':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/unohtunutsalasanalomake/uloskirjautuminenjasalasananlähetys.php');
                
                if(!isset($_SESSION['käyttäjänimi'])){
                    require_once('Grafiikkakomponentit/unohtunutsalasanalomake.php');
                    /*echo "<h1>unohtunutsalasanalomake, GET-muuttujat:</h1>";
                        foreach($_GET as $avain => $arvo){
                            echo "<br><h2>$avain : $arvo</h2>";
                        }*/
                }
                else{  
                     require_once('Grafiikkakomponentit/Ilmoitusviestit/unohtunutsalasanalomake/sisäänkirjauduttu.php');
                }
                break;
            
            case 'asetauusisalasanalomake':
                if(!isset($_SESSION['käyttäjänimi'])){
                    if((isset($_GET['uloskirjautuminenonnistui']) || isset($_GET['sähköposti']) || isset($_GET['käyttäjänimi']) || isset($_SESSION["vaihtolinkinavausonnistui"])  || isset($_GET['salasananvaihtoonnistui']))){
                        require_once('Grafiikkakomponentit/Ilmoitusviestit/asetauusisalasanalomake/uloskirjautuminen.php');
                        
                        if(isset($_GET['sähköposti']) && isset($_GET['käyttäjänimi'])){
                        
                            
                            require_once('Tapahtumankäsittelijät/Käyttäjänhallinta/käsittelevaihtolinkinavaus.php');
                        }
                        if(isset($_SESSION['vaihtolinkinavausonnistui'])){                        
                            if($_SESSION['vaihtolinkinavausonnistui']==true){
                                if(isset($_SESSION["vaihdettavansalasanansähköposti"])){
                                    require_once('Grafiikkakomponentit/Ilmoitusviestit/asetauusisalasanalomake/vaihtolinkinavausonnistui.php');
                                    require_once('Grafiikkakomponentit/asetauusisalasanalomake.php');
                                    
                                }
                            }
                            elseif($_SESSION['vaihtolinkinavausonnistui']==false){
                                require_once('Grafiikkakomponentit/Ilmoitusviestit/asetauusisalasanalomake/vaihtolinkinavausepäonnistui.php');
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
                                    if(isset($_GET['oikeasähköposti'])){
                                        require_once('Grafiikkakomponentit/Ilmoitusviestit/asetauusisalasanalomake/salasananvaihtoepäonnistui_sähköposti.php');
                                        session_destroy();
                                    }
                                }
                                else{
                                    require_once('Grafiikkakomponentit/Ilmoitusviestit/asetauusisalasanalomake/salasananvaihtoepäonnistui_tietokantavirhe.php');
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
                        require_once('Grafiikkakomponentit/Ilmoitusviestit/asetauusisalasanalomake/eivoiavatasuoraan.php');
                    }
                }
                else{
                    require_once('Grafiikkakomponentit/Ilmoitusviestit/asetauusisalasanalomake/sisäänkirjauduttu.php');
                }     
                break;        
            case 'rekisteröintilomake':
                require_once('Grafiikkakomponentit/Ilmoitusviestit/Ilmoitusviestit_rekisteröintilomake.php');
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
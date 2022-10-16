<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<?php
    
    require_once('Tapahtumankäsittelijät/Tietokantayhteys.php');
    
    
    
    require_once('Grafiikkakomponentit/header.php');
    //echo '<b>'.$_SERVER['PHP_SELF'].'</b>';
    $currentdate=date_create();
    echo (string)date_format($currentdate, 'Y-m-d H:i:s');
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
                    if(isset($_GET['sähköposti'])){
                        echo "<br><span class=\"successmessage\">Unohtuneen salasanan lähetys sähköpostiosoitteeseen ". $_GET['sähköposti']." onnistui <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                    }
                }
                elseif($_GET['salasananlähetysonnistui']=='ei' && $_GET['virhe'] == 'sähköpostivirhe'){
                    echo "<br><span class=\"errormessage\">Unohtuneen salasanan lähetys sähköpostiosoitteeseen epäonnistui, sähköpostia ei löytynyt <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                }
                elseif($_GET['salasananlähetysonnistui']=='ei' && $_GET['virhe'] == 'tietokantavirhe'){
                    echo "<br><span class=\"errormessage\">Unohtuneen salasanan lähetys sähköpostiosoitteeseen epäonnistui, tietokantavirhe <a href=\"./index.php?sivu=unohtunutsalasanalomake\">PÄIVITÄ SIVU</a></span>";
                }     
            }
            require_once('Grafiikkakomponentit/unohtunutsalasanalomake.php');
            break;
        case 'asetauusisalasanalomake':
            echo "<h1>GET-muuttujat:</h1>";
            foreach($_GET as $avain => $arvo){
                echo "<br><h2>$avain : $arvo</h2>";
            }
            if(isset($_GET['uloskirjautuminenonnistui'])){
                if($_GET['uloskirjautuminenonnistui']=='kyllä'){
                    echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                }
              
                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                }
            }

            
            if(isset($_GET['sähköposti']) && isset($_GET['käyttäjänimi'])){
                echo "<br><span class=\"errormessage\">Tarkistetaan sähköposti ja käyttäjänimi <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                require_once('Tapahtumankäsittelijät/käsittelevaihtolinkinavaus.php');
            }
            if(isset($_GET['vaihtolinkinavausonnistui'])){
                if($_GET['linkinavausonnistui']=="kyllä"){
                    echo "<br><span class=\"errormessage\">Salasanan vaihtolinkin avaus onnistui <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                    header('Location: ./index.php?sivu=asetauusisalasanalomake');
                }
                elseif($_GET['vaihtolinkinavausonnistui']=="ei"){
                    echo "<br><span class=\"errormessage\">Salasanan vaihtolinkin avaus epäonnistui, tietokantavirhe käyttäjätietoja haettaessa <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                }  
            }

            if(isset($_GET['salasananvaihtoonnistui'])){
                if($_GET['salasananvaihtoonnistui']=="kyllä"){
                echo "<br><span class=\"errormessage\">Salasanan vaihto onnistui <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
            }
                elseif($_GET['salasananvaihtoonnistui']=="ei"){
                    echo "<br><span class=\"errormessage\">Salasanan vaihto epäonnistui, tietokantavirhe <a href=\"./index.php?sivu=asetauusisalasanalomake\">PÄIVITÄ SIVU</a></span>";
                }  
            }
                require_once('Grafiikkakomponentit/asetauusisalasanalomake.php');
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
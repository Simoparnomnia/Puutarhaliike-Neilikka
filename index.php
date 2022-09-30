<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<?php
    
    require_once('Tapahtumankäsittelijät/Tietokantayhteys.php');
    if(isset($_SESSION['käyttäjänimi'])){
      session_start();
    }
    
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
                    echo "<br><span class=\"successmessage\">Kirjautuminen onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                }

                elseif($_GET['uloskirjautuminenonnistui']=='ei'){
                    echo "<br><span class=\"errormessage\">Kirjautuminen onnistui <a href=\"./index.php?sivu=etusivu\">PÄIVITÄ SIVU</a></span>";
                }
            }
            require_once('Grafiikkakomponentit/Etusivu.php');
            break;
        case 'tuotteet':
            require_once('Grafiikkakomponentit/Tuotteet.php');
            break;
        case 'sisäkasvit':
            require_once('Grafiikkakomponentit/Sisäkasvit.php');
            break;
        case 'ulkokasvit':
            require_once('Grafiikkakomponentit/Ulkokasvit.php');
            break;
        case 'työkalut':
            require_once('Grafiikkakomponentit/Työkalut.php');
            break;
        case 'kasvienhoito':
            require_once('Grafiikkakomponentit/Kasvien hoito.php');
            break;
        case 'myymälät':
            require_once('Grafiikkakomponentit/Myymälät.php');
            break;
        case 'tietoameistä':
            require_once('Grafiikkakomponentit/Tietoa meistä.php');
            break;
        case 'otayhteytta':
            require_once('Grafiikkakomponentit/Ota yhteyttä.php');
            break;
        case 'kirjautumislomake':
                echo "<p><b>käyttäjänimi:</b>".$_SESSION['käyttäjänimi']."</p>";
                    if(isset($_SESSION["käyttäjänimi"])){
                        if(isset($_SESSION["käyttäjänimi"])){
                            echo "<br><span class=\"successmessage\">Kirjautuminen onnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                        }
                        else{
                            
                            echo "<br><span class=\"errormessage\">Kirjautuminen epäonnistui, väärä käyttäjänimi tai salasana<a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                        }
                    }
            require_once('Grafiikkakomponentit/kirjautumislomake.php');
            break;
        case 'rekisteröintilomake':
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
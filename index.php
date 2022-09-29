<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<?php
    
    require_once('Omatmoduulit/Tietokantayhteys.php');
    if(isset($_SESSION['kayttajanimi'])){
      session_start();
    }
    
    require_once('Grafiikkakomponentit/header.php');
    
?>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

<?php
    require_once('Grafiikkakomponentit/navigointipalkki.php');
    switch($_GET['sivu']){

        case 'etusivu':
            require_once('Grafiikkakomponentit/Etusivu.php');
        case 'tuotteet':
            require_once('Grafiikkakomponentit/Tuotteet.php');
        case 'sisäkasvit':
            require_once('Grafiikkakomponentit/Sisäkasvit.php');
        case 'ulkokasvit':
            require_once('Grafiikkakomponentit/Ulkokasvit.php');
        case 'työkalut':
            require_once('Grafiikkakomponentit/Työkalut.php');
        case 'kasvienhoito':
            require_once('Grafiikkakomponentit/Kasvien hoito.php');
        case 'myymälät':
            require_once('Grafiikkakomponentit/Myymälät.php');
        case 'tietoameistä':
            require_once('Grafiikkakomponentit/Tietoa meistä.php');
        case 'otayhteytta':
            require_once('Grafiikkakomponentit/Ota yhteyttä.php');
        case 'kirjautumislomake':
                //echo "<p><b>käyttäjänimi:</b>".$_SESSION['kayttajanimi']."</p>";
                    if(isset($_GET["oikeattunnukset"])){
                        if($_GET["oikeattunnukset"]=="kylla"){
                            echo "<br><span class=\"successmessage\">Kirjautuminen onnistui <a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                        }
                        else{
                            echo "<br><span class=\"errormessage\">Kirjautuminen epäonnistui, väärä käyttäjänimi tai salasana<a href=\"./index.php?sivu=kirjautumislomake\">PÄIVITÄ SIVU</a></span>";
                        }
                    }
            require_once('Grafiikkakomponentit/kirjautumislomake.php');
        case 'rekisteröintilomake':
            require_once('Grafiikkakomponentit/rekisteröintilomake.php');
        default:
            require_once('Grafiikkakomponentit/Etusivu.php');
    }
?>

</body>


<?php
    require_once('Grafiikkakomponentit/alatunniste.php');
?>
</html>
<?php

//if(isset($_SESSION['käyttäjänimi'])){
//  session_start();
//}

//Suositellaan basenamen sijasta windows/linux-yhteensopivuuden takaamiseksi
function mb_basename($path) {
  if (preg_match('@^.*[\\\\/]([^\\\\/]+)$@s', $path, $matches)) {
      return $matches[1];
  } else if (preg_match('@^([^\\\\/]+)$@s', $path, $matches)) {
      return $matches[1];
  }
  return '';
}
?>

        <span id="pagelogo"/>
        <span id="companytitle"><a href="./index.php?sivu=etusivu">Puutarhaliike Neilikka</a></span>

<?php
  if(str_contains($_SERVER['QUERY_STRING'], '&')){
    //explodea/implodea tarvitaan koska kyselymuuttujien hasheissa voi olla kenoviiva, jolloin mb_basename luulee jonkin hashin osaa koko query_stringiksi
    $vainsivumuuttuja=strstr(mb_basename(implode(explode("/",$_SERVER['QUERY_STRING']))),'&',true);
    //echo $vainsivumuuttuja;
    $nykyinensivu=rawurldecode(substr(strstr($vainsivumuuttuja,'=',false),1)); 
    
  }
  else{
    $nykyinensivu=rawurldecode(substr(strstr($_SERVER['QUERY_STRING'],'=',false),1));
  }
  
?>
        <div id="main-nav">
            <ul>
              <li><a href="./index.php?sivu=etusivu" <?php if($nykyinensivu == 'etusivu'){echo 'id="here"';}?>>Etusivu</a></li>
              <li><a href="./index.php?sivu=tuotteet" <?php if($nykyinensivu == 'tuotteet'){echo 'id="here"';}?>>Tuotteet</a>
                <ul class="submenu">
                  <li><a href="./index.php?sivu=sisäkasvit" <?php if($nykyinensivu == 'sisäkasvit'){echo 'id="here"';}?>>Sisäkasvit</a></li>
                  <li><a href="./index.php?sivu=ulkokasvit" <?php if($nykyinensivu == 'ulkokasvit'){echo 'id="here"';}?>>Ulkokasvit</a></li>
                  <li><a href="./index.php?sivu=työkalut" <?php if($nykyinensivu == 'työkalut'){echo 'id="here"';}?>>Työkalut</a></li>
                  <li><a href="./index.php?sivu=kasvienhoito" <?php if($nykyinensivu == 'kasvienhoito'){echo 'id="here"';}?>>Kasvien hoito</a></li>
                </ul>	
              </li>
              <li><a href="./index.php?sivu=myymälät" <?php if($nykyinensivu == 'myymälät'){echo 'id="here"';}?>>Myymälät</a></li>
              <li><a href="./index.php?sivu=tietoameistä" <?php if($nykyinensivu == 'tietoameistä'){echo 'id="here"';}?>>Tietoa meistä</a></li>
              <li><a href="./index.php?sivu=otayhteyttä" <?php if($nykyinensivu == 'otayhteyttä'){echo 'id="here"';}?>>Ota yhteyttä</a></li>
            </ul>
          <div style="display:inline-block;">
          <ul>

<?php          
          if(isset($_SESSION['käyttäjänimi'])){
            echo "<li class=\"loginandsignupbuttons\">Käyttäjä: ".$_SESSION['käyttäjänimi']."</li>";
          }
          else{
            echo "<li style=\"color:grey; list-style-type:none\">Ei kirjauduttu sisään</li>";
          }
?>
<?php
          if(!isset($_SESSION['käyttäjänimi'])){
            if($nykyinensivu=="kirjautumislomake"){
              echo "<li class=\"loginandsignupbuttons\"><a href=".("./index.php?sivu=kirjautumislomake")." id=\"here\">Kirjaudu sisään</a></li>";
            }
            else{
              echo "<li class=\"loginandsignupbuttons\"><a href=".("./index.php?sivu=kirjautumislomake").">Kirjaudu sisään</a></li>";
            }
          }
          else{
            echo "<li class=\"loginandsignupbuttons\"><a href=\"Tapahtumankäsittelijät/Käyttäjänhallinta/käsitteleuloskirjautuminen.php?kirjauduulos=kyllä\">Kirjaudu ulos</a></li>";
          }
          if($nykyinensivu=="rekisteröintilomake"){
             echo "<li class=\"loginandsignupbuttons\"><a href=\"index.php?sivu=rekisteröintilomake\" id=\"here\">Rekisteröidy</a></li>";
          }
          else{
           echo "<li class=\"loginandsignupbuttons\"><a href=\"index.php?sivu=rekisteröintilomake\">Rekisteröidy</a></li>";
          }
?>
<?php
if(!isset($_SESSION['käyttäjänimi'])){
  if($nykyinensivu=="unohtunutsalasanalomake"){
    echo "<li class=\"loginandsignupbuttons\"><a href=\"./index.php?sivu=unohtunutsalasanalomake\" id=\"here\"><b>Oletko unohtanut salasanasi?</b></a></li>";
  }
  else{
    echo "<li class=\"loginandsignupbuttons\"><a href=\"./index.php?sivu=unohtunutsalasanalomake\"><b>Oletko unohtanut salasanasi?</b></a></li>";
  }
}
?>
          </ul></div>
          </div>
  

    

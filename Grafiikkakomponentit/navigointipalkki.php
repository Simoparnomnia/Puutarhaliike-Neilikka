<?php

//if(isset($_SESSION['käyttäjänimi'])){
//  session_start();
//}

?>

        <span id="pagelogo"/>
        <span id="companytitle"><a href="./index.php?sivu=etusivu">Puutarhaliike Neilikka</a></span>

        <div id="main-nav">
            <ul>
              <li><a href="./index.php?sivu=etusivu">Etusivu</a></li>
              <li><a href="./index.php?sivu=tuotteet">Tuotteet</a>
                <ul class="submenu">
                  <li><a href="./index.php?sivu=sisäkasvit">Sisäkasvit</a></li>
                  <li><a href="./index.php?sivu=ulkokasvit">Ulkokasvit</a></li>
                  <li><a href="./index.php?sivu=työkalut">Työkalut</a></li>
                  <li><a href="./index.php?sivu=kasvienhoito">Kasvien hoito</a></li>
                </ul>	
              </li>
              <li><a href="./index.php?sivu=myymälät">Myymälät</a></li>
              <li><a href="./index.php?sivu=tietoameistä">Tietoa meistä</a></li>
              <li><a href="./index.php?sivu=otayhteyttä">Ota yhteyttä</a></li>
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
            echo "<li class=\"loginandsignupbuttons\"><a href=".("./index.php?sivu=kirjautumislomake").">Kirjaudu sisään</a></li>";
          }
          else{
            echo "<li class=\"loginandsignupbuttons\"><a href=\"Tapahtumankäsittelijät/käsitteleuloskirjautuminen.php?kirjauduulos=kyllä\">Kirjaudu ulos</a></li>";
          }
?>
            <li class="loginandsignupbuttons"><a href="index.php?sivu=rekisteröintilomake">Rekisteröidy</a></li>

<?php
if(!isset($_SESSION['käyttäjänimi'])){
  echo "<li class=\"loginandsignupbuttons\"><a href=\"./index.php?sivu=unohtunutsalasanalomake\"><b>Oletko unohtanut salasanasi?</b></a></li>";
}
?>
          </ul></div>
          </div>
  

    

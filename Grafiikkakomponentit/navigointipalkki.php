

        <span id="pagelogo"/>
        <span id="companytitle">Puutarhaliike Neilikka</span>

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
              <li><a href="./index.php?sivu=myymalat">Myymälät</a></li>
              <li><a href="./index.php?sivu=tietoameistä">Tietoa meistä</a></li>
              <li><a href="./index.php?sivu=otayhteyttä">Ota yhteyttä</a></li>
            </ul>
          <div style="display:inline-block;">
          <ul>
<?php
          if(!isset($_SESSION['kayttajanimi'])){
            echo "<li><a href=".("./index.php?sivu=kirjautumislomake").">Kirjaudu sisään</a></li>";
          }
          else{
            echo "<li><a href=\"käsitteleuloskirjautuminen.php\">Kirjaudu ulos</a></li>";
          }
?>
            <li><a href="index.php?sivu=rekisteröintilomake">Rekisteröidy</a></li>
          </ul></div>
          </div>
  

    





<div id="pagecontent">
<?php
  if(isset($_GET['rekisteröintionnistui'])){
    if($_GET['rekisteröintionnistui']=="kyllä"){
      echo "<br><span class=\"successmessage\">Käyttäjän luonti onnistui <a href=\"index.php?sivu=rekisteröintilomake\">PÄIVITÄ SIVU</a></span>";
    }
    elseif($_GET['rekisteröintionnistui']=="käyttäjäonjoolemassa"){
      echo "<br><span class=\"errormessage\">Käyttäjän luonti epäonnistui, käyttäjä on jo olemassa <a href=\"index.php?sivu=rekisteröintilomake\">PÄIVITÄ SIVU</a></span>";
    }
    elseif($_GET['rekisteröintionnistui']=="salasanateivättäsmää"){
      echo "<br><span class=\"errormessage\">Käyttäjän luonti epäonnistui, salasanat eivät täsmää <a href=\"index.php?sivu=rekisteröintilomake\">PÄIVITÄ SIVU</a></span>";
    }
    else{
      echo "<br><span class=\"errormessage\">Tuntematon virhe käyttäjän luonnissa <a href=\"index.php?sivu=rekisteröintilomake.php\">PÄIVITÄ SIVU</a></span>";
    }
  }

?>
   <p>
      <form method="post" action="./Tapahtumankäsittelijät/Luokäyttäjätili.php">
      <br><b>Etunimi</b> <input type="text" name="etunimi" id="etunimi" pattern="[a-z]{8,}$"required><br>
      <br><b>Sukunimi</b> <input type="text" name="sukunimi" id="sukunimi" pattern="[a-z]{8,}$"required><br>
      <br><b>Puhelinnumero</b> <input type="text" name="käyttäjänimi" id="käyttäjänimi" pattern="[0-9]{8,}$"required><br>
      
      <br><b>Käyttäjänimi (sisällettävä vähintään 8 merkkiä)</b> <input type="text" name="käyttäjänimi" id="käyttäjänimi" pattern="[a-z]{8,}$"required>  <br>   
      <br><b>Salasana (sisällettävä ainakin yksi numero ja yhteensä vähintään 8 merkkiä)</b> <input type="password" name="salasana" id="salasana" pattern="(?=.*[0-9])(?=.*[a-z]).{8,}"required>
      <br><b>Vahvista salasana</b> <input type="password" name="vahvistasalasana" id="vahvistasalasana" pattern="(?=.*[0-9])(?=.*[a-z]).{8,}"required>
      <input type="submit" name="luokäyttäjätili" id="luokäyttäjätili" value="Luo käyttäjä">
      </form>
  </p>


</div>


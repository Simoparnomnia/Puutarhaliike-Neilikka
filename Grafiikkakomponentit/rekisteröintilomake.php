



<div id="pagecontent">
<?php
  if(isset($_GET['rekisterointionnistui'])){
    if($_GET['rekisterointionnistui']=="kylla"){
      echo '<br><span class=\"successmessage\">Kirjautuminen onnistui <a href=\"./kirjautumislomake.php\">PÄIVITÄ SIVU</a></span>';
      unset($_GET['rekisterointionnistui']);
    }
    else{
      echo '<br><span class=\"errormessage\">Kirjautuminen epäonnistui <a href=\"./kirjautumislomake.php\">PÄIVITÄ SIVU</a></span>';
      unset($_GET['rekisterointionnistui']);
    }
  }

?>
   <p>
      <form method="post" action="./Omatmoduulit/Luokäyttäjätili.php">
      <br><b>Käyttäjänimi (sisällettävä vähintään 8 merkkiä)</b> <input type="text" name="kayttajanimi" id="kayttajanimi" pattern="[a-z]{8,}$"required>  <br>   
      <br><b>Salasana (sisällettävä ainakin yksi numero ja yhteensä vähintään 8 merkkiä)</b> <input type="text" name="salasana" id="salasana" pattern="(?=.*[0-9])(?=.*[a-z]).{8,}"required>
      <input type="submit" name="luokayttajatili" id="luokayttajatili" value="Luo käyttäjä">
      </form>
  </p>


</div>


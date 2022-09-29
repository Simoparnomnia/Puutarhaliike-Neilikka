
<div id="pagecontent">
  <p>
  Voit ottaa meihin yhteyttä
  </p>
  <p>
    <ul class="pagecontentlist">
      <li>puhelimitse yksittäisiin myymälöihin</li>
      <li>sähköpostitse: asiakaspalvelu@puutarhaliikeneilikka.fi</li>
      <li>alla olevalla lomakkeella</li>
    </ul>
  </p>  
  
  <p>
    <form method="post" action="./Omatmoduulit/Lähetäsähköposti_sendgrid_webapi.php">
    Nimi<input type="text" name="customername" id="customername">
    <br>Sähköpostiosoite<input type="email" name="customeremail" id="customeremail" pattern="^[\w._%+-]+@[\w.-]+\.[a-z]{2,}$"required>  <br>   
    <select name="feedbacktopic" id="feedbacktopic">
      <option value="Kysymys tuotteista">Kysymys tuotteista</option>
      <option value="Tilaus">Tilaus</option>
      <option value="Yhteydenottopyyntö">Yhteydenottopyyntö</option>
      <option value="other">Muu</option>
    </select>
    <br>Viesti<input type="text" name="feedbackmessage" id="feedbackmessage">
    Haluan tilata Puutarha Neilikan uutiskirjeen: 
    <br><input type="radio" name="newsletter" id="newsletter-yes" value="Kyllä" class="customradio">
    <label for="newsletter-yes">Kyllä</label>
    <input type="radio" name="newsletter" id="newsletter-no" value="Ei" class="customradio">
    <label for="newsletter-no">Ei</label><br>
    <input type="submit" name="submitfeedback" id="submitfeedback">
    </form>
  </p>
</div>
    
        

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
    <form method="post" action="./Omatmoduulit/Lähetäsähköposti.php?lomake=palaute?sähköpostipalvelu=mailtrap">
    Nimi<input type="text" name="nimi" id="nimi">
    <br>Sähköpostiosoite<input type="email" name="sähköposti" id="sähköposti" pattern="^[\w._%+-]+@[\w.-]+\.[a-z]{2,}$"required>  <br>   
    <select name="palauteaihe" id="palauteaihe">
      <option value="Kysymys tuotteista">Kysymys tuotteista</option>
      <option value="Tilaus">Tilaus</option>
      <option value="Yhteydenottopyyntö">Yhteydenottopyyntö</option>
      <option value="other">Muu</option>
    </select>
    <br>Viesti<input type="text" name="palauteviesti" id="palauteviesti">
    Haluan tilata Puutarha Neilikan uutiskirjeen: 
    <br><input type="radio" name="newsletter" id="newsletter-yes" value="Kyllä" class="customradio">
    <label for="newsletter-yes">Kyllä</label>
    <input type="radio" name="newsletter" id="newsletter-no" value="Ei" class="customradio">
    <label for="newsletter-no">Ei</label><br>
    <input type="submit" name="lomake" id="lomake" value="Lähetä palaute">
    </form>
  </p>
</div>
    
        
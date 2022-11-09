
<div id="pagecontent">
<form method="post" action=".\Tapahtumankäsittelijät\Käyttäjänhallinta\Käsittelesisäänkirjautuminen.php">
        <input type="text" name="käyttäjänimi" required/>
        <label><b>Käyttäjänimi</b></label>
        <input type="password" name="salasana" required/>
        <label><b>Salasana</b></label>
        <INPUT type="checkbox" name="muistaminut" value="kyllä"/>
        <label><b>Muista minut</b></label>
        <input type="submit" name="kirjaudusisään" id="kirjaudusisään" value="Kirjaudu sisään" 
        onClick="buttonpressedtext=window.document.getElementById('buttonpressedtext'); 
        buttonpressedtext.style.fontSize='larger'; buttonpressedtext.innerHTML='Odottakaa, sisäänkirjautumista käsitellään, tai korjatkaa virheet';;">
        <span id="buttonpressedtext"></span>

</form>


</div>
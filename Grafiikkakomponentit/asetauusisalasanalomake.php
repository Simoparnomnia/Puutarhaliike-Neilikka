
<div id="pagecontent">

<b>Uuden salasanan asetus:</b>
    <form method="post" action=".\Tapahtumankäsittelijät\Asetauusisalasana.php">
        
        <br><b>Uusi salasana(sisällettävä ainakin yksi numero ja yhteensä vähintään 8 merkkiä)</b><input type="password"  name="uusisalasana" id="uusisalasana" pattern="(?=.*[0-9])(?=.*[a-zA-Z]).{8,}"required>
        <br><b>Vahvista uusi salasana(sisällettävä ainakin yksi numero ja yhteensä vähintään 8 merkkiä)</b><input type="password"  name="vahvistauusisalasana" id="vahvistauusisalasana" pattern="(?=.*[0-9])(?=.*[a-zA-Z]).{8,}"required>

    </form>

</div>






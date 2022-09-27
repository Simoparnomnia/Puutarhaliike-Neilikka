<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ota yhteyttä</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <link rel="icon" type="image/x-icon" href="favicon.png">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
<?php
    require('navigointi.html');
?>

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
    
        <?php
    require('footer.html');
    ?>
    
    </body>

    
</html>
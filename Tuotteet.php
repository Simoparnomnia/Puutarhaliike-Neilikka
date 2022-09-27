<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tuotteet</title>
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

        require('Navigointi.html');

        ?>

        <div id="pagecontent">
          Tuotevalikoimaamme kuuluu sisäkasveja, ulkokasveja sekä työkaluja ja muita tarvikkeita kasvien hoitoon.

          

          <ul class="pagecontentlist" style="list-style-type:none;">
            <li><a href="Sisäkasvit.html"><p class="paragraphtitle">Sisäkasvit</p></a></li>
            <a href="Sisäkasvit.html"><p><img class="productslinkimage" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/MonsteraAdansonii.jpg/800px-MonsteraAdansonii.jpg"/></p></a>
            <p>Sisäkasvit kuuluvat sisätiloihin</p>
            <li><a href="Ulkokasvit.html"><p class="paragraphtitle">Ulkokasvit</p></a></li>
            <a href="Ulkokasvit.html"><p><img class="productslinkimage" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Petunie.jpg/320px-Petunie.jpg"/></p></a>
            <p>Ulkokasvit kuuluvat ulkotiloihin</p>
            <li><a href="Työkalut.html"><p class="paragraphtitle">Työkalut</p></a></li>
            <a href="Työkalut.html"><p><img class="productslinkimage" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Trowel.JPG/800px-Trowel.JPG" alt="Työkalujen kuva"></img></p></a>
            <p>Valikoimamme käsittää kaikenlaisia työkaluja</p>
            <li><a href="Kasvien hoito.html"><p class="paragraphtitle">Tarvikkeet kasvien hoitoon</p></a></li>
            <a href="Kasvien hoito.html"><p class="paragraphtitle"><img class="productslinkimage" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/MetalwateringcansDec08.jpg/800px-MetalwateringcansDec08.jpg" alt="Kasvien hoitotarvikkeiden kuva"></img></p></a>
            <p>Valikoimaamme kuuluu kaikenlaisia lannoitteita, tukikeppejä yms.</p>
          </ul>

          
        </div>
        <?php    
        require('footer.html')
?>
    </body>
</html>
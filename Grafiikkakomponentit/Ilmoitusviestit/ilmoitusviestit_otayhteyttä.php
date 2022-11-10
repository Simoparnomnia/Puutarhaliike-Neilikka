<?php




if(isset($_GET['uloskirjautuminenonnistui'])){
    if($_GET['uloskirjautuminenonnistui'] =='kyllä'){
        echo "<br><span class=\"successmessage\">Uloskirjautuminen onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
    }

    elseif($_GET['uloskirjautuminenonnistui'] =='ei'){
        echo "<br><span class=\"errormessage\">Uloskirjautuminen epäonnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
    }
}
if(isset($_GET['sähköpostipalvelu'])){
    if($_GET['sähköpostipalvelu']=='mailtrap'){
        if(isset($_GET['palautteenlähetysonnistui'])){
            if($_GET['palautteenlähetysonnistui'] =='kyllä'){
                echo "<br><span class=\"successmessage\">Palautteen lähetys onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
            }
            elseif($_GET['palautteenlähetysonnistui'] =='ei'){
                if($_GET['sähköpostipalvelu']=='mailtrap'){
                    echo "<br><span class=\"errormessage\">Palautteen lähetys epäonnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }
            }
        }
    } 
    elseif($_GET['sähköpostipalvelu']=='sendgrid'){
            if(isset($_GET['palautteenlähetysonnistui'])){
                if($_GET['palautteenlähetysonnistui'] =='kyllä'){
                    echo "<br><span class=\"successmessage\">Palautteen lähetys onnistui <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }         

            else{
                if(!isset($_GET['sendgridsenderidentitypuuttuu'])){
                    echo "<br><span class=\"errormessage\">Palautteen lähetys epäonnistui, palvelu saattaa olla väliaikaisesti tavoittamattomissa <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }
                else{
                    echo "<br><span class=\"errormessage\">Palautteen lähetys epäonnistui, hyväksyttävää lähettäjää ei ole sähköpostipalvelussa <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
                }
            }
        }
    }
    else{
        echo "<br><span class=\"errormessage\">Palautteen lähetys epäonnistui, palvelimella määritettyä sähköpostipalvelua ei ole olemassa! <a href=\"./index.php?sivu=otayhteyttä\">PÄIVITÄ SIVU</a></span>";
    }
}




?>
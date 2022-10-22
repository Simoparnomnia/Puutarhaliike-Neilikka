<?php




if(isset($_GET['sähköposti'])){
    $linkinsähköpostihash=$_GET['sähköposti'];
}
if(isset($_GET['käyttäjänimi'])){
    $linkinkäyttäjänimihash=$_GET['käyttäjänimi'];
}



$tietokantakysely->prepare("SELECT sahkoposti, kayttajanimi FROM kayttajatili");
if($tietokantakysely->execute()){
    //TODO: Session already started, varoitusta ei tule ilman tätä virheellisellä linkillä ja oikean linkin avaus toimii, ei siis tarvita täällä?
    //session_start();
    $tietokantakysely->bind_result($sähköposti, $käyttäjänimi);
    while($tietokantakysely->fetch()){
        
        if(password_verify($sähköposti,$linkinsähköpostihash) && password_verify($käyttäjänimi, $linkinkäyttäjänimihash)){
            
            //viitataan nykyiseen kansioon, koska tapahtumankäsittelijää käytetään suoraan index.php:ssa eikä grafiikkakomponentin lomakkeen actionina
            //header('Location: ./index.php?sivu=asetauusisalasanalomake&vaihtolinkinavausonnistui=kyllä&käyttäjänimihash='.$linkinkäyttäjänimihash);
            $_SESSION["vaihtolinkinavausonnistui"]=true;
            $_SESSION["vaihdettavansalasanansähköposti"]=$sähköposti;
            header('Location: ./index.php?sivu=asetauusisalasanalomake');
            exit();
        }
       
        
    
    }
    
    $_SESSION["vaihtolinkinavausonnistui"]=false;
    //header('Location: ./index.php?sivu=asetauusisalasanalomake');
    
}
else{
    echo "Tietokantavirhe salasanan vaihtolinkkiä avattaessa: ".$connection->error;
    session_start();
    $_SESSION["vaihtolinkinavausonnistui"]=false;
    header('Location: ./index.php?sivu=asetauusisalasanalomake&tietokantavirhe=kyllä');
}








?>
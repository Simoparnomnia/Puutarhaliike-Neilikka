<?php
if(isset($_SESSION["käyttäjänimi"])){
    $käyttäjänimi=$_SESSION["käyttäjänimi"];
    $selektori = bin2hex(random_bytes(16));
    $validaattori = bin2hex(random_bytes(32));
    $validaattorihash = password_hash($validaattori, PASSWORD_DEFAULT);
    $_COOKIE["muistaminut"]="muistaminut";
    $_COOKIE["autentikaatiotoken"]=$selektori.".".$validaattori;
    //$nykypäivämäärä=date_format(date_create(), 'Y-m-d H:i:s');
    //$umpeutumisaika=date_add(date_interval_create_from_date_string("5 minutes"),$nykypäivämäärä);
    //echo "$nykypäivämäärä";
    //echo "<br>$umpeutumisaika";
    //exit();
    $luoautentikaatiotokenkysely="INSERT INTO kayttajantoken (selektori,validaattorihash,kayttajanimi,umpeutumisaika) VALUES ('$selektori','$validaattorihash','$käyttäjänimi', NOW()+ INTERVAL 5 MINUTE)";
    
    try{
        if($kyselyntulos=$connection->query($luoautentikaatiotokenkysely)){
                    //Uudelleenohjataan jos autentikaatiotokenin tallennus onnistui   
                    header('Location: ../index.php?sivu=etusivu$autentikaatioonnistui=kyllä');
                    exit();
            }
        } 
    catch(Exception $e){
        //Tietokantavirhe
        header('Location: ../index.php?sivu=etusivu&tietokantavirhe=kyllä');
    }

}
?>
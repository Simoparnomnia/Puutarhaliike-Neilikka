<?php
if(isset($_SESSION["käyttäjänimi"])){
    $käyttäjänimi=$_SESSION["käyttäjänimi"];
    $selektori = bin2hex(random_bytes(16));
    $validaattori = bin2hex(random_bytes(32));
    $validaattorihash = password_hash($validaattori, PASSWORD_DEFAULT);
    setcookie("muistaminut","kylla",time()+120);
    setcookie("autentikaatiotoken",$selektori.".".$validaattori,time()+120);
    //$nykypäivämäärä=date_format(date_create(), 'Y-m-d H:i:s');
    //$umpeutumisaika=date_add(date_interval_create_from_date_string("5 minutes"),$nykypäivämäärä);
    //echo "$nykypäivämäärä";
    //echo "<br>$umpeutumisaika";
    //exit();
    $luoautentikaatiotokenkysely="INSERT INTO kayttajantoken (selektori,validaattorihash,kayttajanimi,umpeutumisaika) VALUES ('$selektori','$validaattorihash','$käyttäjänimi', NOW()+ INTERVAL 2 MINUTE)";
    
    try{
        if($kyselyntulos=$connection->query($luoautentikaatiotokenkysely)){
                    //Uudelleenohjataan jos autentikaatiotokenin tallennus onnistui   
                    header('Location: ../../index.php?sivu=etusivu&autentikaatiotokeninluontionnistui=kyllä');
                    exit();
            }
        else{
            header('Location: ../../index.php?sivu=etusivu&autentikaatiotokeninluontionnistui=ei');
                    exit();
        }
        } 
    catch(Exception $e){
        //Tietokantavirhe
        header('Location: ../../index.php?sivu=etusivu&tietokantavirhe=kyllä');
    }

}
?>
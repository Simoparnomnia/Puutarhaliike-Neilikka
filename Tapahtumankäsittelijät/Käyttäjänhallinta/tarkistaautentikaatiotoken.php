<?php
require_once('../Tietokantayhteys.php');


/* check the remember_me in cookie
$token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_STRING);

if ($token && token_is_valid($token)) {

    $user = find_user_by_token($token);

    if ($user) {
        return log_user_in($user);
    }
}*/

if(!isset($_SESSION["käyttäjänimi"]) && isset($_COOKIE["autentikaatiotoken"])){
    $autentikaatiotoken=filter_input(INPUT_COOKIE,"autentikaatiotoken",FILTER_SANITIZE_STRING);
    $selektorijavalidaattori=explode(".",$autentikaatiotoken);
    $selektori=$selektorijavalidaattori[0];
    $validaattori=$selektorijavalidaattori[1];
    
    $tarkistaautentikaatiotokenkysely="SELECT kayttajanimi, selektori, validaattorihash, umpeutumisaika FROM kayttajantoken WHERE selektori = '$selektori' and umpeutumisaika > NOW()";
    try{
        if($kyselyntulos=$connection->query($tarkistaautentikaatiotokenkysely)){
            while(list($käyttäjänimi, $selektori, $validaattorihash, $umpeutumisaika)= $kyselyntulos->fetch_row()){
                echo $käyttäjänimi;
                if(password_verify($validaattori,$validaattorihash)==true){
                    session_start();
                    $_SESSION["käyttäjänimi"]=$käyttäjänimi;
                    //Uudelleenohjataan jos oikeat tunnukset löytyivät   
                    header('Location: ../../index.php?sivu=etusivu$automaattinensisäänkirjautuminenonnistui=kyllä');
                    exit();
                }
                header('Location: ../../index.php?sivu=etusivu$automaattinensisäänkirjautuminenonnistui=ei');
            }
        }

    }catch(Exception $e){
        //Tietokantavirhe
        header('Location: ../../index.php?sivu=etusivu&tietokantavirhe=kyllä');
    }

}





?>
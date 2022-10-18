<?php
  
  
  require('../credentials.php');
  require '../vendor/autoload.php';

  

  $lomake=$_POST["lomake"];
  if(isset($_POST["nimi"])){
  $customername=$_POST["nimi"];
  }
  if(isset($_POST["sähköposti"])){
  $customeremailaddress=$_POST["sähköposti"];
  }
  if(isset($_POST["palauteaihe"])){
  $feedbacktopic=$_POST["palauteaihe"];
  }
  if(isset($_POST["palauteviesti"])){
  $feedbackmessage=$_POST["palauteviesti"];
  }
//TODO: ei testattu
  if($lomake=="Lähetä palaute"){
    //credentials.php-tiedostosta:
    if($mailservice=="mailtrap"){
      require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
      

      require_once('../vendor/phpmailer/src/Exception.php');
      require_once('../vendor/phpmailer/src/PHPMailer.php');
      require_once('../vendor/phpmailer/src/SMTP.php');

      $mail = new PHPMailer\PHPMailer\PHPMailer();

      $mail->IsSMTP();
      $mail->Mailer = "smtp";
      $mail->charSet="UTF-8";

      $mail->SMTPDebug  = 0;  
      $mail->Host = $mailtraphostdomain;
      $mail->SMTPAuth = true;
      $mail->Port = 2525;
      $mail->Username = $mailtraphostusername;
      $mail->Password = $mailtraphostpassword;


      
      $mail->IsHTML(true);
      $mail->AddAddress("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
      $mail->SetFrom($customeremailaddress, $customername);
      $mail->AddReplyTo("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
      $mail->AddCC("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
      $mail->Subject = $feedbacktopic;
      $content = $feedbackmessage;

      $mail->MsgHTML($content); 
      if(!$mail->Send()) {
        header("Location: ../index.php?sivu=etusivu&palautteenlähetysonnistui=ei");
        //echo "Virhe sähköpostin lähetyksessä Mailtrap-palvelun kautta.<br>{$mail->ErrorInfo}<br>";
        //var_dump($mail);
      } else {
        header("Location: ../index.php?sivu=etusivu&palautteenlähetysonnistui=kyllä");
        //echo "Sähköposti lähetetty onnistuneesti Mailtrap-palvelun kautta.";
      }

    }
//TODO: ei testattu
    elseif($mailservice=="sendgrid"){
      require_once('../vendor/sendgrid/sendgrid/sendgrid-php.php');



      $email = new SendGrid\Mail\Mail();
      $email->setFrom($customeremailaddress, $customername);
      $email->setSubject($feedbacktopic);
      $email->addTo("Simo.Parnanen@edu-omnia.fi", "Simo P");
      $email->addContent("text/plain", $feedbackmessage);

      $sendgrid = new \SendGrid($sendgridhostpassword);

      try {
          $response = $sendgrid->send($email);
          print $response->statusCode() . "\n";
          print_r($response->headers());
          print $response->body() . "\n";
          header("Location: ../index.php?sivu=etusivu&palautteenlähetysonnistui=kyllä");
      } catch (Exception $e) {
          header("Location: ../index.php?sivu=etusivu&palautteenlähetysonnistui=ei");
          //echo 'Virhe lähetettäessä sähköpostia SendGrid-kirjastolla: '. $e->getMessage() ."\n";
      }
    }

  }
  
  elseif($lomake=="Lähetä uusintalinkki"){
    require_once('Tietokantayhteys.php');
    
    
    if($mailservice=="mailtrap"){
      require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');

      $givenemailaddress=$_POST["sähköposti"];
      //$feedbackmessage=$_POST["palauteviesti"];

      require_once('../vendor/phpmailer/phpmailer/src/Exception.php');
      require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
      require_once('../vendor/phpmailer/phpmailer/src/SMTP.php');

      $mail = new PHPMailer\PHPMailer\PHPMailer();

      $mail->IsSMTP();
      $mail->Mailer = "smtp";
      $mail->CharSet='UTF-8';
      $mail->Encoding="base64";

      $mail->SMTPDebug  = 0;  
      $mail->Host = $mailtraphostdomain;
      $mail->SMTPAuth = true;
      $mail->Port = 2525;
      $mail->Username = $mailtraphostusername;
      $mail->Password = $mailtraphostpassword;

      try{
        $haesähköpostikysely="SELECT sahkoposti, kayttajanimi, etunimi, sukunimi FROM kayttajatili WHERE LCASE(TRIM(sahkoposti))='".strtolower(trim($givenemailaddress))."'";
        if($kyselyntulos=$connection->query($haesähköpostikysely)){
          while(list($sähköposti, $käyttäjänimi, $etunimi, $sukunimi)=$kyselyntulos->fetch_row()){
            //echo $sähköposti.''.$käyttäjänimi;
            if(strtolower(trim($customeremailaddress))==$sähköposti){
              //koodataan tietoturvallista uusintalinkkiä varten
              $haettusähköposti=$sähköposti;
              $customerusername=$käyttäjänimi;
              $haettuetunimi=$etunimi;
              $haettusukunimi=$sukunimi;
              $codedcustomeremailaddress=password_hash($haettusähköposti, PASSWORD_DEFAULT);
              $codedcustomerusername=password_hash($käyttäjänimi, PASSWORD_DEFAULT);
              break;
            }
          }
          
        }
      }catch(Exception $e){
        //echo $e;
        header('Location: ../index.php?sivu=unohtunutsalasanalomake?salasananlähetysonnistui=ei&virhe=tietokantavirhe');
        exit();
      }


      $mail->IsHTML(true);
      $mail->AddAddress($haettusähköposti, $haettuetunimi.' '.$haettusukunimi);
      $mail->SetFrom($mailtraphostdomain, 'Puutarhaliike Neilikka ');
      $mail->AddReplyTo($mailtraphostdomain, "Puutarhaliike Neilikka");
      $mail->AddCC($mailtraphostdomain, "Puutarhaliike Neilikka");
      $mail->Subject = "Unohtuneen salasanan palautus";
      $content = "Automaattinen viesti, älkää vastatko tähän viestiin. \nTälle sähköpostille on pyydetty salasanan uusintaa. Neilikan käyttäjän uusintalomakelinkki: http://localhost/Omnia-repositoryt/Puutarhaliike-Neilikka/index.php?sivu=asetauusisalasanalomake&sähköposti=$codedcustomeremailaddress&käyttäjänimi=$codedcustomerusername";
      

      $mail->MsgHTML($content); 
      if(!$mail->Send()) {
        header('Location: ../index.php?sivu=unohtunutsalasanalomake?salasananlähetysonnistui=ei&virhe=sähköpostivirhe');
        //echo "Virhe sähköpostin lähetyksessä Mailtrap-palvelun kautta.<br>{$mail->ErrorInfo}<br>";
        //var_dump($mail);
      } else {
        header('Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=kyllä');
        //echo "Sähköposti lähetetty onnistuneesti Mailtrap-palvelun kautta.";
      }

    }

  //TODO: ei testattu, vertaa mailtrapin salasanan vaihto
    elseif($mailservice=="sendgrid"){
      require_once('../vendor/sendgrid/sendgrid/sendgrid-php.php');


      
      
      



      try{
        $haesähköpostikysely="'SELECT sahkoposti, kayttajanimi, etunimi, sukunimi FROM kayttajatili WHERE LCASE(TRIM(sahkoposti)='".strtolower(trim($givenemailaddress));
        if($kyselyntulos=$connection->query($haesähköpostikysely)){
          while(list($sähköposti, $käyttäjänimi, $etunimi, $sukunimi)=$kyselyntulos->fetch_row()){
            if($givenemailaddress==$sähköposti){
              $customeremailaddress=$givenemailaddress;
              $customerusername=$käyttäjänimi;
              $haettuetunimi=$etunimi;
              $haettusukunimi=$sukunimi;
              //koodataan tietoturvallista uusintalinkkiä varten
              $codedcustomeremailaddress=password_hash($givenemailaddress, PASSWORD_DEFAULT);
              $codedcustomerusername=password_hash($customerusername, PASSWORD_DEFAULT);
              break;
            }
          }
        }
        }catch(Exception $e){
          header('Location: ../index.php?sivu=unohtunutsalasanalomake?salasananlähetysonnistui=ei&virhe=tietokantavirhe');
          exit();
        }

      $email = new \SendGrid\Mail\Mail();
      $email->setFrom($customeremailaddress, $haettuetunimi.' '.$haettusukunimi);
      $email->setSubject('Puutarhaliike Neilikka, käyttäjätilin salasanan uusintalinkki');
      $email->addTo("Simo.Parnanen@edu-omnia.fi", "Simo P");
      $email->addContent("text/plain", "Tälle sähköpostille on pyydetty salasanan uusintaa. Neilikan käyttäjän uusintalomakelinkki: http://localhost/Omnia-repositoryt/Puutarhaliike-Neilikka/index.php?sivu=asetauusisalasanalomake&salasananlähetysonnistui=kylla&sähköposti=".$codedcustomeremailaddress."&käyttäjänimi=".$codedcustomerusername);

      $sendgrid = new \SendGrid($sendgridhostpassword);

      try {
          $response = $sendgrid->send($email);
          //header("Location: ./index.php?sivu=unohtunutsalasanalomake?salasananlähetysonnistui=kyllä&sähköposti='$codedcustomeremailaddress'&käyttäjänimi='$codedcustomerusername");
          //print $response->statusCode() . "\n";
          //print_r($response->headers());
          //print $response->body() . "\n";
          
      } catch (Exception $e) {
        header('Location: ../index.php?sivu=unohtunutsalasanalomake?salasananlähetysonnistui=ei&virhe=sähköpostivirhe');
        exit();
        //echo 'Virhe lähetettäessä sähköpostia SendGrid-kirjastolla: '. $e->getMessage() ."\n";
      }
    }
  }
?>
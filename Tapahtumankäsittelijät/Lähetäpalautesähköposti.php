<?php
  


   //Tarvitaan dotenv-, PHPmailer- ja Sendgrid-kirjastoille:
  require '../vendor/autoload.php';
  




  $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
  $DOTENVDATA=$dotenv->load();
  
  
  


  if(isset($_POST["nimi"])){
  $lähettäjännimi=$_POST["nimi"];
  }
  if(isset($_POST["sähköposti"])){
  $lähettäjänsähköposti=strtolower(trim($_POST["sähköposti"]));
  }
  if(isset($_POST["palauteaihe"])){
  $palauteaihe=$_POST["palauteaihe"];
  }
  if(isset($_POST["palauteviesti"])){
  $palauteviesti=$_POST["palauteviesti"];
  }

	$sähköpostilöydetty=false;


  
    
    
    //testattu lähetys, credentials.php-tiedostosta:
    if($DOTENVDATA['MAILSERVICE']=="mailtrap"){
    require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
    require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
    require_once('../vendor/phpmailer/phpmailer/src/SMTP.php');

    

      $mail = new PHPMailer\PHPMailer\PHPMailer();

      $mail->IsSMTP();
      $mail->Mailer = "smtp";
      $mail->charSet="UTF-8";

      $mail->SMTPDebug  = 0;  
      $mail->Host = $DOTENVDATA['MAILTRAPHOSTDOMAIN'];
      $mail->SMTPAuth = true;
      $mail->Port = 2525;
      $mail->Username = $DOTENVDATA['MAILTRAPHOSTUSERNAME'];
      $mail->Password = $DOTENVDATA['MAILTRAPHOSTPASSWORD'];

			
      
      $mail->IsHTML(true);
      $mail->AddAddress($DOTENVDATA['MAILTRAPHOSTDOMAIN'], "Puutarhaliike Neilikka");
      $mail->SetFrom($lähettäjänsähköposti, utf8_decode($lähettäjännimi));
      $mail->AddReplyTo($lähettäjänsähköposti, utf8_decode($lähettäjännimi));
      $mail->AddCC($lähettäjänsähköposti, utf8_decode($lähettäjännimi));
      $mail->Subject = utf8_decode($palauteaihe);
      $content = utf8_decode($palauteviesti);

      $mail->MsgHTML($content); 
      if(!$mail->Send()) {
        
        //echo "Virhe sähköpostin lähetyksessä Mailtrap-palvelun kautta.<br>{$mail->ErrorInfo}<br>";
        //var_dump($mail);
        //exit();
        header("Location: ../index.php?sivu=otayhteyttä&palautteenlähetysonnistui=ei&sähköpostipalvelu=".$DOTENVDATA['MAILSERVICE']);
      } else {
        //echo "Palautesähköpostin lähetys Mailtrap-palvelun kautta onnistui.<br>";
        //var_dump($mail);
        //exit();
        header("Location: ../index.php?sivu=otayhteyttä&palautteenlähetysonnistui=kyllä&sähköpostipalvelu=".$DOTENVDATA['MAILSERVICE']);
        //echo "Sähköposti lähetetty onnistuneesti Mailtrap-palvelun kautta.";
      }

    }
    //testattu, jos setFrom:n senderidentitya ei ole SendGridissa sähköpostille, sähköpostia ei lähetetä.
    elseif($DOTENVDATA['MAILSERVICE']=="sendgrid"){
			
      require_once('../vendor/sendgrid/sendgrid/sendgrid-php.php');



      $email = new \SendGrid\Mail\Mail();
      $email->setFrom($lähettäjänsähköposti, urldecode($lähettäjännimi));
      $email->setSubject(utf8_decode($palauteaihe));
      $email->addTo($DOTENVDATA['SENDGRIDRECEIVERIDENTITY'], "Simo P");
      $email->addContent("text/plain", utf8_decode($palauteviesti));

      $sendgrid = new \SendGrid($DOTENVDATA['SENDGRIDHOSTPASSWORD']);

      try {
          $response = $sendgrid->send($email);
          print $response->statusCode() . "\n";
          print_r($response->headers());
          print $response->body() . "\n";
          if($response->statusCode()==202){
          //exit();
          header("Location: ../index.php?sivu=otayhteyttä&palautteenlähetysonnistui=kyllä&sähköpostipalvelu=".$DOTENVDATA['MAILSERVICE']);
          }
          else{
            header("Location: ../index.php?sivu=otayhteyttä&palautteenlähetysonnistui=ei&sähköpostipalvelu=".$DOTENVDATA['MAILSERVICE']."&sendgridsenderidentitypuuttuu=kylla");
          }
      } catch (Exception $e) {
          header("Location: ../index.php?sivu=otayhteyttä&palautteenlähetysonnistui=ei&sähköpostipalvelu=".$DOTENVDATA['MAILSERVICE']);
          //echo 'Virhe lähetettäessä sähköpostia SendGrid-kirjastolla: '. $e->getMessage() ."\n";
          //exit();
      }
    }

  
    else{
      header("Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=ei&sähköpostipalvelu=".$DOTENVDATA['MAILSERVICE']."&virhe=sähköpostipalveluaeilöytynyt");
    }

			
		

	
  
?>
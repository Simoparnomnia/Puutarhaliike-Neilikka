<?php
  


   //Tarvitaan dotenv-, PHPmailer- ja Sendgrid-kirjastoille:
  require '../vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
  $DOTENVDATA=$dotenv->load();
  
  
  

  $lomake=$_POST["lomake"];
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

//TODO: ei testattu
  if($lomake=="Lähetä palaute"){
    //credentials.php-tiedostosta:
    if($DOTENVDATA['MAILSERVICE']=="mailtrap"){
    require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
      

      require_once('../vendor/phpmailer/src/Exception.php');
      require_once('../vendor/phpmailer/src/PHPMailer.php');
      require_once('../vendor/phpmailer/src/SMTP.php');

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
      $mail->AddAddress("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
      $mail->SetFrom($lähettäjänsähköposti, urldecode($lähettäjännimi));
      $mail->AddReplyTo("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
      $mail->AddCC("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
      $mail->Subject = $palauteaihe;
      $content = $palauteviesti;

      $mail->MsgHTML($content); 
      if(!$mail->Send()) {
        header("Location: ../index.php?sivu=otayhteyttä&palautteenlähetysonnistui=ei");
        //echo "Virhe sähköpostin lähetyksessä Mailtrap-palvelun kautta.<br>{$mail->ErrorInfo}<br>";
        //var_dump($mail);
      } else {
        header("Location: ../index.php?sivu=otayhteyttä&palautteenlähetysonnistui=kyllä");
        //echo "Sähköposti lähetetty onnistuneesti Mailtrap-palvelun kautta.";
      }

    }
//TODO: ei testattu
    elseif($DOTENVDATA['MAILSERVICE']=="sendgrid"){
			
      require_once('../vendor/sendgrid/sendgrid/sendgrid-php.php');



      $email = new SendGrid\Mail\Mail();
      $email->setFrom($lähettäjänsähköposti, urldecode($lähettäjännimi));
      $email->setSubject($palauteaihe);
      $email->addTo("Simo.Parnanen@edu-omnia.fi", "Simo P");
      $email->addContent("text/plain", $palauteviesti);

      $sendgrid = new \SendGrid($DOTENVDATA['SENDGRIDHOSTPASSWORD']);

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
  //testattu
  elseif($lomake=="Lähetä uusintalinkki"){
    require_once('Tietokantayhteys.php');
    
    
    if($DOTENVDATA['MAILSERVICE']=="mailtrap"){
      require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');

      
      //$palauteviesti=$_POST["palauteviesti"];

      require_once('../vendor/phpmailer/phpmailer/src/Exception.php');
      require_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
      require_once('../vendor/phpmailer/phpmailer/src/SMTP.php');

      $mail = new PHPMailer\PHPMailer\PHPMailer();

      $mail->IsSMTP();
      $mail->Mailer = "smtp";
      $mail->CharSet='UTF-8';
      $mail->Encoding="base64";

      $mail->SMTPDebug  = 0;  
      $mail->Host = $DOTENVDATA['MAILTRAPHOSTDOMAIN'];
      $mail->SMTPAuth = true;
      $mail->Port = 2525;
      $mail->Username = $DOTENVDATA['MAILTRAPHOSTUSERNAME'];
      $mail->Password = $DOTENVDATA['MAILTRAPHOSTPASSWORD'];

      try{
        $haesähköpostikysely=$connection->prepare("SELECT sahkoposti, kayttajanimi, etunimi, sukunimi FROM kayttajatili WHERE LCASE(TRIM(sahkoposti))=?");
        $haesähköpostikysely->bind_param("s",$lähettäjänsähköposti);
        if($haesähköpostikysely->execute()){
        	$haesähköpostikysely->bind_result($sähköposti, $käyttäjänimi, $etunimi, $sukunimi);
        	while($haesähköpostikysely->fetch()){
          	//echo $sähköposti.''.$käyttäjänimi;
          	if($lähettäjänsähköposti==$sähköposti){
							$sähköpostilöydetty=true;
							$haettuetunimi=$etunimi;
							$haettusukunimi=$sukunimi;
            	//koodataan tietoturvallista uusintalinkkiä varten
            	$koodattulähettäjänsähköposti=password_hash($sähköposti, PASSWORD_DEFAULT);
            	$koodattucustomerusername=password_hash($käyttäjänimi, PASSWORD_DEFAULT);
            	break;
          	}
        	}
          
          
      	}
      }catch(Exception $e){
        //echo $e;
        header('Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=ei&virhe=tietokantavirhe');
        exit();
      }

			if($sähköpostilöydetty==true){
        //echo "Sähköposti löydetty mailtrapilla!";
        //exit();
				$mail->IsHTML(true);
				$mail->AddAddress($lähettäjänsähköposti, $haettuetunimi.' '.$haettusukunimi);
				$mail->SetFrom($DOTENVDATA['MAILTRAPHOSTDOMAIN'], 'Puutarhaliike Neilikka ');
				$mail->AddReplyTo($DOTENVDATA['MAILTRAPHOSTDOMAIN'], "Puutarhaliike Neilikka");
				$mail->AddCC($DOTENVDATA['MAILTRAPHOSTDOMAIN'], "Puutarhaliike Neilikka");
				$mail->Subject = "Unohtuneen salasanan palautus";
				$content = "Automaattinen viesti, älkää vastatko tähän viestiin. \nTälle sähköpostille on pyydetty salasanan uusintaa. Neilikan käyttäjän uusintalomakelinkki: http://localhost/Omnia-repositoryt/Puutarhaliike-Neilikka/index.php?sivu=asetauusisalasanalomake&sähköposti=$koodattulähettäjänsähköposti&käyttäjänimi=$koodattucustomerusername";
				

				$mail->MsgHTML($content); 
				if(!$mail->Send()) {
					//header('Location: ../index.php?sivu=unohtunutsalasanalomake?salasananlähetysonnistui=ei&virhe=sähköpostivirhe');
					echo "Virhe sähköpostin lähetyksessä Mailtrap-palvelun kautta.<br>{$mail->ErrorInfo}<br>";
					var_dump($mail);
					exit();
				} else {
					header('Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=kyllä');
					//echo "Sähköposti lähetetty onnistuneesti Mailtrap-palvelun kautta.";
				}
			}
			else{
				header('Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=ei&virhe=sähköpostiaeilöytynyt');
			}

    }

  //TODO: ei testattu
    elseif($DOTENVDATA['MAILSERVICE']=="sendgrid"){
      

      try{
        $haesähköpostikysely=$connection->prepare("SELECT sahkoposti, kayttajanimi, etunimi, sukunimi FROM kayttajatili WHERE LCASE(TRIM(sahkoposti))=?");
        $haesähköpostikysely->bind_param("s",$lähettäjänsähköposti);
				if($haesähköpostikysely->execute()){     
					$haesähköpostikysely->bind_result($sähköposti, $käyttäjänimi, $etunimi, $sukunimi);
          while($haesähköpostikysely->fetch()){
            if($lähettäjänsähköposti==$sähköposti){
              
              $haettuetunimi=$etunimi;
              $haettusukunimi=$sukunimi;
							$sähköpostilöydetty=true;
              //koodataan tietoturvallista uusintalinkkiä varten
              $koodattulähettäjänsähköposti=password_hash($lähettäjänsähköposti, PASSWORD_DEFAULT);
              $koodattucustomerusername=password_hash($lähettäjänsähköposti, PASSWORD_DEFAULT);
              break;
            }
          }
          
        }
      }catch(Exception $e){
					echo "Tietokantavirhe:".$e;
          exit();
          header('Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=ei&virhe=tietokantavirhe');
          
        }

        if($sähköpostilöydetty==true){
          try{
            
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom($DOTENVDATA['SENDGRIDSENDERIDENTITY'], 'Puutarhaliike Neilikka');
            $email->setSubject('Puutarhaliike Neilikka, käyttäjätilin salasanan uusintalinkki');
            $email->addTo($lähettäjänsähköposti, urldecode($haettuetunimi).' '.urldecode($haettusukunimi) );
            $email->addContent("text/plain", "Automaattinen viesti, älkää vastatko tähän viestiin. \nTälle sähköpostille on pyydetty salasanan uusintaa. Neilikan käyttäjän uusintalomakelinkki: http://localhost/Omnia-repositoryt/Puutarhaliike-Neilikka/index.php?sivu=asetauusisalasanalomake&salasananlähetysonnistui=kylla&sähköposti=".$koodattulähettäjänsähköposti."&käyttäjänimi=".$koodattucustomerusername);
            
            $sendgrid = new \SendGrid($DOTENVDATA['SENDGRIDHOSTPASSWORD']);
  
          
            $response = $sendgrid->send($email);
            //header("Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=kyllä");
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            exit();
            
          } catch (Exception $e) {
            echo "Sähköpostivirhe: ".$e;
            exit();
            header('Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=ei&virhe=sähköpostivirhe');
            
            //echo 'Virhe lähetettäessä sähköpostia SendGrid-kirjastolla: '. $e->getMessage() ."\n";
          }
        }
        else{
          echo "sähköpostia ei löytynyt";
          exit();
          header('Location: ../index.php?sivu=unohtunutsalasanalomake&salasananlähetysonnistui=ei&virhe=sähköpostiaeilöytynyt');
        }
				
    }
			
		
  }
	
  
?>
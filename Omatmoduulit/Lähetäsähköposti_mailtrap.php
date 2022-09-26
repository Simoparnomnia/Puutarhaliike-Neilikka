<?php
namespace PHPMailer\PHPMailer;

require('../credentials.php');
$customername=$_POST["customername"];
$customeremailaddress=$_POST["customeremail"];
$feedbacktopic=$_POST["feedbacktopic"];
$feedbackmessage=$_POST["feedbackmessage"];

require_once('../Kirjastot/PHPMailer/Exception.php');
require_once('../Kirjastot/PHPMailer/PHPMailer.php');
require_once('../Kirjastot/PHPMailer/SMTP.php');

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 0;  
$mail->Host = $mailtraphostdomain;
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = $mailtraphostusername;
$mail->Password = $mailhostpassword;



$mail->IsHTML(true);
$mail->AddAddress("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
$mail->SetFrom($customeremailaddress, $customername);
$mail->AddReplyTo("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
$mail->AddCC("Simo.Parnanen@edu.omnia.fi", "Puutarhaliike Neilikka");
$mail->Subject = $feedbacktopic;
$content = $feedbackmessage;

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Virhe sähköpostin lähetyksessä Mailtrap-palvelun kautta.<br>{$mail->ErrorInfo}<br>";
  var_dump($mail);
} else {
  echo "Sähköposti lähetetty onnistuneesti Mailtrap-palvelun kautta.";
}

?>
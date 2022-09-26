<?php
require_once('../Kirjastot/SendGrid/sendgrid-php/sendgrid-php.php');
require('../credentials.php');

$customername=$_POST["customername"];
$customeremailaddress=$_POST["customeremail"];
$feedbacktopic=$_POST["feedbacktopic"];
$feedbackmessage=$_POST["feedbackmessage"];


$email = new \SendGrid\Mail\Mail();
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
} catch (Exception $e) {
    echo 'Virhe lähetettäessä sähköpostia SendGrid-kirjastolla: '. $e->getMessage() ."\n";
}


?>
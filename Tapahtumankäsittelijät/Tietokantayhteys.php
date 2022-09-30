<?php

require(dirname(__DIR__).'/credentials.php');

$servername = "localhost";
$username = $databaseusername;
$password = $databasepassword;
$db="puutarhaneilikka";



// Luo tietokantayhteys
$connection = new mysqli($servername, $username, $password, $db);
// Tarkista tietokantayhteys
if ($connection->connect_error) {
    die("Tietokantayhteys epäonnistui: " . $connection->connect_error);
} 

?>

<?php
/* ETÄVERSIO
ob_start();

$servername = "localhost";
$username = $databaseusername;
$password = $databasepassword;
$db="sakila";



// Luo tietokantayhteys
$connection = new db.connect($servername, $username, $password, $db);

} 

*/

?>
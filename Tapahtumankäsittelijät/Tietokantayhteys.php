<?php






$servername = "localhost";
$username = $DOTENVDATA['DATABASEUSERNAME'];
$password = $DOTENVDATA['DATABASEPASSWORD'];
$db="puutarhaneilikka";

if(!isset($_SESSION)){
    session_start();
}

// Luo tietokantayhteys
$connection = new mysqli($servername, $username, $password, $db);
$tietokantakysely = new mysqli_stmt($connection);
// Tarkista tietokantayhteys
if ($connection->connect_error) {
    die("Tietokantayhteys epäonnistui: " . $connection->connect_error);
} 

?>

<?php
/* ETÄVERSIO
ob_start();

$servername = "localhost";
$username = $DATABASEUSERNAME;
$password = $DATABASEPASSWORD;
$db="sakila";



// Luo tietokantayhteys
$connection = new db.connect($servername, $username, $password, $db);

} 

*/

?>
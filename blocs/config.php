<?php
$servername = "localhost";
$username = "root";
//$password = "";
$password = "root";
$dbname = "omnesmyskills";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_URI'] == "/projet%20local/config.php") {
    header("Location: accueil.php");
    die();
}
?>
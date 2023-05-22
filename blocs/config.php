<?php
if ($_SERVER['REQUEST_URI'] == "/projet%20local/config.php") {
    header("Location: accueil.php");
    die();
}
$servername = "localhost";
$username = "root";
<<<<<<<<< Temporary merge branch 1
$password = "";
=========
$password = "root";
>>>>>>>>> Temporary merge branch 2
$dbname = "omnesmyskills";

$conn = mysqli_connect($servername, $username, $password, $dbname);

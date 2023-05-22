<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "omnesmyskills";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn){
    session_destroy();
    die("ERREUR : impossible de se connecter");
}
?>
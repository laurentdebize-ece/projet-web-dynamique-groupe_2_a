<?php
if ($_SERVER['REQUEST_URI'] == "/projet%20local/config.php") {
    header("Location: accueil.php");
    die();
}
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
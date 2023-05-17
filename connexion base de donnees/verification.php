<?php
if ($_SERVER['REQUEST_URI'] == "/projet%20local/verification.php") {
    header("Location: accueil.php");
    die();
}
session_start();
if (!isset($_SESSION['ID_ut']) || !isset($_SESSION['statut'])){
    session_destroy();
    header("Location: connexion.php");
}
?>
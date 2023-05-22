<?php
session_start();
if (!isset($_SESSION['ID_ut']) || !isset($_SESSION['statut'])){
    session_destroy();
    header("Location: connexion.php");
    die();
}
?>
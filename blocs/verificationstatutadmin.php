<?php
if ($_SESSION['statut'] != "admin"){
    header("Location: accueil.php");
    die();
}
?>
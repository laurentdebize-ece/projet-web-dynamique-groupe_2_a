<?php
if ($_SESSION['statut'] != "etu" && $_SESSION['statut'] != "ens"){
    header("Location: accueil.php");
    die();
}
?>
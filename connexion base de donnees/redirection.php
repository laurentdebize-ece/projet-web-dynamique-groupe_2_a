<?php
if ($_SERVER['REQUEST_URI'] == "/projet%20local/redirection.php") {
    header("Location: accueil.php");
    die("Vous ne pouvez pas acceder a cette page");
}
if(isset($_POST["se_deconnecter"])){ session_destroy(); header("Location: connexion.php"); }
else if(isset($_POST["accueil"])){ header("Location: accueil.php"); }
else if(isset($_POST["mon_compte"])){ header("Location: moncompte.php"); }
else if(isset($_POST["mes_mat"])){ header("Location: mesmatieres.php"); }
else if(isset($_POST["mes_comp"])){ header("Location: mescompetences.php"); }
else if(isset($_POST["ttes_les_comp"])){ header("Location: touteslescompetences.php"); }
else if(isset($_POST["matieres"])){ header("Location: matieres.php"); }
else if(isset($_POST["groupes"])){ header("Location: groupes.php"); }
else if(isset($_POST["promos"])){ header("Location: promos.php"); }
else if(isset($_POST["enseignants"])){ header("Location: enseignants.php"); }
else if(isset($_POST["etudiants"])){ header("Location: etudiants.php"); }
?>
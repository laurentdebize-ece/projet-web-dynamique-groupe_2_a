<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="accueil.css">

</head>

<form method="post" action="">
    <?php if ($_SESSION['statut'] == "ens" || $_SESSION['statut'] == "etu"){ ?>
        <input type="submit" name="mes_mat" value="Mes matières">
        <input type="submit" name="mes_comp" value="Mes compétences">
        <input type="submit" name="mes_eval" value="Mes évaluations">
        <body>
        <!-- Menu déroulant -->
	<div class="dropdown">
		<button><img src="menu.jpg" alt="Menu"></button>
		<div class="dropdown-content">
			<a href="accueil.php">Acceuil</a>
			<a href="detailcompetence.php">Compétence</a>
            <a href="mesevaluations.php">Evaluations</a>
            <a href="mesmatieres.php">Matieres</a>
		</div>
	</div>
    </body>



    <?php } if ($_SESSION['statut'] == "admin" || $_SESSION['statut'] == "etu"){ ?>
        <input type="submit" name="ttes_les_comp" value="Toutes les compétences">
        <body>
        <!-- Menu déroulant -->
	<div class="dropdown">
		<button><img src="menu.jpg" alt="Menu"></button>
		<div class="dropdown-content">
			<a href="accueil.php">Acceuil</a>
			<a href="detailcompetence.php">Compétence</a>
		</div>
	</div>
    </body>

    <?php } if ($_SESSION['statut'] == "admin"){ ?>
        <input type="submit" name="matieres" value="Matières">
        <input type="submit" name="groupes" value="Groupes">
        <input type="submit" name="promos" value="Promo">
        <input type="submit" name="enseignants" value="Enseignants">
        <input type="submit" name="etudiants" value="Etudiants">
        <body>
        <!-- Menu déroulant -->
	<div class="dropdown">
		<button><img src="menu.jpg" alt="Menu"></button>
		<div class="dropdown-content">
			<a href="accueil.php">Acceuil</a>
			<a href="matieres.php">Matiere</a>
			<a href="groupes.php">Groupe</a>
            <a href="enseignants.php">Enseignants</a>
            <a href="promos.php">Promos</a>
            <a href="etudiants.php">Etudiants</a>
		</div>
	</div>
    
    </html>

    <?php } ?>
    <input type="submit" name="accueil" value="Accueil">
    <input type="submit" name="se_deconnecter" value="Se déconnecter" style="float: right">
    <input type="submit" name="mon_compte" value="Mon compte" style="float: right"><br>
</form>
<?php require("blocs/verificationsession.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="accueil.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<body>
  <header class="header">
    <h1>OMNES MYSKILLS</h1>
  </header>
  <body>
	<!-- Barre de déconnexion -->
	<div class="logout">
		<a href="moncompte.php">Compte</a>
		<a href="connexion.php">Deconnexion</a>
	</div>
	<!-- Menu déroulant -->
	<div class="dropdown">
		<button><img src="menu.jpg" alt="Menu"></button>
		<div class="dropdown-content">
			<a href="accueil.php">Acceuil</a>
			<a href="mescompetences.php">Compétence</a>
			<a href="detailmatiere.php">Matiere</a>
			
		</div>
	</div>

  <div class="content">
    <h2>Bienvenue sur OMNES MY SKILLS</h2>
   
  </div>

  
  <div class="image-with-text">
  <img src="ece.jpeg" alt="Description de l'image">
  <p>L'ecole d'ingenieurs de l'ECE Lyon est une institution de renommee mondiale qui offre une formation de pointe dans les domaines de l'informatique et de l'electronique. Depuis sa fondation en 1919, elle s'est engagee a former des ingenieurs hautement qualifies, capables de relever les defis les plus complexes de notre epoque.Notre ecole propose une gamme de programmes d'études adaptés aux besoins des étudiants, des entreprises et de la société dans son ensemble. Nos diplômés ont la réputation d'être des leaders dans leur domaine, et sont recherchés par les employeurs du monde entier pour leur expertise et leur expérience.</p>
</div>
  
  <footer class="footer">
    <p>&copy; 2023 Mon site. Tous droits réservés.</p>
  </footer>
</body>
    <?php require("blocs/header.php"); ?>
    <div><br>Accueil<br><br></div>
    <?php
    echo "id_ut : " . $_SESSION['ID_ut'] . "<br>statut : " . $_SESSION['statut'];
    echo '<pre>'; echo '</pre>';
    ?>
</body>
</html>

<?php require("blocs/redirection.php"); ?>
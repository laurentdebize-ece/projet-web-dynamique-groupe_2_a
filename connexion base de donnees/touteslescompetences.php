
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require("header.php"); ?>
    <div>Toutes les compétences<br><?php echo "id_ut : " . $_SESSION['ID_ut'] . "<br>statut : " . $_SESSION['statut'] ?></div>
     <br>
        <input type="radio" name="note" value="NA">
            <label for="NA">non aquis</label>
        <input type="radio" name="note" value="PA">
            <label for="PA">partiellement aquis</label>
        <input type="radio" name="note" value="A">
            <label for="A">aquis</label>
    <?php
// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "root";
$nomBaseDeDonnees = "omnesmyskills";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBaseDeDonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Requête pour récupérer les id_mat et les noms de compétences
$sql = "SELECT id_mat, nom FROM competence ORDER BY id_mat";

// Exécution de la requête
$resultat = $connexion->query($sql);

// Vérification du résultat de la requête
if ($resultat->num_rows > 0) {
    $current_id_mat = null;
    while ($row = $resultat->fetch_assoc()) {
        $id_mat = $row["id_mat"];
        $nom = $row["nom"];
        
        // Affichage de l'id_mat en tant que lien cliquable
        if ($id_mat != $current_id_mat) {
            echo "<h2>ID Mat: " . $id_mat . "</h2>";
            $current_id_mat = $id_mat;
        }
        
        // Affichage du nom de la compétence
        echo "- " . $nom . "<br>";
    }
} else {
    echo "Aucune compétence trouvée dans la base de données.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>

</body>
</html>

<?php require("redirection.php"); mysqli_close($conn); ?>
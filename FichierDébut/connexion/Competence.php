<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "YES";
$dbname = "omnesmyskills";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// ID de l'élève
$eleveID = 2;

// Récupération des compétences de l'élève
$sql = "SELECT c.ID_comp, c.nom
        FROM competence c
        INNER JOIN evaluation e ON c.ID_comp = e.ID_comp
        INNER JOIN etudiant et ON e.ID_etu = et.ID_etu
        WHERE et.ID_etu = $eleveID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Compétences de l'élève : <br>";
    while ($row = $result->fetch_assoc()) {
        echo "ID : " . $row["ID_comp"] . " - Nom : " . $row["nom"] . "<br>";
    }
} else {
    echo "Aucune compétence trouvée pour cet élève.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

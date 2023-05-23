<?php
require("blocs/verificationsession.php");
if (isset($_SESSION['ID_comp']) && isset($_SESSION['nom_comp'])){
    $ID_comp = $_SESSION['ID_comp'];
} else {
    if ($_SESSION['statut'] == "etu" || $_SESSION['statut'] == "ens"){
        header("Location: mescompetences.php");
    } else {
        header("Location: touteslescompetences.php");
    }
    die();
}
require("blocs/config.php");
// Récupération des données de la base de données
$sql = "SELECT * FROM competences";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Affichage des compétences et des choix pour chaque compétence
    while ($row = $result->fetch_assoc()) {
        echo $row["nom_competence"] . ": ";

        // Options possibles pour l'évaluation
        $options = array("acquis", "en cours d'acquisition", "non acquis");

        // Affichage des choix pour chaque compétence
        foreach ($options as $option) {
            echo "<input type='radio' name='" . $row["id_competence"] . "' value='" . $option . "'>" . $option . " ";
        }

        echo "<br>";
    }
} else {
    echo "Aucune compétence trouvée dans la base de données.";
}

// Soumission du formulaire
if (isset($_POST["submit"])) {
    // Parcourir les données soumises
    foreach ($_POST as $competenceId => $evaluation) {
        // Vérifier si l'évaluation est valide
        if (in_array($evaluation, $options)) {
            // Mettre à jour l'évaluation dans la base de données
            $sql = "UPDATE competences SET evaluation = '" . $evaluation . "' WHERE id_competence = " . $competenceId;
            $conn->query($sql);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div><br><?php echo $_SESSION['nom_comp'] ?><br><br></div>
    <div></div>
</body>
</html>

<?php require("blocs/redirection.php"); mysqli_close($conn); ?>
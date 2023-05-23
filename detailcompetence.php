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
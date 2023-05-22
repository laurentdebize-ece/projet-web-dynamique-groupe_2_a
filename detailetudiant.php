<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutadmin.php");
if (isset($_SESSION['ID_etu']) && isset($_SESSION['nom_etu']) && isset($_SESSION['prenom_etu'])){
    $ID_etu = $_SESSION['ID_etu'];
} else {
    header("Location: accueil.php");
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
    <div><br>
        Nom : <?php echo $_SESSION['nom_etu'] ?><br>
        Prénom : <?php echo $_SESSION['prenom_etu'] ?><br>
        <br><br></div>
    <div></div>
</body>
</html>

<?php
require("blocs/redirection.php");
mysqli_close($conn);
?>
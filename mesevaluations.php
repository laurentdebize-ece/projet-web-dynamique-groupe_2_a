<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutetuens.php");
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
    <div>Mes évaluations<br><?php echo "id_ut : " . $_SESSION['ID_ut'] . "<br>statut : " . $_SESSION['statut'] ?></div>
</body>
</html>

<?php require("blocs/redirection.php"); mysqli_close($conn); ?>
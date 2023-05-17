<?php require("verification.php"); require("config.php"); ?>
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
    <div>Mes matières<br><?php echo "id_ut : " . $_SESSION['ID_ut'] . "<br>statut : " . $_SESSION['statut'] ?></div>
</body>
</html>

<?php require("redirection.php"); mysqli_close($conn); ?>
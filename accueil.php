<?php require("blocs/verificationsession.php"); ?>

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
    <div><br>Accueil<br><br></div>
    <?php
    echo "id_ut : " . $_SESSION['ID_ut'] . "<br>statut : " . $_SESSION['statut'];
    echo '<pre>'; print_r($_SERVER); echo '</pre>';
    ?>
</body>
</html>

<?php require("blocs/redirection.php"); ?>
<?php
require("blocs/verificationsession.php");
if ($_SESSION['statut'] != "etu" && $_SESSION['statut'] != "admin"){
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
    <link rel="stylesheet" href="pagedebase.css">
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div class="container">
        <h1>Toutes les compétences</h1>
        <div class="Competence">
            <?php
            $sql = "SELECT * FROM competence";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)){ ?>
                <form method="post" action="">
                <?php while ($data = mysqli_fetch_assoc($result)){ ?>
                    <input type="submit" class="competence" name="<?php echo $data['ID_comp'] ?>" value="<?php echo $data['nom'] ?>"><br>
                <?php } ?>
                </form>
            <?php } else { echo "Aucune compétence.<br>"; } ?>
        </div>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM competence";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){
    if (isset($_POST[$data['ID_comp']])){
        $_SESSION['ID_comp'] = $data['ID_comp'];
        $_SESSION['nom_comp'] = $data['nom'];
        header("Location: detailcompetence.php");
        die();
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
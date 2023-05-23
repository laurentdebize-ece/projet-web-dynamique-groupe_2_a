<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutadmin.php");
if (isset($_SESSION['ID_promo']) && isset($_SESSION['nom_promo'])){
    $ID_promo = $_SESSION['ID_promo'];
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
    <link rel="stylesheet" href="pagedebase.css">
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div><h1><?php echo $_SESSION['nom_promo'] ?></h1></div>
    <div>
        <div class="Promos">
            <?php
            $sql = "SELECT * FROM groupe WHERE ID_promo LIKE $ID_promo";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)){?>
                <form method="post" action="">
                <?php while ($data = mysqli_fetch_assoc($result)){ ?>
                <input type="submit" class="detailpromo"name="<?php echo $data['ID_grp'] ?>" value="<?php echo $data['nom'] ?>"><br>
                <?php } ?>
                </form>
            <?php } else { echo "Aucun groupe.<br>"; } ?>
        </div>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM groupe WHERE ID_promo LIKE $ID_promo";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){
    if (isset($_POST[$data['ID_grp']])){
        $_SESSION['ID_grp'] = $data['ID_grp'];
        $_SESSION['nom_grp'] = $data['nom'];
        header("Location: detailgroupe.php");
        die();
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
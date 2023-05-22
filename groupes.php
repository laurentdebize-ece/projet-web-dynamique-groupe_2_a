<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutadmin.php");
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
    <div><br>Groupes<br><br></div>
    <div>
    <?php
        $sql = "SELECT * FROM groupe";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)){ ?>
            <form method="post" action="">
            <?php while ($data = mysqli_fetch_assoc($result)){ ?>
                <input type="submit" name="<?php echo $data['ID_grp'] ?>" value="<?php echo $data['nom'] ?>"><br>
            <?php } ?>
            </form>
    <?php } else { echo "Aucune promo.<br>"; } ?>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM groupe";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){
    if (isset($_POST[$data['ID_grp']])){
        $_SESSION['ID_grp'] = $data['ID_grp'];
        header("Location: detailgroupe.php");
        die();
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
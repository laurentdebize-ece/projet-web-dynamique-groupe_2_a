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
    <link rel="stylesheet" href="matiere.css">
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div class="container">
        <h1>Matières</h1>
        <div class="matieres">
            <?php
            $sql = "SELECT * FROM matiere";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)){ ?>
                <form method="post" action="">
                <?php while ($data = mysqli_fetch_assoc($result)){ ?>
                    <input type="submit" class="matiere-btn" name="<?php echo $data['ID_mat'] ?>" value="<?php echo $data['nom'] ?>"><br>
                <?php } ?>
                </form>
            <?php } else { echo "Aucune matière.<br>"; } ?>
        </div>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM matiere";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){
    if (isset($_POST[$data['ID_mat']])){
        $_SESSION['ID_mat'] = $data['ID_mat'];
        $_SESSION['nom_mat'] = $data['nom'];
        header("Location: detailmatiere.php");
        die();
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
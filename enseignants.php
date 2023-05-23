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
    <link rel="stylesheet" href="pagedebase.css">
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div class="container">
        <h1>Enseignants<h1>
        <div class="Enseignant">
            <?php
                $sql = "SELECT * FROM enseignant";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)){?>
                    <form method="post" action="">
                    <?php while ($data = mysqli_fetch_assoc($result)){ ?>
                        <input type="submit" class="enseignant" name="<?php echo $data['ID_ens'] ?>" value="<?php echo $data['prenom'] . " " . $data['nom'] ?>"><br>
                    <?php } ?>
                </form>
            <?php } else { echo "Aucun enseignant.<br>"; } ?>
        </div>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM enseignant";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)){
    while ($data = mysqli_fetch_assoc($result)){
        if (isset($_POST[$data['ID_ens']])){
            $_SESSION['ID_ens'] = $data['ID_ens'];
            $_SESSION['nom_ens'] = $data['nom'];
            $_SESSION['prenom_ens'] = $data['prenom'];
            header("Location: detailenseignant.php");
            die();
        }
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
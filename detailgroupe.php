<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutadmin.php");
if (isset($_SESSION['ID_grp']) && isset($_SESSION['nom_grp'])){
    $ID_grp = $_SESSION['ID_grp'];
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
    <link rel="stylesheet" href="detailgroupe.css">
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div><h1><?php echo $_SESSION['nom_grp'] ?></h1></div>
    <div>
        <?php
        $sql = "SELECT * FROM groupeetudiant WHERE ID_grp LIKE $ID_grp";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)){?>
            <form method="post" action="">
            <?php while ($data = mysqli_fetch_assoc($result)){ 
                $ID_etu = $data['ID_etu'];
                $sql2 = "SELECT * FROM etudiant WHERE ID_etu LIKE $ID_etu";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result)){
                    $data2 = mysqli_fetch_assoc($result2); ?>
                    <input type="submit" class="prenom" name="<?php echo $data['ID_etu'] ?>" value="<?php echo $data2['prenom'] . " " . $data2['nom'] ?>"><br>
                <?php }
            } ?>
            </form>
        <?php } else { echo "Aucun étudiant.<br>"; } ?>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM groupeetudiant WHERE ID_grp LIKE $ID_grp";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){ 
    $ID_etu = $data['ID_etu'];
    $sql2 = "SELECT * FROM etudiant WHERE ID_etu LIKE $ID_etu";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result)){
        $data2 = mysqli_fetch_assoc($result2);
        if (isset($_POST[$data2['ID_etu']])){
            $_SESSION['ID_etu'] = $data['ID_etu'];
            $_SESSION['nom_etu'] = $data2['nom'];
            $_SESSION['prenom_etu'] = $data2['prenom'];
            header("Location: detailetudiant.php");
            die();
        }
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
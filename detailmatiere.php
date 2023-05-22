<?php
require("blocs/verificationsession.php");
if (isset($_SESSION['ID_mat']) && isset($_SESSION['nom_mat'])){
    $ID_mat = $_SESSION['ID_mat'];
} else {
    if ($_SESSION['statut'] == "etu" || $_SESSION['statut'] == "ens"){
        header("Location: mesmatieres.php");
    } else {
        header("Location: matieres.php");
    }
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
    
    <?php
    if ($_SESSION['statut'] == "admin"){ ?>
        <br><div>
            <form method="post" action="">
                <input type="submit" name="supprimer_mat" value="Supprimer">
            </form>
        </div>
    <?php } ?>

    <div><br><?php echo $_SESSION['nom_mat'] ?><br><br></div>

    <div>
        <?php
        $sql = "SELECT * FROM competence WHERE ID_mat LIKE $ID_mat";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)){?>
            <form method="post" action="">
            <?php while ($data = mysqli_fetch_assoc($result)){ ?>
                <input type="submit" name="<?php echo $data['ID_comp'] ?>" value="<?php echo $data['nom'] ?>"><br>
            <?php } ?>
            </form>
        <?php } else { echo "Aucune compétence.<br>"; } ?>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM competence WHERE ID_mat LIKE $ID_mat";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){
    if (isset($_POST[$data['ID_comp']])){
        $_SESSION['ID_comp'] = $data['ID_comp'];
        $_SESSION['nom_comp'] = $data['nom'];
        header("Location: detailcompetence.php");
        die();
    }
}
if ($_SESSION['statut'] == "admin"){
    if (isset($_POST["supprimer_mat"])){
        $sql = "DELETE FROM matiere WHERE ID_mat LIKE '$ID_mat'";
        $result = mysqli_query($conn, $sql);
        $sql = "DELETE FROM matiere WHERE ID_mat LIKE '$ID_mat'";
        $result = mysqli_query($conn, $sql);
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
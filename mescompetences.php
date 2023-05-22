<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutetuens.php");
$ID_ut = $_SESSION['ID_ut'];
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
    <div><br>Mes compétences<br><br></div>
    <div>
        <?php
        $sql = "SELECT * FROM evaluation WHERE ID_etu LIKE $ID_ut";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)){
            while ($data = mysqli_fetch_assoc($result)){
                $ID_comp = $data['ID_comp'];
                $sql2 = "SELECT * FROM competence WHERE ID_comp LIKE $ID_comp";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) == 1){
                    $data2 = mysqli_fetch_assoc($result2); ?>
                    <form method="post" action="">
                        <input type="submit" name="<?php echo $ID_comp ?>" value="<?php echo $data2['nom'] ?>"><br>
                    </form>
                <?php }
            }
        } else { echo "Aucune compétence.<br>"; } ?>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM evaluation WHERE ID_etu LIKE $ID_ut";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)){
    while ($data = mysqli_fetch_assoc($result)){
        if (isset($_POST[$data['ID_comp']])){
            $ID_comp = $data['ID_comp'];
            $sql2 = "SELECT * FROM competence WHERE ID_comp LIKE $ID_comp";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) == 1){
                $data2 = mysqli_fetch_assoc($result2);
                $_SESSION['ID_comp'] = $ID_comp;
                $_SESSION['nom_comp'] = $data2['nom'];
                header("Location: detailcompetence.php");
                die();
            }
        }
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
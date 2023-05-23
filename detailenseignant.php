<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutadmin.php");
if (isset($_SESSION['ID_ens']) && isset($_SESSION['nom_ens']) && isset($_SESSION['prenom_ens'])){
    $ID_ens = $_SESSION['ID_ens'];
} else {
    header("Location: accueil.php");
    die();
}
require("blocs/config.php");
$erreur_mat = "";

if(isset($_POST["confirmer_mat"])){
    $nv_mat = (isset($_POST["nv_mat"])? $_POST["nv_mat"] : "");

    $sql = "SELECT * FROM matiere WHERE ID_ens LIKE '$ID_ens' AND nom LIKE '%$nv_mat%'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0){
        if ($nv_mat != ""){
            $sql2 = "INSERT INTO matiere(ID_ens, nom) VALUES('$ID_ens', '$nv_mat')";
            $result2 = mysqli_query($conn, $sql2);
        } else {
            $erreur_mat = "Veuillez saisir le nom de la matière<br>";
        }
    } else {
        $erreur_mat = "Une matière porte déjà le même nom<br>";
    }
}
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
    <div><br>
        Nom : <?php echo $_SESSION['nom_ens'] ?><br>
        Prénom : <?php echo $_SESSION['prenom_ens'] ?><br><br>
    </div>
    <div>
        Ajouter une matière :<br>
        <form method="post" action="">
            <input type="text" name="nv_mat"><br>
            <input type="submit" name="confirmer_mat" value="Confirmer">
        </form>
        <?php echo $erreur_mat; ?>
    </div><br>
    <div>
        Liste des matières :<br>
        <?php
        $sql = "SELECT * FROM matiere WHERE ID_ens LIKE $ID_ens";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)){ ?>
            <form method="post" action=""><?php
            while ($data = mysqli_fetch_assoc($result)){ ?>
                <input type="submit" name="<?php echo $data['ID_mat'] ?>" value="<?php echo $data['nom'] ?>"><br>
            <?php } ?>
            </form>
        <?php } ?>
    </div>
</body>
</html>

<?php
$sql = "SELECT * FROM matiere WHERE ID_ens LIKE $ID_ens";
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
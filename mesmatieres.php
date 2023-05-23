<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutetuens.php");
$ID_ut = $_SESSION['ID_ut'];
require("blocs/config.php");
$tabmat = array();
$result = false;
if ($_SESSION['statut'] == "ens"){
    $sql = "SELECT * FROM matiere WHERE ID_ens LIKE $ID_ut";
    $result = mysqli_query($conn, $sql);
} else if ($_SESSION['statut'] == "etu"){
    $sql2 = "SELECT * FROM groupeetudiant WHERE ID_etu LIKE $ID_ut";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2)){
        while ($data = mysqli_fetch_assoc($result2)){
            $ID_grp = $data['ID_grp'];
            $sql3 = "SELECT * FROM groupematiere WHERE ID_grp LIKE $ID_grp";
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3)){
                while ($data = mysqli_fetch_assoc($result3)){
                    // afin d'eviter les doublons de matieres
                    $ajouter_mat = true;
                    foreach ($tabmat as $valeur) {
                        if ($valeur == $data['ID_mat']){ $ajouter_mat = false; break; }
                    }
                    if ($ajouter_mat){ $tabmat[] = $data['ID_mat']; }
                }
            }
        }
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
    <link rel="stylesheet" href="mesmatieres.css">
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div class="container">
        <h1>Mes matières</h1>
        <div class="Nom">
    <div>
        <?php
        //echo mysqli_num_rows($result);
        if ($result){
            if (mysqli_num_rows($result)){ ?>
                <form method="post" action="">
                    <?php while ($data = mysqli_fetch_assoc($result)){ ?>
                    <input type="submit" class="nom" name="<?php echo $data['ID_mat'] ?>" value="<?php echo $data['nom'] ?>"><br>
                    <?php } ?>
                </form>
            <?php } else { echo "Aucune matière.<br>"; }
        } else if (count($tabmat)){ ?>
            <form method="post" action="">
            <?php foreach ($tabmat as $valeur){
                $sql = "SELECT * FROM matiere WHERE ID_mat LIKE $valeur";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result) ?>
                <input type="submit" class="nom" name="<?php echo $valeur ?>" value="<?php echo $data['nom'] ?>"><br>
            <?php } ?>
            </form>
        <?php } else { echo "Aucune matière.<br>"; }
        ?>
    </div>
    </div>
</body>
</html>

<?php
if ($_SESSION['statut'] == "ens"){
    $sql = "SELECT * FROM matiere WHERE ID_ens LIKE $ID_ut";
    $result = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($result)){
        if (isset($_POST[$data['ID_mat']])){
            $_SESSION['ID_mat'] = $data['ID_mat'];
            $_SESSION['nom_mat'] = $data['nom'];
            header("Location: detailmatiere.php");
            die();
        }
    }
} else if ($_SESSION['statut'] == "etu"){
    $sql2 = "SELECT * FROM groupeetudiant WHERE ID_etu LIKE $ID_ut";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2)){
        $tabmat = array();
        while ($data = mysqli_fetch_assoc($result2)){
            $ID_grp = $data['ID_grp'];
            $sql3 = "SELECT * FROM groupematiere WHERE ID_grp LIKE $ID_grp";
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result2)){
                while ($data = mysqli_fetch_assoc($result3)){
                    // afin d'eviter les doublons de matieres
                    $ajouter_mat = true;
                    foreach ($tabmat as $valeur) {
                        if ($valeur == $data['ID_mat']){ $ajouter_mat = false; break; }
                    }
                    if ($ajouter_mat){ $tabmat[] = $data['ID_mat']; }
                }
            }
        }
    }
    foreach ($tabmat as $valeur){
        $sql4 = "SELECT * FROM matiere WHERE ID_mat LIKE $valeur";
        $result4 = mysqli_query($conn, $sql4);
        $data = mysqli_fetch_assoc($result4);
        if (isset($_POST[$data['ID_mat']])){
            $_SESSION['ID_mat'] = $data['ID_mat'];
            $_SESSION['nom_mat'] = $data['nom'];
            header("Location: detailmatiere.php");
            die();
        }
    }
}
require("blocs/redirection.php");
mysqli_close($conn);
?>
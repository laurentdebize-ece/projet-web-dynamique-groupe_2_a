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
$erreur_comp = "";

if(isset($_POST["confirmer_comp"])){
    $nv_comp = (isset($_POST["nv_comp"])? $_POST["nv_comp"] : "");

    $sql = "SELECT * FROM competence WHERE ID_mat LIKE '$ID_mat' AND nom LIKE '%$nv_comp%'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0){
        if ($nv_comp != ""){
            $sql2 = "INSERT INTO competence(ID_mat, nom) VALUES('$ID_mat', '$nv_comp')";
            $result2 = mysqli_query($conn, $sql2);
            $sql2 = "SELECT * FROM competence WHERE ID_mat LIKE '$ID_mat' AND nom LIKE '$nv_comp'";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) == 1){
                $data2 = mysqli_fetch_assoc($result2);
                $ID_comp = $data2['ID_comp'];
                $sql2 = "SELECT * FROM groupematiere WHERE ID_mat LIKE '$ID_mat'";
                $result2 = mysqli_query($conn, $sql2);
                while ($data2 = mysqli_fetch_assoc($result2)){
                    $ID_grp = $data2['ID_grp'];
                    $sql3 = "SELECT * FROM groupeetudiant WHERE ID_grp LIKE '$ID_grp'";
                    $result3 = mysqli_query($conn, $sql3);
                    while ($data3 = mysqli_fetch_assoc($result3)){
                        $ID_etu = $data3['ID_etu'];
                        $sql4 = "INSERT INTO evaluation(ID_etu, ID_comp, deja_evaluee, demandee, note, confirme, commentaire) VALUES('$ID_etu','$ID_comp','non','non','','non','')";
                        $result4 = mysqli_query($conn, $sql4);
                    }
                }
            }
        } else {
            $erreur_comp = "Veuillez saisir le nom de la compétence<br>";
        }
    } else {
        $erreur_comp = "Une compétence porte déjà le même nom<br>";
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
    
    <br><div><?php echo $_SESSION['nom_mat'] ?></div>

    <?php
    if ($_SESSION['statut'] == "admin"){ ?>
        <br><div>
            <form method="post" action="">
                <input type="submit" name="supprimer_mat" value="Supprimer la matière">
                <br><br>
                Ajouter un groupe :<br>
                <select name="choix_ajt_grp">
                    <option value="aucun_grp">---</option>
                    <?php
                    $sql = "SELECT * FROM groupe";
                    $result = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_assoc($result)){
                        $ID_grp = $data['ID_grp'];
                        $nom_grp = $data['nom'];
                        $sql2 = "SELECT * FROM groupematiere WHERE ID_mat LIKE $ID_mat AND ID_grp LIKE $ID_grp";
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) == 0){ ?>
                            <option value="<?php echo $ID_grp ?>"><?php echo $data['nom'] ?></option>
                        <?php }
                    } ?>
                </select>
                <input type="submit" name="ajouter_grp" value="Confirmer">
            </form>
        </div>
    <?php } ?>

    <?php
    if ($_SESSION['statut'] == "admin" || $_SESSION['statut'] == "ens"){ ?>
        <br><div>
            <form method="post" action="">
                Ajouter une compétence :<br>
                <input type="text" name="nv_comp">
                <input type="submit" name="confirmer_comp" value="Confirmer">
            </form>
            <?php echo $erreur_comp; ?>
        </div>
    <?php } ?>

    <?php
    if ($_SESSION['statut'] == "admin"){ ?>
        <br><div>
            <?php
            $sql = "SELECT * FROM groupematiere WHERE ID_mat LIKE $ID_mat";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)){?>
                <form method="post" action="">
                <?php while ($data = mysqli_fetch_assoc($result)){
                    $ID_grp = $data['ID_grp'];
                    $sql2 = "SELECT * FROM groupe WHERE ID_grp LIKE '$ID_grp'";
                    $result2 = mysqli_query($conn, $sql2);
                    $data2 = mysqli_fetch_assoc($result2) ?>
                <input type="submit" name="<?php echo "grp" . $data['ID_grp'] ?>" value="<?php echo $data2['nom'] ?>"><br>
                <?php } ?>
                </form>
            <?php } else { echo "Aucun groupe.<br>"; } ?>
        </div>
    <?php } ?>

    <br><div>
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
$sql = "SELECT * FROM groupematiere WHERE ID_mat LIKE $ID_mat";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)){
    if (isset($_POST["grp" . $data['ID_grp']])){
        $ID_grp = $data['ID_grp'];
        $sql2 = "SELECT * FROM groupe WHERE ID_grp LIKE '$ID_grp'";
        $result2 = mysqli_query($conn, $sql2);
        $data2 = mysqli_fetch_assoc($result2);
        $_SESSION['ID_grp'] = $data['ID_grp'];
        $_SESSION['nom_grp'] = $data2['nom'];
        header("Location: detailgroupe.php");
        die();
    }
}

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
        $sql = "DELETE FROM groupematiere WHERE ID_mat LIKE '$ID_mat'";
        $result = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM competence WHERE ID_mat LIKE '$ID_mat'";
        $result = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($result)){
            $ID_comp_supp = $data['ID_comp'];
            $sql2 = "DELETE FROM evaluation WHERE ID_comp LIKE '$ID_comp_supp'";
            $result2 = mysqli_query($conn, $sql2);
            $sql2 = "DELETE FROM competence WHERE ID_comp LIKE '$ID_comp_supp'";
            $result2 = mysqli_query($conn, $sql2);
        }
        $sql = "DELETE FROM matiere WHERE ID_mat LIKE '$ID_mat'";
        $result = mysqli_query($conn, $sql);
        header("Location: matieres.php");
        die();
    }
}

if ($_SESSION['statut'] == "admin" && isset($_POST['ajouter_grp']) && $_POST["choix_ajt_grp"] != "aucun_grp"){
    $sql = "SELECT * FROM groupe";
    $result = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($result)){
        $ID_grp = $data['ID_grp'];
        $nom_grp = $data['nom'];
        $sql2 = "SELECT * FROM groupematiere WHERE ID_mat LIKE $ID_mat AND ID_grp LIKE $ID_grp";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) == 0){
            if ($_POST["choix_ajt_grp"] == $ID_grp){
                echo $_POST["choix_ajt_grp"];
                $sql3 = "INSERT INTO groupematiere(ID_grp, ID_mat) VALUES('$ID_grp','$ID_mat')";
                $result3 = mysqli_query($conn, $sql3);
                $sql3 = "SELECT * FROM competence WHERE ID_mat LIKE '$ID_mat'";
                $result3 = mysqli_query($conn, $sql3);
                while ($data3 = mysqli_fetch_assoc($result3)){
                    $ID_comp = $data3['ID_comp'];
                    $sql4 = "SELECT * FROM groupeetudiant WHERE ID_grp LIKE '$ID_grp'";
                    $result4 = mysqli_query($conn, $sql4);
                    while ($data4 = mysqli_fetch_assoc($result4)){
                        $ID_etu = $data4['ID_etu'];
                        $sql5 = "INSERT INTO evaluation(ID_etu, ID_comp, deja_evaluee, demandee, note, confirme, commentaire) VALUES('$ID_etu','$ID_comp','non','non','','non','')";
                        $result5 = mysqli_query($conn, $sql5);
                    }
                }
                header("Location: detailmatiere.php");
                die();
            }
        }
    }
}

require("blocs/redirection.php");
mysqli_close($conn);
?>
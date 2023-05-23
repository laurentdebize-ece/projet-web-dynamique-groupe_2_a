<?php
require("blocs/verificationsession.php");
require("blocs/verificationstatutetuens.php");
require("blocs/config.php");
$ID_ens = $_SESSION['ID_ut'];
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
    <div><br>Mes évaluations<br><br></div>

    <?php
    if ($_SESSION['statut'] == "ens"){ ?>
        <div><form method="post" action=""><?php
        $sql = "SELECT * FROM matiere WHERE ID_ens LIKE '$ID_ens'";
        $result = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($result)){
            $ID_mat = $data['ID_mat'];
            $sql2 = "SELECT * FROM competence WHERE ID_mat LIKE '$ID_mat'";
            $result2 = mysqli_query($conn, $sql2);
            while ($data2 = mysqli_fetch_assoc($result2)){
                $ID_comp = $data2['ID_comp'];
                $sql3 = "SELECT * FROM evaluation WHERE ID_comp LIKE '$ID_comp'";
                $result3 = mysqli_query($conn, $sql3);
                while ($data3 = mysqli_fetch_assoc($result3)){
                    if ($data3['confirme'] == "non" && $data3['note'] != ""){
                        $ID_etu = $data3['ID_etu'];
                        $sql4 = "SELECT * FROM etudiant WHERE ID_etu LIKE '$ID_etu'";
                        $result4 = mysqli_query($conn, $sql4);
                        $data4 = mysqli_fetch_assoc($result4);
                        echo "Etudiant : " . $data4['prenom'] . " " . $data4['nom'] . "<br>";
                        echo "Matière : " . $data['nom'] . ", compétence : " . $data2['nom'] . "<br>";
                        echo "Dernière évaluation de l'étudiant : ";
                        switch ($data3['note']) {
                            case "na": echo "non-acquis"; break;
                            case "eca": echo "en cours d'acquisition"; break;
                            case "a": echo "acquis"; break;
                            default : echo "aucune évaluation";
                        }?>
                        <input type="submit" name="<?php echo $data3['ID_eval'] ?>" value="Evaluer"><br><br>
                    <?php }
                }
            }
        } ?>
        </form></div>
    <?php } ?>
</body>
</html>

<?php
if ($_SESSION['statut'] == "ens"){
    $sql = "SELECT * FROM matiere WHERE ID_ens LIKE '$ID_ens'";
    $result = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($result)){
        $ID_mat = $data['ID_mat'];
        $sql2 = "SELECT * FROM competence WHERE ID_mat LIKE '$ID_mat'";
        $result2 = mysqli_query($conn, $sql2);
        while ($data2 = mysqli_fetch_assoc($result2)){
            $ID_comp = $data2['ID_comp'];
            $sql3 = "SELECT * FROM evaluation WHERE ID_comp LIKE '$ID_comp'";
            $result3 = mysqli_query($conn, $sql3);
            while ($data3 = mysqli_fetch_assoc($result3)){
                if ($data3['confirme'] == "non" && $data3['note'] != ""){
                    if (isset($_POST[$data3['ID_eval']])){
                        $ID_etu = $data3['ID_etu'];
                        $sql4 = "SELECT * FROM etudiant WHERE ID_etu LIKE '$ID_etu'";
                        $result4 = mysqli_query($conn, $sql4);
                        $data4 = mysqli_fetch_assoc($result4);
                        $_SESSION['ID_eval'] = $data3['ID_eval'];
                        header("Location: detailevaluation.php");
                        die();
                    }
                }
            }
        }
    }
}

require("blocs/redirection.php");
mysqli_close($conn);
?>
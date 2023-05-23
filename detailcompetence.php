<?php
require("blocs/verificationsession.php");
if (isset($_SESSION['ID_comp']) && isset($_SESSION['nom_comp'])){
    $ID_comp = $_SESSION['ID_comp'];
    $ID_ut = $_SESSION['ID_ut'];
} else {
    if ($_SESSION['statut'] == "etu" || $_SESSION['statut'] == "ens"){
        header("Location: mescompetences.php");
    } else {
        header("Location: touteslescompetences.php");
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
    <br><div><?php echo $_SESSION['nom_comp'] ?></div>
    
    <?php
    if ($_SESSION['statut'] == "etu"){
        $sql = "SELECT * FROM evaluation WHERE ID_etu LIKE '$ID_ut' AND ID_comp LIKE '$ID_comp'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){ ?>
            <br><div>Dernière évaluation : 
            <?php $data = mysqli_fetch_assoc($result);
            if ($data['deja_evaluee'] == "oui"){
                switch ($data['note']) {
                    case "na": echo "non-acquis"; break;
                    case "eca": echo "en cours d'acquisition"; break;
                    case "a": echo "acquis"; break;
                    default : echo "aucune évaluation";
                }
            } else if ($data['deja_evaluee'] == "non"){
                echo "aucune évaluation";
            }
            ?></div><?php
        }
    } ?>

    <?php if ($_SESSION['statut'] == "etu"){ ?>
        <br><div>
            <form method="post" action="">
                Evaluation :<br>
                <input type="radio" name="eval" value="comp_na"><label for="comp_na">Non-acquis</label><br>
                <input type="radio" name="eval" value="comp_eca"><label for="comp_eca">En cours d'acquisition</label><br>
                <input type="radio" name="eval" value="comp_a"><label for="comp_a">Acquis</label><br>
                <input type="submit" name="confirmer_eval" value="Confirmer l'auto-évaluation"><br>
                <?php echo $erreur_eval ?>
            </form>
        </div>
    <?php } ?>
    
</body>
</html>

<?php require("blocs/redirection.php"); mysqli_close($conn); ?>
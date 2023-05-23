<?php
require("blocs/verificationsession.php");
if ($_SESSION['statut'] != "ens" && !isset($_SESSION['ID_eval'])){
    header("Location: accueil.php");
    die();
}
require("blocs/config.php");
$ID_eval = $_SESSION['ID_eval'];

$erreur_eval = "";

if (isset($_POST["confirmer_eval"])){
    if (isset($_POST["eval"])){
        $sql = "SELECT * FROM evaluation WHERE ID_eval LIKE '$ID_eval'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){
            $note = "";
            switch ($_POST["eval"]) {
                case "comp_na": $note = "na" ; break;
                case "comp_eca": $note = "eca" ; break;
                case "comp_a": $note = "a" ; break;
            }
            if ($note != ""){
                $sql = "UPDATE evaluation SET deja_evaluee = 'oui', note = '$note', confirme = 'oui' WHERE ID_eval LIKE '$ID_eval'";
                $result = mysqli_query($conn, $sql);
                header("Location: mesevaluations.php");
                die();
            }
        }
    } else { $erreur_eval = "Saisissez une evaluation<br>"; }
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
    <div><br>Mes évaluations<br><br></div>

    <div>
        <?php
        $sql = "SELECT * FROM evaluation WHERE ID_eval LIKE '$ID_eval'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            $ID_etu = $data['ID_etu'];
            $ID_comp = $data['ID_comp'];
            $note = $data['note'];
            $sql = "SELECT * FROM etudiant WHERE ID_etu LIKE '$ID_etu'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            echo "Etudiant : " . $data['prenom'] . " " . $data['nom'] . "<br>";
            $sql = "SELECT * FROM competence WHERE ID_comp LIKE '$ID_comp'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $ID_mat = $data['ID_mat'];
            $sql2 = "SELECT * FROM matiere WHERE ID_mat LIKE '$ID_mat'";
            $result2 = mysqli_query($conn, $sql2);
            $data2 = mysqli_fetch_assoc($result2);
            echo "Matière : " . $data2['nom'] . ", compétence : " . $data['nom'] . "<br>";
            echo "Dernière évaluation de l'étudiant : ";
            switch ($note) {
                case "na": echo "non-acquis"; break;
                case "eca": echo "en cours d'acquisition"; break;
                case "a": echo "acquis"; break;
                default : echo "aucune évaluation";
            } ?>
            <br><br><form method="post" action="">
                Evaluation :<br>
                <input type="radio" name="eval" value="comp_na"><label for="comp_na">Non-acquis</label><br>
                <input type="radio" name="eval" value="comp_eca"><label for="comp_eca">En cours d'acquisition</label><br>
                <input type="radio" name="eval" value="comp_a"><label for="comp_a">Acquis</label><br>
                <input type="submit" name="confirmer_eval" value="Confirmer l'auto-évaluation"><br>
                <?php echo $erreur_eval ?>
            </form>
        <?php } ?>
    </div>
</body>
</html>

<?php require("blocs/redirection.php"); mysqli_close($conn); ?>
<?php
require("blocs/verificationsession.php");
require("blocs/config.php");
$erreur_mail = "";
$erreur_mdp = "";
$ID_ut = $_SESSION['ID_ut'];

if(isset($_POST["confirmer_mail"])){
    $nvmail = (isset($_POST["nv_mail"])? $_POST["nv_mail"] : "");
    $sql = "SELECT * FROM utilisateur";

    if (($nvmail != "")){
        $sql .= " WHERE mail LIKE '$nvmail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0){
            $sql = "UPDATE utilisateur SET mail = '$nvmail' WHERE utilisateur.ID_ut = '$ID_ut'";
            $result = mysqli_query($conn, $sql);
            $erreur_mail = "E-mail modifié avec succès<br>";
        } else if (mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            if ($data['ID_ut'] == $_SESSION['ID_ut']){
                $erreur_mail = "E-mail modifié avec succès<br>";
            }
            else {
                $erreur_mail = "Cet e-mail est déjà pris<br>";
            }
        } else {
            $erreur_mail = "Cet e-mail est déjà pris<br>";
        }
    } else {
        $erreur_mail = "Veuillez saisir un nouvel e-mail<br>";
    }
} else if(isset($_POST["confirmer_mdp"])){
    $mdpactuel = (isset($_POST["mdp_actuel"])? $_POST["mdp_actuel"] : "");
    $nvmdp1 = (isset($_POST["nv_mdp1"])? $_POST["nv_mdp1"] : "");
    $nvmdp2 = (isset($_POST["nv_mdp2"])? $_POST["nv_mdp2"] : "");

    if ($mdpactuel != "" && $nvmdp1 != "" && $nvmdp2 != ""){
        $sql = "SELECT * FROM utilisateur WHERE ID_ut LIKE '$ID_ut' AND mdp LIKE '$mdpactuel'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){
            if ($nvmdp1 == $nvmdp2){
                $sql = "UPDATE utilisateur SET mdp = '$nvmdp1' WHERE utilisateur.ID_ut = '$ID_ut'";
                $result = mysqli_query($conn, $sql);
                $erreur_mdp = "Mot de passe modifié avec succès";
            } else {
                $erreur_mdp = "Le nouveau mot de passe saisi n'est pas identique dans les deux champs";
            }
        } else {
            $erreur_mdp = "Mot de passe incorrect";
        }
    } else {
        $erreur_mdp = "Veuillez remplir les trois champs précédents";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#modifier_mail").click(function(){
                $("#formulaire_mail").css("display", "block");
            });
        });
    </script>
</head>
<body>
    <?php require("blocs/header.php"); ?>
    <div><br>Mon compte<br><br></div>
    <div>
        <?php
        $table = "";
        switch ($_SESSION['statut']) {
            case "admin": $table = "administrateur"; break;
            case "etu": $table = "etudiant"; break;
            case "ens": $table = "enseignant"; break;
        }
        $sql = "SELECT * FROM $table WHERE ID_ut LIKE '$ID_ut'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            echo "Nom : " . $data['nom'] . "<br>";
            echo "Prénom : " . $data['prenom'] . "<br>";
        }
        $sql = "SELECT * FROM utilisateur WHERE ID_ut LIKE '$ID_ut'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            echo "Statut : " . $table . "<br>";
            echo "E-mail : " . $data['mail'] . "<br>";
        } ?>
    </div>
    <div>
        <br><input type="submit" id="modifier_mail" name="modifier_mail" value="Modifier l'e-mail"><br>
        <form method="post" action="">
            Nouvel e-mail :<br>
            <input type="email" name="nv_mail"><br>
            <input type="submit" name="confirmer_mail" value="Confirmer"><br>
            <?php echo $erreur_mail; ?>
        </form>
    </div>
    <div>
        <br><input type="submit" id="modifier_mdp" name="modifier_mdp" value="Modifier le mot de passe"><br>
        <form method="post" action="">
            Mot de passe actuel :<br>
            <input type="password" name="mdp_actuel"><br>
            Nouveau mot de passe :<br>
            <input type="password" name="nv_mdp1"><br>
            Confirmation du mot de passe :<br>
            <input type="password" name="nv_mdp2"><br>
            <input type="submit" name="confirmer_mdp" value="Confirmer"><br>
            <?php echo $erreur_mdp; ?>
        </form>
    </div>
</body>
</html>

<?php require("blocs/redirection.php"); mysqli_close($conn); ?>
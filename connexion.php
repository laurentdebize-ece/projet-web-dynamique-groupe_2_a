<<<<<<<<< Temporary merge branch 1
<?php
session_start();
if (isset($_SESSION['ID_ut']) && isset($_SESSION['statut'])){
    header("Location: accueil.php");
    die();
}
require("config.php");
?>

=========
>>>>>>>>> Temporary merge branch 2
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        Connexion<br>
        E-mail : <input type="email" name="mail"><br>
        Mot de passe : <input type="password" name="mdp"><br>
        <input type="submit" name="se_connecter" value="Se connecter"><br>
    </form>
    <?php
    if(isset($_POST["se_connecter"])){
        //on recupere mail et mdp du formulaire
        $mail = (isset($_POST["mail"])? $_POST["mail"] : "");
        $mdp = (isset($_POST["mdp"])? $_POST["mdp"] : "");
        $sql = "SELECT * FROM utilisateur";

        if (($mail != "")&&($mdp != "")) {
            //on definit la requete sql
            $sql .= " WHERE mail LIKE '$mail' AND mdp LIKE '$mdp'";
            $result = mysqli_query($conn, $sql);
            //on regarde s'il y a un resultat
            if (mysqli_num_rows($result) == 1){
                $data = mysqli_fetch_assoc($result);
                //on cree une variable pour identifier l'utilisateur dans la session
                $_SESSION['ID_ut'] = $data['ID_ut'];
                $_SESSION['statut'] = $data['statut'];
                //on va vers l'accueil
                header("Location: accueil.php");
            } else {
                echo "E-mail ou mot de passe incorrect";
                session_destroy();
            }
        } else {
            echo "Veuillez saisir votre e-mail et votre mot de passe";
            session_destroy();
        }
    }
    ?>
</body>
</html>

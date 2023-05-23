<?php

session_start();
if (isset($_SESSION['ID_ut']) && isset($_SESSION['statut'])){
    header("Location: accueil.php");
    die();      
}
require("blocs/config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form method="post" action="">
            <label for="mail">E-mail :</label>
            <input type="email" id="mail" name="mail">
            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp">
            <input type="submit" name="se_connecter" value="Se connecter">
        </form>
        <?php
        if(isset($_POST["se_connecter"])){
            //on recupere mail et mdp du formulaire
            $mail = (isset($_POST["mail"])? $_POST["mail"] : "");
            $mdp = (isset($_POST["mdp"])? $_POST["mdp"] : "");

            if (($mail != "")&&($mdp != "")) {
                //on definit la requete sql
                $sql = "SELECT * FROM utilisateur WHERE mail LIKE '$mail' AND mdp LIKE '$mdp'";
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
                    echo "<div class='error'>E-mail ou mot de passe incorrect</div>";
                    session_destroy();
                }
            } else {
                echo "<div class='error'>Veuillez saisir votre e-mail et votre mot de passe</div>";
                session_destroy();
            }
        }
        ?>
    </div>
</body>
</html>


<?php mysqli_close($conn); ?>
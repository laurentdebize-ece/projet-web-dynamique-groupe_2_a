<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form method="post" action="">
            <?php if ($_SESSION['statut'] == "ens" || $_SESSION['statut'] == "eleve"){ ?>
                <input type="submit" name="mes_mat" value="Mes matières" onclick="window.location.href='mesmatieres.php';">
                <input type="submit" name="mes_comp" value="Mes compétences" onclick="window.location.href='mescomptences.php';">
            <?php } if ($_SESSION['statut'] == "admin" || $_SESSION['statut'] == "eleve"){ ?>
                <input type="submit" name="ttes_les_comp" value="Toutes les compétences" onclick="window.location.href='touteslescompetences.php';">
            <?php } if ($_SESSION['statut'] == "admin"){ ?>
                <input type="submit" name="matieres" value="Matières" onclick="window.location.href='matieres.php';">
                <input type="submit" name="groupes" value="Groupes" onclick="window.location.href='groupes.php';">
                <input type="submit" name="promos" value="Promo" onclick="window.location.href='promo.php';">
                <input type="submit" name="enseignants" value="Enseignants" onclick="window.location.href='enseignants.php';">
                <input type="submit" name="etudiants" value="Etudiants" onclick="window.location.href='etudiants.php';">
            <?php } ?>
            <input type="submit" name="accueil" value="Accueil" onclick="window.location.href='accueil.php';">
            <input type="submit" name="se_deconnecter" value="Se déconnecter" onclick="window.location.href='connexion.php';" style="float: right">
            <input type="submit" name="mon_compte" value="Mon compte" onclick="window.location.href='moncompte.php';" style="float: right"><br>
</form>

</body>
</html>




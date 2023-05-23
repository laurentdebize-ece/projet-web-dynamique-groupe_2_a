<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="blocs/header.css">
</head>
<body>
    <header>
        <form method="post" action="">
            <?php if ($_SESSION['statut'] == "ens" || $_SESSION['statut'] == "etu"){ ?>
                <input type="submit" class="bouton1" name="mes_mat" value="Mes matières">
                <input type="submit" class="bouton1" name="mes_comp" value="Mes compétences">
                <input type="submit" class="bouton1" name="mes_eval" value="Mes évaluations">
            <?php } if ($_SESSION['statut'] == "admin" || $_SESSION['statut'] == "etu"){ ?>
                <input type="submit" class="bouton1" name="ttes_les_comp" value="Toutes les compétences">
            <?php } if ($_SESSION['statut'] == "admin"){ ?>
                <input type="submit" class="bouton1" name="matieres" value="Matières">
                <input type="submit" class="bouton1" name="groupes" value="Groupes">
                <input type="submit" class="bouton1" name="promos" value="Promo">
                <input type="submit" class="bouton1" name="enseignants" value="Enseignants">
                <input type="submit" class="bouton1" name="etudiants" value="Etudiants">
            <?php } ?>
            <input type="submit"  class="bouton1" name="accueil" value="Accueil">
            <input type="submit" class="bouton1" name="se_deconnecter" value="Se déconnecter" style="float: right">
            <input type="submit" class="bouton1" name="mon_compte" value="Mon compte" style="float: right"><br>
        </form>
    </header>
</body>
</html>

<form method="post" action="">
    <?php if ($_SESSION['statut'] == "ens" || $_SESSION['statut'] == "eleve"){ ?>
        <input type="submit" name="mes_mat" value="Mes matières">
        <input type="submit" name="mes_comp" value="Mes compétences">
    <?php } if ($_SESSION['statut'] == "admin" || $_SESSION['statut'] == "eleve"){ ?>
        <input type="submit" name="ttes_les_comp" value="Toutes les compétences">
    <?php } if ($_SESSION['statut'] == "admin"){ ?>
        <input type="submit" name="matieres" value="Matières">
        <input type="submit" name="groupes" value="Groupes">
        <input type="submit" name="promos" value="Promo">
        <input type="submit" name="enseignants" value="Enseignants">
        <input type="submit" name="etudiants" value="Etudiants">
    <?php } ?>
    <input type="submit" name="accueil" value="Accueil">
    <input type="submit" name="se_deconnecter" value="Se déconnecter" style="float: right">
    <input type="submit" name="mon_compte" value="Mon compte" style="float: right"><br>
</form>
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 mai 2023 à 11:18
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `omnesmyskills`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `ID_admin` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ut` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_admin`),
  KEY `FK_ADMIN_UT` (`ID_ut`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`ID_admin`, `ID_ut`, `nom`, `prenom`) VALUES
(1, 1, 'Nom Admin1', 'Prenom Admin1');

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `ID_comp` int(11) NOT NULL AUTO_INCREMENT,
  `ID_mat` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_comp`),
  KEY `FK_COMP_MAT` (`ID_mat`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`ID_comp`, `ID_mat`, `nom`) VALUES
(1, 1, 'HTML'),
(2, 1, 'XML'),
(3, 1, 'CSS'),
(4, 2, 'Espaces vectoriels'),
(5, 2, 'Applications lineaires'),
(6, 2, 'Matrices'),
(7, 3, 'Condensateur'),
(8, 3, 'Dipole electrostatique'),
(9, 3, 'Dipole magnetique');

-- --------------------------------------------------------

--
-- Structure de la table `detailevaluation`
--

DROP TABLE IF EXISTS `detailevaluation`;
CREATE TABLE IF NOT EXISTS `detailevaluation` (
  `ID_eval` int(11) NOT NULL,
  `note` int(3) NOT NULL,
  `confirme` varchar(3) NOT NULL,
  `commentaire` text NOT NULL,
  KEY `FK_DETEVAL_EVAL` (`ID_eval`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

DROP TABLE IF EXISTS `ecole`;
CREATE TABLE IF NOT EXISTS `ecole` (
  `ID_ecole` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_ecole`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ecole`
--

INSERT INTO `ecole` (`ID_ecole`, `nom`) VALUES
(1, 'ECE'),
(2, 'HEIP'),
(3, 'Sup de Pub');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `ID_ens` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ut` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_ens`),
  KEY `FK_ENS_UT` (`ID_ut`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`ID_ens`, `ID_ut`, `nom`, `prenom`) VALUES
(3, 3, 'Debize', 'Laurent'),
(4, 4, 'Bianchi', 'Celine'),
(5, 5, 'Dedecker', 'Samira');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_etu` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ut` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_etu`),
  KEY `FK_ETU_UT` (`ID_ut`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ID_etu`, `ID_ut`, `nom`, `prenom`) VALUES
(2, 2, 'Merlin', 'Amaury'),
(6, 6, 'Soliveres', 'Yannis'),
(7, 7, 'Imbert', 'Remi'),
(8, 8, 'Sanchez', 'Florian');

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `ID_eval` int(11) NOT NULL AUTO_INCREMENT,
  `ID_etu` int(11) NOT NULL,
  `ID_comp` int(11) NOT NULL,
  `deja_evaluee` varchar(3) NOT NULL,
  PRIMARY KEY (`ID_eval`),
  KEY `FK_EVAL_ETU` (`ID_etu`),
  KEY `FK_EVAL_COMP` (`ID_comp`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`ID_eval`, `ID_etu`, `ID_comp`, `deja_evaluee`) VALUES
(1, 6, 1, 'non'),
(2, 6, 2, 'non'),
(3, 6, 3, 'non'),
(4, 7, 1, 'non'),
(5, 7, 2, 'non'),
(6, 7, 3, 'non'),
(7, 8, 1, 'non'),
(8, 8, 2, 'non'),
(9, 8, 3, 'non'),
(10, 2, 1, 'non'),
(11, 2, 2, 'non'),
(12, 2, 3, 'non');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `ID_grp` int(11) NOT NULL AUTO_INCREMENT,
  `ID_promo` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_grp`),
  KEY `FK_GRP_PROMO` (`ID_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`ID_grp`, `ID_promo`, `nom`) VALUES
(1, 1, 'Groupe 1'),
(2, 1, 'Groupe 2'),
(3, 1, 'Groupe 3');

-- --------------------------------------------------------

--
-- Structure de la table `groupeetudiant`
--

DROP TABLE IF EXISTS `groupeetudiant`;
CREATE TABLE IF NOT EXISTS `groupeetudiant` (
  `ID_etu` int(11) NOT NULL,
  `ID_grp` int(11) NOT NULL,
  KEY `FK_GRPETU_GRP` (`ID_grp`),
  KEY `FK_GRPETU_ETU` (`ID_etu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupeetudiant`
--

INSERT INTO `groupeetudiant` (`ID_etu`, `ID_grp`) VALUES
(7, 2),
(8, 2),
(2, 2),
(2, 3),
(6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `groupematiere`
--

DROP TABLE IF EXISTS `groupematiere`;
CREATE TABLE IF NOT EXISTS `groupematiere` (
  `ID_grp` int(11) NOT NULL,
  `ID_mat` int(11) NOT NULL,
  KEY `FK_GRPMAT_GRP` (`ID_grp`),
  KEY `FK_GRPMAT_MAT` (`ID_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupematiere`
--

INSERT INTO `groupematiere` (`ID_grp`, `ID_mat`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `ID_mat` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ens` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_mat`),
  KEY `FK_MAT_ENS` (`ID_ens`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`ID_mat`, `ID_ens`, `nom`) VALUES
(1, 3, 'Web dynamique'),
(2, 4, 'Algebre 3'),
(3, 5, 'Electromagnetisme 2');

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `ID_promo` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ecole` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `fin` int(4) NOT NULL,
  PRIMARY KEY (`ID_promo`),
  KEY `FK_PROMO_ECOLE` (`ID_ecole`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`ID_promo`, `ID_ecole`, `nom`, `fin`) VALUES
(1, 1, 'ING2', 2026),
(2, 1, 'ING1', 2027),
(3, 1, 'ING3', 2025),
(4, 1, 'Pas de promo', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_ut` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `statut` varchar(5) NOT NULL,
  PRIMARY KEY (`ID_ut`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_ut`, `mail`, `mdp`, `statut`) VALUES
(1, '1@edu.ece.fr', 'abc123', 'admin'),
(2, '2@edu.ece.fr', 'abc123', 'etu'),
(3, '3@edu.ece.fr', 'abc123', 'ens'),
(4, '4@edu.ece.fr', 'abc123', 'ens'),
(5, '5@edu.ece.fr', 'abc123', 'ens'),
(6, '6@edu.ece.fr', 'abc123', 'etu'),
(7, '7@edu.ece.fr', 'abc123', 'etu'),
(8, '8@edu.ece.fr', 'abc123', 'etu');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `FK_ADMIN_UT` FOREIGN KEY (`ID_ut`) REFERENCES `utilisateur` (`ID_ut`);

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `FK_COMP_MAT` FOREIGN KEY (`ID_mat`) REFERENCES `matiere` (`ID_mat`);

--
-- Contraintes pour la table `detailevaluation`
--
ALTER TABLE `detailevaluation`
  ADD CONSTRAINT `FK_DETEVAL_EVAL` FOREIGN KEY (`ID_eval`) REFERENCES `evaluation` (`ID_eval`);

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `FK_ENS_UT` FOREIGN KEY (`ID_ut`) REFERENCES `utilisateur` (`ID_ut`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_ETU_UT` FOREIGN KEY (`ID_ut`) REFERENCES `utilisateur` (`ID_ut`);

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `FK_EVAL_COMP` FOREIGN KEY (`ID_comp`) REFERENCES `competence` (`ID_comp`),
  ADD CONSTRAINT `FK_EVAL_ETU` FOREIGN KEY (`ID_etu`) REFERENCES `etudiant` (`ID_etu`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `FK_GRP_PROMO` FOREIGN KEY (`ID_promo`) REFERENCES `promo` (`ID_promo`);

--
-- Contraintes pour la table `groupeetudiant`
--
ALTER TABLE `groupeetudiant`
  ADD CONSTRAINT `FK_GRPETU_ETU` FOREIGN KEY (`ID_etu`) REFERENCES `etudiant` (`ID_etu`),
  ADD CONSTRAINT `FK_GRPETU_GRP` FOREIGN KEY (`ID_grp`) REFERENCES `groupe` (`ID_grp`);

--
-- Contraintes pour la table `groupematiere`
--
ALTER TABLE `groupematiere`
  ADD CONSTRAINT `FK_GRPMAT_GRP` FOREIGN KEY (`ID_grp`) REFERENCES `groupe` (`ID_grp`),
  ADD CONSTRAINT `FK_GRPMAT_MAT` FOREIGN KEY (`ID_mat`) REFERENCES `matiere` (`ID_mat`);

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `FK_MAT_ENS` FOREIGN KEY (`ID_ens`) REFERENCES `enseignant` (`ID_ens`);

--
-- Contraintes pour la table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `FK_PROMO_ECOLE` FOREIGN KEY (`ID_ecole`) REFERENCES `ecole` (`ID_ecole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

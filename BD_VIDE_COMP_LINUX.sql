-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2017 at 07:56 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `activites`
--

CREATE TABLE `activites` (
  `id_activite` int(11) NOT NULL,
  `nom_activite` varchar(75) NOT NULL,
  `duree` varchar(30) NOT NULL,
  `commentaire` text NOT NULL,
  `couleur` char(6) NOT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `ponderation` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activites`
--

INSERT INTO `activites` (`id_activite`, `nom_activite`, `duree`, `commentaire`, `couleur`, `hidden`, `ponderation`) VALUES
(1, 'Soccer intérieur', '50', 'Equipes 4 contre 4', '3152C3', 0, 1),
(2, 'Badminton', '50', 'Badminton en double', '3152C3', 0, 1),
(4, 'Marathon', '180', '', '', 0, 6),
(6, 'Soccer extérieur', '50', 'Equipe 7 contre 7', '48B492', 0, 1),
(7, 'Natation', '60', 'Nage libre', '1B7EBB', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `activites_prevues`
--

CREATE TABLE `activites_prevues` (
  `id_activite_prevue` int(11) NOT NULL,
  `date_activite` date NOT NULL,
  `heure_debut` time NOT NULL,
  `participants_max` int(11) NOT NULL,
  `frais` double NOT NULL,
  `endroit` varchar(200) NOT NULL,
  `id_activite` int(11) NOT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `presences_prises` tinyint(1) NOT NULL,
  `responsable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `id_groupe` int(11) NOT NULL,
  `nom_groupe` varchar(65) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `ensemble` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id_session` int(11) NOT NULL,
  `debut_session` date NOT NULL,
  `fin_session` date NOT NULL,
  `mi_session` date NOT NULL,
  `nom_session` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `id_groupe` int(11) DEFAULT NULL,
  `code_acces` char(5) DEFAULT NULL,
  `actif` tinyint(1) DEFAULT '0',
  `courriel` varchar(75) DEFAULT NULL,
  `telephone` char(14) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `administrateur` tinyint(1) NOT NULL,
  `type_utilisateur` varchar(50) DEFAULT NULL,
  `date_inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `id_groupe`, `code_acces`, `actif`, `courriel`, `telephone`, `sexe`, `username`, `password`, `administrateur`, `type_utilisateur`, `date_inscription`) VALUES
(1, 'administrateur', 'administrateur', 0, NULL, 1, NULL, NULL, NULL, 'administrateur', '$2y$10$uO8R31N32qnesMkIcWt9LO15yGVCbvsWkgg2P9yNmHb3ZGCR1IRb6', 2, 'administrateur', '2016-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur_activites`
--

CREATE TABLE `utilisateur_activites` (
  `id_eleve_activite` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_activite_prevue` int(11) NOT NULL,
  `present` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id_activite`);

--
-- Indexes for table `activites_prevues`
--
ALTER TABLE `activites_prevues`
  ADD PRIMARY KEY (`id_activite_prevue`);

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id_session`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Indexes for table `utilisateur_activites`
--
ALTER TABLE `utilisateur_activites`
  ADD PRIMARY KEY (`id_eleve_activite`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activites`
--
ALTER TABLE `activites`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `activites_prevues`
--
ALTER TABLE `activites_prevues`
  MODIFY `id_activite_prevue` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `utilisateur_activites`
--
ALTER TABLE `utilisateur_activites`
  MODIFY `id_eleve_activite` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

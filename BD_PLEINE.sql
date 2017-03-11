-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2017 at 04:10 AM
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
  `ID_Activite` int(11) NOT NULL,
  `Nom_Activite` varchar(75) NOT NULL,
  `Duree` varchar(30) NOT NULL,
  `Commentaire` text NOT NULL,
  `couleur` char(6) NOT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `Ponderation` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activites`
--

INSERT INTO `activites` (`ID_Activite`, `Nom_Activite`, `Duree`, `Commentaire`, `couleur`, `hidden`, `Ponderation`) VALUES
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
  `ID_activite_prevue` int(11) NOT NULL,
  `Date_Activite` date NOT NULL,
  `Heure_debut` time NOT NULL,
  `Participants_Max` int(11) NOT NULL,
  `Frais` double NOT NULL,
  `Endroit` varchar(200) NOT NULL,
  `ID_Activite` int(11) NOT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `presences_prises` tinyint(1) NOT NULL,
  `responsable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activites_prevues`
--

INSERT INTO `activites_prevues` (`ID_activite_prevue`, `Date_Activite`, `Heure_debut`, `Participants_Max`, `Frais`, `Endroit`, `ID_Activite`, `hidden`, `presences_prises`, `responsable`) VALUES
(1, '2016-09-15', '19:00:00', 10, 10, 'Gymnase des sciences', 2, 0, 1, 2),
(2, '2016-10-10', '19:00:00', 10, 10, 'Gymnase des sciences', 2, 0, 1, 2),
(3, '2016-09-28', '19:00:00', 10, 10, 'Piscine du Cégep', 7, 0, 1, 2),
(4, '2016-11-05', '19:00:00', 10, 10, 'Parc national de la mauricie', 6, 0, 1, 2),
(5, '2016-11-15', '16:00:00', 15, 19, 'Parc pie iv', 4, 0, 1, 2),
(7, '2017-03-17', '15:00:00', 12, 0, 'Piscine des humanités', 7, 0, 0, 2),
(8, '2017-03-24', '15:00:00', 12, 0, 'Piscine des humanités', 7, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `ID_Groupe` int(11) NOT NULL,
  `Nom_Groupe` varchar(65) NOT NULL,
  `ID_Prof` int(11) NOT NULL,
  `ID_Session` int(11) NOT NULL,
  `Ensemble` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`ID_Groupe`, `Nom_Groupe`, `ID_Prof`, `ID_Session`, `Ensemble`) VALUES
(1, 'Vie Active Gr.1', 2, 4, 1),
(8, 'Plein Air Gr.7', 2, 4, 2),
(9, 'Vie Active Gr.2', 2, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `ID_Session` int(11) NOT NULL,
  `Debut_Session` date NOT NULL,
  `Fin_Session` date NOT NULL,
  `Mi_Session` date NOT NULL,
  `Nom_Session` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`ID_Session`, `Debut_Session`, `Fin_Session`, `Mi_Session`, `Nom_Session`) VALUES
(1, '2017-01-20', '2017-05-19', '2017-03-13', 'Hiver 2017'),
(4, '2016-08-20', '2016-12-15', '2016-10-18', 'Automne 2016');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ID_Groupe` int(11) DEFAULT NULL,
  `CODE_ACCES` char(5) DEFAULT NULL,
  `Actif` tinyint(1) DEFAULT '0',
  `Courriel` varchar(75) DEFAULT NULL,
  `Telephone` char(14) DEFAULT NULL,
  `Sexe` char(1) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `administrateur` tinyint(1) NOT NULL,
  `Type_Utilisateur` varchar(50) DEFAULT NULL,
  `Date_Inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `Nom`, `Prenom`, `ID_Groupe`, `CODE_ACCES`, `Actif`, `Courriel`, `Telephone`, `Sexe`, `username`, `password`, `administrateur`, `Type_Utilisateur`, `Date_Inscription`) VALUES
(1, 'administrateur', 'administrateur', 0, NULL, 1, NULL, NULL, NULL, 'administrateur', '$2y$10$uO8R31N32qnesMkIcWt9LO15yGVCbvsWkgg2P9yNmHb3ZGCR1IRb6', 2, 'administrateur', '2016-08-10'),
(2, 'Paré', 'Marie', 0, '', 1, 'Mpare@hotmail.com', '(819) 384-2691', 'F', 'Mpare', '$2y$10$4ZNj5An49fbwnFJhUNUBdes0QF2zIGnU8hgQMxTgaj.TAOZXOJNJ.', 2, 'eleve', '2016-09-01'),
(3, NULL, NULL, NULL, '4whWO', 0, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(4, 'Bélanger', 'Martin', 1, '', 1, 'Mbelanger@hotmail.com', '(813) 931-2098', 'H', 'Mbelanger', '$2y$10$HdS1AtQ9dg9UpadiwIqFz.dNSGVkRZB5v55YKOLjDUVb.nV771uli', 0, 'eleve', '2016-09-01'),
(5, 'Goulet', 'Lisa', 1, '', 1, 'Lgoulet@hotmail.com', '(981) 427-4908', 'F', 'Lgoulet', '$2y$10$/VML0StPF3Kk3qmfzZM7ku0BJXDc85chQLcnP5Vv7FAWl0D/niy/6', 0, 'eleve', '2016-09-01'),
(6, 'Légaré', 'Xavier', 1, '', 1, 'Xlegare@hotmail.com', '(940) 812-8904', 'H', 'Xlegare', '$2y$10$VCL/mTpE0AZ2w.UmjAsqs.T2oFBZYKzAEdxwUXzy7TvzO7LRnFrci', 0, 'eleve', '2016-09-01'),
(7, NULL, NULL, 1, '5SVul', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(8, NULL, NULL, 1, 'HmzWL', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(9, NULL, NULL, 1, 'N07cX', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(10, NULL, NULL, 1, 'G84uo', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(11, 'Charpentier', 'Anne-sophie', 1, '', 1, 'Acharpentier@hotmail.com', '(905) 128-5921', 'F', 'Acharpentier', '$2y$10$SlpC5FleEMz0JZL/AVDNBuDNC5p3VDB2Nd4DGmRqNCxb4LJfcGfGG', 0, 'eleve', '2016-09-01'),
(12, NULL, NULL, 1, 'Q94K8', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(13, NULL, NULL, 1, 'VCopi', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(14, 'Martel', 'Karine', 8, '', 1, 'Kmartel@hotmail.com', '(891) 270-1940', 'F', 'Kmartel', '$2y$10$z3n/3uSjDmGmT2hewdX4y.kdutRbFA1pxtX.5w/SdqGlWvZqyCMOe', 0, 'eleve', '2016-09-01'),
(15, NULL, NULL, 8, 'LVfJu', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(16, NULL, NULL, 8, 'rilHK', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(17, NULL, NULL, 8, '4f4ai', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(18, 'Naud', 'Alexandre', 8, '', 1, 'Anaud@hotmail.com', '(124) 127-9048', 'H', 'Anaud', '$2y$10$WA0u2Ai.1Z4G6YZXHUm63OdwNNE73ri271G976/ZujV0v3YFxX4ci', 0, 'eleve', '2016-09-01'),
(19, 'Robichaud', 'Guy', 9, '', 1, 'Rguy@hotmail.com', '(109) 481-2901', 'H', 'Rguy', '$2y$10$EmUvizigmIbFUjhyktKTcuExf3aSEsyTfcj8gw1471zG677usMJqW', 0, 'eleve', '2016-09-01'),
(20, NULL, NULL, 9, 'cxokz', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(21, 'Tousignant', 'Lyanne', 9, '', 1, 'Ltousignant@hotmail.com', '(590) 237-2857', 'F', 'Ltousignant', '$2y$10$rJy/r6L0y/UnD2XCGqOcKe03kZNcKmx88TnaCy66IeeYkcwBt5T36', 0, 'eleve', '2016-09-01'),
(22, NULL, NULL, NULL, 'mI2LA', 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(23, NULL, NULL, 0, 'i9NA8', 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(24, NULL, NULL, -1, 'RqqZb', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(25, NULL, NULL, -1, 'LWH1w', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(26, NULL, NULL, -1, 'MDF2j', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(27, 'Paré', 'Réjean', 0, '', 1, 'Rpare@hotmail.com', '(255) 243-2423', 'H', 'Rpare', '$2y$10$/X89GIpz0Kkji4u664aZp.3pCZEhioFuiPa9K/mR2dgPBqY/b.E9C', 0, 'soutien', '2017-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur_activites`
--

CREATE TABLE `utilisateur_activites` (
  `ID_Eleve_Activite` int(11) NOT NULL,
  `ID_Utilisateur` int(11) NOT NULL,
  `ID_Activite_Prevue` int(11) NOT NULL,
  `Present` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur_activites`
--

INSERT INTO `utilisateur_activites` (`ID_Eleve_Activite`, `ID_Utilisateur`, `ID_Activite_Prevue`, `Present`) VALUES
(10, 4, 4, 1),
(11, 4, 3, 0),
(12, 4, 2, 1),
(13, 4, 1, 0),
(14, 14, 4, 1),
(15, 14, 3, 1),
(16, 14, 2, 1),
(17, 14, 1, 0),
(23, 18, 4, 1),
(24, 18, 2, 1),
(25, 18, 3, 1),
(26, 18, 1, 1),
(28, 5, 1, 1),
(29, 5, 3, 1),
(30, 5, 2, 1),
(31, 5, 4, 1),
(32, 6, 3, 0),
(33, 6, 4, 0),
(34, 6, 2, 1),
(35, 6, 1, 0),
(37, 11, 2, 1),
(38, 11, 3, 1),
(39, 11, 1, 1),
(40, 21, 1, 1),
(41, 21, 2, 1),
(42, 21, 3, 1),
(43, 21, 4, 1),
(44, 21, 5, 1),
(45, 19, 1, 1),
(46, 19, 2, 0),
(47, 19, 3, 1),
(48, 19, 4, 1),
(49, 19, 5, 1),
(50, 2, 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`ID_Activite`);

--
-- Indexes for table `activites_prevues`
--
ALTER TABLE `activites_prevues`
  ADD PRIMARY KEY (`ID_activite_prevue`);

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`ID_Groupe`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`ID_Session`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Indexes for table `utilisateur_activites`
--
ALTER TABLE `utilisateur_activites`
  ADD PRIMARY KEY (`ID_Eleve_Activite`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activites`
--
ALTER TABLE `activites`
  MODIFY `ID_Activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `activites_prevues`
--
ALTER TABLE `activites_prevues`
  MODIFY `ID_activite_prevue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `ID_Groupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `ID_Session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `utilisateur_activites`
--
ALTER TABLE `utilisateur_activites`
  MODIFY `ID_Eleve_Activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

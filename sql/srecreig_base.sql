-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: mysql1.alwaysdata.com
-- Generation Time: May 16, 2016 at 12:07 AM
-- Server version: 5.1.66-0+squeeze1
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `srecreig_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `Action`
--

CREATE TABLE IF NOT EXISTS `Action` (
  `idAction` varchar(100) NOT NULL,
  PRIMARY KEY (`idAction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Action`
--

INSERT INTO `Action` (`idAction`) VALUES
('Accueil d''apprentis en Energetique'),
('Accueil d''apprentis en Informatique et Réseaux'),
('Animation d''ateliers RH de simulations d''entretiens'),
('Animation de conférences métiers'),
('Partenariat officiel'),
('Participation au Forum Sup Galilée Entreprises'),
('Recrutement de stagiaires'),
('Recrutement des jeunes diplômé(e)s'),
('Soutien financier par le versement de taxe d''apprentissage');

-- --------------------------------------------------------

--
-- Table structure for table `Alternance`
--

CREATE TABLE IF NOT EXISTS `Alternance` (
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `formationAlternance` varchar(5) DEFAULT NULL,
  `anneeEntree` int(11) DEFAULT NULL,
  `typeContrat` varchar(70) DEFAULT NULL,
  `CoordonneesPersonne_alternant` int(11) NOT NULL,
  `CoordonneesPersonne_maitre` int(11) DEFAULT NULL,
  `CoordonneesPersonne_RH` int(11) DEFAULT NULL,
  `dateRVPreparation` date DEFAULT NULL,
  `dateRVSimulation` date DEFAULT NULL,
  `dateDebutContrat` year(4) DEFAULT NULL,
  `dateFinContrat` year(4) DEFAULT NULL,
  `dateRuptureContrat` date DEFAULT NULL,
  `dateEnvoiFLAuCFA` date DEFAULT NULL,
  `docAAttacher` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`CoordonneesPersonne_alternant`),
  KEY `fk_apprentissage_Entreprise1_idx` (`Entreprise_nomEntreprise`),
  KEY `fk_apprentissage_coordoneesPersonneMaitre_idx` (`CoordonneesPersonne_maitre`),
  KEY `fk_apprentissage_coordoneesPersonneRH_idx` (`CoordonneesPersonne_RH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Alternance`
--

INSERT INTO `Alternance` (`Entreprise_nomEntreprise`, `formationAlternance`, `anneeEntree`, `typeContrat`, `CoordonneesPersonne_alternant`, `CoordonneesPersonne_maitre`, `CoordonneesPersonne_RH`, `dateRVPreparation`, `dateRVSimulation`, `dateDebutContrat`, `dateFinContrat`, `dateRuptureContrat`, `dateEnvoiFLAuCFA`, `docAAttacher`) VALUES
('CAPGEMINI', 'AIR', 1, NULL, 616, NULL, NULL, NULL, NULL, 2010, 2013, NULL, NULL, NULL),
('EDF', 'ENER', 3, NULL, 639, NULL, NULL, NULL, NULL, 2013, 2014, NULL, NULL, NULL),
('EDF', 'AIR', 1, NULL, 640, NULL, NULL, NULL, NULL, 2013, 2016, NULL, NULL, NULL),
('EDF', 'AIR', 1, NULL, 641, NULL, NULL, NULL, NULL, 2010, 2013, NULL, NULL, NULL),
('ERDF', 'ENER', 1, NULL, 650, NULL, NULL, NULL, NULL, 2015, 2018, NULL, NULL, NULL),
('LINK BY NET', 'AIR', 1, NULL, 675, 345, 346, NULL, NULL, 2013, 2016, NULL, NULL, NULL),
('LINK BY NET', 'AIR', 1, NULL, 676, 575, 346, NULL, NULL, 2013, 2016, NULL, NULL, NULL),
('LINK BY NET', 'AIR', 1, NULL, 677, NULL, NULL, NULL, NULL, 2013, 2016, NULL, NULL, NULL),
('ORANGE', 'AIR', 1, NULL, 686, 395, 396, NULL, NULL, 2012, 2015, NULL, NULL, NULL),
('ORANGE', 'AIR', 1, NULL, 687, NULL, NULL, NULL, NULL, 2014, 2017, NULL, NULL, NULL),
('ORANGE', 'AIR', 1, NULL, 688, 397, 398, NULL, NULL, 2014, 2017, NULL, NULL, NULL),
('ORANGE', 'AIR', 1, NULL, 689, NULL, NULL, NULL, NULL, 2013, 2016, NULL, NULL, NULL),
('ORANGE', 'AIR', 1, NULL, 690, NULL, NULL, NULL, NULL, 2011, 2014, NULL, NULL, NULL),
('ORANGE', 'AIR', 1, NULL, 691, NULL, NULL, NULL, NULL, 2014, 2017, NULL, NULL, NULL),
('ORANGE', 'AIR', 1, NULL, 692, NULL, NULL, NULL, NULL, 2015, 2018, NULL, NULL, NULL),
('SFR', 'AIR', 1, NULL, 712, NULL, NULL, NULL, NULL, 2012, 2015, NULL, NULL, NULL),
('SFR', 'AIR', 1, NULL, 713, NULL, NULL, NULL, NULL, 2014, 2017, NULL, NULL, NULL),
('SFR', 'AIR', 1, NULL, 714, NULL, NULL, NULL, NULL, 2014, 2017, NULL, NULL, NULL),
('SFR', 'AIR', 1, NULL, 715, NULL, NULL, NULL, NULL, 2011, 2014, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `AtelierRH`
--

CREATE TABLE IF NOT EXISTS `AtelierRH` (
  `idAtelierRH` int(11) NOT NULL AUTO_INCREMENT,
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `dateAtelier` date DEFAULT NULL,
  `heureDebut` time DEFAULT NULL,
  `heureFin` time DEFAULT NULL,
  `commentairesAtelier` longtext,
  PRIMARY KEY (`idAtelierRH`),
  KEY `fk_atelierRh_Entreprise1_idx` (`Entreprise_nomEntreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `AtelierRH`
--

INSERT INTO `AtelierRH` (`idAtelierRH`, `Entreprise_nomEntreprise`, `dateAtelier`, `heureDebut`, `heureFin`, `commentairesAtelier`) VALUES
(1, 'ORANGE', '2016-05-24', '08:00:00', '10:45:00', 'Un commmentaire pour l''atelier RH'),
(2, 'ORANGE', '2016-06-02', '14:00:00', '18:45:00', 'Un commmentaire ');

-- --------------------------------------------------------

--
-- Table structure for table `a_AtelierRH_CoordonneesPersonne`
--

CREATE TABLE IF NOT EXISTS `a_AtelierRH_CoordonneesPersonne` (
  `AtelierRH_id` int(11) NOT NULL,
  `CoordonneesPersonne_id` int(11) NOT NULL,
  PRIMARY KEY (`AtelierRH_id`,`CoordonneesPersonne_id`),
  KEY `fk_ContactAtelierRh_atelierRh1_idx` (`AtelierRH_id`),
  KEY `fk_a-AtelierRH-CoordonneesPersonne_CoordonneesPersonne` (`CoordonneesPersonne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_AtelierRH_CoordonneesPersonne`
--

INSERT INTO `a_AtelierRH_CoordonneesPersonne` (`AtelierRH_id`, `CoordonneesPersonne_id`) VALUES
(1, 38),
(1, 105),
(1, 125),
(2, 41),
(2, 124);

-- --------------------------------------------------------

--
-- Table structure for table `a_Conference_CoordonneesPersonne`
--

CREATE TABLE IF NOT EXISTS `a_Conference_CoordonneesPersonne` (
  `Conference_id` int(11) NOT NULL,
  `CoordonneesPersonne_id` int(11) NOT NULL,
  PRIMARY KEY (`Conference_id`,`CoordonneesPersonne_id`),
  KEY `fk_conferencier_coordoneesPersonne1_idx` (`CoordonneesPersonne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_Conference_CoordonneesPersonne`
--

INSERT INTO `a_Conference_CoordonneesPersonne` (`Conference_id`, `CoordonneesPersonne_id`) VALUES
(1, 38),
(2, 41),
(1, 120),
(2, 256),
(1, 400);

-- --------------------------------------------------------

--
-- Table structure for table `a_Entreprise_Action`
--

CREATE TABLE IF NOT EXISTS `a_Entreprise_Action` (
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `Action_id` varchar(100) NOT NULL,
  PRIMARY KEY (`Entreprise_nomEntreprise`,`Action_id`),
  KEY `fk_a_actEnt_Entreprise_idx` (`Entreprise_nomEntreprise`),
  KEY `fk_a-Entreprise-Action_Action` (`Action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `a_Entreprise_CoordonneesPersonne`
--

CREATE TABLE IF NOT EXISTS `a_Entreprise_CoordonneesPersonne` (
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `CoordonneesPersonne_id` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Entreprise_nomEntreprise`,`CoordonneesPersonne_id`),
  KEY `fk_conferencier_coordoneesPersonne1_idx` (`CoordonneesPersonne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_Entreprise_CoordonneesPersonne`
--

INSERT INTO `a_Entreprise_CoordonneesPersonne` (`Entreprise_nomEntreprise`, `CoordonneesPersonne_id`, `type`) VALUES
('ACCENTURE', 3, 'Primaire'),
('ACCENTURE', 4, 'Secondaire'),
('ACCENTURE', 5, 'Autre'),
('ACCENTURE', 565, 'TA'),
('ALTEN', 38, 'Secondaire'),
('ALTEN', 39, 'Autre'),
('ALTEN', 40, 'Autre'),
('ALTEN', 41, 'Primaire'),
('ALTEN', 42, 'Autre'),
('BOUYGUES TELECOM', 104, 'Primaire'),
('BOUYGUES TELECOM', 105, 'Secondaire'),
('CAPGEMINI', 118, 'Autre'),
('CAPGEMINI', 119, 'Autre'),
('CAPGEMINI', 120, 'Autre'),
('CAPGEMINI', 121, 'Primaire'),
('CAPGEMINI', 122, 'Autre'),
('CAPGEMINI', 123, 'Autre'),
('CAPGEMINI', 124, 'Secondaire'),
('CAPGEMINI', 125, 'Autre'),
('CAPGEMINI', 569, 'TA'),
('CGI', 152, 'Primaire'),
('EDF', 215, 'Autre'),
('EDF', 216, 'Secondaire'),
('EDF', 217, 'Autre'),
('EDF', 218, 'Autre'),
('EDF', 219, 'Autre'),
('EDF', 220, 'Primaire'),
('EDF', 221, 'Autre'),
('EDF', 222, 'Autre'),
('EDF', 223, 'Autre'),
('EDF', 224, 'Autre'),
('EDF', 225, 'Autre'),
('EDF', 226, 'Autre'),
('ERDF', 252, 'Primaire'),
('ERDF', 253, 'Autre'),
('ERDF', 254, 'Secondaire'),
('ERDF', 255, 'Autre'),
('ERDF', 256, 'Autre'),
('ERDF', 257, 'Autre'),
('ERDF', 572, 'TA'),
('LINK BY NET', 345, 'Primaire'),
('LINK BY NET', 346, 'Secondaire'),
('LINK BY NET', 575, 'TA'),
('ORANGE', 395, 'Autre'),
('ORANGE', 396, 'Autre'),
('ORANGE', 397, 'Primaire'),
('ORANGE', 398, 'Autre'),
('ORANGE', 399, 'Secondaire'),
('ORANGE', 400, 'Autre'),
('ORANGE', 401, 'Autre'),
('ORANGE', 402, 'Autre'),
('ORANGE', 403, 'Autre'),
('ORANGE', 404, 'Autre'),
('SFR', 457, 'Primaire'),
('SFR', 458, 'Secondaire'),
('SFR', 459, 'Autre'),
('SFR', 460, 'Autre'),
('SFR', 461, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `a_Entreprise_CycleFormation`
--

CREATE TABLE IF NOT EXISTS `a_Entreprise_CycleFormation` (
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `CycleFormation_id` int(11) NOT NULL,
  PRIMARY KEY (`Entreprise_nomEntreprise`,`CycleFormation_id`),
  KEY `fk_acfen_En_idx` (`Entreprise_nomEntreprise`),
  KEY `fk_a-Entreprise-CycleFormation_CycleFormation` (`CycleFormation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_Entreprise_CycleFormation`
--

INSERT INTO `a_Entreprise_CycleFormation` (`Entreprise_nomEntreprise`, `CycleFormation_id`) VALUES
('ACCENTURE', 4),
('CAPGEMINI', 4),
('CGI', 4),
('ACCENTURE', 16),
('CAPGEMINI', 16),
('CGI', 16),
('ALTEN', 18),
('EDF', 18),
('ERDF', 18),
('VINCI ENERGIES', 18),
('ALTEN', 19),
('EDF', 19),
('ORANGE', 19),
('SFR', 19),
('ACCENTURE', 25),
('CAPGEMINI', 25),
('CGI', 25),
('ACCENTURE', 26),
('CAPGEMINI', 26),
('CGI', 26),
('ACCENTURE', 32),
('ALTEN', 32),
('BOUYGUES TELECOM', 32),
('CAPGEMINI', 32),
('EDF', 32),
('LINK BY NET', 32),
('ORANGE', 32),
('SFR', 32),
('ACCENTURE', 33),
('ALTEN', 33),
('BOUYGUES TELECOM', 33),
('CAPGEMINI', 33),
('EDF', 33),
('LINK BY NET', 33),
('ORANGE', 33),
('SFR', 33);

-- --------------------------------------------------------

--
-- Table structure for table `a_TaxeApprentissage_CycleFormation`
--

CREATE TABLE IF NOT EXISTS `a_TaxeApprentissage_CycleFormation` (
  `TaxeApprentissage_id` int(11) NOT NULL,
  `CycleFormation_id` int(11) NOT NULL,
  `categorie` varchar(1) NOT NULL,
  `montant` int(11) NOT NULL,
  PRIMARY KEY (`TaxeApprentissage_id`,`CycleFormation_id`,`categorie`,`montant`),
  KEY `fk_acfta_TA_idx` (`TaxeApprentissage_id`),
  KEY `fk_a-TaxeApprentissage-CycleFormation_CycleFormation` (`CycleFormation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_TaxeApprentissage_CycleFormation`
--

INSERT INTO `a_TaxeApprentissage_CycleFormation` (`TaxeApprentissage_id`, `CycleFormation_id`, `categorie`, `montant`) VALUES
(1, 3, 'B', 2000),
(11, 3, 'B', 10000),
(125, 3, 'B', 7000),
(128, 3, 'B', 1800),
(140, 3, 'A', 1840),
(140, 3, 'B', 660),
(141, 3, 'B', 2500),
(194, 18, 'C', 4000),
(207, 3, 'B', 1000),
(211, 17, 'B', 899),
(212, 16, 'B', 899),
(213, 18, 'B', 899),
(214, 15, 'B', 899),
(223, 3, 'B', 4000),
(236, 3, 'B', 5000),
(250, 3, 'B', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `Conference`
--

CREATE TABLE IF NOT EXISTS `Conference` (
  `idConference` int(11) NOT NULL AUTO_INCREMENT,
  `Entreprise_nomEntreprise` varchar(40) NOT NULL,
  `typeConference` varchar(20) DEFAULT NULL,
  `dateConference` date DEFAULT NULL,
  `heureDebut` time DEFAULT NULL,
  `heureFin` time DEFAULT NULL,
  `lieuConference` varchar(45) DEFAULT NULL,
  `themeConference` varchar(100) DEFAULT NULL,
  `commentairesConference` longtext,
  PRIMARY KEY (`idConference`,`Entreprise_nomEntreprise`),
  KEY `fk_Conference_Entreprise1_idx` (`Entreprise_nomEntreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Conference`
--

INSERT INTO `Conference` (`idConference`, `Entreprise_nomEntreprise`, `typeConference`, `dateConference`, `heureDebut`, `heureFin`, `lieuConference`, `themeConference`, `commentairesConference`) VALUES
(1, 'ORANGE', NULL, '2016-05-23', '08:00:00', '14:00:00', 'Villetaneuse', 'Big Data', 'Un commentaire pour la conference'),
(2, 'ORANGE', NULL, '2016-06-15', '10:00:00', '13:45:00', 'Paris', 'Objets connectés', 'Un autre commentaire ');

-- --------------------------------------------------------

--
-- Table structure for table `Connexion`
--

CREATE TABLE IF NOT EXISTS `Connexion` (
  `id` varchar(70) NOT NULL,
  `pass` varchar(64) DEFAULT NULL,
  `profil` varchar(10) NOT NULL DEFAULT 'read',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Connexion`
--

INSERT INTO `Connexion` (`id`, `pass`, `profil`) VALUES
('madame.lecture', '62db9e0f40b319a7e47788c541dacea3', 'read'),
('monsieur.ecriture', '9c8e4f0f59c5bba8a1557a233704641a', 'read'),
('rachid.lebrache', '9df3b01c60df20d13843841ff0d4482c', 'super'),
('test.test', NULL, 'write');

-- --------------------------------------------------------

--
-- Table structure for table `CoordonneesPersonne`
--

CREATE TABLE IF NOT EXISTS `CoordonneesPersonne` (
  `idCoordonneesPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `fonction` varchar(100) DEFAULT NULL,
  `telephoneFixe` varchar(20) DEFAULT NULL,
  `telephoneMobile` varchar(20) DEFAULT NULL,
  `mail` varchar(70) DEFAULT NULL,
  `commentaires` longtext,
  PRIMARY KEY (`idCoordonneesPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=716 ;

--
-- Dumping data for table `CoordonneesPersonne`
--

INSERT INTO `CoordonneesPersonne` (`idCoordonneesPersonne`, `civilite`, `nom`, `prenom`, `fonction`, `telephoneFixe`, `telephoneMobile`, `mail`, `commentaires`) VALUES
(3, 'Madame', 'PADEY', 'Elodie', 'Campus Manager', '01 56 52 66 55', '', ' elodie.padey@accenture.com', '118, avenue de France - 75 636 Paris Cedex 13'),
(4, 'Madame', 'LEFEBVRE', 'Fanny', 'Responsable Relations Ecoles et Universites', '01 56 52 70 68', '', '', ''),
(5, 'Monsieur', 'LE SAUX', 'Regis', '', '', '', 'regis.le.saux@accenture.com', '118, avenue de France - 75 636 Paris Cedex 13'),
(38, 'Madame', 'SIMON', 'Anne Mallory', 'Responsable du recrutement', '01 46 08 70 72', '', 'amsimon@alten.fr', ''),
(39, 'Monsieur', 'TY', 'Chi-Hong', 'Responsable du Recrutement Ingenieurs Systemes d''information, Reseaux et Telecommunications', '01 46 08 76 21', '06 78 45 96 45', 'c.ty@altensir.fr', ''),
(40, 'Monsieur', 'HAMEAU', 'Herve', 'Responsable d''agence', '01 46 08 76 60', '617985688', 'hhameau@altensir.fr', ''),
(41, 'Madame', 'VIEIRA', 'Filipa', 'Charge de recrutement', '01 46 08 76 62', '06 16 27 29 20', 'fvieira@altensir.fr', ''),
(42, 'Madame', 'CHAUVET', 'Delphine', 'Chargee de Recrutement et Developpement RH - ‎Alten', '', '', 'dchauvet@alten.fr', ''),
(104, 'Monsieur', 'GALIBERT', 'Yann', 'Direction des Ressources Humaines', '01 81 75 38 62', '', 'YGALIBER@bouyguestelecom.fr', ''),
(105, 'Madame', 'THOUMAK', 'Valerie', 'Responsable Relations Ecols Entreprises', '', '', 'VTHOUMAK@bouyguestelecom.fr', ''),
(118, 'Madame', 'PLENIER', 'Geraldine', 'Directrice de la Responsabilite Sociale', '01 49 00 34 28', '06 89 85 39 05', 'geraldine.plenier@capgemini.com', ''),
(119, 'Madame', 'BERAUD', 'Stephanie', 'Responsable des Ressources Humaines Senior', '01 49 00 57 18', '06 80 75 44 81', 'stephanie.beraud@capgemini.com', ''),
(120, 'Madame', 'de DORTAN', 'Emmanuelle', 'Chargee Relations Ecoles-Universites', '01 49 00 61 38', '', '', ''),
(121, 'Madame', 'JACQUOT', 'Aurelie', 'Responsable Relations Ecoles Entreprises', '01 49 67 47 68', '', 'aurelie.jacquot@capgemini.com', 'rl 03/04/2013: Aurelie lm''envoie le catalogue des offres en alternance d''ici 1 semaine / 10 jours ,,,Les CV devront lui être envoyes et à compter de mai 2013 elle sera en conge arrêt maternite , notre contact sera alors Geoffrey Burns. M. Chefdeville 01 49 67 20 81'),
(122, 'Monsieur', 'SY', 'Mamadou', 'Expert en Big Data', '01 49 67 56 96', '06 15 96 83 81', 'mamadou.sy@capgemini.com', 'rl 03/04/2013: Aurelie lm''envoie le catalogue des offres en alternance d''ici 1 semaine / 10 jours ,,,Les CV devront lui être envoyes et à compter de mai 2013 elle sera en conge arrêt maternite , notre contact sera alors Geoffrey Burns. M. Chefdeville 01 49 67 20 81'),
(123, 'Madame', 'NOWACKI', 'Eloise', 'Direction du recrutement', '01 49 67 99 53', '', '', ''),
(124, 'Madame', 'TEYSSIER', 'Caroline', '', '', '', 'caroline.teyssier@capgemini.com', ''),
(125, 'Madame', 'BOUCHE', 'Martine', 'Chargee de mission RH', '01 49 00 43 61', '', 'martine.bouche@capgemini.com', ''),
(152, 'Monsieur', 'BAIS', 'Xavier', 'Charge des relations ecoles', '01 57 87 44 81', '06 70 08 65 56', 'xavier.bais@cgi.com', 'rl 13/03/2015: RV CHEZ CGI LE 27/03/2015'),
(215, 'Madame', 'PLAGNOL', 'Benedicte', 'Manager, Relations with Higher Education', '182248247', '', 'benedicte.plagnol@edf.fr', ''),
(216, 'Madame', 'DARRIGUES', 'Isabelle', 'DRH Direction Production Ingenierie', '01 43 69 20 01', '06 87 71 61 69', 'isabelle.darrigues@edf.fr', ''),
(217, 'Madame', 'LUCAT', 'Celine', 'Consultant RH', '01 77 51 75 15', '', 'celine.lucat@edf.fr', ''),
(218, 'Monsieur', 'THOMAS', 'Nicolas', 'Charge de conseil RH', '01 77 51 76 76', '', 'nicolas-n.thomas@edf.fr', ''),
(219, 'Monsieur', 'SOUBLIN', '', 'Charge RH', '01 78 66 92 48', '07 86 60 27 66', '', ''),
(220, 'Monsieur', 'SANDROCK', 'Jean-Philippe', 'Chef du Departement Relations avec l''Enseignement superieur long', '01 82 24 82 47', '06 58 59 92 20', 'jean-philippe.sandrock@edf.fr', 'Contact rencontre au salon du RUE 2014'),
(221, 'Madame', 'SAMSON', 'Jenifer', 'Chargee des relations avec l''enseignement superieur long chez EDF', '01 82 24 82 48', '', 'jenifer.samson@edf.fr', ''),
(222, 'Monsieur', 'LE POGAM', 'Ravel', 'Responsable Outils et Calculs informatiques', '02 47 21 24 08', '06 11 42 38 81', 'ravel.le-pogam@climatelec.fr', ''),
(223, 'Madame', 'MALBERT', 'Annabelle', 'Charge RH', '01 56 65 24 15', '06 67 89 13 57', 'annabelle.malbert@edf.fr', ''),
(224, 'Madame', 'PESKINE', 'Gabrielle', 'Chef de service Ingenierie', '01 34 78 94 06', '06 65 68 78 72', 'gabrielle.peskine@edf.fr', ''),
(225, 'Madame', 'JURETIG', 'Nathalie', 'Charge de Mission RH', '01 82 47 81 75', '', 'nathalie.juretig@edf.fr', 'Possibilite de prendre des apprentis mais en attente des projets Rappeler debut Avril. Contacter Mme Terion Dominique en charge Alternance au 01 58 86 70 25 voir Mai'),
(226, 'Madame', 'LUCAT', 'Celine', 'Consultante RH', '177517515', '', 'celine.lucat@edf.fr', ''),
(252, 'Monsieur', 'DASSONVILLE', 'Pascal', 'Directeur Territorial IDF EST', '158916123', '', 'pascal.dassonville@erdf.fr', ''),
(253, 'Monsieur', 'AVELINE', 'Mathieu', 'Chef d''agence Haut de Portefeuille et Grands Projets', '01 41 67 90 58', '06 64 09 21 52', 'mathieu.aveline@erdf.fr', ''),
(254, 'Madame', 'DUPUY', 'Fabienne', 'Adjointe au Directeur Territorial IDF EST', '01 49 42 52 07', '06 85 11 97 37', 'fabienne.dupuy@erdf.fr', ''),
(255, 'Monsieur', 'GUICHARD', 'Christophe', '', '01 49 42 54 97', '07 62 69 33 13', 'christophe.guichard@erdf.fr', ''),
(256, 'Madame', 'BEAUDEMONT', 'Fabienne', '', '01 58 91 61 16', '06 68 25 88 41', '', ''),
(257, 'Madame', 'ALBERDI', 'Gaizka', 'Chef de Projet Smart Grid / Direction Interregionale Ile de France', '01 81 97 53 87', '06 89 22 35 65', 'gaizka.alberdi@erdf-grdf.fr', ''),
(345, 'Madame', 'LACHAAL', 'Amira', 'Chargee RH', '01 48 13 21 47', '', 'a.lachaal@linkbynet.com', ''),
(346, 'Madame', 'MARSEILLE', 'Christelle', 'Responsable recrutement', '01 48 13 22 45', '', 'c.marseille@linkbynet.com', 'RL 19/06/2013: va nous transmettre une offre d''apprentissage\nRL 26/02/2014: Present au FEE 2013, a pris des stagiaires et des apprentis, entreprise en pleine croissance du territoire,membre du CA de Sup Galilee ,  a reinviter au FEE 2014'),
(395, 'Madame', 'BADJI', 'Sona', 'Chargee de recrutement\nOrange/DRH/DSPF/DRDP/DIF', '145294633', '', '', 'Forum 2014\ncontact perime'),
(396, 'Madame', 'LIETARD', 'Claire', 'Consultante en Recrutement', '01 44 37 60 07', '', 'claire.lietard@orange.com', ''),
(397, 'Monsieur', 'SANGLIER', 'Philippe', 'Chef De Projet Enseignement Superieur IDF', '01 44 44 22 22', '06 86 16 67 61', 'philippe.sanglier@orange.com', 'Possibilite de prendre des apprentis mais en attente des demandes'),
(398, 'Madame', 'Gaudeix', 'Agnes', 'Chargee de recrutement', '01 44 45 17 00', '', 'agnes.gaudeix@orange.com', 'à recontacter pour voir avec sa hierarchie à Rennes'),
(399, 'Madame', 'MONTFORT', 'Regine', 'Responsable Agences de recrutement Idf', '01 45 29 55 02', '06 08 96 41 38', 'regine.montfort@orange.com', 'Rachid 31/03/2014 : contact rencontre lors de la reunion chez Orange au siege DRH Groupe \n( 10 rue Jobbe Duval 75015 Paris ) pour le lancement de l'' Operation Orange Tres Haut Debit'),
(400, 'Madame', 'TRANG', 'Evelyne', 'Consultante en recrutement', '01 45 29 81 16', '', '', 'contact perime'),
(401, 'Monsieur', 'DELANNOY', 'Denis', 'Directeur Relations avec les Collectivites Locales de la Seine Saint Denis', '01 58 94 10 23', '06 33 55 11 40', 'denis.delannoy@orange.com', ''),
(402, 'Monsieur', 'LASFER', '', 'RH', '', '', '', ''),
(403, 'Madame', 'MONTILLOT', 'Elisabeth', 'Pilotage campagne Alternance', '', '', 'elisabeth.montillot@orange.com', ''),
(404, 'Madame', 'MANCEL', 'Cecile', 'Consultante en recrutement', '', '', 'cecile.mancel@orange.com', ''),
(457, 'Madame', 'MERLIN', 'Helene', 'Adjointe à la Responsable des  Relations Ecoles', '01 85 06 21 73', '06 46 78 00 75', 'helene.merlin@sfr.com', 'A voir sa collegue est Mme Hamdani au poste 01 71 07 61 02\nRL 090413: Suite info de Mireille Dunez ( Plaine Commune ) , SFR est interessee par notre formation AIR , je lui envoie un mail avec la plaquette et l''informe que SFR  a dejà pris un apprenti de chez nous en AIR , A relancer par telephone si pas de nouvelle'),
(458, 'Madame', 'RAMDANE', 'Dounia', 'Campus SFR\nDirection des Ressources Humaines', '01 85 06 27 35', '', 'dounia.ramdane@sfr.com', ''),
(459, 'Madame', 'Fornacciari', 'Amandine', '', '01 85 06 87 93', '', 'amandine.fornacciari@sfr.com', 'Est venue au Forum 2014'),
(460, 'Monsieur', 'DJIM', 'Amadou', 'Chef  Projet SI Decisionnel Entreprises', '', '06 04 52 12 33', 'amadou.djim@sfr.com', ''),
(461, 'Madame', 'ASSUIED', 'Kamilia', 'RH', '', '', 'kamilia.assuied@sfr.com', 'Contact obtenu lors d''un salon'),
(565, 'Madame', 'REAL', 'Florence', 'Responsable Relations Ecoles et Universités', NULL, NULL, NULL, NULL),
(569, 'Madame', 'PLENIER', 'Geraldine', 'Directrice Resp Sociale et Environnementale', NULL, NULL, NULL, NULL),
(572, 'Monsieur', 'CHEREL', 'Daniel', 'Chef du Développement RH Compétences & Divers', NULL, NULL, NULL, NULL),
(575, 'Monsieur', 'LAURENDON', 'Cédric', 'Responsable recrutement', NULL, NULL, NULL, NULL),
(616, 'Monsieur', 'DUVAL', 'Bastien', 'alternant', '', '620651236', 'bastienduval1@gmail.com', ''),
(639, 'Monsieur', 'ABASSE', 'Goulam', 'alternant', '', '06 69 99 19 25', 'abassegoulam@gmail.com', ''),
(640, 'Monsieur', 'LAHBAL', 'Said', 'alternant', '', '', '', ''),
(641, 'Monsieur', 'MONZIE', 'Thomas', 'alternant', '', '601904456', 'thomas.monzie@gmail.com', ''),
(650, 'Monsieur', 'RACHWAL', 'Jonathan', 'alternant', '', '06 37 54 80 25', 'rachwaljonathan@hotmail.fr', ''),
(675, 'Monsieur', 'BOUKRA', 'Ali', 'alternant', '', '', '', ''),
(676, 'Monsieur', 'DIALLO', 'Mouhamadou Yahya', 'alternant', '', '', '', ''),
(677, 'Monsieur', 'LOISEAU', 'Kevin', 'alternant', '', '', '', ''),
(686, 'Monsieur', 'BATAHI', 'Mohcine', 'alternant', '', '', '', ''),
(687, 'Monsieur', 'DIALLO', 'Mame Mor', 'alternant', '', '', '', ''),
(688, 'Monsieur', 'DIENG', 'El Hadji Malick', 'alternant', '', '', '', ''),
(689, 'Monsieur', 'FALL', 'Amadou-Diaw', 'alternant', '', '', '', ''),
(690, 'Madame', 'NOLEO', 'Nancy', 'alternant', '', '640568505', 'nancynoleo@gmail.com', ''),
(691, 'Monsieur', 'UNG', 'Bobby', 'alternant', '', '', '', ''),
(692, 'Monsieur', 'HARTI', 'Mohamed  Amine', 'alternant', '', '0613699450', 'aminos.adm@gmail.com', ''),
(712, 'Monsieur', 'AZZOUZI', 'Karim', 'alternant', '', '', '', ''),
(713, 'Madame', 'MINKO', 'Margane', 'alternant', '', '', '', ''),
(714, 'Monsieur', 'SENOUNI', 'Joachim', 'alternant', '', '', '', ''),
(715, 'Monsieur', 'SOW', 'Ibrahima', 'alternant', '', '699417318', 'sowibrahi@yahoo.fr', '');

-- --------------------------------------------------------

--
-- Table structure for table `CorrespondanceNom`
--

CREATE TABLE IF NOT EXISTS `CorrespondanceNom` (
  `nomSql` varchar(50) DEFAULT NULL,
  `nomCorrespondant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CorrespondanceNom`
--

INSERT INTO `CorrespondanceNom` (`nomSql`, `nomCorrespondant`) VALUES
('nomEntreprise', 'Nom Entreprise'),
('civilite', 'Civilité'),
('nom', 'Nom'),
('prenom', 'Prénom'),
('fonction', 'Fonction'),
('telephoneFixe', 'Téléphone Fixe'),
('telephoneMobile', 'Téléphone Mobile'),
('mail', 'Mail'),
('commentaires', 'Commentaires'),
('groupe', 'Groupe'),
('adresse', 'Adresse'),
('complementAdresse', 'Complément Adresse'),
('codePostal', 'Code Postal'),
('ville', 'Ville'),
('pays', 'Pays'),
('typeContact', 'Type Contact'),
('origine', 'Origine'),
('NAF_codeNAF', 'Code NAF'),
('partenariatOfficiel', 'Partenariat Officiel'),
('taille', 'Taille'),
('alias', 'Alias'),
('commentairesEntreprise', 'Commentaires Entreprise'),
('formationAlternance', 'Formation Alternance'),
('anneeEntree', 'Année d''entrée'),
('typeContrat', 'Type Contrat'),
('CoordonneesPersonne_alternant', 'Ajouter les coordonnees de lalternant ?'),
('CoordonneesPersonne_maitre', 'Ajouter les coordonnees du maître?'),
('CoordonneesPersonne_RH', 'Ajouter RH ? '),
('dateRVPreparation', 'Date RV Préparation'),
('dateRVSimulation', 'Date RV Simulation'),
('dateDebutContrat', 'Date Début Contrat'),
('dateFinContrat', 'Date Fin Contrat'),
('dateRuptureContrat', 'Date Rupture Contrat'),
('dateEnvoiFLAuCFA', 'Date Envoi FL Au CFA'),
('docAAttacher', 'Ajouter les docs ?'),
('anneeDeVersement', 'Année de Versement'),
('montantPromesseVersement', 'Montant Promesse Versement'),
('montantVerse', 'Montant Versé'),
('OCTA', 'OCTA'),
('dateEnregistrement', 'Date Enregistrement'),
('dateDerniereModification', 'Date de dernière Modification'),
('modePaiement', 'Mode de Paiement'),
('versementVia', 'Versement Via'),
('dateTransmissionChequeAC', 'Date de Transmission Cheque AC'),
('rapprochementAC', 'Rapprochement AC'),
('commentairesTaxe', 'Commentaires Taxe'),
('dateAtelier', 'Date Atelier'),
('creneauAtelier', 'Créneau Atelier'),
('typeConference', 'Type Conférence'),
('dateConference', 'Date Conférence'),
('heureDebut', 'Heure Début'),
('heureFin', 'Heure Fin'),
('lieuConference', 'Lieu Conférence'),
('themeConference', 'Thème Conférence'),
('anneeDeParticipation', 'Année de Participation'),
('questionnaireDeSatisfaction', 'Questionnaire de Satisfaction ?'),
('commentairesForum', 'Commentaires Forum'),
('Entreprise_nomEntreprise', 'Nom Entreprise'),
('numeroSIRET', 'N° SIRET '),
('nomEntreprise', 'Nom Entreprise'),
('civilite', 'Civilité'),
('nom', 'Nom'),
('prenom', 'Prénom'),
('fonction', 'Fonction'),
('telephoneFixe', 'Téléphone Fixe'),
('telephoneMobile', 'Téléphone Mobile'),
('mail', 'Mail'),
('commentaires', 'Commentaires'),
('groupe', 'Groupe'),
('adresse', 'Adresse'),
('complementAdresse', 'Complément Adresse'),
('codePostal', 'Code Postal'),
('ville', 'Ville'),
('pays', 'Pays'),
('typeContact', 'Type Contact'),
('origine', 'Origine'),
('NAF_codeNAF', 'Code NAF'),
('partenariatOfficiel', 'Partenariat Officiel'),
('taille', 'Taille'),
('alias', 'Alias'),
('commentairesEntreprise', 'Commentaires Entreprise'),
('formationAlternance', 'Formation Alternance'),
('anneeEntree', 'Année d''entrée'),
('typeContrat', 'Type Contrat'),
('CoordonneesPersonne_alternant', 'Ajouter les coordonnees de lalternant ?'),
('CoordonneesPersonne_maitre', 'Ajouter les coordonnees du maître?'),
('CoordonneesPersonne_RH', 'Ajouter RH ? '),
('dateRVPreparation', 'Date RV Préparation'),
('dateRVSimulation', 'Date RV Simulation'),
('dateDebutContrat', 'Date Début Contrat'),
('dateFinContrat', 'Date Fin Contrat'),
('dateRuptureContrat', 'Date Rupture Contrat'),
('dateEnvoiFLAuCFA', 'Date Envoi FL Au CFA'),
('docAAttacher', 'Ajouter les docs ?'),
('anneeDeVersement', 'Année de Versement'),
('montantPromesseVersement', 'Montant Promesse Versement'),
('montantVerse', 'Montant Versé'),
('OCTA', 'OCTA'),
('dateEnregistrement', 'Date Enregistrement'),
('dateDerniereModification', 'Date de dernière Modification'),
('modePaiement', 'Mode de Paiement'),
('versementVia', 'Versement Via'),
('dateTransmissionChequeAC', 'Date de Transmission Cheque AC'),
('rapprochementAC', 'Rapprochement AC'),
('commentairesTaxe', 'Commentaires Taxe'),
('dateAtelier', 'Date Atelier'),
('creneauAtelier', 'Créneau Atelier'),
('typeConference', 'Type Conférence'),
('dateConference', 'Date Conférence'),
('heureDebut', 'Heure Début'),
('heureFin', 'Heure Fin'),
('lieuConference', 'Lieu Conférence'),
('themeConference', 'Thème Conférence'),
('anneeDeParticipation', 'Année de Participation'),
('questionnaireDeSatisfaction', 'Questionnaire de Satisfaction ?'),
('commentairesForum', 'Commentaires Forum'),
('Entreprise_nomEntreprise', 'Nom Entreprise'),
('numeroSIRET', 'N° SIRET '),
('civiliteAlternant', 'Civilité Alternant'),
('nomAlternant', 'Nom Alternant'),
('prenomAlternant', 'Prénom Alternant'),
('Fonction Alternant', 'Nom Entreprise'),
('telephoneFixeAlternant', 'Téléphone Fixe Alternant'),
('telephoneMobileAlternant', 'Téléphone Mobile Alternant'),
('Fonction Alternant', 'Nom Entreprise'),
('mailAlternant', 'Mail Alternant'),
('commentaireAlternant', 'Commentaire sur l''alternant'),
('nomEntreprise', 'Nom Entreprise'),
('civilite', 'Civilité'),
('nom', 'Nom'),
('prenom', 'Prénom'),
('fonction', 'Fonction'),
('telephoneFixe', 'Téléphone Fixe'),
('telephoneMobile', 'Téléphone Mobile'),
('mail', 'Mail'),
('commentaires', 'Commentaires'),
('groupe', 'Groupe'),
('adresse', 'Adresse'),
('complementAdresse', 'Complément Adresse'),
('codePostal', 'Code Postal'),
('ville', 'Ville'),
('pays', 'Pays'),
('typeContact', 'Type Contact'),
('origine', 'Origine'),
('NAF_codeNAF', 'Code NAF'),
('partenariatOfficiel', 'Partenariat Officiel'),
('taille', 'Taille'),
('alias', 'Alias'),
('commentairesEntreprise', 'Commentaires Entreprise'),
('formationAlternance', 'Formation Alternance'),
('anneeEntree', 'Année d''entrée'),
('typeContrat', 'Type Contrat'),
('CoordonneesPersonne_alternant', 'Ajouter les coordonnees de lalternant ?'),
('CoordonneesPersonne_maitre', 'Ajouter les coordonnees du maître?'),
('CoordonneesPersonne_RH', 'Ajouter RH ? '),
('dateRVPreparation', 'Date RV Préparation'),
('dateRVSimulation', 'Date RV Simulation'),
('dateDebutContrat', 'Date Début Contrat'),
('dateFinContrat', 'Date Fin Contrat'),
('dateRuptureContrat', 'Date Rupture Contrat'),
('dateEnvoiFLAuCFA', 'Date Envoi FL Au CFA'),
('docAAttacher', 'Ajouter les docs ?'),
('anneeDeVersement', 'Année de Versement'),
('montantPromesseVersement', 'Montant Promesse Versement'),
('montantVerse', 'Montant Versé'),
('OCTA', 'OCTA'),
('dateEnregistrement', 'Date Enregistrement'),
('dateDerniereModification', 'Date de dernière Modification'),
('modePaiement', 'Mode de Paiement'),
('versementVia', 'Versement Via'),
('dateTransmissionChequeAC', 'Date de Transmission Cheque AC'),
('rapprochementAC', 'Rapprochement AC'),
('commentairesTaxe', 'Commentaires Taxe'),
('dateAtelier', 'Date Atelier'),
('creneauAtelier', 'Créneau Atelier'),
('typeConference', 'Type Conférence'),
('dateConference', 'Date Conférence'),
('heureDebut', 'Heure Début'),
('heureFin', 'Heure Fin'),
('lieuConference', 'Lieu Conférence'),
('themeConference', 'Thème Conférence'),
('anneeDeParticipation', 'Année de Participation'),
('questionnaireDeSatisfaction', 'Questionnaire de Satisfaction ?'),
('commentairesForum', 'Commentaires Forum'),
('Entreprise_nomEntreprise', 'Nom Entreprise'),
('numeroSIRET', 'N° SIRET '),
('civiliteAlternant', 'Civilité Alternant'),
('nomAlternant', 'Nom Alternant'),
('prenomAlternant', 'Prénom Alternant'),
('fonctionAlternant', 'Fonction Alternant'),
('telephoneFixeAlternant', 'Téléphone Fixe Alternant'),
('telephoneMobileAlternant', 'Téléphone Mobile Alternant'),
('mailAlternant', 'Mail Alternant'),
('commentaireAlternant', 'Commentaire sur l''alternant'),
('zer', 'azeez'),
('ag', 'kytk'),
('eb', 'tzer'),
('theh', 'zefsd'),
('fq', 'tky'),
('tzet', 'raeraz'),
('fqsqjh', 'tuktk'),
('ukul', 'ort'),
('jyhrth', 'aesdq'),
('utyu', 'gsht'),
('ztet', 'yuzert'),
('raer', 'yjytrt'),
('kuyk', 'fgdgkt'),
('oipl', 'rzer'),
('yre', 'ry'),
('eaze', 'azertejyzrez'),
('nomEntreprise', 'Nom Entreprise'),
('civilite', 'Civilité'),
('nom', 'Nom'),
('prenom', 'Prénom'),
('fonction', 'Fonction'),
('telephoneFixe', 'Téléphone Fixe'),
('telephoneMobile', 'Téléphone Mobile'),
('mail', 'Mail'),
('commentaires', 'Commentaires'),
('groupe', 'Groupe'),
('adresse', 'Adresse'),
('complementAdresse', 'Complément Adresse'),
('codePostal', 'Code Postal'),
('ville', 'Ville'),
('pays', 'Pays'),
('typeContact', 'Type Contact'),
('origine', 'Origine'),
('NAF_codeNAF', 'Code NAF'),
('partenariatOfficiel', 'Partenariat Officiel'),
('taille', 'Taille'),
('alias', 'Alias'),
('commentairesEntreprise', 'Commentaires Entreprise'),
('formationAlternance', 'Formation Alternance'),
('anneeEntree', 'Année d''entrée'),
('typeContrat', 'Type Contrat'),
('CoordonneesPersonne_alternant', 'Ajouter les coordonnees de lalternant ?'),
('CoordonneesPersonne_maitre', 'Ajouter les coordonnees du maître?'),
('CoordonneesPersonne_RH', 'Ajouter RH ? '),
('dateRVPreparation', 'Date RV Préparation'),
('dateRVSimulation', 'Date RV Simulation'),
('dateDebutContrat', 'Date Début Contrat'),
('dateFinContrat', 'Date Fin Contrat'),
('dateRuptureContrat', 'Date Rupture Contrat'),
('dateEnvoiFLAuCFA', 'Date Envoi FL Au CFA'),
('docAAttacher', 'Ajouter les docs ?'),
('anneeDeVersement', 'Année de Versement'),
('montantPromesseVersement', 'Montant Promesse Versement'),
('montantVerse', 'Montant Versé'),
('OCTA', 'OCTA'),
('dateEnregistrement', 'Date Enregistrement'),
('dateDerniereModification', 'Date de dernière Modification'),
('modePaiement', 'Mode de Paiement'),
('versementVia', 'Versement Via'),
('dateTransmissionChequeAC', 'Date de Transmission Cheque AC'),
('rapprochementAC', 'Rapprochement AC'),
('commentairesTaxe', 'Commentaires Taxe'),
('dateAtelier', 'Date Atelier'),
('creneauAtelier', 'Créneau Atelier'),
('typeConference', 'Type Conférence'),
('dateConference', 'Date Conférence'),
('heureDebut', 'Heure Début'),
('heureFin', 'Heure Fin'),
('lieuConference', 'Lieu Conférence'),
('themeConference', 'Thème Conférence'),
('anneeDeParticipation', 'Année de Participation'),
('questionnaireDeSatisfaction', 'Questionnaire de Satisfaction ?'),
('commentairesForum', 'Commentaires Forum'),
('Entreprise_nomEntreprise', 'Nom Entreprise'),
('numeroSIRET', 'N° SIRET '),
('civiliteAlternant', 'Civilité Alternant'),
('nomAlternant', 'Nom Alternant'),
('prenomAlternant', 'Prénom Alternant'),
('fonctionAlternant', 'Fonction Alternant'),
('telephoneFixeAlternant', 'Téléphone Fixe Alternant'),
('telephoneMobileAlternant', 'Téléphone Mobile Alternant'),
('mailAlternant', 'Mail Alternant'),
('commentaireAlternant', 'Commentaires sur l''alternant'),
('civiliteMaitre', 'Civilité Maître'),
('nomMaitre', 'Nom Maître'),
('prenomMaitre', 'Prénom Maître'),
('fonctionMaitre', 'Fonction Maître'),
('telephoneFixeMaitre', 'Téléphone Fixe Maître'),
('telephoneMobileMaitre', 'Téléphone Mobile Maître'),
('mailMaitre', 'Mail Maître'),
('commentaireMaitre', 'Commentaires sur le Maître'),
('civiliteRH', 'Civilité RH'),
('nomRH', 'Nom RH'),
('prenomRH', 'Prénom RH'),
('fonctionRH', 'Fonction RH'),
('telephoneFixeRH', 'Téléphone Fixe RH'),
('telephoneMobileRH', 'Téléphone Mobile RH'),
('mailRH', 'Mail RH'),
('commentaireRH', 'Commentaires sur le RH');

-- --------------------------------------------------------

--
-- Table structure for table `CycleFormation`
--

CREATE TABLE IF NOT EXISTS `CycleFormation` (
  `idCycleFormation` int(11) NOT NULL,
  `cycle` varchar(70) NOT NULL,
  `mention` varchar(70) DEFAULT NULL,
  `specialite` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idCycleFormation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CycleFormation`
--

INSERT INTO `CycleFormation` (`idCycleFormation`, `cycle`, `mention`, `specialite`) VALUES
(0, 'LICENCES', NULL, NULL),
(1, 'MASTER', NULL, NULL),
(2, 'INGENIEURS', NULL, NULL),
(3, 'INSTITUT GALILEE', NULL, NULL),
(4, 'LICENCES', 'INFORMATIQUE', NULL),
(5, 'LICENCES', 'MATHEMATIQUES', NULL),
(6, 'LICENCES', 'PHYSIQUE-CHIMIE', NULL),
(7, 'LICENCES', 'SCIENCES POUR L''INGENIEUR', NULL),
(8, 'MASTER', 'PHYSIQUE ET SCIENCES DES MATERIAUX', NULL),
(9, 'MASTER', 'INFORMATIQUE', NULL),
(10, 'MASTER', 'GENIE DES PROCEDES', NULL),
(11, 'MASTER', 'MATHEMATIQUES', NULL),
(12, 'MASTER', 'MEEF', NULL),
(13, 'MASTER', 'INGENIERIE ET INNOVATIONS EN IMAGES ET RESEAUX', NULL),
(14, 'MASTER', 'INGENIERIE DE LA SANTE, BIOMATERIAUX', NULL),
(15, 'INGENIEURS', 'MATHEMATIQUES APPLIQUEES ET CALCUL SCIENTIFIQUE', NULL),
(16, 'INGENIEURS', 'INFORMATIQUE', NULL),
(17, 'INGENIEURS', 'TELECOMMUNICATIONS ET RESEAUX', NULL),
(18, 'INGENIEURS', 'ENERGETIQUE', NULL),
(19, 'INGENIEURS', 'AIR', NULL),
(20, 'INGENIEURS', 'ENERA', NULL),
(21, 'MASTER', 'PHYSIQUE ET SCIENCES DES MATERIAUX', 'PHOTONIQUE ET NANOTECHNOLOGIES'),
(22, 'MASTER', 'PHYSIQUE ET SCIENCES DES MATERIAUX', 'MODELISATION ET SIMULATION EN MECANIQUE'),
(23, 'MASTER', 'PHYSIQUE ET SCIENCES DES MATERIAUX', 'MATERIAUX DE STRUCTURE'),
(24, 'MASTER', 'PHYSIQUE ET SCIENCES DES MATERIAUX', 'MATERIAUX FONCTIONNELS'),
(25, 'MASTER', 'INFORMATIQUE', 'EIDD'),
(26, 'MASTER', 'INFORMATIQUE', 'PLS'),
(27, 'MASTER', 'GENIE DES PROCEDES', 'PQE'),
(28, 'MASTER', 'GENIE DES PROCEDES', 'GPIDD'),
(29, 'MASTER', 'MATHEMATIQUES', 'PREPARATION A L''AGREGATION'),
(30, 'MASTER', 'MATHEMATIQUES', 'MATHEMATIQUES FONDAMENTALES'),
(31, 'MASTER', 'MEEF', 'PREPARATION CAPES MATHEMATIQUES'),
(32, 'MASTER', 'INGENIERIE ET INNOVATIONS EN IMAGES ET RESEAUX', 'PARCOURS IMAGES'),
(33, 'MASTER', 'INGENIERIE ET INNOVATIONS EN IMAGES ET RESEAUX', 'PARCOURS RESEAUX'),
(34, 'MASTER', 'INGENIERIE DE LA SANTE, BIOMATERIAUX', 'INGENIERIE DE LA SANTE, BIOMATERIAUX');

-- --------------------------------------------------------

--
-- Table structure for table `Entreprise`
--

CREATE TABLE IF NOT EXISTS `Entreprise` (
  `nomEntreprise` varchar(70) NOT NULL,
  `groupe` varchar(70) DEFAULT NULL,
  `adresse` varchar(70) DEFAULT NULL,
  `complementAdresse` varchar(70) DEFAULT NULL,
  `codePostal` varchar(5) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `typeContact` varchar(70) DEFAULT NULL,
  `origine` varchar(70) DEFAULT NULL,
  `numeroSIRET` varchar(70) DEFAULT NULL,
  `NAF_codeNAF` int(11) DEFAULT NULL,
  `partenariatOfficiel` varchar(3) DEFAULT 'NON',
  `taille` varchar(20) DEFAULT NULL,
  `alias` text,
  `commentairesEntreprise` longtext,
  PRIMARY KEY (`nomEntreprise`),
  KEY `fk_Entreprise_Naf_idx` (`NAF_codeNAF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Entreprise`
--

INSERT INTO `Entreprise` (`nomEntreprise`, `groupe`, `adresse`, `complementAdresse`, `codePostal`, `ville`, `pays`, `typeContact`, `origine`, `numeroSIRET`, `NAF_codeNAF`, `partenariatOfficiel`, `taille`, `alias`, `commentairesEntreprise`) VALUES
('ACCENTURE', '', '118 avenue de France', '', '75636', 'Paris cedex 13', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, ''),
('ALTEN', '', '130-136 Rue de Silly', '', '92773', 'Boulogne Billancourt Cedex', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, ''),
('BOUYGUES TELECOM', '', '32 avenue Hoche', '', '75008', 'PARIS', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, ''),
('CAPGEMINI', '', '20 avenue Andre Prothin', 'Tour Europlaza', '92927', 'Paris La Defense Cedex', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, ''),
('CGI', '', '', '', '', '', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, 'Commentaires import (pour le contact: BAIS Xavier) : \nEx Logica\n'),
('EDF', '', '45 rue Kleber', '', '92309', 'Levallois Perret Cedex', 'France', NULL, NULL, NULL, NULL, 'NON', '> 5000', NULL, 'Commentaires import (pour le contact: PESKINE Gabrielle) : \n Direction Services Partages\nCommentaires import (pour le contact: LUCAT Celine) : \nDirection des Services Partages\nDirection des Ressources Humaines\n'),
('ERDF', '', '6 rue de la Liberte', '', '93691', 'PANTIN CEDEX', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, ''),
('LINK BY NET', '', '5 RUE DE L INDUSTRIE', '', '93200', 'SAINT DENIS', 'France', NULL, NULL, NULL, NULL, 'NON', '250 à 5000', NULL, ''),
('ORANGE', '', '16 Boulevard du Mont D', '', '93160', 'NOISY LE GRAND', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, ''),
('SFR', '', '12 rue Jean-Philippe RAMEAU', 'CS 80001', '93634', 'La Plaine St-Denis cedex', 'France', NULL, NULL, NULL, NULL, 'NON', '> 5000', NULL, ''),
('SODEXO ENERGIE ET MAINTENANCE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NON', NULL, NULL, NULL),
('VINCI ENERGIES', '', 'Pôle Ile-de-France Tertiaire\n7 Place de la Defense', '', '92400', 'COURBEVOIE', 'France', NULL, NULL, NULL, NULL, 'NON', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `ForumSG`
--

CREATE TABLE IF NOT EXISTS `ForumSG` (
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `anneeDeParticipation` year(4) NOT NULL,
  `questionnaireDeSatisfaction` varchar(100) DEFAULT NULL,
  `commentairesForum` longtext,
  PRIMARY KEY (`Entreprise_nomEntreprise`,`anneeDeParticipation`),
  KEY `fk_forumSG_Entreprise1_idx` (`Entreprise_nomEntreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ForumSG`
--

INSERT INTO `ForumSG` (`Entreprise_nomEntreprise`, `anneeDeParticipation`, `questionnaireDeSatisfaction`, `commentairesForum`) VALUES
('ACCENTURE', 2012, NULL, NULL),
('ACCENTURE', 2013, NULL, 'à inviter'),
('ACCENTURE', 2014, NULL, NULL),
('ACCENTURE', 2015, NULL, 'Partenaire actif \nPrésent au Forum Sup Galilée 2014\nVerse de la TA'),
('ALTEN', 2015, NULL, 'Nouveau Partenaire très actif \nN''a jamais participé au Forum Sup Galilée \nVerse de la TA'),
('CAPGEMINI', 2012, NULL, NULL),
('CAPGEMINI', 2013, NULL, 'à inviter Baptiste CHEFDEVILLE : Chargé de mission RH'),
('CAPGEMINI', 2014, NULL, NULL),
('CAPGEMINI', 2015, NULL, 'Partenaire actif \nPrésent au Forum Sup Galilée 2014\nVerse de la TA'),
('CGI', 2015, NULL, 'Partenaire actif\nOfficiellement invitée au forum par Céline et Rachid lors de notre visite à La Défense \nN''a jamais participé au Forum Sup Galilée'),
('EDF', 2015, NULL, 'convention de partenariat en cours de redaction avec P13\nN''a jamais participé au Forum Sup Galilée \nVerse  de la TA'),
('ERDF', 2014, NULL, NULL),
('ErDF', 2015, NULL, 'convention de partenariat écrite avec l''IG\nMembre du conseil d''école Sup Galilee\nPrésent au Forum Sup Galilée 2014\nVerse de la TA'),
('LINK BY NET', 2013, NULL, ''),
('LINK BY NET', 2014, NULL, NULL),
('LINK BY NET', 2015, NULL, 'Partenaire actif \nMembre du conseil d''école Sup Galilee\nPrésent au Forum Sup Galilée 2014\nEntreprise territoire de Plaine Commune\nVerse de la TA'),
('ORANGE', 2012, NULL, NULL),
('ORANGE', 2014, NULL, NULL),
('ORANGE', 2015, NULL, 'Partenaire actif\nMembre du conseil  de l''IG et Sup Galilée\nPrésent au Forum Sup Galilée 2014\nEntreprise territoire de Plaine Commune'),
('SFR', 2015, NULL, 'Suite defection de ALGOFI, j''invite SFR , je viens de m''entretenir avec Hélène MERLIN qui a déjà 2 forums ce jour là ,\nelle fait le max pour assurer une présence au moins une 1/2 journée\nelle sonde ses RH et me fera un retour avant le lundi 12/10\n\nRL 12/10/2015 : mail de Hélène MERLIN : \nBonjour Rachid , Nous vous faisons un retour au plus tôt, mais n’avons pas encore pu régler notre problème d’organisation pour être présent à votre forum. Pour rappel, nous étions déjà engagé sur 2 autres forums le 26 novembre. Bonne journée et à bientôt'),
('SODEXO ENERGIE ET MAINTENANCE', 2015, NULL, 'Partenaire actif \nPrésent au Forum Sup Galilée 2014\nVerse de la TA');

-- --------------------------------------------------------

--
-- Table structure for table `NAF`
--

CREATE TABLE IF NOT EXISTS `NAF` (
  `codeNAF` int(11) NOT NULL,
  `libelleNAF` int(11) DEFAULT NULL,
  PRIMARY KEY (`codeNAF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `TaxeApprentissage`
--

CREATE TABLE IF NOT EXISTS `TaxeApprentissage` (
  `idTA` int(11) NOT NULL AUTO_INCREMENT,
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `anneeDeVersement` year(4) DEFAULT NULL,
  `montantPromesseVersement` int(11) DEFAULT NULL,
  `montantVerse` int(11) DEFAULT NULL,
  `OCTA` varchar(50) DEFAULT NULL,
  `dateEnregistrement` date DEFAULT NULL,
  `dateDerniereModification` date DEFAULT NULL,
  `modePaiement` varchar(10) DEFAULT NULL,
  `versementVia` varchar(50) DEFAULT NULL,
  `dateTransmissionChequeAC` date DEFAULT NULL,
  `rapprochementAC` date DEFAULT NULL,
  `commentairesTaxe` longtext,
  PRIMARY KEY (`idTA`),
  KEY `fk_TA_Entreprise_idx` (`Entreprise_nomEntreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `TaxeApprentissage`
--

INSERT INTO `TaxeApprentissage` (`idTA`, `Entreprise_nomEntreprise`, `anneeDeVersement`, `montantPromesseVersement`, `montantVerse`, `OCTA`, `dateEnregistrement`, `dateDerniereModification`, `modePaiement`, `versementVia`, `dateTransmissionChequeAC`, `rapprochementAC`, `commentairesTaxe`) VALUES
(1, 'ACCENTURE', 2012, 2000, 2000, 'SYNTEC', '2012-07-18', NULL, 'cheque', NULL, NULL, NULL, 'Chèque de 24081 euros envoyé directement à l''agence comptable'),
(11, 'CAPGEMINI', 2012, 10000, 10000, 'SYNTEC', '2012-07-18', NULL, 'cheque', NULL, NULL, NULL, 'Chèque de 24081 euros envoyé directement à l''agence comptable'),
(125, 'CAPGEMINI', 2013, NULL, 7000, 'SYNTEC', '2013-07-16', NULL, NULL, 'AC', NULL, '2013-09-06', 'Institut Galilée'),
(128, 'ACCENTURE', 2013, NULL, 1800, 'SYNTEC', '2013-07-16', NULL, 'cheque', 'AC', NULL, '2013-09-06', 'Institut Galilée'),
(140, 'LINK BY NET', 2014, NULL, 2500, 'ORT COLLECTEUR', NULL, NULL, NULL, 'SRE', NULL, '2014-09-02', 'PDV orale\nCheque directement reçu par l''AC'),
(141, 'ACCENTURE', 2014, NULL, 2500, 'SYNTEC', NULL, NULL, 'cheque', 'SRE', NULL, '2014-09-02', 'PDV ecrite ( flechage IG )'),
(194, 'ERDF', 2014, NULL, 4000, 'AGIRES', NULL, NULL, NULL, 'SRE', NULL, '2014-09-02', NULL),
(207, 'ACCENTURE', 2015, NULL, 1000, 'SYNTEC', NULL, NULL, NULL, 'SRE', NULL, '2015-09-10', 'RL 05/05/2015: recu mail de Fanny Lefebvre qui nous informe que le versement de TA sera de 1000 eurosen categorie B \nPresent sur un bordereau du Syntec : flechage IG ecrite'),
(211, 'ALTEN', 2015, NULL, 899, 'AGIRES', NULL, NULL, 'cheque', 'SRE', NULL, '2015-09-10', 'Flechage Ingés Telecom '),
(212, 'ALTEN', 2015, NULL, 899, 'AGIRES', NULL, NULL, 'cheque', 'SRE', NULL, '2015-09-10', 'Flechage Ingés Informatique '),
(213, 'ALTEN', 2015, NULL, 899, 'AGIRES', NULL, NULL, 'cheque', 'SRE', NULL, '2015-09-10', 'Flechage Ingés Energetique '),
(214, 'ALTEN', 2015, NULL, 899, 'AGIRES', NULL, NULL, 'cheque', 'SRE', NULL, '2015-09-10', 'Flechage Ingés MACS '),
(223, 'CAPGEMINI', 2015, NULL, 4000, 'SYNTEC', NULL, NULL, NULL, 'SRE', NULL, '2015-09-10', 'Recu mail de Aurélie Jacquot qui nous informe d''un versement de 6000 au total ( 4000 Capgemini, 2000 Sogeti ) \nPresent sur un bordereau du Syntec : flechage IG'),
(236, 'ERDF', 2015, NULL, 5000, 'AGIRES', NULL, NULL, 'cheque', 'SRE', NULL, '2015-09-10', 'RL 06/05/2014 : recu mail de Pascal Dassonville qui nous informe que ERDF versera 5000 euros de TA \nRL 07/07/2015: reçu courrier de ERDF signé par le DRH Daniel CHEREL confirmant le versement de 5000 euros .\nRL 30/07/2015 : recu le cheque de AGIRES mais le flechage est clairement indique Inges Telecom alors que ERDF collabore dns un 1er temps avec les Ingés Energetique / La direction de Galilée décidera ecrite'),
(250, 'ORANGE', 2015, NULL, 7000, 'UNIPE', NULL, NULL, 'cheque', 'SRE', NULL, '2015-09-10', 'Courrier du 26/08/2015 envoyé par Philippe SANGLIER nous informant du versement de 7000 euros');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vueAlternance`
--
CREATE TABLE IF NOT EXISTS `vueAlternance` (
`Entreprise_nomEntreprise` varchar(70)
,`formationAlternance` varchar(5)
,`anneeEntree` int(11)
,`typeContrat` varchar(70)
,`civiliteAlternant` varchar(20)
,`nomAlternant` varchar(20)
,`prenomAlternant` varchar(20)
,`fonctionAlternant` varchar(100)
,`telephoneFixeAlternant` varchar(20)
,`telephoneMobileAlternant` varchar(20)
,`mailAlternant` varchar(70)
,`commentaireAlternant` longtext
,`civiliteMaitre` varchar(20)
,`nomMaitre` varchar(20)
,`prenomMaitre` varchar(20)
,`fonctionMaitre` varchar(100)
,`telephoneFixeMaitre` varchar(20)
,`telephoneMobileMaitre` varchar(20)
,`mailMaitre` varchar(70)
,`commentaireMaitre` longtext
,`civiliteRH` varchar(20)
,`nomRH` varchar(20)
,`prenomRH` varchar(20)
,`fonctionRH` varchar(100)
,`telephoneFixeRH` varchar(20)
,`telephoneMobileRH` varchar(20)
,`mailRH` varchar(70)
,`commentaireRH` longtext
,`dateRVPreparation` date
,`dateRVSimulation` date
,`dateDebutContrat` year(4)
,`dateFinContrat` year(4)
,`dateRuptureContrat` date
,`dateEnvoiFLAuCFA` date
,`docAAttacher` varchar(200)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vueAlternance1`
--
CREATE TABLE IF NOT EXISTS `vueAlternance1` (
`Entreprise_nomEntreprise` varchar(70)
,`formationAlternance` varchar(5)
,`anneeEntree` int(11)
,`typeContrat` varchar(70)
,`civiliteAlternant` varchar(20)
,`nomAlternant` varchar(20)
,`prenomAlternant` varchar(20)
,`fonctionAlternant` varchar(100)
,`telephoneFixeAlternant` varchar(20)
,`telephoneMobileAlternant` varchar(20)
,`mailAlternant` varchar(70)
,`commentaireAlternant` longtext
,`CoordonneesPersonne_maitre` int(11)
,`CoordonneesPersonne_RH` int(11)
,`dateRVPreparation` date
,`dateRVSimulation` date
,`dateDebutContrat` year(4)
,`dateFinContrat` year(4)
,`dateRuptureContrat` date
,`dateEnvoiFLAuCFA` date
,`docAAttacher` varchar(200)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vueAlternance2`
--
CREATE TABLE IF NOT EXISTS `vueAlternance2` (
`Entreprise_nomEntreprise` varchar(70)
,`formationAlternance` varchar(5)
,`anneeEntree` int(11)
,`typeContrat` varchar(70)
,`civiliteAlternant` varchar(20)
,`nomAlternant` varchar(20)
,`prenomAlternant` varchar(20)
,`fonctionAlternant` varchar(100)
,`telephoneFixeAlternant` varchar(20)
,`telephoneMobileAlternant` varchar(20)
,`mailAlternant` varchar(70)
,`commentaireAlternant` longtext
,`civiliteMaitre` varchar(20)
,`nomMaitre` varchar(20)
,`prenomMaitre` varchar(20)
,`fonctionMaitre` varchar(100)
,`telephoneFixeMaitre` varchar(20)
,`telephoneMobileMaitre` varchar(20)
,`mailMaitre` varchar(70)
,`commentaireMaitre` longtext
,`CoordonneesPersonne_maitre` int(11)
,`CoordonneesPersonne_RH` int(11)
,`dateRVPreparation` date
,`dateRVSimulation` date
,`dateDebutContrat` year(4)
,`dateFinContrat` year(4)
,`dateRuptureContrat` date
,`dateEnvoiFLAuCFA` date
,`docAAttacher` varchar(200)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vueAlternance3`
--
CREATE TABLE IF NOT EXISTS `vueAlternance3` (
`Entreprise_nomEntreprise` varchar(70)
,`formationAlternance` varchar(5)
,`anneeEntree` int(11)
,`typeContrat` varchar(70)
,`civiliteAlternant` varchar(20)
,`nomAlternant` varchar(20)
,`prenomAlternant` varchar(20)
,`fonctionAlternant` varchar(100)
,`telephoneFixeAlternant` varchar(20)
,`telephoneMobileAlternant` varchar(20)
,`mailAlternant` varchar(70)
,`commentaireAlternant` longtext
,`civiliteMaitre` varchar(20)
,`nomMaitre` varchar(20)
,`prenomMaitre` varchar(20)
,`fonctionMaitre` varchar(100)
,`telephoneFixeMaitre` varchar(20)
,`telephoneMobileMaitre` varchar(20)
,`mailMaitre` varchar(70)
,`commentaireMaitre` longtext
,`civiliteRH` varchar(20)
,`nomRH` varchar(20)
,`prenomRH` varchar(20)
,`fonctionRH` varchar(100)
,`telephoneFixeRH` varchar(20)
,`telephoneMobileRH` varchar(20)
,`mailRH` varchar(70)
,`commentaireRH` longtext
,`dateRVPreparation` date
,`dateRVSimulation` date
,`dateDebutContrat` year(4)
,`dateFinContrat` year(4)
,`dateRuptureContrat` date
,`dateEnvoiFLAuCFA` date
,`docAAttacher` varchar(200)
);
-- --------------------------------------------------------

--
-- Table structure for table `vueAtelierRh`
--
-- in use(#1356 - View 'srecreig_base.vueAtelierRh' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)
-- Error reading data: (#1356 - View 'srecreig_base.vueAtelierRh' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

-- --------------------------------------------------------

--
-- Stand-in structure for view `vueConference`
--
CREATE TABLE IF NOT EXISTS `vueConference` (
`Entreprise_nomEntreprise` varchar(40)
,`typeConference` varchar(20)
,`dateConference` date
,`heureDebut` time
,`heureFin` time
,`lieuConference` varchar(45)
,`themeConference` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vueContact`
--
CREATE TABLE IF NOT EXISTS `vueContact` (
`nomEntreprise` varchar(70)
,`civilite` varchar(20)
,`nom` varchar(20)
,`prenom` varchar(20)
,`fonction` varchar(100)
,`telephoneFixe` varchar(20)
,`telephoneMobile` varchar(20)
,`mail` varchar(70)
,`commentaires` longtext
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vueEntreprise`
--
CREATE TABLE IF NOT EXISTS `vueEntreprise` (
`nomEntreprise` varchar(70)
,`groupe` varchar(70)
,`adresse` varchar(70)
,`complementAdresse` varchar(70)
,`codePostal` varchar(5)
,`ville` varchar(100)
,`pays` varchar(50)
,`typeContact` varchar(70)
,`origine` varchar(70)
,`numeroSIRET` varchar(70)
,`NAF_codeNAF` int(11)
,`partenariatOfficiel` varchar(3)
,`taille` varchar(20)
,`alias` text
,`commentairesEntreprise` longtext
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vueForumSG`
--
CREATE TABLE IF NOT EXISTS `vueForumSG` (
`Entreprise_nomEntreprise` varchar(70)
,`anneeDeParticipation` year(4)
,`questionnaireDeSatisfaction` varchar(100)
,`commentairesForum` longtext
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vueTaxeApprentissage`
--
CREATE TABLE IF NOT EXISTS `vueTaxeApprentissage` (
`Entreprise_nomEntreprise` varchar(70)
,`anneeDeVersement` year(4)
,`montantPromesseVersement` int(11)
,`montantVerse` int(11)
,`OCTA` varchar(50)
,`dateEnregistrement` date
,`dateDerniereModification` date
,`modePaiement` varchar(10)
,`versementVia` varchar(50)
,`dateTransmissionChequeAC` date
,`rapprochementAC` date
,`commentairesTaxe` longtext
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `Vue_Entreprise_Contact`
--
CREATE TABLE IF NOT EXISTS `Vue_Entreprise_Contact` (
`nomEntreprise` varchar(70)
,`groupe` varchar(70)
,`adresse` varchar(70)
,`complementAdresse` varchar(70)
,`codePostal` varchar(5)
,`ville` varchar(100)
,`pays` varchar(50)
,`typeContact` varchar(70)
,`origine` varchar(70)
,`numeroSIRET` varchar(70)
,`NAF_codeNAF` int(11)
,`partenariatOfficiel` varchar(3)
,`taille` varchar(20)
,`alias` text
,`commentairesEntreprise` longtext
,`idCoordonneesPersonne` int(11)
,`civilite` varchar(20)
,`nom` varchar(20)
,`prenom` varchar(20)
,`fonction` varchar(100)
,`telephoneFixe` varchar(20)
,`telephoneMobile` varchar(20)
,`mail` varchar(70)
,`commentaires` longtext
);
-- --------------------------------------------------------

--
-- Structure for view `vueAlternance`
--
DROP TABLE IF EXISTS `vueAlternance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueAlternance` AS select `vueAlternance2`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`vueAlternance2`.`formationAlternance` AS `formationAlternance`,`vueAlternance2`.`anneeEntree` AS `anneeEntree`,`vueAlternance2`.`typeContrat` AS `typeContrat`,`vueAlternance2`.`civiliteAlternant` AS `civiliteAlternant`,`vueAlternance2`.`nomAlternant` AS `nomAlternant`,`vueAlternance2`.`prenomAlternant` AS `prenomAlternant`,`vueAlternance2`.`fonctionAlternant` AS `fonctionAlternant`,`vueAlternance2`.`telephoneFixeAlternant` AS `telephoneFixeAlternant`,`vueAlternance2`.`telephoneMobileAlternant` AS `telephoneMobileAlternant`,`vueAlternance2`.`mailAlternant` AS `mailAlternant`,`vueAlternance2`.`commentaireAlternant` AS `commentaireAlternant`,`vueAlternance2`.`civiliteMaitre` AS `civiliteMaitre`,`vueAlternance2`.`nomMaitre` AS `nomMaitre`,`vueAlternance2`.`prenomMaitre` AS `prenomMaitre`,`vueAlternance2`.`fonctionMaitre` AS `fonctionMaitre`,`vueAlternance2`.`telephoneFixeMaitre` AS `telephoneFixeMaitre`,`vueAlternance2`.`telephoneMobileMaitre` AS `telephoneMobileMaitre`,`vueAlternance2`.`mailMaitre` AS `mailMaitre`,`vueAlternance2`.`commentaireMaitre` AS `commentaireMaitre`,`Coord3`.`civilite` AS `civiliteRH`,`Coord3`.`nom` AS `nomRH`,`Coord3`.`prenom` AS `prenomRH`,`Coord3`.`fonction` AS `fonctionRH`,`Coord3`.`telephoneFixe` AS `telephoneFixeRH`,`Coord3`.`telephoneMobile` AS `telephoneMobileRH`,`Coord3`.`mail` AS `mailRH`,`Coord3`.`commentaires` AS `commentaireRH`,`vueAlternance2`.`dateRVPreparation` AS `dateRVPreparation`,`vueAlternance2`.`dateRVSimulation` AS `dateRVSimulation`,`vueAlternance2`.`dateDebutContrat` AS `dateDebutContrat`,`vueAlternance2`.`dateFinContrat` AS `dateFinContrat`,`vueAlternance2`.`dateRuptureContrat` AS `dateRuptureContrat`,`vueAlternance2`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`vueAlternance2`.`docAAttacher` AS `docAAttacher` from (`vueAlternance2` left join `CoordonneesPersonne` `Coord3` on((`vueAlternance2`.`CoordonneesPersonne_RH` = `Coord3`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueAlternance1`
--
DROP TABLE IF EXISTS `vueAlternance1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueAlternance1` AS select `Alternance`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`Alternance`.`formationAlternance` AS `formationAlternance`,`Alternance`.`anneeEntree` AS `anneeEntree`,`Alternance`.`typeContrat` AS `typeContrat`,`Coord1`.`civilite` AS `civiliteAlternant`,`Coord1`.`nom` AS `nomAlternant`,`Coord1`.`prenom` AS `prenomAlternant`,`Coord1`.`fonction` AS `fonctionAlternant`,`Coord1`.`telephoneFixe` AS `telephoneFixeAlternant`,`Coord1`.`telephoneMobile` AS `telephoneMobileAlternant`,`Coord1`.`mail` AS `mailAlternant`,`Coord1`.`commentaires` AS `commentaireAlternant`,`Alternance`.`CoordonneesPersonne_maitre` AS `CoordonneesPersonne_maitre`,`Alternance`.`CoordonneesPersonne_RH` AS `CoordonneesPersonne_RH`,`Alternance`.`dateRVPreparation` AS `dateRVPreparation`,`Alternance`.`dateRVSimulation` AS `dateRVSimulation`,`Alternance`.`dateDebutContrat` AS `dateDebutContrat`,`Alternance`.`dateFinContrat` AS `dateFinContrat`,`Alternance`.`dateRuptureContrat` AS `dateRuptureContrat`,`Alternance`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`Alternance`.`docAAttacher` AS `docAAttacher` from (`Alternance` join `CoordonneesPersonne` `Coord1` on((`Alternance`.`CoordonneesPersonne_alternant` = `Coord1`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueAlternance2`
--
DROP TABLE IF EXISTS `vueAlternance2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueAlternance2` AS select `vueAlternance1`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`vueAlternance1`.`formationAlternance` AS `formationAlternance`,`vueAlternance1`.`anneeEntree` AS `anneeEntree`,`vueAlternance1`.`typeContrat` AS `typeContrat`,`vueAlternance1`.`civiliteAlternant` AS `civiliteAlternant`,`vueAlternance1`.`nomAlternant` AS `nomAlternant`,`vueAlternance1`.`prenomAlternant` AS `prenomAlternant`,`vueAlternance1`.`fonctionAlternant` AS `fonctionAlternant`,`vueAlternance1`.`telephoneFixeAlternant` AS `telephoneFixeAlternant`,`vueAlternance1`.`telephoneMobileAlternant` AS `telephoneMobileAlternant`,`vueAlternance1`.`mailAlternant` AS `mailAlternant`,`vueAlternance1`.`commentaireAlternant` AS `commentaireAlternant`,`Coord2`.`civilite` AS `civiliteMaitre`,`Coord2`.`nom` AS `nomMaitre`,`Coord2`.`prenom` AS `prenomMaitre`,`Coord2`.`fonction` AS `fonctionMaitre`,`Coord2`.`telephoneFixe` AS `telephoneFixeMaitre`,`Coord2`.`telephoneMobile` AS `telephoneMobileMaitre`,`Coord2`.`mail` AS `mailMaitre`,`Coord2`.`commentaires` AS `commentaireMaitre`,`vueAlternance1`.`CoordonneesPersonne_maitre` AS `CoordonneesPersonne_maitre`,`vueAlternance1`.`CoordonneesPersonne_RH` AS `CoordonneesPersonne_RH`,`vueAlternance1`.`dateRVPreparation` AS `dateRVPreparation`,`vueAlternance1`.`dateRVSimulation` AS `dateRVSimulation`,`vueAlternance1`.`dateDebutContrat` AS `dateDebutContrat`,`vueAlternance1`.`dateFinContrat` AS `dateFinContrat`,`vueAlternance1`.`dateRuptureContrat` AS `dateRuptureContrat`,`vueAlternance1`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`vueAlternance1`.`docAAttacher` AS `docAAttacher` from (`vueAlternance1` left join `CoordonneesPersonne` `Coord2` on((`vueAlternance1`.`CoordonneesPersonne_maitre` = `Coord2`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueAlternance3`
--
DROP TABLE IF EXISTS `vueAlternance3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueAlternance3` AS select `vueAlternance2`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`vueAlternance2`.`formationAlternance` AS `formationAlternance`,`vueAlternance2`.`anneeEntree` AS `anneeEntree`,`vueAlternance2`.`typeContrat` AS `typeContrat`,`vueAlternance2`.`civiliteAlternant` AS `civiliteAlternant`,`vueAlternance2`.`nomAlternant` AS `nomAlternant`,`vueAlternance2`.`prenomAlternant` AS `prenomAlternant`,`vueAlternance2`.`fonctionAlternant` AS `fonctionAlternant`,`vueAlternance2`.`telephoneFixeAlternant` AS `telephoneFixeAlternant`,`vueAlternance2`.`telephoneMobileAlternant` AS `telephoneMobileAlternant`,`vueAlternance2`.`mailAlternant` AS `mailAlternant`,`vueAlternance2`.`commentaireAlternant` AS `commentaireAlternant`,`vueAlternance2`.`civiliteMaitre` AS `civiliteMaitre`,`vueAlternance2`.`nomMaitre` AS `nomMaitre`,`vueAlternance2`.`prenomMaitre` AS `prenomMaitre`,`vueAlternance2`.`fonctionMaitre` AS `fonctionMaitre`,`vueAlternance2`.`telephoneFixeMaitre` AS `telephoneFixeMaitre`,`vueAlternance2`.`telephoneMobileMaitre` AS `telephoneMobileMaitre`,`vueAlternance2`.`mailMaitre` AS `mailMaitre`,`vueAlternance2`.`commentaireMaitre` AS `commentaireMaitre`,`Coord3`.`civilite` AS `civiliteRH`,`Coord3`.`nom` AS `nomRH`,`Coord3`.`prenom` AS `prenomRH`,`Coord3`.`fonction` AS `fonctionRH`,`Coord3`.`telephoneFixe` AS `telephoneFixeRH`,`Coord3`.`telephoneMobile` AS `telephoneMobileRH`,`Coord3`.`mail` AS `mailRH`,`Coord3`.`commentaires` AS `commentaireRH`,`vueAlternance2`.`dateRVPreparation` AS `dateRVPreparation`,`vueAlternance2`.`dateRVSimulation` AS `dateRVSimulation`,`vueAlternance2`.`dateDebutContrat` AS `dateDebutContrat`,`vueAlternance2`.`dateFinContrat` AS `dateFinContrat`,`vueAlternance2`.`dateRuptureContrat` AS `dateRuptureContrat`,`vueAlternance2`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`vueAlternance2`.`docAAttacher` AS `docAAttacher` from (`vueAlternance2` left join `CoordonneesPersonne` `Coord3` on((`vueAlternance2`.`CoordonneesPersonne_RH` = `Coord3`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueConference`
--
DROP TABLE IF EXISTS `vueConference`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueConference` AS select `Conference`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`Conference`.`typeConference` AS `typeConference`,`Conference`.`dateConference` AS `dateConference`,`Conference`.`heureDebut` AS `heureDebut`,`Conference`.`heureFin` AS `heureFin`,`Conference`.`lieuConference` AS `lieuConference`,`Conference`.`themeConference` AS `themeConference` from `Conference`;

-- --------------------------------------------------------

--
-- Structure for view `vueContact`
--
DROP TABLE IF EXISTS `vueContact`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueContact` AS select `Entreprise`.`nomEntreprise` AS `nomEntreprise`,`CoordonneesPersonne`.`civilite` AS `civilite`,`CoordonneesPersonne`.`nom` AS `nom`,`CoordonneesPersonne`.`prenom` AS `prenom`,`CoordonneesPersonne`.`fonction` AS `fonction`,`CoordonneesPersonne`.`telephoneFixe` AS `telephoneFixe`,`CoordonneesPersonne`.`telephoneMobile` AS `telephoneMobile`,`CoordonneesPersonne`.`mail` AS `mail`,`CoordonneesPersonne`.`commentaires` AS `commentaires` from ((`Entreprise` join `a_Entreprise_CoordonneesPersonne` on((`a_Entreprise_CoordonneesPersonne`.`Entreprise_nomEntreprise` = `Entreprise`.`nomEntreprise`))) join `CoordonneesPersonne` on((`a_Entreprise_CoordonneesPersonne`.`CoordonneesPersonne_id` = `CoordonneesPersonne`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueEntreprise`
--
DROP TABLE IF EXISTS `vueEntreprise`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueEntreprise` AS select `Entreprise`.`nomEntreprise` AS `nomEntreprise`,`Entreprise`.`groupe` AS `groupe`,`Entreprise`.`adresse` AS `adresse`,`Entreprise`.`complementAdresse` AS `complementAdresse`,`Entreprise`.`codePostal` AS `codePostal`,`Entreprise`.`ville` AS `ville`,`Entreprise`.`pays` AS `pays`,`Entreprise`.`typeContact` AS `typeContact`,`Entreprise`.`origine` AS `origine`,`Entreprise`.`numeroSIRET` AS `numeroSIRET`,`Entreprise`.`NAF_codeNAF` AS `NAF_codeNAF`,`Entreprise`.`partenariatOfficiel` AS `partenariatOfficiel`,`Entreprise`.`taille` AS `taille`,`Entreprise`.`alias` AS `alias`,`Entreprise`.`commentairesEntreprise` AS `commentairesEntreprise` from `Entreprise`;

-- --------------------------------------------------------

--
-- Structure for view `vueForumSG`
--
DROP TABLE IF EXISTS `vueForumSG`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueForumSG` AS select `ForumSG`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`ForumSG`.`anneeDeParticipation` AS `anneeDeParticipation`,`ForumSG`.`questionnaireDeSatisfaction` AS `questionnaireDeSatisfaction`,`ForumSG`.`commentairesForum` AS `commentairesForum` from `ForumSG`;

-- --------------------------------------------------------

--
-- Structure for view `vueTaxeApprentissage`
--
DROP TABLE IF EXISTS `vueTaxeApprentissage`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `vueTaxeApprentissage` AS select `TaxeApprentissage`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`TaxeApprentissage`.`anneeDeVersement` AS `anneeDeVersement`,`TaxeApprentissage`.`montantPromesseVersement` AS `montantPromesseVersement`,`TaxeApprentissage`.`montantVerse` AS `montantVerse`,`TaxeApprentissage`.`OCTA` AS `OCTA`,`TaxeApprentissage`.`dateEnregistrement` AS `dateEnregistrement`,`TaxeApprentissage`.`dateDerniereModification` AS `dateDerniereModification`,`TaxeApprentissage`.`modePaiement` AS `modePaiement`,`TaxeApprentissage`.`versementVia` AS `versementVia`,`TaxeApprentissage`.`dateTransmissionChequeAC` AS `dateTransmissionChequeAC`,`TaxeApprentissage`.`rapprochementAC` AS `rapprochementAC`,`TaxeApprentissage`.`commentairesTaxe` AS `commentairesTaxe` from `TaxeApprentissage`;

-- --------------------------------------------------------

--
-- Structure for view `Vue_Entreprise_Contact`
--
DROP TABLE IF EXISTS `Vue_Entreprise_Contact`;

CREATE ALGORITHM=UNDEFINED DEFINER=`srecreig`@`%` SQL SECURITY DEFINER VIEW `Vue_Entreprise_Contact` AS select `Entreprise`.`nomEntreprise` AS `nomEntreprise`,`Entreprise`.`groupe` AS `groupe`,`Entreprise`.`adresse` AS `adresse`,`Entreprise`.`complementAdresse` AS `complementAdresse`,`Entreprise`.`codePostal` AS `codePostal`,`Entreprise`.`ville` AS `ville`,`Entreprise`.`pays` AS `pays`,`Entreprise`.`typeContact` AS `typeContact`,`Entreprise`.`origine` AS `origine`,`Entreprise`.`numeroSIRET` AS `numeroSIRET`,`Entreprise`.`NAF_codeNAF` AS `NAF_codeNAF`,`Entreprise`.`partenariatOfficiel` AS `partenariatOfficiel`,`Entreprise`.`taille` AS `taille`,`Entreprise`.`alias` AS `alias`,`Entreprise`.`commentairesEntreprise` AS `commentairesEntreprise`,`CoordonneesPersonne`.`idCoordonneesPersonne` AS `idCoordonneesPersonne`,`CoordonneesPersonne`.`civilite` AS `civilite`,`CoordonneesPersonne`.`nom` AS `nom`,`CoordonneesPersonne`.`prenom` AS `prenom`,`CoordonneesPersonne`.`fonction` AS `fonction`,`CoordonneesPersonne`.`telephoneFixe` AS `telephoneFixe`,`CoordonneesPersonne`.`telephoneMobile` AS `telephoneMobile`,`CoordonneesPersonne`.`mail` AS `mail`,`CoordonneesPersonne`.`commentaires` AS `commentaires` from ((`Entreprise` join `CoordonneesPersonne`) join `a_Entreprise_CoordonneesPersonne`) where ((`a_Entreprise_CoordonneesPersonne`.`CoordonneesPersonne_id` = `CoordonneesPersonne`.`idCoordonneesPersonne`) and (`a_Entreprise_CoordonneesPersonne`.`Entreprise_nomEntreprise` = `Entreprise`.`nomEntreprise`));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Alternance`
--
ALTER TABLE `Alternance`
  ADD CONSTRAINT `fk_Alternance_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Alternance_CoordonneesPersonneAlternant` FOREIGN KEY (`CoordonneesPersonne_alternant`) REFERENCES `CoordonneesPersonne` (`idCoordonneesPersonne`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Alternance_CoordonneesPersonneMaitre` FOREIGN KEY (`CoordonneesPersonne_maitre`) REFERENCES `CoordonneesPersonne` (`idCoordonneesPersonne`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Alternance_CoordonneesPersonneRH` FOREIGN KEY (`CoordonneesPersonne_RH`) REFERENCES `CoordonneesPersonne` (`idCoordonneesPersonne`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `AtelierRH`
--
ALTER TABLE `AtelierRH`
  ADD CONSTRAINT `fk_AtelierRH_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_AtelierRH_CoordonneesPersonne`
--
ALTER TABLE `a_AtelierRH_CoordonneesPersonne`
  ADD CONSTRAINT `fk_a-AtelierRH-CoordonneesPersonne_AtelierRH` FOREIGN KEY (`AtelierRH_id`) REFERENCES `AtelierRH` (`idAtelierRH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_a-AtelierRH-CoordonneesPersonne_CoordonneesPersonne` FOREIGN KEY (`CoordonneesPersonne_id`) REFERENCES `CoordonneesPersonne` (`idCoordonneesPersonne`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_Conference_CoordonneesPersonne`
--
ALTER TABLE `a_Conference_CoordonneesPersonne`
  ADD CONSTRAINT `fk_a-Conference-CoordonneesPersonne_Conference` FOREIGN KEY (`Conference_id`) REFERENCES `Conference` (`idConference`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_a-Conference-CoordonneesPersonne_CoordonneesPersonne` FOREIGN KEY (`CoordonneesPersonne_id`) REFERENCES `CoordonneesPersonne` (`idCoordonneesPersonne`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_Entreprise_Action`
--
ALTER TABLE `a_Entreprise_Action`
  ADD CONSTRAINT `fk_a-Entreprise-Action_Action` FOREIGN KEY (`Action_id`) REFERENCES `Action` (`idAction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_a-Entreprise-Action_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_Entreprise_CoordonneesPersonne`
--
ALTER TABLE `a_Entreprise_CoordonneesPersonne`
  ADD CONSTRAINT `fk_a-Entreprise-CoordonneesPersonne_CoordonneesPersonne` FOREIGN KEY (`CoordonneesPersonne_id`) REFERENCES `CoordonneesPersonne` (`idCoordonneesPersonne`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_a-Entreprise-CoordonneesPersonne_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_Entreprise_CycleFormation`
--
ALTER TABLE `a_Entreprise_CycleFormation`
  ADD CONSTRAINT `fk_a-Entreprise-CycleFormation_CycleFormation` FOREIGN KEY (`CycleFormation_id`) REFERENCES `CycleFormation` (`idCycleFormation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_a-Entreprise-CycleFormation_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_TaxeApprentissage_CycleFormation`
--
ALTER TABLE `a_TaxeApprentissage_CycleFormation`
  ADD CONSTRAINT `fk_a-TaxeApprentissage-CycleFormation_CycleFormation` FOREIGN KEY (`CycleFormation_id`) REFERENCES `CycleFormation` (`idCycleFormation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_a-TaxeApprentissage-CycleFormation_TaxeApprentissage` FOREIGN KEY (`TaxeApprentissage_id`) REFERENCES `TaxeApprentissage` (`idTA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Conference`
--
ALTER TABLE `Conference`
  ADD CONSTRAINT `fk_Conference_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Entreprise`
--
ALTER TABLE `Entreprise`
  ADD CONSTRAINT `fk_Entreprise_NAF` FOREIGN KEY (`NAF_codeNAF`) REFERENCES `NAF` (`codeNAF`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ForumSG`
--
ALTER TABLE `ForumSG`
  ADD CONSTRAINT `fk_ForumSG_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TaxeApprentissage`
--
ALTER TABLE `TaxeApprentissage`
  ADD CONSTRAINT `fk_TA_Entreprise` FOREIGN KEY (`Entreprise_nomEntreprise`) REFERENCES `Entreprise` (`nomEntreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

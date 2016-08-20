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
  `idAction` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  PRIMARY KEY (`idAction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Action`
--

INSERT INTO `Action` (`idAction`,`action`) VALUES
(1,'Accueil d''apprentis en Energetique'),
(2,'Accueil d''apprentis en Informatique et Réseaux'),
(3,'Animation d''ateliers RH de simulations d''entretiens'),
(4,'Animation de conférences métiers'),
(5,'Partenariat officiel'),
(6,'Participation au Forum Sup Galilée Entreprises'),
(7,'Recrutement de stagiaires'),
(8,'Recrutement des jeunes diplômé(e)s'),
(9,'Soutien financier par le versement de taxe d''apprentissage');

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


-- --------------------------------------------------------

--
-- Table structure for table `a_Entreprise_Action`
--

CREATE TABLE IF NOT EXISTS `a_Entreprise_Action` (
  `Entreprise_nomEntreprise` varchar(70) NOT NULL,
  `Action_id` int(11) NOT NULL,
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


-- --------------------------------------------------------

--
-- Table structure for table `NAF`
--

CREATE TABLE IF NOT EXISTS `NAF` (
  `codeNAF` int(11) NOT NULL AUTO_INCREMENT,
  `libelleNAF` TEXT DEFAULT NULL,
  PRIMARY KEY (`codeNAF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `NAF` (`codeNAF`, `libelleNAF`) VALUES
(1, 'Culture et production animale, chasse et services annexes'),
(2, 'Sylviculture et exploitation forestière'),
(3, 'Pêche et aquaculture'),
(4, 'Extraction de houille et de lignite'),
(5, 'Extraction d''hydrocarbures'),
(6, 'Extraction de minerais métalliques'),
(7, 'Autres industries extractives'),
(8, 'Services de soutien aux industries extractives'),
(9, 'Industries alimentaires'),
(10, 'Fabrication de boissons'),
(11, 'Fabrication de produits à base de tabac'),
(12, 'Fabrication de textiles'),
(13, 'Industrie de l''habillement'),
(14, 'Industrie du cuir et de la chaussure'),
(15, 'Travail du bois et fabrication d''articles en bois et en liège, à l''exception des meubles ; fabrication d''articles en vannerie et sparterie'),
(16, 'Industrie du papier et du carton'),
(17, 'Imprimerie et reproduction d''enregistrements'),
(18, 'Cokéfaction et raffinage'),
(19, 'Industrie chimique'),
(20, 'Industrie pharmaceutique'),
(21, 'Fabrication de produits en caoutchouc et en plastique'),
(22, 'Fabrication d''autres produits minéraux non métalliques'),
(23, 'Métallurgie'),
(24, 'Fabrication de produits métalliques, à l''exception des machines et des équipements'),
(25, 'Fabrication de produits informatiques, électroniques et optiques'),
(26, 'Fabrication d''équipements électriques'),
(27, 'Fabrication de machines et équipements n.c.a.'),
(28, 'Industrie automobile'),
(29, 'Fabrication d''autres matériels de transport'),
(30, 'Fabrication de meubles'),
(31, 'Autres industries manufacturières'),
(32, 'Réparation et installation de machines et d''équipements'),
(33, 'Production et distribution d''électricité, de gaz, de vapeur et d''air conditionné'),
(34, 'Captage, traitement et distribution d''eau'),
(35, 'Collecte et traitement des eaux usées'),
(36, 'Collecte, traitement et élimination des déchets ; récupération'),
(37, 'Dépollution et autres services de gestion des déchets'),
(38, 'Construction de bâtiments'),
(39, 'Génie civil'),
(40, 'Travaux de construction spécialisés'),
(41, 'Commerce et réparation d''automobiles et de motocycles'),
(42, 'Commerce de gros, à l''exception des automobiles et des motocycles'),
(43, 'Commerce de détail, à l''exception des automobiles et des motocycles'),
(44, 'Transports terrestres et transport par conduites'),
(45, 'Transports par eau'),
(46, 'Transports aériens'),
(47, 'Entreposage et services auxiliaires des transports'),
(48, 'Activités de poste et de courrier'),
(49, 'Hébergement'),
(50, 'Restauration'),
(51, 'Édition'),
(52, 'Production de films cinématographiques, de vidéo et de programmes de télévision ; enregistrement sonore et édition musicale'),
(53, 'Programmation et diffusion'),
(54, 'Télécommunications'),
(55, 'Programmation, conseil et autres activités informatiques'),
(56, 'Services d''information'),
(57, 'Activités des services financiers, hors assurance et caisses de retraite'),
(58, 'Assurance'),
(59, 'Activités auxiliaires de services financiers et d''assurance'),
(60, 'Activités immobilières'),
(61, 'Activités juridiques et comptables'),
(62, 'Activités des sièges sociaux ; conseil de gestion'),
(63, 'Activités d''architecture et d''ingénierie ; activités de contrôle et analyses techniques'),
(64, 'Recherche-développement scientifique'),
(65, 'Publicité et études de marché'),
(66, 'Autres activités spécialisées, scientifiques et techniques'),
(67, 'Activités vétérinaires'),
(68, 'Activités de location et location-bail'),
(69, 'Activités liées à l''emploi'),
(70, 'Activités des agences de voyage, voyagistes, services de réservation et activités connexes'),
(71, 'Enquêtes et sécurité'),
(72, 'Services relatifs aux bâtiments et aménagement paysager'),
(73, 'Activités administratives et autres activités de soutien aux entreprises'),
(74, 'Administration publique et défense ; sécurité sociale obligatoire'),
(75, 'Enseignement'),
(76, 'Activités pour la santé humaine'),
(77, 'Hébergement médico-social et social'),
(78, 'Action sociale sans hébergement'),
(79, 'Activités créatives, artistiques et de spectacle'),
(80, 'Bibliothèques, archives, musées et autres activités culturelles'),
(81, 'Organisation de jeux de hasard et d''argent'),
(82, 'Activités sportives, récréatives et de loisirs'),
(83, 'Activités des organisations associatives'),
(84, 'Réparation d''ordinateurs et de biens personnels et domestiques'),
(85, 'Autres services personnels'),
(86, 'Activités des ménages en tant qu''employeurs de personnel domestique'),
(87, 'Activités indifférenciées des ménages en tant que producteurs de biens et services pour usage propre'),
(88, 'Activités des organisations et organismes extraterritoriaux');

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

CREATE VIEW `vueAlternance` AS select `vueAlternance2`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`vueAlternance2`.`formationAlternance` AS `formationAlternance`,`vueAlternance2`.`anneeEntree` AS `anneeEntree`,`vueAlternance2`.`typeContrat` AS `typeContrat`,`vueAlternance2`.`civiliteAlternant` AS `civiliteAlternant`,`vueAlternance2`.`nomAlternant` AS `nomAlternant`,`vueAlternance2`.`prenomAlternant` AS `prenomAlternant`,`vueAlternance2`.`fonctionAlternant` AS `fonctionAlternant`,`vueAlternance2`.`telephoneFixeAlternant` AS `telephoneFixeAlternant`,`vueAlternance2`.`telephoneMobileAlternant` AS `telephoneMobileAlternant`,`vueAlternance2`.`mailAlternant` AS `mailAlternant`,`vueAlternance2`.`commentaireAlternant` AS `commentaireAlternant`,`vueAlternance2`.`civiliteMaitre` AS `civiliteMaitre`,`vueAlternance2`.`nomMaitre` AS `nomMaitre`,`vueAlternance2`.`prenomMaitre` AS `prenomMaitre`,`vueAlternance2`.`fonctionMaitre` AS `fonctionMaitre`,`vueAlternance2`.`telephoneFixeMaitre` AS `telephoneFixeMaitre`,`vueAlternance2`.`telephoneMobileMaitre` AS `telephoneMobileMaitre`,`vueAlternance2`.`mailMaitre` AS `mailMaitre`,`vueAlternance2`.`commentaireMaitre` AS `commentaireMaitre`,`Coord3`.`civilite` AS `civiliteRH`,`Coord3`.`nom` AS `nomRH`,`Coord3`.`prenom` AS `prenomRH`,`Coord3`.`fonction` AS `fonctionRH`,`Coord3`.`telephoneFixe` AS `telephoneFixeRH`,`Coord3`.`telephoneMobile` AS `telephoneMobileRH`,`Coord3`.`mail` AS `mailRH`,`Coord3`.`commentaires` AS `commentaireRH`,`vueAlternance2`.`dateRVPreparation` AS `dateRVPreparation`,`vueAlternance2`.`dateRVSimulation` AS `dateRVSimulation`,`vueAlternance2`.`dateDebutContrat` AS `dateDebutContrat`,`vueAlternance2`.`dateFinContrat` AS `dateFinContrat`,`vueAlternance2`.`dateRuptureContrat` AS `dateRuptureContrat`,`vueAlternance2`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`vueAlternance2`.`docAAttacher` AS `docAAttacher` from (`vueAlternance2` left join `CoordonneesPersonne` `Coord3` on((`vueAlternance2`.`CoordonneesPersonne_RH` = `Coord3`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueAlternance1`
--
DROP TABLE IF EXISTS `vueAlternance1`;

CREATE VIEW `vueAlternance1` AS select `Alternance`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`Alternance`.`formationAlternance` AS `formationAlternance`,`Alternance`.`anneeEntree` AS `anneeEntree`,`Alternance`.`typeContrat` AS `typeContrat`,`Coord1`.`civilite` AS `civiliteAlternant`,`Coord1`.`nom` AS `nomAlternant`,`Coord1`.`prenom` AS `prenomAlternant`,`Coord1`.`fonction` AS `fonctionAlternant`,`Coord1`.`telephoneFixe` AS `telephoneFixeAlternant`,`Coord1`.`telephoneMobile` AS `telephoneMobileAlternant`,`Coord1`.`mail` AS `mailAlternant`,`Coord1`.`commentaires` AS `commentaireAlternant`,`Alternance`.`CoordonneesPersonne_maitre` AS `CoordonneesPersonne_maitre`,`Alternance`.`CoordonneesPersonne_RH` AS `CoordonneesPersonne_RH`,`Alternance`.`dateRVPreparation` AS `dateRVPreparation`,`Alternance`.`dateRVSimulation` AS `dateRVSimulation`,`Alternance`.`dateDebutContrat` AS `dateDebutContrat`,`Alternance`.`dateFinContrat` AS `dateFinContrat`,`Alternance`.`dateRuptureContrat` AS `dateRuptureContrat`,`Alternance`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`Alternance`.`docAAttacher` AS `docAAttacher` from (`Alternance` join `CoordonneesPersonne` `Coord1` on((`Alternance`.`CoordonneesPersonne_alternant` = `Coord1`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueAlternance2`
--
DROP TABLE IF EXISTS `vueAlternance2`;

CREATE VIEW `vueAlternance2` AS select `vueAlternance1`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`vueAlternance1`.`formationAlternance` AS `formationAlternance`,`vueAlternance1`.`anneeEntree` AS `anneeEntree`,`vueAlternance1`.`typeContrat` AS `typeContrat`,`vueAlternance1`.`civiliteAlternant` AS `civiliteAlternant`,`vueAlternance1`.`nomAlternant` AS `nomAlternant`,`vueAlternance1`.`prenomAlternant` AS `prenomAlternant`,`vueAlternance1`.`fonctionAlternant` AS `fonctionAlternant`,`vueAlternance1`.`telephoneFixeAlternant` AS `telephoneFixeAlternant`,`vueAlternance1`.`telephoneMobileAlternant` AS `telephoneMobileAlternant`,`vueAlternance1`.`mailAlternant` AS `mailAlternant`,`vueAlternance1`.`commentaireAlternant` AS `commentaireAlternant`,`Coord2`.`civilite` AS `civiliteMaitre`,`Coord2`.`nom` AS `nomMaitre`,`Coord2`.`prenom` AS `prenomMaitre`,`Coord2`.`fonction` AS `fonctionMaitre`,`Coord2`.`telephoneFixe` AS `telephoneFixeMaitre`,`Coord2`.`telephoneMobile` AS `telephoneMobileMaitre`,`Coord2`.`mail` AS `mailMaitre`,`Coord2`.`commentaires` AS `commentaireMaitre`,`vueAlternance1`.`CoordonneesPersonne_maitre` AS `CoordonneesPersonne_maitre`,`vueAlternance1`.`CoordonneesPersonne_RH` AS `CoordonneesPersonne_RH`,`vueAlternance1`.`dateRVPreparation` AS `dateRVPreparation`,`vueAlternance1`.`dateRVSimulation` AS `dateRVSimulation`,`vueAlternance1`.`dateDebutContrat` AS `dateDebutContrat`,`vueAlternance1`.`dateFinContrat` AS `dateFinContrat`,`vueAlternance1`.`dateRuptureContrat` AS `dateRuptureContrat`,`vueAlternance1`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`vueAlternance1`.`docAAttacher` AS `docAAttacher` from (`vueAlternance1` left join `CoordonneesPersonne` `Coord2` on((`vueAlternance1`.`CoordonneesPersonne_maitre` = `Coord2`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueAlternance3`
--
DROP TABLE IF EXISTS `vueAlternance3`;

CREATE VIEW `vueAlternance3` AS select `vueAlternance2`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`vueAlternance2`.`formationAlternance` AS `formationAlternance`,`vueAlternance2`.`anneeEntree` AS `anneeEntree`,`vueAlternance2`.`typeContrat` AS `typeContrat`,`vueAlternance2`.`civiliteAlternant` AS `civiliteAlternant`,`vueAlternance2`.`nomAlternant` AS `nomAlternant`,`vueAlternance2`.`prenomAlternant` AS `prenomAlternant`,`vueAlternance2`.`fonctionAlternant` AS `fonctionAlternant`,`vueAlternance2`.`telephoneFixeAlternant` AS `telephoneFixeAlternant`,`vueAlternance2`.`telephoneMobileAlternant` AS `telephoneMobileAlternant`,`vueAlternance2`.`mailAlternant` AS `mailAlternant`,`vueAlternance2`.`commentaireAlternant` AS `commentaireAlternant`,`vueAlternance2`.`civiliteMaitre` AS `civiliteMaitre`,`vueAlternance2`.`nomMaitre` AS `nomMaitre`,`vueAlternance2`.`prenomMaitre` AS `prenomMaitre`,`vueAlternance2`.`fonctionMaitre` AS `fonctionMaitre`,`vueAlternance2`.`telephoneFixeMaitre` AS `telephoneFixeMaitre`,`vueAlternance2`.`telephoneMobileMaitre` AS `telephoneMobileMaitre`,`vueAlternance2`.`mailMaitre` AS `mailMaitre`,`vueAlternance2`.`commentaireMaitre` AS `commentaireMaitre`,`Coord3`.`civilite` AS `civiliteRH`,`Coord3`.`nom` AS `nomRH`,`Coord3`.`prenom` AS `prenomRH`,`Coord3`.`fonction` AS `fonctionRH`,`Coord3`.`telephoneFixe` AS `telephoneFixeRH`,`Coord3`.`telephoneMobile` AS `telephoneMobileRH`,`Coord3`.`mail` AS `mailRH`,`Coord3`.`commentaires` AS `commentaireRH`,`vueAlternance2`.`dateRVPreparation` AS `dateRVPreparation`,`vueAlternance2`.`dateRVSimulation` AS `dateRVSimulation`,`vueAlternance2`.`dateDebutContrat` AS `dateDebutContrat`,`vueAlternance2`.`dateFinContrat` AS `dateFinContrat`,`vueAlternance2`.`dateRuptureContrat` AS `dateRuptureContrat`,`vueAlternance2`.`dateEnvoiFLAuCFA` AS `dateEnvoiFLAuCFA`,`vueAlternance2`.`docAAttacher` AS `docAAttacher` from (`vueAlternance2` left join `CoordonneesPersonne` `Coord3` on((`vueAlternance2`.`CoordonneesPersonne_RH` = `Coord3`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueConference`
--
DROP TABLE IF EXISTS `vueConference`;

CREATE VIEW `vueConference` AS select `Conference`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`Conference`.`typeConference` AS `typeConference`,`Conference`.`dateConference` AS `dateConference`,`Conference`.`heureDebut` AS `heureDebut`,`Conference`.`heureFin` AS `heureFin`,`Conference`.`lieuConference` AS `lieuConference`,`Conference`.`themeConference` AS `themeConference` from `Conference`;

-- --------------------------------------------------------

--
-- Structure for view `vueContact`
--
DROP TABLE IF EXISTS `vueContact`;

CREATE VIEW `vueContact` AS select `Entreprise`.`nomEntreprise` AS `nomEntreprise`,`CoordonneesPersonne`.`civilite` AS `civilite`,`CoordonneesPersonne`.`nom` AS `nom`,`CoordonneesPersonne`.`prenom` AS `prenom`,`CoordonneesPersonne`.`fonction` AS `fonction`,`CoordonneesPersonne`.`telephoneFixe` AS `telephoneFixe`,`CoordonneesPersonne`.`telephoneMobile` AS `telephoneMobile`,`CoordonneesPersonne`.`mail` AS `mail`,`CoordonneesPersonne`.`commentaires` AS `commentaires` from ((`Entreprise` join `a_Entreprise_CoordonneesPersonne` on((`a_Entreprise_CoordonneesPersonne`.`Entreprise_nomEntreprise` = `Entreprise`.`nomEntreprise`))) join `CoordonneesPersonne` on((`a_Entreprise_CoordonneesPersonne`.`CoordonneesPersonne_id` = `CoordonneesPersonne`.`idCoordonneesPersonne`)));

-- --------------------------------------------------------

--
-- Structure for view `vueEntreprise`
--
DROP TABLE IF EXISTS `vueEntreprise`;

CREATE VIEW `vueEntreprise` AS select `Entreprise`.`nomEntreprise` AS `nomEntreprise`,`Entreprise`.`groupe` AS `groupe`,`Entreprise`.`adresse` AS `adresse`,`Entreprise`.`complementAdresse` AS `complementAdresse`,`Entreprise`.`codePostal` AS `codePostal`,`Entreprise`.`ville` AS `ville`,`Entreprise`.`pays` AS `pays`,`Entreprise`.`typeContact` AS `typeContact`,`Entreprise`.`origine` AS `origine`,`Entreprise`.`numeroSIRET` AS `numeroSIRET`,`NAF`.`libelleNAF` AS `libelleNAF`,`Entreprise`.`partenariatOfficiel` AS `partenariatOfficiel`,`Entreprise`.`taille` AS `taille`,`Entreprise`.`alias` AS `alias`,`Entreprise`.`commentairesEntreprise` AS `commentairesEntreprise` from `Entreprise` LEFT join `NAF` on `Entreprise`.`NAF_codeNAF`=`NAF`.`codeNAF` AND `NAF`.`codeNAF`=`Entreprise`.`NAF_codeNAF`;

-- --------------------------------------------------------

--
-- Structure for view `vueForumSG`
--
DROP TABLE IF EXISTS `vueForumSG`;

CREATE VIEW `vueForumSG` AS select `ForumSG`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`ForumSG`.`anneeDeParticipation` AS `anneeDeParticipation`,`ForumSG`.`questionnaireDeSatisfaction` AS `questionnaireDeSatisfaction`,`ForumSG`.`commentairesForum` AS `commentairesForum` from `ForumSG`;

-- --------------------------------------------------------

--
-- Structure for view `vueTaxeApprentissage`
--
DROP TABLE IF EXISTS `vueTaxeApprentissage`;

CREATE VIEW `vueTaxeApprentissage` AS select `TaxeApprentissage`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,`TaxeApprentissage`.`anneeDeVersement` AS `anneeDeVersement`,`TaxeApprentissage`.`montantPromesseVersement` AS `montantPromesseVersement`,`TaxeApprentissage`.`montantVerse` AS `montantVerse`,`TaxeApprentissage`.`OCTA` AS `OCTA`,`TaxeApprentissage`.`dateEnregistrement` AS `dateEnregistrement`,`TaxeApprentissage`.`dateDerniereModification` AS `dateDerniereModification`,`TaxeApprentissage`.`modePaiement` AS `modePaiement`,`TaxeApprentissage`.`versementVia` AS `versementVia`,`TaxeApprentissage`.`dateTransmissionChequeAC` AS `dateTransmissionChequeAC`,`TaxeApprentissage`.`rapprochementAC` AS `rapprochementAC`,`TaxeApprentissage`.`commentairesTaxe` AS `commentairesTaxe` from `TaxeApprentissage`;

-- --------------------------------------------------------

--
-- Structure for view `Vue_Entreprise_Contact`
--
DROP TABLE IF EXISTS `Vue_Entreprise_Contact`;

CREATE VIEW `Vue_Entreprise_Contact` AS select `Entreprise`.`nomEntreprise` AS `nomEntreprise`,`Entreprise`.`groupe` AS `groupe`,`Entreprise`.`adresse` AS `adresse`,`Entreprise`.`complementAdresse` AS `complementAdresse`,`Entreprise`.`codePostal` AS `codePostal`,`Entreprise`.`ville` AS `ville`,`Entreprise`.`pays` AS `pays`,`Entreprise`.`typeContact` AS `typeContact`,`Entreprise`.`origine` AS `origine`,`Entreprise`.`numeroSIRET` AS `numeroSIRET`,`NAF`.`libelleNAF` AS `libelleNAF`,`Entreprise`.`partenariatOfficiel` AS `partenariatOfficiel`,`Entreprise`.`taille` AS `taille`,`Entreprise`.`alias` AS `alias`,`Entreprise`.`commentairesEntreprise` AS `commentairesEntreprise`,`CoordonneesPersonne`.`idCoordonneesPersonne` AS `idCoordonneesPersonne`,`CoordonneesPersonne`.`civilite` AS `civilite`,`CoordonneesPersonne`.`nom` AS `nom`,`CoordonneesPersonne`.`prenom` AS `prenom`,`CoordonneesPersonne`.`fonction` AS `fonction`,`CoordonneesPersonne`.`telephoneFixe` AS `telephoneFixe`,`CoordonneesPersonne`.`telephoneMobile` AS `telephoneMobile`,`CoordonneesPersonne`.`mail` AS `mail`,`CoordonneesPersonne`.`commentaires` AS `commentaires` from (((`Entreprise` LEFT join `NAF` on `Entreprise`.`NAF_codeNAF`=`NAF`.`codeNAF` AND `NAF`.`codeNAF`=`Entreprise`.`NAF_codeNAF`) join `CoordonneesPersonne`) join `a_Entreprise_CoordonneesPersonne` ) where ((`a_Entreprise_CoordonneesPersonne`.`CoordonneesPersonne_id` = `CoordonneesPersonne`.`idCoordonneesPersonne`) and (`a_Entreprise_CoordonneesPersonne`.`Entreprise_nomEntreprise` = `Entreprise`.`nomEntreprise`));

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

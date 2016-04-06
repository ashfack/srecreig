INSERT INTO `Entreprise` (`nomEntreprise`, `groupe`, `adresse`, `complementAdresse`, `codePostal`, `ville`, `pays`, `numeroSIRET`, `Naf_codeNAF`, `typeContact`, `partenariatOfficiel`, `taille`, `alias`, `commentairesEntreprise`) VALUES
('CGP SRE', 'groupe 3', '99 avenue jean baptiste clement', 'Universite paris 13', '93430', 'Villetaneuse', 'France', NULL, NULL, 'Entreprise', 'OUI', 'petite', NULL, 'Un commentaire pour l''entreprise cgp sre'),
('CGP SRE 2', 'groupe 3', '99 avenue jean baptiste clement', 'Universite paris 13', '93430', 'Villetaneuse', 'France', NULL, NULL, 'Entreprise', 'OUI', 'petite', NULL, 'Un commentaire pour l''entreprise cgp sre 2');

INSERT INTO `CoordonneesPersonne` (`idCoordonneesPersonne`, `civilite`, `nom`, `prenom`, `fonction`, `telephoneFixe`, `telephoneMobile`, `mail`, `commentaires`) VALUES
(1, 'Monsieur', 'Abdoul Azid', 'Ashfack', 'Chef de projet', '0000000000', '0000000000', 'abdoulazid.ashfack@gmail.com', 'Un petit commentaire pour ashfack'),
(2, 'Monsieur', 'Bouanaoui', 'Brahim', 'Developpeur', '0000000000', '0000000000', 'b.bouanaoui@gmail.com', 'Un petit commentaire pour brahim'),
(3, 'Monsieur', 'Dkhissi', 'Salah', 'Analyste fonctionnel', '0000000000', '0000000000', 'dkhssi.salah@gmail.com', 'Un petit commentaire pour salah'),
(4, 'Madame', 'Joundi', 'Sahar', 'Responsable BDD', '0000000000', '0000000000', 'joundi.sahar@gmail.com', 'Un petit commentaire pour sahar'),
(5, 'Monsieur', 'Kacel', 'Nacim', 'Developpeur', '0000000000', '0000000000', 'nacim.kacel@gmail.com', 'Un petit commentaire pour nacim'),
(6, 'Monsieur', 'Zgoda', 'Rafal', 'Developpeur et Responsable BDD', '0000000000', '0000000000', 'zgoda.rafal@gmail.com', 'Un petit commentaire pour rafal'),
(7, 'Monsieur', 'Boudjraf', 'Moustapha', 'Developpeur', '0000000000', '0000000000', 'boudjraf@gmail.com', 'Un petit commentaire pour moustapha l''alternant de CGP SRE'),
(8, 'Monsieur', 'Alaoui', 'zoubair', 'Developpeur', '0000000000', '0000000000', 'alaoui@gmail.com', 'Un petit commentaire pour moustapha l''alternant de CGP SRE'),
(9, 'Monsieur', 'Alternant', 'sonPrenom', 'Developpeur', '0000000000', '0000000000', 'alternant@gmail.com', 'Un petit commentaire pour l''alternant de CGP SRE 2');

INSERT INTO a_Entreprise_CoordonneesPersonne VALUES 
( 'CGP SRE', 1 , 'Primaire'),
( 'CGP SRE', 2 , 'Secondaire'),
( 'CGP SRE', 3 , 'TA'),
( 'CGP SRE 2', 4 , 'Primaire'),
( 'CGP SRE 2', 5 , 'Secondaire'),
( 'CGP SRE 2', 6, 'Secondaire'),
( 'CGP SRE', 7 , NULL),
( 'CGP SRE', 8 , NULL),
( 'CGP SRE 2', 9 , NULL);

INSERT INTO `Alternance`(`Entreprise_nomEntreprise`, `formationAlternance`, `anneeEntree`, `typeContrat`, `CoordonneesPersonne_alternant`, `CoordonneesPersonne_maitre`, `CoordonneesPersonne_RH`, `dateRVPreparation`, `dateRVSimulation`, `dateDebutContrat`, `dateFinContrat`, `dateRuptureContrat`, `dateEnvoiFLAuCFA`, `docAAttacher`, `commentaires`) VALUES 
('CGP SRE',"AIR",2014,"Apprentissage",7,1,2,"10/02/2016","10/05/2016","10/09/2016","10/08/2018",NULL,"15/06/2016",NULL,"Un ptit com"),
('CGP SRE',"AIR",2014,"Apprentissage",8,1,2,"10/02/2016","10/05/2016","10/09/2016","10/08/2018",NULL,"15/06/2016",NULL,"Un ptit com"),
('CGP SRE 2',"AIR",2014,"Apprentissage",9,4,5,"10/02/2016","10/05/2016","10/09/2016","10/08/2018",NULL,"15/06/2016",NULL,"Un ptit com");
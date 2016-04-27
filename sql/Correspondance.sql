CREATE TABLE IF NOT EXISTS CorrespondanceNom 
(
  nomSql VARCHAR(50),
  nomCorrespondant VARCHAR(70)
); 

ALTER TABLE CorrespondanceNom MODIFY COLUMN nomCorrespondant VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

INSERT INTO CorrespondanceNom (nomSql, nomCorrespondant) VALUES 
('nomEntreprise', 'Nom Entreprise') , 
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
('anneeEntree', 'Année d\'entrée'), 
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
('numeroSIRET', 'N° SIRET ') 
 ;

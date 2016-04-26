CREATE OR REPLACE VIEW vueContact
AS 
select `srecreig_base`.`entreprise`.`nomEntreprise`,`srecreig_base`.`coordonneespersonne`.`civilite` ,`srecreig_base`.`coordonneespersonne`.`nom`,`srecreig_base`.`coordonneespersonne`.`prenom`,`srecreig_base`.`coordonneespersonne`.`fonction` ,`srecreig_base`.`coordonneespersonne`.`telephoneFixe` ,`srecreig_base`.`coordonneespersonne`.`telephoneMobile` ,`srecreig_base`.`coordonneespersonne`.`mail` ,`srecreig_base`.`coordonneespersonne`.`commentaires`  from ((`srecreig_base`.`entreprise` join `srecreig_base`.`coordonneespersonne`) join `srecreig_base`.`a_entreprise_coordonneespersonne`) where ((`srecreig_base`.`a_entreprise_coordonneespersonne`.`CoordonneesPersonne_id` = `srecreig_base`.`coordonneespersonne`.`idCoordonneesPersonne`) and (`srecreig_base`.`a_entreprise_coordonneespersonne`.`Entreprise_nomEntreprise` = `srecreig_base`.`a_entreprise_coordonneespersonne`.`Entreprise_nomEntreprise`)); 


CREATE OR REPLACE VIEW vueEntreprise
AS 
select * from Entreprise ;


CREATE OR REPLACE VIEW vueAlternance
AS 
Select `srecreig_base`.`alternance`.`Entreprise_nomEntreprise` ,`srecreig_base`.`alternance`.`formationAlternance` ,`srecreig_base`.`alternance`.`anneeEntree` ,`srecreig_base`.`alternance`.`typeContrat` ,`srecreig_base`.`alternance`.`CoordonneesPersonne_alternant` ,`srecreig_base`.`alternance`.`CoordonneesPersonne_maitre` ,`srecreig_base`.`alternance`.`CoordonneesPersonne_RH` ,`srecreig_base`.`alternance`.`dateRVPreparation` ,`srecreig_base`.`alternance`.`dateRVSimulation` ,`srecreig_base`.`alternance`.`dateDebutContrat` ,`srecreig_base`.`alternance`.`dateFinContrat` ,`srecreig_base`.`alternance`.`dateRuptureContrat` ,`srecreig_base`.`alternance`.`dateEnvoiFLAuCFA` ,`srecreig_base`.`alternance`.`docAAttacher`  from `srecreig_base`.`alternance` ;

CREATE OR REPLACE VIEW vueTaxeApprentissage
AS 
select `srecreig_base`.`taxeapprentissage`.`Entreprise_nomEntreprise` ,`srecreig_base`.`taxeapprentissage`.`anneeDeVersement` ,`srecreig_base`.`taxeapprentissage`.`montantPromesseVersement` ,`srecreig_base`.`taxeapprentissage`.`montantVerse` ,`srecreig_base`.`taxeapprentissage`.`OCTA` ,`srecreig_base`.`taxeapprentissage`.`dateEnregistrement`,`srecreig_base`.`taxeapprentissage`.`dateDerniereModification`,`srecreig_base`.`taxeapprentissage`.`modePaiement` ,`srecreig_base`.`taxeapprentissage`.`versementVia` ,`srecreig_base`.`taxeapprentissage`.`dateTransmissionChequeAC`,`srecreig_base`.`taxeapprentissage`.`rapprochementAC` ,`srecreig_base`.`taxeapprentissage`.`commentairesTaxe`  from `srecreig_base`.`taxeapprentissage` ;

CREATE OR REPLACE VIEW vueAtelierRh
AS 
select `srecreig_base`.`atelierrh`.`Entreprise_nomEntreprise` ,`srecreig_base`.`atelierrh`.`dateAtelier`,`srecreig_base`.`atelierrh`.`creneauAtelier` from `srecreig_base`.`atelierrh`
;

CREATE OR REPLACE VIEW vueConference
AS 
select `srecreig_base`.`conference`.`Entreprise_nomEntreprise` ,`srecreig_base`.`conference`.`typeConference` ,`srecreig_base`.`conference`.`dateConference` ,`srecreig_base`.`conference`.`heureDebut` ,`srecreig_base`.`conference`.`heureFin` ,`srecreig_base`.`conference`.`lieuConference` ,`srecreig_base`.`conference`.`themeConference`  from `srecreig_base`.`conference`
;


CREATE OR REPLACE VIEW vueForumSG
AS 
select `srecreig_base`.`forumsg`.`Entreprise_nomEntreprise` ,`srecreig_base`.`forumsg`.`anneeDeParticipation` ,`srecreig_base`.`forumsg`.`questionnaireDeSatisfaction` ,`srecreig_base`.`forumsg`.`commentairesForum` from `srecreig_base`.`forumsg`
;

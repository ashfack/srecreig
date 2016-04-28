CREATE OR REPLACE VIEW vueContact
AS 
select `srecreig_base`.`Entreprise`.`nomEntreprise`,`srecreig_base`.`CoordonneesPersonne`.`civilite` ,
`srecreig_base`.`CoordonneesPersonne`.`nom`,`srecreig_base`.`CoordonneesPersonne`.`prenom`,
`srecreig_base`.`CoordonneesPersonne`.`fonction` ,`srecreig_base`.`CoordonneesPersonne`.`telephoneFixe` ,
`srecreig_base`.`CoordonneesPersonne`.`telephoneMobile` ,`srecreig_base`.`CoordonneesPersonne`.`mail` ,
`srecreig_base`.`CoordonneesPersonne`.`commentaires`  
from ( 
	(`srecreig_base`.`Entreprise`) inner join (`srecreig_base`.`a_Entreprise_CoordonneesPersonne`) 
	on (`srecreig_base`.`a_Entreprise_CoordonneesPersonne`.`Entreprise_nomEntreprise` = `srecreig_base`.`Entreprise`.`nomEntreprise`)
	)  
	inner join  (`srecreig_base`.`CoordonneesPersonne`) on  
	((`srecreig_base`.`a_Entreprise_CoordonneesPersonne`.`CoordonneesPersonne_id` = 
	`srecreig_base`.`CoordonneesPersonne`.`idCoordonneesPersonne`)); 


CREATE OR REPLACE VIEW vueEntreprise
AS 
select * from Entreprise ;


CREATE OR REPLACE VIEW vueAlternance
AS 
Select `srecreig_base`.`Alternance`.`Entreprise_nomEntreprise` ,
`srecreig_base`.`Alternance`.`formationAlternance` ,`srecreig_base`.`Alternance`.`anneeEntree` ,
`srecreig_base`.`Alternance`.`typeContrat` ,`srecreig_base`.`Alternance`.`CoordonneesPersonne_alternant` ,
`srecreig_base`.`Alternance`.`CoordonneesPersonne_maitre` ,`srecreig_base`.`Alternance`.`CoordonneesPersonne_RH` ,
`srecreig_base`.`Alternance`.`dateRVPreparation` ,`srecreig_base`.`Alternance`.`dateRVSimulation` ,
`srecreig_base`.`Alternance`.`dateDebutContrat` ,`srecreig_base`.`Alternance`.`dateFinContrat` ,
`srecreig_base`.`Alternance`.`dateRuptureContrat` ,`srecreig_base`.`Alternance`.`dateEnvoiFLAuCFA` ,
`srecreig_base`.`Alternance`.`docAAttacher`  from `srecreig_base`.`Alternance` ;

CREATE OR REPLACE VIEW vueTaxeApprentissage
AS 
select `srecreig_base`.`TaxeApprentissage`.`Entreprise_nomEntreprise` ,`srecreig_base`.`TaxeApprentissage`.`anneeDeVersement` ,
`srecreig_base`.`TaxeApprentissage`.`montantPromesseVersement` ,`srecreig_base`.`TaxeApprentissage`.`montantVerse` ,
`srecreig_base`.`TaxeApprentissage`.`OCTA` ,`srecreig_base`.`TaxeApprentissage`.`dateEnregistrement`,
`srecreig_base`.`TaxeApprentissage`.`dateDerniereModification`,`srecreig_base`.`TaxeApprentissage`.`modePaiement` ,
`srecreig_base`.`TaxeApprentissage`.`versementVia` ,`srecreig_base`.`TaxeApprentissage`.`dateTransmissionChequeAC`,
`srecreig_base`.`TaxeApprentissage`.`rapprochementAC` ,`srecreig_base`.`TaxeApprentissage`.`commentairesTaxe`  
from `srecreig_base`.`TaxeApprentissage` ;

CREATE OR REPLACE VIEW vueAtelierRh
AS 
select * from AtelierRH ; 
;

CREATE OR REPLACE VIEW vueConference
AS 
select `srecreig_base`.`Conference`.`Entreprise_nomEntreprise` ,`srecreig_base`.`Conference`.`typeConference` ,
`srecreig_base`.`Conference`.`dateConference` ,`srecreig_base`.`Conference`.`heureDebut` ,
`srecreig_base`.`Conference`.`heureFin` ,`srecreig_base`.`Conference`.`lieuConference` ,
`srecreig_base`.`Conference`.`themeConference`  from `srecreig_base`.`Conference`
;


CREATE OR REPLACE VIEW vueForumSG
AS 
select `srecreig_base`.`ForumSG`.`Entreprise_nomEntreprise` ,`srecreig_base`.`ForumSG`.`anneeDeParticipation` ,
`srecreig_base`.`ForumSG`.`questionnaireDeSatisfaction` ,`srecreig_base`.`ForumSG`.`commentairesForum` 
from `srecreig_base`.`ForumSG`
;

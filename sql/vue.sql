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



CREATE OR REPLACE VIEW vueAlternance1
AS 
Select `srecreig_base`.`Alternance`.`Entreprise_nomEntreprise` ,
`srecreig_base`.`Alternance`.`formationAlternance` ,`srecreig_base`.`Alternance`.`anneeEntree` ,
`srecreig_base`.`Alternance`.`typeContrat` , Coord1.civilite AS civiliteAlternant , Coord1.nom AS nomAlternant ,Coord1.prenom AS prenomAlternant ,Coord1.fonction AS fonctionAlternant ,Coord1.telephoneFixe AS telephoneFixeAlternant ,Coord1.telephoneMobile AS telephoneMobileAlternant ,Coord1.mail AS mailAlternant ,Coord1.commentaires AS commentaireAlternant , `srecreig_base`.`Alternance`.`CoordonneesPersonne_maitre`,`srecreig_base`.`Alternance`.`CoordonneesPersonne_RH` ,
`srecreig_base`.`Alternance`.`dateRVPreparation` ,`srecreig_base`.`Alternance`.`dateRVSimulation` ,
`srecreig_base`.`Alternance`.`dateDebutContrat` ,`srecreig_base`.`Alternance`.`dateFinContrat` ,
`srecreig_base`.`Alternance`.`dateRuptureContrat` ,`srecreig_base`.`Alternance`.`dateEnvoiFLAuCFA` ,
`srecreig_base`.`Alternance`.`docAAttacher`
	from  `srecreig_base`.`Alternance`
	inner join `srecreig_base`.`CoordonneesPersonne` AS Coord1 on ( `srecreig_base`.`Alternance`.`CoordonneesPersonne_alternant` = Coord1.`idCoordonneesPersonne`)
;




CREATE OR REPLACE VIEW vueAlternance2
AS 
Select `srecreig_base`.`vueAlternance1`.`Entreprise_nomEntreprise` ,
`srecreig_base`.`vueAlternance1`.`formationAlternance` ,`srecreig_base`.`vueAlternance1`.`anneeEntree` ,
`srecreig_base`.`vueAlternance1`.`typeContrat` , `srecreig_base`.`vueAlternance1`.civiliteAlternant , `srecreig_base`.`vueAlternance1`.nomAlternant ,  `srecreig_base`.`vueAlternance1`.prenomAlternant , `srecreig_base`.`vueAlternance1`.fonctionAlternant , `srecreig_base`.`vueAlternance1`.telephoneFixeAlternant , `srecreig_base`.`vueAlternance1`.telephoneMobileAlternant , `srecreig_base`.`vueAlternance1`.mailAlternant , `srecreig_base`.`vueAlternance1`.commentaireAlternant , 
Coord2.civilite AS civiliteMaitre , Coord2.nom AS nomMaitre ,Coord2.prenom AS prenomMaitre ,Coord2.fonction AS fonctionMaitre ,Coord2.telephoneFixe AS telephoneFixeMaitre ,Coord2.telephoneMobile AS telephoneMobileMaitre ,Coord2.mail AS mailMaitre ,Coord2.commentaires AS commentaireMaitre , `srecreig_base`.`vueAlternance1`.`CoordonneesPersonne_maitre`,`srecreig_base`.`vueAlternance1`.`CoordonneesPersonne_RH` ,
`srecreig_base`.`vueAlternance1`.`dateRVPreparation` ,`srecreig_base`.`vueAlternance1`.`dateRVSimulation` ,
`srecreig_base`.`vueAlternance1`.`dateDebutContrat` ,`srecreig_base`.`vueAlternance1`.`dateFinContrat` ,
`srecreig_base`.`vueAlternance1`.`dateRuptureContrat` ,`srecreig_base`.`vueAlternance1`.`dateEnvoiFLAuCFA` ,
`srecreig_base`.`vueAlternance1`.`docAAttacher`
	from  `srecreig_base`.`vueAlternance1`
	left join `srecreig_base`.`CoordonneesPersonne` AS Coord2 on ( `srecreig_base`.`vueAlternance1`.`CoordonneesPersonne_maitre` = Coord2.`idCoordonneesPersonne`)
;




/*
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


Select `srecreig_base`.`Alternance`.`Entreprise_nomEntreprise` ,
`srecreig_base`.`Alternance`.`formationAlternance` ,`srecreig_base`.`Alternance`.`anneeEntree` ,
`srecreig_base`.`Alternance`.`typeContrat` , Coord1.nom , `srecreig_base`.`Alternance`.`CoordonneesPersonne_maitre`,`srecreig_base`.`Alternance`.`CoordonneesPersonne_RH` ,
`srecreig_base`.`Alternance`.`dateRVPreparation` ,`srecreig_base`.`Alternance`.`dateRVSimulation` ,
`srecreig_base`.`Alternance`.`dateDebutContrat` ,`srecreig_base`.`Alternance`.`dateFinContrat` ,
`srecreig_base`.`Alternance`.`dateRuptureContrat` ,`srecreig_base`.`Alternance`.`dateEnvoiFLAuCFA` ,
`srecreig_base`.`Alternance`.`docAAttacher`
	from  `srecreig_base`.`Alternance`
	inner join `srecreig_base`.`CoordonneesPersonne` AS Coord1 on ( `srecreig_base`.`Alternance`.`CoordonneesPersonne_alternant` = Coord1.`idCoordonneesPersonne`)

Select Alternance1.Entreprise_nomEntreprise,  Coord1.nom , Coord2.nom , Alternance1.dateRVPreparation from 
	Alternance AS Alternance1
    inner join CoordonneesPersonne AS Coord1
	on (Alternance1.`CoordonneesPersonne_alternant` = Coord1.`idCoordonneesPersonne`)
	inner join CoordonneesPersonne AS Coord2
	on (Alternance1.`CoordonneesPersonne_alternant` = Coord2.`idCoordonneesPersonne`)
       
;

Select `srecreig_base`.`Alternance`.`Entreprise_nomEntreprise` ,
`srecreig_base`.`Alternance`.`formationAlternance` ,`srecreig_base`.`Alternance`.`anneeEntree` ,
`srecreig_base`.`Alternance`.`typeContrat` ,  Coord1.nom , Coord2.nom ,  `srecreig_base`.`Alternance`.dateRVPreparation ,`srecreig_base`.`Alternance`.`dateRVSimulation` ,
`srecreig_base`.`Alternance`.`dateDebutContrat` ,`srecreig_base`.`Alternance`.`dateFinContrat` ,
`srecreig_base`.`Alternance`.`dateRuptureContrat` ,`srecreig_base`.`Alternance`.`dateEnvoiFLAuCFA` ,
`srecreig_base`.`Alternance`.`docAAttacher` from 
	`srecreig_base`.`Alternance` 
    inner join `srecreig_base`.`CoordonneesPersonne` AS Coord1
	on (`srecreig_base`.`Alternance`.`CoordonneesPersonne_alternant` = Coord1.`idCoordonneesPersonne`)
	inner join `srecreig_base`.`CoordonneesPersonne` AS Coord2
	on ( `srecreig_base`.`Alternance`.`CoordonneesPersonne_RH` = Coord2.`idCoordonneesPersonne`)
       
;

*/


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
select `AtelierRH`.`Entreprise_nomEntreprise` AS `Entreprise_nomEntreprise`,
`AtelierRH`.`dateAtelier` AS `dateAtelier`,`AtelierRH`.`creneauAtelier` AS `creneauAtelier` 
from `AtelierRH`
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

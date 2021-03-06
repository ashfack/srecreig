<?php
    require("security.php"); 
    require'../db_connect.php';
    
    if(isset($_POST['nomEntreprise']) && isset($_POST['idSelected']) && isset($_POST['table'])  && isset($_POST['niveau']) && isset($_POST['donnees'])  )
    {
        if($_POST['nomEntreprise']!="" && $_POST['idSelected']!="" && $_POST['table']!="" && $_POST['niveau']!="" && $_POST['donnees']!="")
        {
            $nomEntreprise=$_POST['nomEntreprise'];
            $idSelected=$_POST['idSelected'];
			$idSelected2=$_POST['idSelected2'];
            $table=$_POST['table'];
			$idCoordRH=$_POST['idCoordRH'];
			$idCoordRH2=$_POST['idCoordRH2'];

            $donnees=$_POST['donnees'];
            $niveau=$_POST['niveau'];
      		//print_r($donnees);

           $tabCorrespondanceColonnes=array("EntrepriseNiveau1"=>array("groupe","adresse","complementAdresse","codePostal","ville","pays","commentairesEntreprise","nomEntreprise"),
												"EntrepriseNiveau2"=>array("numeroSIRET","NAF_codeNAF","origine","typeContact","partenariatOfficiel","taille","alias"),
                                                "CoordonneesPersonneNiveau1"=>array("civilite","nom","prenom","fonction","telephoneFixe","telephoneMobile","mail","commentaires","type"),
                                                "AlternanceNiveau1"=>array("formationAlternance","anneeEntree","typeContrat","civilite","nom","prenom","telephoneFixe","telephoneMobile","mail","commentaires"),
												"AlternanceNiveau2"=>array("dateRVPreparation","dateRVSimulation","dateDebutContrat","dateFinContrat","dateEnvoiFLAuCFA","docAAttacher"),
												"AlternanceNiveau3"=>array("civilite","nom","prenom","fonction","telephoneFixe","telephoneMobile","mail","commentaires"),
												"AlternanceNiveau4"=>array("civilite","nom","prenom","fonction","telephoneFixe","telephoneMobile","mail","commentaires"),
                                                "TaxeApprentissageNiveau1"=>array("anneeDeVersement","montantPromesseVersement","montantVerse","versementVia","rapprochementAC","OCTA","modePaiement","dateTransmissionChequeAC","commentairesTaxe"),
												"TaxeApprentissageNiveau3"=>array("dateEnregistrement", "OCTA","dateDerniereModification","modePaiement","dateTransmissionChequeAC","commentairesTaxe"),
                                                "AtelierRHNiveau1"=>array("dateAtelier","heureDebut","heureFin","commentairesAtelier"),
                                                "AtelierRHNiveau2"=>array("civilite","nom","prenom","fonction","telephoneFixe","telephoneMobile","mail","commentaires"),
                                                "ConferenceNiveau1"=>array("dateConference","typeConference","heureDebut","heureFin","lieuConference","themeConference","commentairesConference"),
                                                "ConferenceNiveau2"=>array("civilite","nom","prenom","fonction","telephoneFixe","telephoneMobile","mail","commentaires"),
                                                "ForumSGNiveau1"=>array("anneeDeParticipation","questionnaireDeSatisfaction","commentairesForum")
                                                );

            $sql;
            $rep;
            $deuxColonnes=false;
			$cle=$table."Niveau".$niveau;
            if($table=="Entreprise" && $niveau==1)
            {
				$sql ="UPDATE Entreprise  SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7
										where nomEntreprise = :nomEntreprise";						
				$rep=$conn->prepare($sql);
				/*$rep->bindValue(':donnee1',trim($donnees[1]),PDO::PARAM_STR);*/
                $deuxColonnes=true;
				//print_r($tabCorrespondanceColonnes[$cle][5]);
				//print_r(trim($donnees[6]));
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':donnee1'=>trim($donnees[0]),
										':donnee2'=>trim($donnees[1]),
										':donnee3'=>trim($donnees[2]),
										':donnee4'=>trim($donnees[3]),
										':donnee5'=>trim($donnees[4]),
										':donnee6'=>trim($donnees[5]),
										':donnee7'=>trim($donnees[6]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
            }
            elseif($table=="Entreprise" && $niveau==2)
            {
            	if($donnees[1]=="NULL")
            		$donnees[1]=null;
			    
			    $sql ="UPDATE Entreprise SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7
										where nomEntreprise = :nomEntreprise "; 
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;

				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':donnee1'=>trim($donnees[0]),
										':donnee2'=>$donnees[1],
										':donnee3'=>trim($donnees[2]),
										':donnee4'=>trim($donnees[3]),
										':donnee5'=>trim($donnees[4]),
										':donnee6'=>trim($donnees[5]),
										':donnee7'=>trim($donnees[6]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="CoordonneesPersonne")
            {
				$sql ="UPDATE CoordonneesPersonne SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7,
										".$tabCorrespondanceColonnes[$cle][7]." = :donnee8
										where idCoordonneesPersonne = :idSelected ; 
						UPDATE a_Entreprise_CoordonneesPersonne SET ".$tabCorrespondanceColonnes[$cle][8]." = :donnee9
						where CoordonneesPersonne_id = :idSelected and Entreprise_nomEntreprise = :nomEntreprise ;  ";
						 //and codeNAF=:donnee2			PROBLEME		


										/*	.$tabCorrespondanceColonnes[$cle][8]." = :donnee9	,
										':donnee9'=>trim($donnees[9])
										type 
										*/
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				//print_r($tabCorrespondanceColonnes[$cle][5]);
				//print_r(trim($donnees[6]));
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':idSelected'=>$idSelected, ':nomEntreprise'=>$nomEntreprise, 
										':donnee1'=>trim($donnees[0]),
										':donnee2'=>trim($donnees[1]),
										':donnee3'=>trim($donnees[2]),
										':donnee4'=>trim($donnees[3]),
										':donnee5'=>trim($donnees[4]),
										':donnee6'=>trim($donnees[5]),
										':donnee7'=>trim($donnees[6]),
										':donnee8'=>trim($donnees[7]),
										':donnee9'=>trim($donnees[8]))))
				{
					echo "ok";

				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="Alternance" && $niveau==1)
            {
				$sql ="UPDATE Alternance join CoordonneesPersonne on CoordonneesPersonne_alternant=idCoordonneesPersonne SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7,
										".$tabCorrespondanceColonnes[$cle][7]." = :donnee8,
										".$tabCorrespondanceColonnes[$cle][8]." = :donnee9,
										".$tabCorrespondanceColonnes[$cle][9]." = :donnee10
										where Entreprise_nomEntreprise= :nomEntreprise and CoordonneesPersonne_alternant=:idSelected "; //OK			
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idSelected'=>$idSelected,
										':donnee1'=>trim($donnees[0]),
										':donnee2'=>trim($donnees[1]),
										':donnee3'=>trim($donnees[2]),
										':donnee4'=>trim($donnees[3]),
										':donnee5'=>trim($donnees[4]),
										':donnee6'=>trim($donnees[5]),
										':donnee7'=>trim($donnees[6]),
										':donnee8'=>trim($donnees[7]),
										':donnee9'=>trim($donnees[8]),
										':donnee10'=>trim($donnees[9]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="Alternance" && $niveau==2)
            {				
				$sql ="UPDATE Alternance SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6
										where Entreprise_nomEntreprise= :nomEntreprise and CoordonneesPersonne_alternant= :idSelected "; //and codeNAF=:donnee2			PROBLEME			
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idSelected'=>$idSelected,
										':donnee1'=>trim($donnees[1]), //donnees[0] contient l'id de l'alternant
										':donnee2'=>trim($donnees[2]),
										':donnee3'=>trim($donnees[3]),
										':donnee4'=>trim($donnees[4]),
										':donnee5'=>trim($donnees[5]),
										':donnee6'=>trim($donnees[6]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="Alternance" && ($niveau==3 || $niveau==4)) 
            {
				
				$sql ="UPDATE Alternance, CoordonneesPersonne Coord_alternant, CoordonneesPersonne Coord_RH  SET 
										Coord_RH.".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										Coord_RH.".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										Coord_RH.".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										Coord_RH.".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										Coord_RH.".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										Coord_RH.".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										Coord_RH.".$tabCorrespondanceColonnes[$cle][6]." = :donnee7,
										Coord_RH.".$tabCorrespondanceColonnes[$cle][7]." = :donnee8
										where Entreprise_nomEntreprise= :nomEntreprise and Coord_alternant.idCoordonneesPersonne= :idSelected2 and Coord_RH.idCoordonneesPersonne= :idCoordRH2 ";
				//print_r($nomEntreprise);
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idSelected2'=>$idSelected2,
										':idCoordRH2'=>$idCoordRH2,
										':donnee1'=>trim($donnees[1]),  //donnees[0] contient l'id de l'alternant
										':donnee2'=>trim($donnees[2]),
										':donnee3'=>trim($donnees[3]),
										':donnee4'=>trim($donnees[4]),
										':donnee5'=>trim($donnees[5]),
										':donnee6'=>trim($donnees[6]),
										':donnee7'=>trim($donnees[7]),
										':donnee8'=>trim($donnees[8]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="TaxeApprentissage" && $niveau==1) 
            {

            	$objFormations;
				$toutOK=true;
          		$tabIdCF=array();

				for($i=9;$i<count($donnees);$i++)
				{
					$objFormations=$donnees[$i];

					$cycle=trim($objFormations['cycle']);
					$mention=trim($objFormations['mention']);
					$specialite=trim($objFormations['specialite']);
					$categorie=trim($objFormations['categorie']);
					
					if($cycle=="cycle" || $categorie=="Categorie")
					{
						$toutOK=false;
						break;
					}
					$sql="SELECT idCycleFormation as id FROM CycleFormation WHERE cycle=:cycle ";
					
					if($mention!="Aucune" && $mention!="mention")
						$sql.="and mention=:mention ";
					if($specialite!="Aucune" && $specialite!="specialite")
						$sql.="and specialite=:specialite";
						
					
					$rep = $conn->prepare($sql);
					$rep->bindValue(':cycle',$cycle,PDO::PARAM_STR);
					
					if($mention!="Aucune" && $mention!="mention")
						$rep->bindValue(':mention',$mention,PDO::PARAM_STR);
					
					if($specialite!="Aucune" && $specialite!="specialite")
						$rep->bindValue(':specialite',$specialite,PDO::PARAM_STR);
					$rep->execute();
					if($res = $rep->fetch())
					{
						$idCF=intval($res['id']);
						$tabIdCF[$i]=$idCF;
					}
					else
					{
						$toutOK=false;
						break;
					}
						
				}

          		if($toutOK)
				{
					$sql ="UPDATE TaxeApprentissage SET 
											".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
											".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
											".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
											".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
											".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
											".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
											".$tabCorrespondanceColonnes[$cle][6]." = :donnee7,
											".$tabCorrespondanceColonnes[$cle][7]." = :donnee8,
											".$tabCorrespondanceColonnes[$cle][8]." = :donnee9
											where Entreprise_nomEntreprise= :nomEntreprise and idTA =:idSelected; ".
											"DELETE FROM a_TaxeApprentissage_CycleFormation where TaxeApprentissage_id =:idSelected"; 
					$rep=$conn->prepare($sql);
					if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
											':idSelected'=>$idSelected,
											':donnee1'=>trim($donnees[0]),
											':donnee2'=>trim($donnees[1]),
											':donnee3'=>trim($donnees[2]),
											':donnee4'=>trim($donnees[3]),
											':donnee5'=>trim($donnees[4]),
											':donnee6'=>trim($donnees[5]),
											':donnee7'=>trim($donnees[6]),
											':donnee8'=>trim($donnees[7]),
											':donnee9'=>trim($donnees[8]))))
					{
						for($i=9;$i<count($donnees);$i++)
						{
						
							$objFormations=$donnees[$i];
							
							$sql="INSERT INTO a_TaxeApprentissage_CycleFormation VALUES(:idTA, :idCF, :categorie, :montant)";
							
							$rep=$conn->prepare($sql);

							$rep->bindValue(':idTA',$idSelected,PDO::PARAM_INT);
							$rep->bindValue(':idCF',$tabIdCF[$i],PDO::PARAM_INT);
							$rep->bindValue(':categorie',trim($objFormations['categorie']),PDO::PARAM_STR);
							$rep->bindValue(':montant',trim($objFormations['montant']),PDO::PARAM_INT);

							$rep->execute();
						}
						echo "ok";
					}
					else
					{
						echo "<p> Une erreur s'est produite ! </p>";
					}
				}
				else
					echo "<p> L'une des combinaisons cycle,mention,specialite est incorrecte </p>";

           
            }
			
			/*elseif($table=="TaxeApprentissage" && $niveau==2) 
            {
				$sql ="UPDATE TaxeApprentissage, a_TaxeApprentissage_CycleFormation, CycleFormation SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7
										where Entreprise_nomEntreprise= :nomEntreprise and TaxeApprentissage_id=:idSelected"; 
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idSelected'=>$idSelected,
										':donnee1'=>trim($donnees[1]),
										':donnee2'=>trim($donnees[2]),
										':donnee3'=>trim($donnees[4]),
										':donnee4'=>trim($donnees[5]),
										':donnee5'=>trim($donnees[6]),
										':donnee6'=>trim($donnees[7]),
										':donnee7'=>trim($donnees[8])
										)))
				{
					echo "ok";
				}
				else
				{
					echo "erreur edition";
				}
           
            }*/
			
			elseif($table=="TaxeApprentissage" && $niveau==3) 
            {
				$sql ="UPDATE TaxeApprentissage SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6
										where Entreprise_nomEntreprise= :nomEntreprise and idTA =:idSelected"; 
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idSelected'=>$idSelected,
										':donnee1'=>trim($donnees[1]), //donnees[0] contient l'id de la taxe
										':donnee2'=>trim($donnees[2]),
										':donnee3'=>trim($donnees[3]),
										':donnee4'=>trim($donnees[4]),
										':donnee5'=>trim($donnees[5]),
										':donnee6'=>trim($donnees[6])
										)))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
       
            elseif($table=="AtelierRH" && $niveau==1) 
            {
				$sql ="UPDATE AtelierRH SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4
										where Entreprise_nomEntreprise= :nomEntreprise and idAtelierRH=:idSelected"; 
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idSelected'=>$idSelected,
										':donnee1'=>trim($donnees[0]),
										':donnee2'=>trim($donnees[1]),
										':donnee3'=>trim($donnees[2]),
										':donnee4'=>trim($donnees[3]),
										)))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="AtelierRH" && $niveau==2) 
            {
				$sql ="UPDATE AtelierRH join a_AtelierRH_CoordonneesPersonne on idAtelierRH=AtelierRH_id join CoordonneesPersonne on CoordonneesPersonne_id=idCoordonneesPersonne SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7,
										".$tabCorrespondanceColonnes[$cle][7]." = :donnee8
										where Entreprise_nomEntreprise= :nomEntreprise and CoordonneesPersonne_id=:idCoordRH"; 			
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idCoordRH'=>$idCoordRH,
										':donnee1'=>trim($donnees[1]),
										':donnee2'=>trim($donnees[2]),
										':donnee3'=>trim($donnees[3]),
										':donnee4'=>trim($donnees[4]),
										':donnee5'=>trim($donnees[5]),
										':donnee6'=>trim($donnees[6]),
										':donnee7'=>trim($donnees[7]),
										':donnee8'=>trim($donnees[8]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="Conference" && $niveau==1)
            {
				$sql ="UPDATE Conference SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7
										where Entreprise_nomEntreprise= :nomEntreprise and idConference=:idSelected"; 	
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idSelected'=>$idSelected,
										':donnee1'=>trim($donnees[0]),
										':donnee2'=>trim($donnees[1]),
										':donnee3'=>trim($donnees[2]),
										':donnee4'=>trim($donnees[3]),
										':donnee5'=>trim($donnees[4]),
										':donnee6'=>trim($donnees[5]),
										':donnee7'=>trim($donnees[6]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="Conference" && $niveau==2) 
            {
				$sql ="UPDATE Conference, CoordonneesPersonne SET 
										".$tabCorrespondanceColonnes[$cle][0]." = :donnee1,
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3,
										".$tabCorrespondanceColonnes[$cle][3]." = :donnee4,
										".$tabCorrespondanceColonnes[$cle][4]." = :donnee5,
										".$tabCorrespondanceColonnes[$cle][5]." = :donnee6,
										".$tabCorrespondanceColonnes[$cle][6]." = :donnee7,
										".$tabCorrespondanceColonnes[$cle][7]." = :donnee8
										where Entreprise_nomEntreprise= :nomEntreprise and idCoordonneesPersonne=:idCoordRH "; 	
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':idCoordRH'=>$idCoordRH,
										':donnee1'=>trim($donnees[1]),
										':donnee2'=>trim($donnees[2]),
										':donnee3'=>trim($donnees[3]),
										':donnee4'=>trim($donnees[4]),
										':donnee5'=>trim($donnees[5]),
										':donnee6'=>trim($donnees[6]),
										':donnee7'=>trim($donnees[7]),
										':donnee8'=>trim($donnees[8]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }
			
			elseif($table=="ForumSG")
            {
				$sql ="UPDATE ForumSG SET 
										".$tabCorrespondanceColonnes[$cle][1]." = :donnee2,
										".$tabCorrespondanceColonnes[$cle][2]." = :donnee3
										where Entreprise_nomEntreprise= :nomEntreprise and anneeDeParticipation=:donnee1"; // ANNEE A NE PAS MODIFIER ET ENLEVER DU FORM
				$rep=$conn->prepare($sql);
                $deuxColonnes=true;
				$rep=$conn->prepare($sql);
				if($rep->execute(array(':nomEntreprise'=>$nomEntreprise,
										':donnee1'=>trim($donnees[0]),
										':donnee2'=>trim($donnees[1]),
										':donnee3'=>trim($donnees[2]))))
				{
					echo "ok";
				}
				else
				{
					echo "<p> Une erreur s'est produite ! </p>";
				}
           
            }

		}
        else
            echo "<p> Une erreur s'est produite ! </p>";
    }
    else
        echo "<p> Une erreur s'est produite ! </p>";

        
        
?>
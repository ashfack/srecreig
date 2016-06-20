<?php
    require("security.php"); 
    require'../db_connect.php';


    function personneDansBase($nom,$prenom)
    {
	        $rep = $GLOBALS['conn']->prepare("SELECT idCoordonneesPersonne,nom, prenom,fonction FROM CoordonneesPersonne where (nom LIKE ?) and (prenom LIKE ?)");
	        $rep->execute(array($nom,$prenom));
	        
	        if($rep->fetch())
	     		return true;
	        else
	        	return false;
    }

    function verifPersonne($nom,$prenom)
    {
		if($nom=="" || $prenom=="")
    	{
    		echo "<p> Le nom et le prénom ne sont pas renseignés ! </p>";
    		return false;
    	}
    	else if(personneDansBase($nom, $prenom))
    	{
    		echo "<p> La personne que vous essayez d'ajouter existe déjà dans la base ! </p>";
    		return false;
    	}
    	else
    		return true;
    }
    
    if(isset($_POST['nomEntreprise']) && isset($_POST['table'])  && isset($_POST['niveau']) && isset($_POST['donnees'])  )
    {
        if($_POST['nomEntreprise']!="" && $_POST['table']!="" && $_POST['niveau']!="" && $_POST['donnees']!="")
        {
            $nomEntreprise=trim($_POST['nomEntreprise']);
           
            $table=$_POST['table'];

            $donnees=$_POST['donnees'];
            $niveau=$_POST['niveau'];
            //echo "<p> $nomEntreprise $table $niveau </p>";
           	//print_r($donnees);
      

            $tabCorrespondanceColonnes=array( "AtelierRHNiveau1"=>array("Entreprise_nomEntreprise","dateAtelier","heureDebut","heureFin","commentairesAtelier"),
                                                "ConferenceNiveau1"=>array("Entreprise_nomEntreprise","dateConference","typeConference","heureDebut","heureFin","lieuConference","themeConference","commentairesConference"),
                                                "ForumSGNiveau1"=>array("Entreprise_nomEntreprise","anneeDeParticipation","questionnaireDeSatisfaction","commentairesForum")
                                                );

            //association entre la position des champs "nom" et "prenom"; et la table !
			$tabPositionNomPersonne=array("CoordonneesPersonneNiveau1"=>1,"AlternanceNiveau1"=>4, "AlternanceNiveau3"=>2, "AlternanceNiveau4"=>2, "AtelierRHNiveau2"=>2, "ConferenceNiveau2"=>2);


            $sql;
            $rep;
        
			$cle=$table."Niveau".$niveau;

			if($cle=="CoordonneesPersonneNiveau1" || $cle=="AtelierRHNiveau2" || $cle=="ConferenceNiveau2")
            {
            	$pos=$tabPositionNomPersonne[$cle];
            
            	if(verifPersonne($donnees[$pos], $donnees[$pos+1]))
            	{
            		$sql ="INSERT INTO CoordonneesPersonne(civilite,nom,prenom,fonction,telephoneFixe,telephoneMobile,mail,commentaires) VALUES ( :civilite, :nom, :prenom,:fonction, :telephoneFixe, :telephoneMobile, :mail, :commentaires ); ";
					$sql.="SET @id = LAST_INSERT_ID(); ";
					if($table=="CoordonneesPersonne")
					{
						$compt=0;
						$sql.="INSERT INTO a_Entreprise_CoordonneesPersonne VALUES(:nomEntreprise,@id,:type);";
						
					}
					else
					{
						$compt=1;
						$sql.="INSERT INTO a_".$table."_CoordonneesPersonne VALUES(:id,@id);";
					}
						
						
					$rep=$conn->prepare($sql);


					$rep->bindValue(':civilite',trim($donnees[$compt++]),PDO::PARAM_STR);
					$rep->bindValue(':nom',trim($donnees[$compt++]),PDO::PARAM_STR);
					$rep->bindValue(':prenom',trim($donnees[$compt++]),PDO::PARAM_STR);
					$rep->bindValue(':fonction',trim($donnees[$compt++]),PDO::PARAM_STR);
					$rep->bindValue(':telephoneFixe',trim($donnees[$compt++]),PDO::PARAM_STR);
					$rep->bindValue(':telephoneMobile',trim($donnees[$compt++]),PDO::PARAM_STR);
					$rep->bindValue(':mail',trim($donnees[$compt++]),PDO::PARAM_STR);
					$rep->bindValue(':commentaires',trim($donnees[$compt++]),PDO::PARAM_STR);

					if($table=="CoordonneesPersonne")
					{
						$rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
						$rep->bindValue(':type',trim($donnees[$compt]),PDO::PARAM_STR);

					}
					else
					{
						$rep->bindValue(':id',trim($donnees[0]),PDO::PARAM_INT);
					}


					if($rep->execute())
					{
						echo "ok";

					}
					else
					{
						echo "<p> Une erreur s'est produite ! </p>";
					}
            	}
				
           
            }
			
			elseif($table=="Alternance" && $niveau==1)
            {
				$pos=$tabPositionNomPersonne[$cle];

				if(verifPersonne($donnees[$pos], $donnees[$pos+1]))
            	{
            		$sql ="INSERT INTO CoordonneesPersonne(civilite,nom,prenom,fonction,telephoneFixe,telephoneMobile,mail,commentaires) VALUES ( :civilite, :nom, :prenom,:fonction, :telephoneMobile, :telephoneMobile, :mail, :commentaires ); ";
					$sql.="SET @id = LAST_INSERT_ID(); ";
					$sql.="INSERT INTO Alternance(Entreprise_nomEntreprise,formationAlternance,anneeEntree,typeContrat,CoordonneesPersonne_alternant) VALUES(:nomEntreprise,:formationAlternance,:anneeEntree,:typeContrat,@id);";

					$rep=$conn->prepare($sql);
					
					$rep->bindValue(':civilite',trim($donnees[3]),PDO::PARAM_STR);
					$rep->bindValue(':nom',trim($donnees[4]),PDO::PARAM_STR);
					$rep->bindValue(':prenom',trim($donnees[5]),PDO::PARAM_STR);
					$rep->bindValue(':fonction',"Alternant",PDO::PARAM_STR);
					$rep->bindValue(':telephoneFixe',trim($donnees[6]),PDO::PARAM_STR);
					$rep->bindValue(':telephoneMobile',trim($donnees[7]),PDO::PARAM_STR);
					$rep->bindValue(':mail',trim($donnees[8]),PDO::PARAM_STR);
					$rep->bindValue(':commentaires',trim($donnees[9]),PDO::PARAM_STR);

					$rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
					$rep->bindValue(':formationAlternance',trim($donnees[0]),PDO::PARAM_STR);
					$rep->bindValue(':anneeEntree',trim($donnees[1]),PDO::PARAM_INT);
					$rep->bindValue(':typeContrat',trim($donnees[2]),PDO::PARAM_STR);

	              
					if($rep->execute())
					{
						echo "ok";
					}
					else
					{
						echo "<p> Une erreur s'est produite ! </p>";
					}
				}

				
           
            }
            elseif($table=="Alternance" && ($niveau==3 || $niveau==4))
            {
				$pos=$tabPositionNomPersonne[$cle];
				if(verifPersonne($donnees[$pos], $donnees[$pos+1]))
            	{
            		$sql ="INSERT INTO CoordonneesPersonne(civilite,nom,prenom,fonction,telephoneFixe,telephoneMobile,mail,commentaires) VALUES ( :civilite, :nom, :prenom,:fonction, :telephoneMobile, :telephoneMobile, :mail, :commentaires ); ";
					$sql.="SET @id = LAST_INSERT_ID(); ";

					$choix= ($niveau==3) ? "CoordonneesPersonne_maitre" : "CoordonneesPersonne_RH";
					$sql.="UPDATE Alternance SET $choix=@id WHERE CoordonneesPersonne_alternant= :idAlternant;";
					
					$rep=$conn->prepare($sql);

					$rep->bindValue(':civilite',trim($donnees[1]),PDO::PARAM_STR);
					$rep->bindValue(':nom',trim($donnees[2]),PDO::PARAM_STR);
					$rep->bindValue(':prenom',trim($donnees[3]),PDO::PARAM_STR);
					$rep->bindValue(':fonction',trim($donnees[4]),PDO::PARAM_STR);
					$rep->bindValue(':telephoneFixe',trim($donnees[5]),PDO::PARAM_STR);
					$rep->bindValue(':telephoneMobile',trim($donnees[6]),PDO::PARAM_STR);
					$rep->bindValue(':mail',trim($donnees[7]),PDO::PARAM_STR);
					$rep->bindValue(':commentaires',trim($donnees[8]),PDO::PARAM_STR);
              		$rep->bindValue(':idAlternant',trim($donnees[0]),PDO::PARAM_INT);
					
					if($rep->execute())
					{
						echo "ok";
					}
					else
					{
						echo "<p> Une erreur s'est produite ! </p>";
					}

				}
            }
            elseif($table=="TaxeApprentissage" && $niveau==1 )
            {
            	//echo "<p> ok </p>";

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

	            	$sql ="INSERT INTO TaxeApprentissage(Entreprise_nomEntreprise,anneeDeVersement,montantPromesseVersement,montantVerse,versementVia,rapprochementAC,dateEnregistrement,OCTA,modePaiement,dateTransmissionChequeAC,commentairesTaxe) VALUES (:nomEntreprise,:anneeDeVersement,:montantPromesseVersement,:montantVerse,:versementVia,:rapprochementAC, DATE( NOW() ),:OCTA,:modePaiement,:dateTransmissionChequeAC,:commentairesTaxe) ";
				
					$rep=$conn->prepare($sql);
					
					$rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
					$rep->bindValue(':anneeDeVersement',trim($donnees[0]),PDO::PARAM_INT);
					$rep->bindValue(':montantPromesseVersement',trim($donnees[1]),PDO::PARAM_INT);
					$rep->bindValue(':montantVerse',trim($donnees[2]),PDO::PARAM_INT);
					$rep->bindValue(':versementVia',trim($donnees[3]),PDO::PARAM_STR);
					$rep->bindValue(':rapprochementAC',trim($donnees[4]),PDO::PARAM_STR);
					$rep->bindValue(':OCTA',trim($donnees[5]),PDO::PARAM_STR);
					$rep->bindValue(':modePaiement',trim($donnees[6]),PDO::PARAM_STR);
					$rep->bindValue(':dateTransmissionChequeAC',trim($donnees[7]),PDO::PARAM_STR);
					$rep->bindValue(':commentairesTaxe',trim($donnees[8]),PDO::PARAM_STR);
					if($rep->execute())
					{
						$rep = $conn->query('SELECT LAST_INSERT_ID() AS id');
						$res = $rep->fetch();
						$idTA=intval($res['id']);

						for($i=9;$i<count($donnees);$i++)
						{
							//echo "i : $i";
							$objFormations=$donnees[$i];
							//print_r($objFormations);
							$sql="INSERT INTO a_TaxeApprentissage_CycleFormation VALUES(:idTA, :idCF, :categorie, :montant)";
							//echo "sql : $sql";
							//echo "idCF : ".$tabIdCF[$i];
							$rep=$conn->prepare($sql);

							$rep->bindValue(':idTA',$idTA,PDO::PARAM_INT);
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
            else
            {
            	$tabColonnesPrepare=$tabCorrespondanceColonnes[$cle];
            	for($i=0;$i<count($tabColonnesPrepare);$i++)
            	{
            		$chaine=$tabColonnesPrepare[$i];
            		$tabColonnesPrepare[$i]=":".$chaine;
            	}

            	$sql="INSERT INTO $table (".implode(",", $tabCorrespondanceColonnes[$cle]).") VALUES (".implode(",", $tabColonnesPrepare)."); ";
		
				//echo "<p> $sql </p>";
				$rep=$conn->prepare($sql);
				for($i=0;$i<count($tabColonnesPrepare);$i++)
            	{
            		$chaine=$tabColonnesPrepare[$i];
            		if($chaine==":anneeDeParticipation")
            			$rep->bindValue($chaine,trim($donnees[0]),PDO::PARAM_INT);
            		else
            		{
            			if($chaine==":Entreprise_nomEntreprise")
            				$rep->bindValue($chaine,$nomEntreprise,PDO::PARAM_STR);
            			else
							$rep->bindValue($chaine,trim($donnees[$i-1]),PDO::PARAM_STR); // moins 1 parce que j'ai ajouté entreprise en premiere
            		}
            			
            	}
          		
				
				if($rep->execute())
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
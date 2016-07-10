<?php
function transformeChaine($tab_chaine)
{
	$sigle_transforme=array("numeroSIRET"=>"Numero SIRET","codeNAF"=>"Code NAF","libelleNAF"=>"Libelle NAF",
					"rapprochementAC"=>"Rapprochement AC","dateTransmissionChequeAC"=>"Date transmission cheque AC","dateRVPreparation"=>
					"Date RV preparation","dateRVSimulation"=>"Date RV simulation","dateEnvoiFLAuCFA"=>"Date envoi FL au CFA","OCTA"=>"OCTA");
	$sigle=array_keys($sigle_transforme);

	$tab_chaine_transforme=array();

	foreach ($tab_chaine as $chaine) 
	{
		$lettre=substr($chaine,0,1);
		$deuxLettre=substr($chaine,0,2);

		if($deuxLettre=="id")
			array_push($tab_chaine_transforme,$chaine);
		//c'est un sigle
		elseif(in_array($chaine,$sigle))
			array_push($tab_chaine_transforme,$sigle_transforme[$chaine]);

		elseif($chaine=="Entreprise_nomEntreprise" )
		{
			array_push($tab_chaine_transforme,"Nom entreprise");
		}

		//ca commence par une miniscule
		elseif(strtoupper($lettre)!=$lettre)
		{
			$keywords = preg_split('/(?=[A-Z]+)/', $chaine);
			if(sizeof($keywords)==1)
				array_push($tab_chaine_transforme,ucfirst($chaine));
			else
			{
				$keywords[0]=ucfirst($keywords[0]);
				for($i=1;$i<sizeof($keywords);$i++) 
				{
					$keywords[$i]=strtolower($keywords[$i]);
				}
				array_push($tab_chaine_transforme,implode(" ",$keywords));
			}
		}
		else
		{
			/*if($chaine=="CoordonneesPersonne.commentaires")
				array_push($tab_chaine_transforme,"Commentaires");*/
		}
			
	}

	//print_r($tab_chaine_transforme);
	return $tab_chaine_transforme;
}

function colonne_null(&$tab_donnees)
{
	foreach ($tab_donnees as $key => $value) 
	{
		if($value=="NaN" || $value=="null" || $value=="undefined" || $value=="0000-00-00")
			$tab_donnees[$key]="";
			
	}
}


function genererDataTable($table,$nomEntreprise,$pk,$tab_niveaux)
{
	echo "<div id='menu_$table' class='panel'>";
	$cle_CP_presente=false;
	//$array_colonne_date=array("dateRVPreparation","dateRVSimulation","dateDebutContrat","dateFinContrat","dateEnvoiFLAuCFA","rapprochementAC");
	try
	{
	
		//boucle sur les niveaux
		foreach ($tab_niveaux as $nom_niveau => $niveau) 
		{
			$attribut;
			foreach ($niveau as $colonne_niveau) 
			{

				if($colonne_niveau == "Entreprise_nomEntreprise")
				{
					continue;
				}


				$res=preg_split("/_/",$colonne_niveau);

				//cle etrangere
				if(sizeof($res)==2)
				{
					$table_req=$res[0];
					$attribut=$res[1];
						
					$indice=array_search($colonne_niveau, $niveau); //indice de la cle etrangere dans le tableau de niveau: à supprimer et remplacer par les colonnes recuperées
					$cle_CP_presente=true;
					$colonne_cle_array = array();
					$colonne_cle_affichage_array = array();

					if($colonne_niveau == "CoordonneesPersonne_alternant" && $nom_niveau!="niveau1")
					{
						array_push($colonne_cle_array, "idCoordonneesPersonne");
						array_push($colonne_cle_array, "nom");
						array_push($colonne_cle_array, "prenom");
					}
					else
					{
						$sql = "DESCRIBE $table_req";
						$rep=$GLOBALS['conn']->query($sql);
						
						
						while( $row = $rep->fetch()) 
						{ 
							array_push($colonne_cle_array, $row['Field']);
						}
					}
					
					array_splice($niveau,$indice,1,$colonne_cle_array);
					
				}
				
			}
			
			
			if($table=="Entreprise")
				$sql=" SELECT ".implode($niveau,",")." FROM Entreprise left join NAF on (Entreprise.Naf_codeNAF=NAF.codeNAF) WHERE Entreprise.nomEntreprise = :nomEntreprise";
			elseif($table=="CoordonneesPersonne")
			{
				$sql=" SELECT ".implode($niveau,",").", type FROM a_Entreprise_CoordonneesPersonne a right join CoordonneesPersonne cp on (a.CoordonneesPersonne_id = cp.idCoordonneesPersonne)".
					" WHERE a.type IS NOT NULL and a.Entreprise_nomEntreprise = :nomEntreprise ".
					"ORDER BY (CASE WHEN type='Autre' THEN 1 ELSE 0 END) ASC,type";
			}
			else if(($table=="Conference" || $table=="AtelierRH") && $nom_niveau=="niveau2") 
			{
				$table_asso="a_".$table."_CoordonneesPersonne";
				$sql=" SELECT ".implode($niveau,",")." FROM $table_asso join $table on ($table_asso.".$table."_id = ".$table.".id".$table.") ".
					"join CoordonneesPersonne on ($table_asso.CoordonneesPersonne_id = CoordonneesPersonne.idCoordonneesPersonne) WHERE $table.Entreprise_nomEntreprise = :nomEntreprise";
			}
			else if($table=="TaxeApprentissage" && $nom_niveau=="niveau2")
			{

				$sql=" SELECT ".implode($niveau,",")." FROM TaxeApprentissage join a_TaxeApprentissage_CycleFormation on (idTA=TaxeApprentissage_id) join CycleFormation on ( CycleFormation_id=idCycleFormation) WHERE Entreprise_nomEntreprise=:nomEntreprise";
			}
				
			else
			{
				if($cle_CP_presente)
				{
					if($nom_niveau=="niveau3" || $nom_niveau=="niveau4")
					{
						if($nom_niveau=="niveau3")
							$col_req="AL.CoordonneesPersonne_maitre";
						else
							$col_req="AL.CoordonneesPersonne_RH";


						$sql="SELECT p1.idCoordonneesPersonne as idA,p1.nom as nomA,p1.prenom as prenomA, p2.idCoordonneesPersonne,p2.civilite,p2.nom,p2.prenom,p2.fonction,p2.telephoneFixe,p2.telephoneMobile,p2.mail,p2.commentaires ".
								"FROM ".
								    "Alternance AL ".
								        "INNER JOIN CoordonneesPersonne p1 ".
								            "ON AL.CoordonneesPersonne_alternant = p1.idCoordonneesPersonne ".
								        "INNER JOIN CoordonneesPersonne p2 ".
								            "ON $col_req = p2.idCoordonneesPersonne ".
								"WHERE Entreprise_nomEntreprise=:nomEntreprise ORDER BY nomA";
					}
					else
						$sql=" SELECT ".implode($niveau,",")." FROM $table left join CoordonneesPersonne on ($table.CoordonneesPersonne_$attribut = CoordonneesPersonne.idCoordonneesPersonne) WHERE Entreprise_nomEntreprise = :nomEntreprise ORDER BY nom";
					
				}
				else
					$sql=" SELECT ".implode($niveau,",")." FROM $table WHERE Entreprise_nomEntreprise = :nomEntreprise";
			}
				
			
			//echo $sql;
			$rep=$GLOBALS['conn']->prepare($sql);
			$rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
			$rep->execute();

			$keywords = preg_split('/(?=[0-9]+)/', $nom_niveau);
			$num_niveau=$keywords[1];

			if($nom_niveau != "niveau1")
			{
				if($table=="Alternance" && ($num_niveau==3 || $num_niveau==4))
				{
					if($num_niveau==3)
						echo "<h3 id='titre_".$table."_"."niveau3' style='cursor:pointer; margin-top: 60px;' class='titreDataTable'> <img src='../img/minus.png' alt='Icon zoom'> Niveau 3 (Maître d'apprentissage) </h3>";
					else
						echo "<h3 id='titre_".$table."_"."niveau4' style='cursor:pointer; margin-top: 60px;' class='titreDataTable' > <img src='../img/minus.png' alt='Icon zoom'> Niveau 4 (Responsable RH) </h3>";
				}
				else
					echo "<h3 id='titre_".$table."_"."$nom_niveau' style='cursor:pointer; margin-top: 60px;' class='titreDataTable' > <img src='../img/minus.png' alt='Icon zoom'> Niveau $num_niveau </h3>";
			}
			
			
			echo "<table width='100%' border='1' cellspacing='0' cellpadding='0' id='dataTable_".$table."_"."$nom_niveau' class='display'>";
			echo "<thead><tr>";

			$colonne_array_affichage=transformeChaine($niveau);
			
			if($table=="Entreprise" && $nom_niveau=="niveau1")
			{
				$colonne_array_affichage[count($colonne_array_affichage)]="Cycle formation";
				
			}
			if($table=="Entreprise" && $nom_niveau=="niveau2")
			{
				$colonne_array_affichage[count($colonne_array_affichage)]="Actions menees";
			}
			
			
			for($i=0;$i<count($colonne_array_affichage);$i++)
			{
				$nom_col_affichage=$colonne_array_affichage[$i];
				if(substr($nom_col_affichage, 0,2)=="id" || $nom_col_affichage=="Nom entreprise" || $nom_col_affichage=="Code NAF" || ($nom_col_affichage=="Fonction" && $table=="Alternance" && $nom_niveau=="niveau1"))
					echo  "<th name='cacher'> $nom_col_affichage </th>";
				else
					echo  "<th class=\"$nom_col_affichage\"> $nom_col_affichage </th>";
			}

			echo '</tr></thead>';
			echo '<tbody>';

			while($data=$rep->fetch())
			{
					
					colonne_null($data);
					
					echo "<tr>";
					if($table=="Alternance")
						$pk="idCoordonneesPersonne";
					if($table=="Alternance" && $nom_niveau!="niveau1" && $nom_niveau!="niveau2")
					{
						echo "<td id='Alternance_idCoordonneesPersonne_idA_"."$nom_niveau' name='cacher'>".$data['idA']."</td>";
						echo "<td id='Alternance_idCoordonneesPersonne_nomA_"."$nom_niveau'>".$data['nomA']."</td>";
						echo "<td id='Alternance_idCoordonneesPersonne_prenomA_"."$nom_niveau'>".$data['prenomA']."</td>";
						
						for ($j=3;$j<count($niveau);$j++)
						{
							$valeur=$data[$niveau[$j]];
							if($niveau[$j]=="idCoordonneesPersonne")
								echo "<td id='$table"."_".$valeur_pk."_".$niveau[$j]."_"."$nom_niveau' name='cacher'> $valeur</td>";
							else
								echo "<td id='$table"."_".$valeur_pk."_".$niveau[$j]."_"."$nom_niveau'> $valeur</td>";
						}
						
					}
					else
					{
						$valeur_pk=$data[$pk];
						for ($j=0;$j<count($niveau);$j++)
						{
							$nom_col=$niveau[$j];

							if($nom_col=="heureDebut" || $nom_col=="heureFin")
								$data[$nom_col]=substr($data[$nom_col],0,5);

							$valeur=$data[$nom_col];
							if(substr($nom_col, 0,2)=="id" || $nom_col=="nomEntreprise"  || $nom_col=="Entreprise_nomEntreprise" || $nom_col=="codeNAF"|| ($nom_col=="fonction" && $table=="Alternance" && $nom_niveau=="niveau1"))
									echo "<td id='$table"."_".$valeur_pk."_".$nom_col."_"."$nom_niveau' name='cacher'> $valeur</td>";
							else
								echo "<td id='$table"."_".$valeur_pk."_".$nom_col."_"."$nom_niveau'> $valeur</td>";
						}

						if($table=="Entreprise" && $nom_niveau=="niveau1")
							echo "<td id='cycleFormation'> <input type='button' value='Voir les cycles' id='bVoirCycle'/> </td>";
						if($table=="Entreprise" && $nom_niveau=="niveau2")
							echo "<td id='actionsMenees'> <input type='button' value='Voir les actions' id='bVoirActionsMenees'/> </td>";
							
					}
					
					echo '</tr>';
			}
			
			echo '</tbody>';
			echo '<tfoot><tr></tr></tfoot>';
			echo '</table>';
			echo '<br/>';


		    $tablePasBoutonAjouter=array("EntrepriseNiveau1","EntrepriseNiveau2","AlternanceNiveau2","TaxeApprentissageNiveau2","TaxeApprentissageNiveau3");
		    $tablePasBoutonSupprimer=array("EntrepriseNiveau2","AlternanceNiveau2","TaxeApprentissageNiveau2","TaxeApprentissageNiveau3");
			$cle=$table.ucfirst($nom_niveau);

			if($_SESSION['profil']=='write' || $_SESSION['profil']=='super')
			{
				?>
				<center>
				<?php 
				if(!in_array($cle, $tablePasBoutonAjouter ))
					echo "<button class=\"btn btn-sm\" type='button' value='Ajouter' style =\"margin-left: 10px;\" id='bAjouter_".$table."_"."$nom_niveau'><i class=\"fa fa-plus\"></i> Ajouter</button> ";

				if($cle!="TaxeApprentissageNiveau2")
					echo "<button class=\"btn btn-sm\" style =\"margin-left: 10px;\" type='button' value='Modifier' id='bModifier_".$table."_"."$nom_niveau'><i class=\"fa fa-pencil\"></i> Modifier</button>";
			}
			if($_SESSION['profil']=='super')
			{
				if(!in_array($cle, $tablePasBoutonSupprimer ))
				echo "<button class=\"btn btn-sm\" style =\"margin-left: 10px;\" type='button' value='Supprimer' id='bSupprimer_".$table."_"."$nom_niveau'><i class=\"fa fa-trash-o\"></i> Supprimer</button> ";
			}
			$cle_CP_presente=false;
			$colonne_array_affichage=array();
				?>
				</center>
				<?php
		}
		
		echo "</div>";
	}
	catch(PDOException $e)
	{
	    echo "erreur: " . $e->getMessage();
	}

}
?>
<?php
function transformeChaine($tab_chaine)
{
	$sigle_transforme=array("numeroSIRET"=>"Numero SIRET","codeNAF"=>"Code NAF","libelleNAF"=>"Libelle NAF","dateAtelierRH"=>"Date atelier RH",
					"rapprochementAC"=>"Rapprochement AC","dateRVPreparation"=>"Date RV preparation","dateRVSimulation"=>"Date RV simulation",
					"dateEnvoiFLAuCFA"=>"Date envoi FL au CFA","OCTA"=>"OCTA","idTA"=>"id TA","idAtelierRH"=>"id atelier RH");
	$sigle=array_keys($sigle_transforme);

	$tab_chaine_transforme=array();

	foreach ($tab_chaine as $chaine) 
	{
		$lettre=substr($chaine,0,1);

		if(in_array($chaine,$sigle))
			array_push($tab_chaine_transforme,$sigle_transforme[$chaine]);

		elseif($chaine=="CoordonneesPersonne_alternant" )
		{
			array_push($tab_chaine_transforme,"id alternant");
		}

		elseif($chaine=="Entreprise_nomEntreprise" )
		{
			array_push($tab_chaine_transforme,"nom Entreprise");
		}

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
			
		}
			
	}

	//print_r($tab_chaine_transforme);
	return $tab_chaine_transforme;
}


function genererDataTable($table,$nomEntreprise,$pk,$tab_niveaux)
{

	//$cle_etrangere=array("Naf_codeNaf","CoordonneesPersonne_alternant","CoordonneesPersonne_maitre","CoordonneesPersonne_RH");

	//$pk="nomEntreprise";
	echo "<div id='menu_$table'>";
	$cle_CP_presente=false;

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
					//$cle_Entreprise_presente=true;
					continue;
				}

				$res=preg_split("/_/",$colonne_niveau);

				if(sizeof($res)==2)
				{
					$table_req=$res[0];
					$attribut=$res[1];
						
					$indice=array_search($colonne_niveau, $niveau); //indice de la cle etrangere dans le tableau de niveau: à supprimer et remplacer par les colonnes recuperées
				
					$cle_CP_presente=true;
					$sql = "DESCRIBE $table_req";
					$rep=$GLOBALS['conn']->query($sql);
					
					$colonne_cle_array = array();
					$colonne_cle_affichage_array = array();
					while( $row = $rep->fetch()) 
					{ 
						//echo "<p> je change ------> <p>";
						if($row['Field']=="commentaires")
							$row['Field']="CoordonneesPersonne.commentaires";
						array_push($colonne_cle_affichage_array, $row['Field'].ucfirst($attribut));
						array_push($colonne_cle_array, $row['Field']);
					}

						array_splice($niveau,$indice,1,$colonne_cle_array);
				}
				
			}
			$colonne_array_affichage=transformeChaine($niveau);

			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' id='dataTable_".$table."_"."$nom_niveau' class='display'>";
			echo "<thead><tr>";
			
			for($i=0;$i<count($colonne_array_affichage);$i++)
			{
				echo  "<th> $colonne_array_affichage[$i] </th>";
			}

			echo '</tr></thead>';
			echo '<tbody>';
			
			//$sql=" SELECT ".implode($tab_niveau,",")." FROM Entreprise WHERE nomEntreprise = :nomEntreprise";
			if($table=="Entreprise")
				$sql=" SELECT ".implode($niveau,",")." FROM Entreprise left join NAF on (Entreprise.Naf_codeNAF=NAF.codeNAF) WHERE Entreprise.nomEntreprise = :nomEntreprise";
			elseif($table=="CoordonneesPersonne")
			{
				$sql=" SELECT ".implode($niveau,",").", type FROM a_Entreprise_CoordonneesPersonne a right join CoordonneesPersonne cp on (a.CoordonneesPersonne_id = cp.idCoordonneesPersonne)".
					" WHERE a.type IS NOT NULL and a.Entreprise_nomEntreprise = :nomEntreprise";

				//echo $sql;
			}
			else if($table=="Conference" || $table=="AtelierRH")
			{
				$table_asso="a_".$table."_CoordonneesPersonne";
				$sql=" SELECT ".implode($niveau,",")." FROM $table_asso join $table on ($table_asso.".$table."_id = ".$table.".id".$table.") ".
					"join CoordonneesPersonne on ($table_asso.CoordonneesPersonne_id = CoordonneesPersonne.idCoordonneesPersonne) WHERE $table.Entreprise_nomEntreprise = :nomEntreprise";
			}
				
			else
			{
				if($cle_CP_presente)
					$sql=" SELECT ".implode($niveau,",")." FROM $table left join CoordonneesPersonne on ($table.CoordonneesPersonne_$attribut = CoordonneesPersonne.idCoordonneesPersonne) WHERE Entreprise_nomEntreprise = :nomEntreprise";
				else
					$sql=" SELECT ".implode($niveau,",")." FROM $table WHERE Entreprise_nomEntreprise = :nomEntreprise";
			}
				
			
			//echo $sql;
			$rep=$GLOBALS['conn']->prepare($sql);
			$rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
			$rep->execute();

			while($data=$rep->fetch())
			{
					echo "<tr>";
					$valeur_pk=$data[$pk];
					for ($j=0;$j<count($niveau);$j++)
					{
						$valeur=$data[$niveau[$j]];
						echo "<td id='$table"."_".$valeur_pk."_".$niveau[$j]."_"."$nom_niveau'> $valeur</td>";
					}
					echo '</tr>';
			}
			echo '</tbody>';
			echo '<tfoot><tr><th colspan="9"></th></tr></tfoot>';
			echo '</table>';
			echo '<br/>';

			$cle_CP_presente=false;
		}
		
		echo "</div>";
	}
	catch(PDOException $e)
	{
	    echo "erreur: " . $e->getMessage();
	}

}
?>
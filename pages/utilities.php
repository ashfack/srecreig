<?php
function transformeChaine($tab_chaine)
{
	$sigle_transforme=array("numeroSIRET"=>"Numero SIRET","codeNAF"=>"Code NAF","libelleNAF"=>"Libelle NAF","dateAtelierRH"=>"Date atelier RH",
					"rapprochementAC"=>"Rapprochement AC","dateRVPreparation"=>"Date RV preparation","dateRVSimulation"=>"Date RV simulation",
					"dateEnvoiFLAuCFA"=>"Date envoi FL au CFA","OCTA"=>"OCTA");
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
							/*//echo "<p> je change ------> <p>";
							array_push($colonne_cle_affichage_array, "id Alternant");
							array_push($colonne_cle_affichage_array, "Nom alternant");
							array_push($colonne_cle_affichage_array, "Prenom alternant");*/
							
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
							
							/*if($row['Field']=="commentaires")
								$row['Field']="CoordonneesPersonne.commentaires";*/
							//array_push($colonne_cle_affichage_array, $row['Field'].ucfirst($attribut));
							array_push($colonne_cle_array, $row['Field']);
						}
					}
					
					//print_r($colonne_cle_array);
					array_splice($niveau,$indice,1,$colonne_cle_array);
					//print_r($niveau);
				}
				
			}

			$colonne_array_affichage=transformeChaine($niveau);
			//print_r($colonne_array_affichage);

			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' id='dataTable_".$table."_"."$nom_niveau' class='display'>";
			echo "<thead><tr>";
			
			for($i=0;$i<count($colonne_array_affichage);$i++)
			{
				$nom_col_affichage=$colonne_array_affichage[$i];
				if(substr($nom_col_affichage, 0,2)=="id" || $nom_col_affichage=="Nom entreprise")
					echo  "<th name='cacher'> $nom_col_affichage </th>";
				else
					echo  "<th> $nom_col_affichage </th>";
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
				{
					//echo $nom_niveau;
					if($nom_niveau=="niveau3" || $nom_niveau=="niveau4")
					{
						//$colonne_requete_alternance=array("idA","nomA","prenomA",)
						if($nom_niveau=="niveau3")
							$col_req="AL.CoordonneesPersonne_maitre";
						else
							$col_req="AL.CoordonneesPersonne_RH";


						$sql="SELECT p1.idCoordonneesPersonne as idA,p1.nom as nomA,p1.prenom as prenomA, p2.idCoordonneesPersonne,p2.civilite,p2.nom,p2.prenom,p2.fonction,p2.telephoneFixe,p2.telephoneMobile,p2.mail,p2.commentaires ".
								"FROM ".
								    "alternance AL ".
								        "INNER JOIN CoordonneesPersonne p1 ".
								            "ON AL.CoordonneesPersonne_alternant = p1.idCoordonneesPersonne ".
								        "INNER JOIN CoordonneesPersonne p2 ".
								            "ON $col_req = p2.idCoordonneesPersonne ".
								"WHERE Entreprise_nomEntreprise=:nomEntreprise";
					}
					else
						$sql=" SELECT ".implode($niveau,",")." FROM $table left join CoordonneesPersonne on ($table.CoordonneesPersonne_$attribut = CoordonneesPersonne.idCoordonneesPersonne) WHERE Entreprise_nomEntreprise = :nomEntreprise";
					
					//echo $sql;
				}
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
					if($table=="Alternance")
						$pk="idCoordonneesPersonne";
					if($table=="Alternance" && $nom_niveau!="niveau1" && $nom_niveau!="niveau2")
					{
						echo "<td id='Alternance_idCoordonneesPersonne_idA_"."$nom_niveau' name='cacher'>".$data['idA']."</td>";
						echo "<td id='Alternance_idCoordonneesPersonne_nomA_"."$nom_niveau'>".$data['nomA']."</td>";
						echo "<td id='Alternance_idCoordonneesPersonne_prenomA_"."$nom_niveau'>".$data['prenomA']."</td>";
						
						//echo sizeof($niveau);
						//print_r($niveau);
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

							$valeur=$data[$nom_col];
							if(substr($nom_col, 0,2)=="id" || $nom_col=="nomEntreprise")
									echo "<td id='$table"."_".$valeur_pk."_".$nom_col."_"."$nom_niveau' name='cacher'> $valeur</td>";
							else
								echo "<td id='$table"."_".$valeur_pk."_".$nom_col."_"."$nom_niveau'> $valeur</td>";
						}
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
<?php
function transformeChaine($tab_chaine)
{
	$sigle_transforme=array("numeroSIRET"=>"Numero SIRET","codeNAF"=>"Code NAF","libelleNAF"=>"Libelle NAF","dateAtelierRH"=>"Date atelier RH",
					"rapprochementAC"=>"Rapprochement AC","dateRVPreparation"=>"Date RV preparation","dateRVSimulation"=>"Date RV simulation",
					"dateEnvoieFLAuCFA"=>"Date Envoi FL Au CFA","OCTA"=>"OCTA","idTA"=>"id TA","idAtelierRH"=>"id atelier RH");
	$sigle=array_keys($sigle_transforme);

	$tab_chaine_transforme=array(); 
	foreach ($tab_chaine as $chaine) 
	{
		$lettre=substr($chaine,0,1);

		if(in_array($chaine,$sigle))
			array_push($tab_chaine_transforme,$sigle_transforme[$chaine]);

		elseif($chaine=="CoordonneesPersonne_alternant")
		{
			array_push($tab_chaine_transforme,"id alternant");
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
			continue;
	}

	//print_r($tab_chaine_transforme);
	return $tab_chaine_transforme;
}
?>
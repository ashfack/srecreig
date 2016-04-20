<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SRE - Recherche </title>
		
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<?php
            require('header_link.html');
        ?>
        <?php
            require('header_script.html');
        ?>
	</head>
	<body>
		<?php 
			require "header.php";
			require "db_connect.php";
		  	require "utilities.php";
			if(isset($_GET['nomEntreprise']) && $_GET['nomEntreprise']!="")
			{
					$nomEntreprise=$_GET['nomEntreprise'];
		?>

		<h1 class="text-center"> <span> <?php echo $nomEntreprise; ?> </span> </h1>
		
		<div id="tabs">
			<ul> 
		  	<?php 
		  		
		  		
		  		$table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
				$table_array= array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
				for($i=0;$i<count($table_array);$i++)
				{
					echo "<li> <a href=\"#menu_".$table_array[$i]."\">".$table_onglet_array[$i]."</a> </li>";
				}
				echo "</ul>";
				
				// faut ajouter la formation, action mené !
				$tab_niveaux_Entreprise=array("niveau1"=>array("nomEntreprise","groupe","adresse","complementAdresse","codePostal","ville","pays","commentairesEntreprise"),
							"niveau2" => array("nomEntreprise","numeroSIRET","NAF_codeNAF","origine","typeContact","partenariatOfficiel","taille","alias"));
				$tab_niveaux_CoordonneesPersonne=array("niveau1"=>array("idCoordonneesPersonne","civilite","nom","prenom","fonction","telephoneFixe","telephoneMobile",
													"mail","commentaires","type"));
		
				$tab_niveaux_Alternance=array("niveau1"=>array("formationAlternance","anneeEntree","typeContrat","CoordonneesPersonne_alternant"),
												"niveau2"=>array("CoordonneesPersonne_alternant","dateRVPreparation","dateRVSimulation","dateDebutContrat","dateFinContrat","dateEnvoiFLAuCFA","docAAttacher"),
												"niveau3"=>array("CoordonneesPersonne_alternant","CoordonneesPersonne_maitre"),
												"niveau4"=>array("CoordonneesPersonne_alternant","CoordonneesPersonne_RH"));
		
<<<<<<< HEAD

				$tab_niveaux_TaxeApprentissage=array("niveau1"=>array("idTA","anneeDeVersement","montantPromesseVersement","montantVerse","versementVia","rapprochementAC"),
													"niveau2"=>array("idTA","anneeDeVersement","OCTA","dateEnregistrement","dateDerniereModification","modePaiement","dateTransmissionChequeAC","commentairesTaxe"));

=======
				$tab_niveaux_TaxeApprentissage=array("niveau1"=>array("idTA","anneedeVersement","montantPromesseVersement","montantVerse","versementVia","rapprochementAC"),
													"niveau2"=>array("idTA","anneedeVersement","OCTA","dateEnregistrement","dateDerniereModification","modePaiement","dateTransmissionChequeAC","commentairesTaxe"));
>>>>>>> origin/master
				
				$tab_niveaux_AtelierRH=array("niveau1"=>array("dateAtelier","creneauAtelier","CoordonneesPersonne_RH"));
		
				$tab_niveaux_Conference=array("niveau1"=>array("typeConference","dateConference","heureDebut","heureFin","lieuConference","themeConference"),
												"niveau2"=>array("CoordonneesPersonne_conferencier"));	
		
				$tab_niveaux_ForumSG=array("niveau1"=>array("Entreprise_nomEntreprise","anneeDeParticipation","questionnaireDeSatisfaction","commentairesForum"));
				$pk=array("nomEntreprise","idCoordonneesPersonne","CoordonneesPersonne_alternant","idTA","idAtelierRH","idConference","Entreprise_nomEntreprise");
				$niveaux=array($tab_niveaux_Entreprise,$tab_niveaux_CoordonneesPersonne,$tab_niveaux_Alternance,$tab_niveaux_TaxeApprentissage,$tab_niveaux_AtelierRH,$tab_niveaux_Conference,$tab_niveaux_ForumSG);
				for($i=0;$i<count($table_array);$i++)
				{
					
					genererDataTable($table_array[$i],$nomEntreprise,$pk[$i],$niveaux[$i]);
				}	
		  ?>

		  <?php
		  	}
		  	else
		  		echo "Erreur le nom de l'entreprise n'est pas specifié ";
		  ?>
		</div>
	</body>
<<<<<<< HEAD
	<script type="text/javascript" src="../js/script_rechercher-propagation.js"></script>
</html>
=======
</html>
>>>>>>> origin/master

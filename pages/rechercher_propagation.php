<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SRE - Recherche </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<?php
	require('header_link.html');
	require('header_script.html');
	?>
	<!-- JQUERY DATATABLE CSS -->
	<link href="../css/jquery.dataTables.min.css" rel="stylesheet">
	<script type="text/javascript" src="../js/export_zip.js"></script>

</head>
<body>
	<div class="se-pre-con">
		<?php require('header.php');  ?>
	</div>
	<?php require('header.php');  
	require "db_connect.php";
	require "utilities.php";
	if(isset($_GET['nomEntreprise']) && $_GET['nomEntreprise']!="")
	{
		$nomEntreprise=$_GET['nomEntreprise'];
		?>
		<div class="col-md-3"> 
		<?php
		if($_SESSION['profil']=='super') {   ?>  
		      <button class="btn btn-sm dropdown-toggle" onclick="tablesToExcel(['dataTable_Entreprise_niveau1','dataTable_Entreprise_niveau2','dataTable_CoordonneesPersonne_niveau1','dataTable_Alternance_niveau1','dataTable_Alternance_niveau2','dataTable_Alternance_niveau3','dataTable_Alternance_niveau4','dataTable_TaxeApprentissage_niveau1','dataTable_TaxeApprentissage_niveau2','dataTable_AtelierRH_niveau1','dataTable_Conference_niveau1', 'dataTable_Conference_niveau2', 'dataTable_ForumSG_niveau1'], ['Entreprise 1','Entreprise 2','CoordonneesPersonne','Alternance 1','Alternance 2','Alternance 3','Alternance 4','Taxe apprentissage 1','Taxe apprentissage 2','Atelier RH', 'Conférence 1', 'Conférence 2', 'Forum SG'], '<?php echo $nomEntreprise; ?>.xls', 'Excel')" data-toggle="	dropdown">
		      <i class="fa fa-download"></i> Exporter 
		      </button>
		<?php  } ?>  

		</div> 
		<div class="col-md-6"> 
		<div id="div_titre_nomEntreprise">
			<h1 class="text-center" id="titre_nomEntreprise">  <?php echo $nomEntreprise; ?> </h1>
		</div>
		</div> 
		<div class="col-md-3"> </div> 		

		<div class="col-md-12"> 		
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
				
				$tab_niveaux_Alternance=array("niveau1"=>array("idCoordonneesPersonne","formationAlternance","anneeEntree","typeContrat","CoordonneesPersonne_alternant"),
					"niveau2"=>array("CoordonneesPersonne_alternant","dateRVPreparation","dateRVSimulation","dateDebutContrat","dateFinContrat","dateEnvoiFLAuCFA","docAAttacher"),
					"niveau3"=>array("CoordonneesPersonne_alternant","CoordonneesPersonne_maitre"),
					"niveau4"=>array("CoordonneesPersonne_alternant","CoordonneesPersonne_RH"));
				


				$tab_niveaux_TaxeApprentissage=array("niveau1"=>array("idTA","anneeDeVersement","montantPromesseVersement","montantVerse","versementVia","rapprochementAC"),
					"niveau2"=>array("idTA","anneeDeVersement","dateEnregistrement","CycleFormation_id","categorie","montant"),
					"niveau3"=>array("idTA","anneeDeVersement","dateEnregistrement","OCTA","dateDerniereModification","modePaiement","dateTransmissionChequeAC","commentairesTaxe"));

				
				$tab_niveaux_AtelierRH=array("niveau1"=>array("idAtelierRH","dateAtelier","creneauAtelier"),
											"niveau2"=>array("idAtelierRH","dateAtelier","CoordonneesPersonne_RH"));

				$tab_niveaux_Conference=array("niveau1"=>array("idConference","dateConference","typeConference","heureDebut","heureFin","lieuConference","themeConference"),
					"niveau2"=>array("idConference","dateConference","CoordonneesPersonne_conferencier"));	
				
				
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

		<div id="dialog_cycle"  title="Cycle Formation">
			<p> En bleu, les cycles/formations liés à l'entreprise (Pour modifier les cycles cliquez sur le bouton "Modifier"):  </p>
			<?php
			require ("jstree_cycle.php");
			?>
		</div>

		<div id="dialog_message"  title="Information">
			
		</div>

		<div id="dialog_supprimer_confirmation" title="Confirmation !">
        
        </div>

        <div id="dialog_ajouter" title="ajouter">
        
        </div>
		
		<div id="dialog_editer" title="Edition">
			<p>
			  Edition selon Entreprise <span id="emplacement_editer_nomEntreprise"> </span>
			</p>
			<?php
			require('jstree_cycle.php');
			?>
		</div>

</div> 
	</body>
	
<script type="text/javascript" src="../js/script_rechercher-propagation.js"></script>
<link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css" />
</html>


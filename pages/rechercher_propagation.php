<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Demonstration</title>
		
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<?php
	        require('header_link.html');
	    ?>
	    <?php
	        require('header_script.html');
	    ?>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../js/script_rechercher-propagation.js"></script>
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

		<h1 class="text-center"> Informations concernant l'entreprise:  <span> <?php echo $nomEntreprise; ?> </span> </h1>
		
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

				for($i=0;$i<7;$i++)
				{
					try
					{
						$sql = "DESCRIBE $table_array[$i]";
						$rep=$conn->query($sql);
						//iterate on results row and create new index array of data
						$colonne_array = array();
						$pk;
						while( $row = $rep->fetch()) 
						{ 
							$lettre=substr($row['Field'],0,1);
							//ATTENTION SI PLUSIEURS COLONNE EN CLE PRIMAIRE !!!
							if(isset($row['Key']) && $row['Key'] == 'PRI')
								$pk=$row['Field'];
							if(strtoupper($lettre)!=$lettre || $row['Field']=="OCTA" || $row['Field']=="CoordonneesPersonne_alternant")
								array_push($colonne_array,$row['Field']);
						}
						$colonne_array_affichage=transformeChaine($colonne_array);
						echo "<div id='menu_".$table_array[$i]."'>";
						echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' id='$table_array[$i]' class='display'>";
						echo "<thead><tr>";

						for($j=0;$j<count($colonne_array_affichage);$j++)
						{
							echo  "<th> $colonne_array_affichage[$j] </th>";
						}

						echo '</tr></thead>';
						echo '<tbody>';

						$sql="Select * from Entreprise";
						if($table_array[$i]=="Entreprise")
							$sql=" SELECT ".implode($colonne_array,",")." FROM Entreprise WHERE nomEntreprise = :nomEntreprise";
						elseif($table_array[$i]=="CoordonneesPersonne")
						{
							$sql=" SELECT ".implode($colonne_array,",")." FROM $table_array[$i] WHERE idCoordonneesPersonne in ".
							"(select CoordonneesPersonne_primaire from Entreprise where nomEntreprise = :nomEntreprise) ".
							"or idCoordonneesPersonne in (select CoordonneesPersonne_secondaire from Entreprise where nomEntreprise = :nomEntreprise) ".
							"or idCoordonneesPersonne in (select CoordonneesPersonne_TA from Entreprise where nomEntreprise = :nomEntreprise)";

							//echo $sql;
						}
						else
							$sql=" SELECT ".implode($colonne_array,",")." FROM $table_array[$i] WHERE Entreprise_nomEntreprise = :nomEntreprise";
						
						//echo $sql;
						$rep=$conn->prepare($sql);
						$rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
						$rep->execute();
					
						while($data=$rep->fetch())
						{
								echo "<tr>";
								$valeur_pk=$data[$pk];
								for ($k=0;$k<count($colonne_array);$k++)
								{
									$valeur=$data[$colonne_array[$k]];
									echo "<td id='$table_array[$i]"."_$pk"."_$valeur_pk"."_$colonne_array[$k]'> $valeur</td>";
								}
								echo '</tr>';
						}
						echo '</tbody>';
						echo '<tfoot><tr><th colspan="4"></th></tr></tfoot>';
						echo '</table>';
						echo '</div>';	
					}
					catch(PDOException $e)
					{
					    echo "erreur: " . $e->getMessage();
					}
					
				}
		  ?>

		  <?php
		  	}
		  	else
		  		echo "Erreur le nom de l'entreprise n'est pas specifié ";
		  ?>
		</div>
	</body>
</html>

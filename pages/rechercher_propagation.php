<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demonstration</title>
	
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
   	<link rel="stylesheet" href="../css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	
	<script src="../js/jquery-1.11.0.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../js/script_rechercher-propagation.js"></script>
	
</head>
<body>

	<h1> Information concernant l'entreprise:  <span> <?php echo $_GET['nomEntreprise'] ?> </span> </h1>
	
	<div id="tabs">
		<ul> 
	  <?php 
	  		require "db_connect.php";
	  		require "utilities.php";
	  		$table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
			$table_array= array("entreprise","coordonneespersonne","alternance","taxeapprentissage","atelierrh","conference","forumsg");
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
						if(strtoupper($lettre)!=$lettre || $row['Field']=="OCTA")
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
					if($table_array[$i]=="entreprise")
						$sql=" SELECT ".implode($colonne_array,",")." FROM entreprise WHERE nomEntreprise='".$_GET['nomEntreprise']."'";
					elseif($table_array[$i]=="coordonneespersonne")
					{
						$sql=" SELECT ".implode($colonne_array,",")." FROM coordonneespersonne WHERE idCoordonneesPersonne in ".
						"(select CoordonneesPersonne_primaire from entreprise where nomEntreprise='".$_GET['nomEntreprise']."') ".
						"or idCoordonneesPersonne in (select CoordonneesPersonne_secondaire from entreprise where nomEntreprise='".$_GET['nomEntreprise']."') ".
						"or idCoordonneesPersonne in (select CoordonneesPersonne_TA from entreprise where nomEntreprise='".$_GET['nomEntreprise']."')";

						//echo $sql;
					}
					else
						$sql=" SELECT ".implode($colonne_array,",")." FROM $table_array[$i] WHERE Entreprise_nomEntreprise='".$_GET['nomEntreprise']."'";
					
					//echo $sql;
					$rep=$conn->query($sql);

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
	</div>
</body>
</html>
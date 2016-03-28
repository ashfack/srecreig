<html lang="fr">
	<head>
		<title>Pop up d'ajout</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel ="stylesheet" type="text/css" href="contacter.css">
		<?php
		    require('header_link.html');
		?>
	  
	</head>
	
	<body>
		<div class="container">
		  <h2>Modal Example</h2>
		  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
		  <div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 id="test" class="modal-title">Modal Header</h4>
		        </div>
		        <div id="test1" class="modal-body">
				<?php 
			  		require "db_connect.php";
					$table_array= array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
					
					$sql = "DESCRIBE $table_array[0]";
					$rep=$conn->query($sql);
					//iterate on results row and create new index array of data
					$colonne_array = array();
					$pk;
					while( $row = $rep->fetch()) 
					{ 
						$lettre=substr($row['Field'],0,1);
						if(isset($row['Key']) && $row['Key'] == 'PRI')
							$pk=$row['Field'];
						if(strtoupper($lettre)!=$lettre || $row['Field']=="OCTA")
							array_push($colonne_array,$row['Field']);
					}
						echo "<form id=\"\" method='POST'>";
						echo "<div class=\"champs\">";
					for($j=0;$j<count($colonne_array);$j++)
					{
						echo "
						<br></br>
						<label>$colonne_array[$j]
						</label>
						<input type=\"text\" name=\"$colonne_array[$j]\"> ";
						/*echo "$colonne_array[$j]";
						echo "<input type=\"text\" name=\"$colonne_array[$j]\"><br>";*/
					}
					
						echo "
								<br/><br/>
								<input class=\"send\" src=\"Envoyer.png\" type=\"image\">
								<br></br>
								</div>
								</form>";
		        ?>
				
				</div>
				
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>		  
		</div>
	</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <title>Rechercher Entreprise</title>
        <meta charset="UTF-8">
        <?php
            require('header_script.html');
        ?>
        <?php
            require('header_link.html');
        ?>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel ="stylesheet" type="text/css" href="../css/contacter.css">
        <script type="text/javascript" src="../js/script_rechercher.js"></script>
    </head>


    <body>
        <?php require('header.php'); ?>
        <div class="container">
            <div class="row" id="content">
                <h1 class="text-center"> Rechercher une entreprise </h1>
                <!-- <form id="form_rechercher" > -->
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                <center>
                                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-university"></i></span>
                           <input type="text" id="choix_entreprise" name="choix_entreprise" class="form-control" required="true" placeholder="Entreprise" aria-describedby="sizing-addon1">
                        </div>

                <p> </br>
                    <input type="button" value="Rechercher" id="bRechercher"/>
                </p>
                </center>
                </div>
                <div class="col-md-4">
                </div>
                <!-- </form> -->
                <div id="div_datatable">    
                </div>

                <div id="dialog_supprimer_confirmation" title="Confirmation !">
                    <p>
                      Vous avez allez supprimer l'entreprise <span id="emplacement_supprimer_nomEntreprise"> </span> et toutes les données qui lui sont liées (Contacts, alternants, taxe d'apprentissage...) <br/>
                      Etes vous sûr de vouloir continuer ?
                    </p>
                </div>
				
				<div id="dialog_editer">
                    <p>
                      Edition Entreprise <span id="emplacement_editer_nomEntreprise"> </span>
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
				echo "<input type=\"text\" name=\"$colonne_array[$j]\"><br>";
				<br/><br/>
						<input class=\"send\" src=\"../img/Envoyer.png\" type=\"image\">
						<br></br>*/
			}
			
				echo "
						
						</div>
						</form>";
			?>
                    </p>
                </div>


                <div id="dialog_refus"  title="Refus">
                    <p> Vous devez selectionner une entreprise </p>
                </div>

                <div id="dialog_aucune_entreprise"  title="Aucune entreprise !">
                    <p> Aucune entreprise ne répond au nom que vous avez entré ! </p>
                </div>
            </div>
        </div>
    </body>
</html>

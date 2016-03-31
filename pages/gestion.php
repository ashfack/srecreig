<?php
	// session_start();
	require('header.php');
	include('db_connect.php');
	$d=$_GET['dt'];
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/style.css">
	    <?php
	        require('header_link.html');
	    ?>
	    <?php
	        require('header_script.html');
	    ?>
	    <script src="../js/script_gestion-agenda.js"></script>
		<title>Details de  la date : <?php echo $d;?></title>
	</head>
	<body>
		<h1>Gestion de la date : <?php echo $d;?></h1>
		<?php
			$sql="select * from Agenda where dt='$d'";
			$req=$conn->query($sql);
			if($req->rowcount()>0)
			{
				$i=0;
		?>
				<div class="container">
	            <!-- Pour centrer, div de gauche -->
		            <div class="col-md-3">
		            </div>
		            <div class="col-md-6">
				<?php	
					while($data=$req->fetch())
					{
						$mod=1;
						$id=$data['id'];
						$personne=$data['personne'];
						$nomEntreprise=$data['nomEntreprise'];
						$commentaires=$data['commentaires'];
						$module=$data['module'];
						$statut=$data['statut'];
				?>
						<div class="panel panel-primary">
		                    <div class="panel-heading">
		                        <h3 class="panel-title">Tâche n° <?php echo $i+1; ?></h3>
		                    </div>
							<div class="<?php echo $d; ?> panel-body" id="<?php echo $i; ?>">
								<table class="table table-stripped">
								        <tr>
											<td><strong>Personne</strong></td>
											<td><input disabled type="text" name="personne" value="<?php echo $personne;?>"></td>
										</tr>
										<tr>
											<td><strong>Nom Entreprise</strong></td>
											<td><input type="text" name="nomEntreprise" value="<?php echo $nomEntreprise;?>"></td>
										</tr>
										<tr>
											<td><strong>Commentaires</strong></td>
											<td><textarea name="commentaires"><?php echo $commentaires;?></textarea></td>
										</tr>
										<tr>
											<td><strong>Module</strong></td>
											<td><input type="text" name="module" value="<?php echo $module;?>"></td>
										</tr>
										<tr>
											<td><strong>Statut</strong></td>
											<td><input type="text" name="statut" value="<?php echo $statut;?>"></td>
			                                <td><input type='hidden' class="form-control" name='id' value="<?php echo $id;?>"></td>
			                            </tr>
			                            <tr>
			                                <span class="input-group-btn">
			                                	<td><button class="supprimer btn btn-danger btn-responsive">Supprimer</button></td>    
			                                </span>
			                                <span class="input-group-btn">
			                                	<td><button class="modifier btn btn-warning btn-responsive">Modifier</button></td>
			                                </span>
			                                <!-- <?php
												// echo "<input type='hidden' id='sup' name='sup' value='0'><input type='hidden' name='upd' value='$id'></td>";
											?> -->
								        </tr>
								</table>
							</div>
						</div>
					<?php
						$i++;
					}
					?>
	                <button class="nouvelle btn btn-info btn-responsive" name="<?php echo $d;?>">Nouvelle tâche</button>
					</div>
					<div class="col-md-3">
		            </div>
		        </div>
		    <?php
			}
			else
			{
				$mod=0;
				$id="";
				$personne="";
				$nomEntreprise="";
				$commentaires="";
				$module="";
				$statut="";
			?>
				<button class="nouvelle btn btn-info btn-responsive" name="<?php echo $d;?>">Nouvelle tâche</button>
			<?php
			}
			?>
	</body>
</html>
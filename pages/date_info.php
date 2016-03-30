<?php 
	require('db_connect.php'); 
	$d=$_GET['dt']; 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Details de  la date : <?php echo $d;?></title>
	</head>
	<body>
		<h1>Detail de la date : <?php echo $d;?></h1>
		<?php
			$sql="select * from Agenda where dt='$d'";
			$req=$conn->query($sql);
			while($data=$req->fetch())
			{
		?>
		<table>
			<tr>
				<td><strong>Personne</strong></td>
				<td><?php echo $data['personne'];?></td>
			</tr>
			<tr>
				<td><strong>Nom Entreprise</strong></td>
				<td><?php echo $data['nomEntreprise'];?></td>
			</tr>
			<tr>
				<td><strong>Commentaires</strong></td>
				<td><?php echo $data['commentaires'];?></td>
			</tr>
			<tr>
				<td><strong>Module</strong></td>
				<td><?php echo $data['module'];?></td>
			</tr>
			<tr>
				<td><strong>Statut</strong></td>
				<td><?php echo $data['statut'];?></td>
			</tr>
		</table>
		<?php
			}
		?>
	</body>
</html>

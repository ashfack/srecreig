<?php
	session_start();
	include("db_connect.php");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$type= $_POST['type'];
	
	if($type=="upd")
	{	
		$id=$_POST['id'];
		$personne=$_SESSION['id'];
		$nomEntreprise=$_POST['nomEntreprise'];
		$commentaires=$_POST['commentaires'];
		$module=$_POST['module'];
		$statut=$_POST['statut'];
		$dt=$_POST['date'];
		$req = $conn->prepare("UPDATE Agenda SET personne = ?,  dt= ?, nomEntreprise = ?, commentaires= ?, module = ?, statut = ? WHERE id = ? ");
		$req->execute(array($personne,$dt,$nomEntreprise,$commentaires,$module,$statut,$id));
		echo "1";			
	}
	else if ($type=="del")
	{
		$id=$_POST['id'];
		$req = $conn->prepare("DELETE FROM Agenda WHERE id = ? ");
		$req->execute(array($id));
		echo "1";	
	}
	else if($type=="ins")
	{
		$profil= $_POST['profil'];
		$req = $conn->prepare("INSERT INTO Connexion (id,profil) VALUES(?,?) ");
		$req->execute(array($identifiant,$profil));
		echo "1";
	}
	else
	{
		echo "0";
	}
?>
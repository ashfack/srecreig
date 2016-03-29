<?php
	session_start();
	include("db_connect.php");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$type= $_POST['type'];
	$identifiant= $_POST['id'];
	
	if($type=="upd")
	{	
		$profil= $_POST['profil'];
		$req = $conn->prepare("UPDATE Connexion SET profil = ? WHERE id = ? ");
		$req->execute(array($profil,$identifiant));
		echo "1";			
	}
	else if ($type=="del")
	{
		$req = $conn->prepare("DELETE FROM Connexion WHERE id = ? ");
		$req->execute(array($identifiant));
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
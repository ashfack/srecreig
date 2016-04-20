<?php
	session_start();
	include("db_connect.php");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$pseudo= $_POST['pseudo'];
	$mdp= md5($_POST['mdp']);

	$req = $conn->prepare("SELECT * FROM Connexion WHERE id = ? AND pass = ?");
	$req->execute(array($pseudo,$mdp));
	

	if($req->rowcount()==1)
	{
		$membre = $req->fetch(); 
		$_SESSION['id']=$membre['id'];
		$_SESSION['profil']=$membre['profil'];
		echo "1"; // on 'retourne' la valeur 1 au javascript si la connexion est bonne
	}
	else 
	{
		echo "0"; 
	}
?>
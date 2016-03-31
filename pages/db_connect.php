<?php
	try
	{
	//	session_start();
		$servername ="mysql-srecreig.alwaysdata.net";
		$username = "srecreig";
		// $password = "SREPARIS";
		$dbName = "srecreig_base";
		//$conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		$conn = new PDO("mysql:host=$servername;dbname=srecreig_base", $username,'sre@paris13');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
	    // echo "Connection failed: " . $e->getMessage();
	    echo "Impossible de joindre le serveur de la base de données";
	}
?>
<?php
	set_time_limit(300); 
	
	$paths="../files"; // A modifier par rapport au chemin du serveur !!!
	
	if ($_FILES['userfile']['error'] > 0) 
	{
		echo "<p>Erreur lors du transfert</p>";
		exit;
	}
	$filep=$_FILES['userfile']['tmp_name']; // le fichier
	
	// INFORMATIONS SERVEUR FTP
	
	
	$ftp_server= 'ftp-srecreig.alwaysdata.net';	  
	$ftp_user_name='srecreig';  
	$ftp_user_pass='SREPARIS';

	$name=$_FILES['userfile']['name'];
	// To-do : changer le nom de sorte qu'il y ait l'ID (nomEntreprise_conf_nom_fic)
	// Ajouter le nom dans la bdd et faire un hyperlien , alternative, rediriger le client vers la zone de ddl	  
	$prefix=$_POST['nom'];
	$resultat = move_uploaded_file($_FILES['userfile']['tmp_name'],$paths.'/'.$prefix."_".$name);
	if ($resultat) 
	{
		echo "Transfert réussi";
	}
	/*
	$conn_id = ftp_connect($ftp_server);	  
	// login
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);  
	// vérification
	if ((!$conn_id) || (!$login_result)) 
	{
       echo "Problème de connexion au serveur";
       exit;
	}
	*/
	  
	/*
	$upload = ftp_put($conn_id, $paths.'/'.$prefix."_".$name, $filep, FTP_BINARY);
	// résultat de l'uplaod'
	if (!$upload) 
	{
	    echo "Erreur";
	} 
	else 
	{
	    // echo "Le fichier $name à bien été uploadé ";
	    header("Location: rechercher.php");
	}
	*/  
	  
	// pas oublier de fermer la connexion
	// ftp_close($conn_id);
?>
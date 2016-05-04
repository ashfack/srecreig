<?php
	set_time_limit(300); 
	// $paths=$_POST['pathserver']; // chemin vers le dossier d'upload
	$paths="/www/srecreig/files";
	$filep=$_FILES['userfile']['tmp_name']; // le fichier
	$ftp_server= 'ftp-srecreig.alwaysdata.net';	  
	$ftp_user_name='srecreig';  
	$ftp_user_pass='SREPARIS';  
	$name=$_FILES['userfile']['name'];	  
	$conn_id = ftp_connect($ftp_server);	  
	// login
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);  
	// vérification
	if ((!$conn_id) || (!$login_result)) 
	{
       echo "Problème de connexion au serveur";
       exit;
	} 
	else 
	{
	    echo "Connexion établie";
	}
	  
	// upload
	echo $paths.'/'.$name;
	$upload = ftp_put($conn_id, $paths.'/'.$name, $filep, FTP_BINARY);
	  
	// résultat de l'uplaod'
	if (!$upload) 
	{
	    echo "Erreur";
	} 
	else 
	{
	    echo "Le fichier $name à bien été uploadé ";
	}  
	// pas oublier de fermer la connexion
	ftp_close($conn_id);
?>
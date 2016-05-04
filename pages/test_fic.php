<!DOCTYPE html>
<html>

<head>
    <title>Gestion des profils</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../css/style.css">
    <?php
    	require('header_link.html');
    ?>
    <?php
    	require('header_script.html');
    ?>
</head>

<body>
    <?php require('header.php'); ?>

	<form method="post" action="serveur_fic.php" enctype="multipart/form-data">
	    <input type="file" name="userfile" id="userfile" /><br />
	    <input type="submit" name="submit" value="Envoyer" />
	</form>
</body>
</html>	
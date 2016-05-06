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
        <input type="text" name="nom" class="form-control" required="true" placeholder="Nom_Prenom ou NomEntreprise_Annee">
	    <input type="file" name="userfile" id="userfile" /><br />
	    <input type="submit" name="submit" value="Envoyer" />
	</form>
</body>
</html>	
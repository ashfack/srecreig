<!DOCTYPE html>
<html>

<head>
    <title>Upload de fichier</title>
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
    <div class="container">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1 class="text-center">Joindre un fichier </h1><br>
            <center>
        	<form method="post" action="serveur_fic.php" enctype="multipart/form-data">
                <input type="text" name="nom" class="form-control" required="true" placeholder="Nom_Prenom ou NomEntreprise_Annee">
        	    <label for="userfile">Fichier (tous formats | max. 2 Mo) :</label><br />
                <input type="file" name="userfile" id="userfile" /><br />
        	    <input type="submit" name="submit" value="Envoyer" />
        	</form>
            </center>
        </div>
        <div class="col-md-3"></div>
    </div>
</body>
</html>	
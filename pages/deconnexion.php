<?php
session_start();
session_destroy();
session_unset();
?>

<html>
    <head>
        <title>Connexion SRE CREIG</title>
        <meta charset='UTF-8'>
    </head>
    <body>
        <div align="center">
            Vous avez été déconnecté !
            <br/><br/>
            <a href="index.php">Reconnectez-vous</a>
        </div>
        <iframe src="https://cas.univ-paris13.fr/cas/logout" style="margin-left:-500px;" width="0" height="0" ></iframe>
    </body>
</html>
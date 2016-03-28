<?php
session_start();
?>

<html>
    <head>
        <title>Connexion appli SRE CREIG</title>
        <meta charset="UTF-8">
        <noscript>
             Pour accéder à toutes les fonctionnalités de ce site, vous devez activer JavaScript.
             Voici les <a href="http://www.enable-javascript.com/fr/" target="_blank">
             instructions pour activer JavaScript dans votre navigateur Web</a>.
        </noscript>
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/script_connexion.js"></script>
    </head>

    <body id="portail">
        <div id="div0">
            <img src="../img/logoispg.jpg" alt="APPLI CREIG" />
        </div>
        <h1 style="text-align: center"> Bienvenue, connectez vous !</h1>
        <div id="div1">
        	<form name="connexion" id ="Connect">
                <label for="pseudo">Identifiant :</label><input type="text" id="pseudo" required/><br/>
                <label for="mdp">Mot de passe :</label><input type="password" id="mdp" required/><br/>
                <input type="submit" id ="submit" value="Se connecter"> 
        	</form>	
        </div>
    </body>
</html>
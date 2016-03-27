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
    </head>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        $(document).ready( function () { 
            $("#Connect").submit( function() {  
                $.ajax(
                { 
                   type: "POST", 
                   url : "login.php", 
                   data: "pseudo="+$("#pseudo").val()+"&mdp="+$("#mdp").val(), 
                   success: function(msg)
                   { 
                        if(msg==1) //Succes
                        {
                            window.location.replace("rechercher.php");
                        }
                        else // si la connexion en php n'a pas fonctionnée
                        {
                            if (msg!=0)
                                alert('Vous vous êtes trompés'); 
                        }
                   }
                });
                return false;
            });
        });
    </script>

    <body id="portail">
        <div id="div0">
            <img src="http://www.sup-galilee.univ-paris13.fr/templates/jsn_epic_free/images/logoispg.jpg" alt="APPLI CREIG" />
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
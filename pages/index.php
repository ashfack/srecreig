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
        <?php
            require('header_link.html');
        ?>
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
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon">Identifiant</span>
                        <!-- <label for="pseudo">Identifiant :</label> -->
                        <input type="text" class="form-control" placeholder="Identifiant" aria-describedby="sizing-addon1" id="pseudo" required/><br/> 
                        <!-- <label for="mdp">Mot de passe :</label> -->
                        <!-- <input type="password" class="form-control" placeholder="Mot de passe" aria-describedby="sizing-addon1" id="mdp" required/><br/>
                        <input type="submit" id ="submit" value="Se connecter">                               -->
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Mot de passe</span>
                        <!-- <label for="pseudo">Identifiant :</label> -->
                        <!-- <input type="text" class="form-control" placeholder="Identifiant" aria-describedby="sizing-addon1" id="pseudo" required/><br/>  -->
                        <!-- <label for="mdp">Mot de passe :</label> -->
                        <input type="password" class="form-control" placeholder="Mot de passe" aria-describedby="sizing-addon1" id="mdp" required/><br/>
                                                      
                    </div>
                    <input type="submit" id ="submit" value="Se connecter">
                </div>

                
        	</form>	
        </div>
    </body>
</html>
<?php
    session_start();
    if (isset($_SESSION['id']))
    {
        echo 'Vous êtes déja connectez, redirection en cours !';
        echo "Cliquez <a href=\"agenda.php\">ici</a> si vous ne voulez pas attendre."; 
        header('Location: agenda.php');
        exit();
    } 
    // header('Content-Type: text/html; charset=utf-8');
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
        <?php
            require('header_script.html');
        ?>
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/script_connexion.js"></script>
    </head>

    <body id="portail">
            <div class="container">
            <div class="row" id="content">

        <div id="div0" style="text-align: center">
            <img src="../img/logoispg.jpg" alt="APPLI CREIG" />
        </div>
        <center>
        <h1 style="text-align: center"> Bienvenue, connectez vous !</h1>
        <div id="div1">
        	<form name="connexion" id ="Connect">
                <div class="col-md-4"> </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">Identifiant</span>
                        <input type="text" class="form-control" placeholder="Identifiant" aria-describedby="sizing-addon1" id="pseudo" required/>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Mot de passe</span>
                        <input type="password" class="form-control" placeholder="Mot de passe" aria-describedby="sizing-addon1" id="mdp" required/>
                    </div>
                    <input type="submit" class="btn btn-success btn-responsive" id ="submit" value="Se connecter">
                </div>

                
        	</form>	
        </div>
    </center>
    </div>
    </div>

    </body>
</html>
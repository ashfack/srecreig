<?php
    session_start();
    if (isset($_SESSION['id']))
    {
        echo 'Vous êtes déja connectez, redirection en cours !';
        echo "Cliquez <a href=\"rechercher.php\">ici</a> si vous ne voulez pas attendre."; 
        header('Location: rechercher.php');
        exit();
    } 
    // header('Content-Type: text/html; charset=utf-8');
?>

<html>
    <head>
        <title>Connexion SRE CREIG</title>
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
</html
<?php
/*// Démarrage de la session
session_start();

// Test d'existence de la session utilisateur
if (isset($_SESSION['id'])) {
    echo 'Vous êtes déja connectez, redirection en cours !';
    echo "Cliquez <a href=\"rechercher.php\">ici</a> si vous ne voulez pas attendre.";
    header('Location: rechercher.php');
    exit();
}

// La session de l'utilisateur n'existe pas -> interrogation du serveur CAS
include_once '../framework/cas/CAS.php';
//phpCAS::setDebug();
phpCAS::client(CAS_VERSION_2_0, 'cas.univ-paris13.fr', 443, '/cas');
phpCAS::setLang(PHPCAS_LANG_FRENCH);
phpCAS::setNoCasServerValidation();
// Recherche du login de l'utilisateur
phpCAS::forceAuthentication();
$login = phpCAS::getUser();
//echo "login : " . $login;

// Test d'existence de l'utilisateur
require("db_connect.php");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$req = $conn->prepare("SELECT * FROM Connexion WHERE id = ?");
$req->execute(array($login));
if ($req->rowcount() == 1) { 
    // L'utilisateur existe dans la base de données, on lui affecte son profil
    $membre = $req->fetch();
    $_SESSION['id'] = $membre['id'];
    $_SESSION['profil'] = $membre['profil'];
    header('Location: rechercher.php');
} else { 
    // Erreur : l'utilisateur ne figure pas dans la base de données
    echo "<html>
        <head>
        <title>Connexion SRE CREIG</title>
        <meta charset='UTF-8'>
        </head>
        <body>
        Vous n'êtes pas autorisés à vous connecter !
        <body>
        </html>";
}
exit();*/
?>

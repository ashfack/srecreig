<?php
// Démarrage de la session
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
exit();
?>

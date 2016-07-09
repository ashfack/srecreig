<?php
    require("security.php");    
    require("../db_connect.php");
   
    if(isset($_POST['nomEntreprise']))
    {
        $nomEntreprise = $_POST['nomEntreprise'];

        $rep = $conn->prepare("SELECT NAF_codeNAF FROM Entreprise WHERE nomEntreprise=:nomEntreprise");
        $rep->bindValue(':nomEntreprise',trim($nomEntreprise),PDO::PARAM_STR);
        $rep->execute();
        if($donnees = $rep->fetch())
            echo $donnees['NAF_codeNAF'];
        else
            echo "erreur";
    }
    else
        echo "erreur"
?>
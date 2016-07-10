<?php
    require("security.php");    
    require("../db_connect.php");
   
    $tab_donnees=array();
    if(isset($_POST['nomEntreprise']))
    {
        $nomEntreprise=trim($_POST['nomEntreprise']);

        $rep = $conn->prepare("SELECT idAction FROM a_Entreprise_Action join Action on Action_id=idAction WHERE Entreprise_nomEntreprise=:nomEntreprise");
        $rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
        $rep->execute();
        while ($donnees = $rep->fetch())
        {    
            array_push($tab_donnees, $donnees['idAction']);  
        }
    }
    echo json_encode($tab_donnees);
?>

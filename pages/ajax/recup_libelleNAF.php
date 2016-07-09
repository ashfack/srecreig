<?php
    require("security.php");    
    require("../db_connect.php");
   
    $tab_donnees=array();

    $rep = $conn->query("SELECT codeNAF,libelleNAF FROM NAF order by libelleNAF");
    while ($donnees = $rep->fetch())
    {    
        $naf=array('id'=>$donnees['codeNAF'], 'libelle'=>$donnees['libelleNAF']);
        array_push($tab_donnees, $naf);  
    }
    
  
    echo json_encode($tab_donnees);
?>


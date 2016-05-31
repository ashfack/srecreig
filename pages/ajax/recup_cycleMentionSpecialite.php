<?php
    require("security.php");    
    require("../db_connect.php");
    
    $donnees=array();
    /*if(isset($_POST['choixCycleMentionSpecialite']) && $_POST['choixCycleMentionSpecialite']!="")
    {
        $choix=$_POST['choixCycleMentionSpecialite'];
        $rep=$conn->prepare("SELECT DISTINCT $choix FROM CycleFormation WHERE $choix IS NOT NULL");*/
        $rep=$conn->prepare("SELECT DISTINCT cycle FROM CycleFormation");
        $rep->execute();
        while($data=$rep->fetch())
        {
            array_push($donnees, $data["cycle"]);
        }
        
    //}
    
    echo json_encode($donnees);
        
?>
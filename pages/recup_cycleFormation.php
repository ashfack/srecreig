<?php
    
    require'db_connect.php';
    
     $idCycle=array();
    if(isset($_POST['nomEntreprise']) && $_POST['nomEntreprise']!="")
    {
        $nomEntreprise=$_POST['nomEntreprise'];

        $rep=$conn->prepare("SELECT CycleFormation_id FROM a_Entreprise_CycleFormation WHERE Entreprise_nomEntreprise = :nomEntreprise ");
        $rep->bindValue(':nomEntreprise',"$nomEntreprise",PDO::PARAM_STR);
        $rep->execute();
       
        while($data=$rep->fetch())
        {
            //echo "<p> ".$data['CycleFormation_id'];
            array_push($idCycle, $data['CycleFormation_id']);
        }
        
    }
    
    echo json_encode($idCycle);
        
?>

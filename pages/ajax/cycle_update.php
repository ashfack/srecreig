<?php
    require("security.php");    
    require("../db_connect.php");
    
    // nomEntreprise
    
    if(isset($_POST['nomEntreprise'])&&isset($_POST['liste_cycle_id'])) 
    {
        $nomEntreprise  = $_POST['nomEntreprise'];
        $liste_cycle_id = $_POST["liste_cycle_id"];

        $tab_list_cycle = explode(",",$liste_cycle_id);
        $arr_length=count($tab_list_cycle);
        //Suppression des anciens cyles
        try
        {
            $result=$conn->prepare("DELETE from a_Entreprise_CycleFormation WHERE Entreprise_nomEntreprise = upper(?)");
            $result->execute(array($nomEntreprise));    
            // Insertion des cycles
            for($i=0;$i<$arr_length;$i++)
            {
                $result=$conn->prepare("INSERT INTO a_Entreprise_CycleFormation(Entreprise_nomEntreprise,CycleFormation_id) VALUES (upper(?),?)");
                $result->execute(array($nomEntreprise,$tab_list_cycle[$i]));    
            }
            echo "ok";
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
?>

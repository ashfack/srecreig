<?php
    require("security.php");    
    require("../db_connect.php");
    
    $donnees=array();
    if(isset($_POST['select']) && $_POST['select']!="" && isset($_POST['selected']) && $_POST['selected']!="" && isset($_POST['cycleChoisit']) && $_POST['cycleChoisit']!="")
    {
        $select=$_POST['select'];
        $selected=$_POST['selected'];
        $cycleChoisit=$_POST['cycleChoisit'];
        //echo "<p>$select"."_"."$selected</p>";
        $sql="";
        //$tabFormations=array("cycle"=>array("mention","specialite"), "mention"=>array("specialite"));

        if($selected=="cycle")
        {
            $donnees["mention"]=array("Aucune");
            $donnees["specialite"]=array("Aucune");
        }  
        else
        {
            //si c'est cycle qui est selectionné on change mention sinon c'est mention qui est selectionné et donc on change specialite
            $choix=$select=="cycle" ? "mention" : "specialite"; 
            
            if($selected=="mention" || $selected=="Aucune")
            {
               $donnees["specialite"]=array("Aucune");
            }
            else
            {
                $donneesInt=array();
                if($select=="cycle")
                {
                    $donnees["specialite"]=array("Aucune");
                    $sql="SELECT DISTINCT mention FROM CycleFormation WHERE cycle= :cycleChoisit and mention IS NOT NULL ";
                }         
                else
                    $sql="SELECT DISTINCT specialite FROM CycleFormation WHERE mention= :selected and cycle= :cycleChoisit and specialite IS NOT NULL ";
             
                $rep=$conn->prepare($sql);
                if($select!="cycle")
                    $rep->bindValue(':selected',$selected,PDO::PARAM_STR);
                $rep->bindValue(':cycleChoisit',$cycleChoisit,PDO::PARAM_STR);
                $rep->execute();
              
                array_push($donneesInt, "Aucune");
                while($data=$rep->fetch())
                {
                    array_push($donneesInt,$data[$choix]);
                }
                $donnees[$choix]=$donneesInt;  
            }
            
        }

    }
    
    echo json_encode($donnees);
        
?>
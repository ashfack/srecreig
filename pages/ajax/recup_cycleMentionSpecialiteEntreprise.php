<?php
    require("security.php");    
    require("../db_connect.php");
    
    $donnees=array();
    if(isset($_POST['idTA']) && $_POST['idTA']!="")
    {
        $idTA=$_POST['idTA'];
        $rep=$conn->prepare("SELECT cycle,mention,specialite,categorie,montant FROM a_TaxeApprentissage_CycleFormation join CycleFormation on (CycleFormation_id=idCycleFormation) WHERE TaxeApprentissage_id=:idTA");
        $rep->bindValue(':idTA',$idTA,PDO::PARAM_STR);
        $rep->execute();
        $tabFormation=array("cycle","mention","specialite");

        while($data=$rep->fetch())
        {
            for($i=0;$i<3;$i++)
            {
                if(is_null($data[$tabFormation[$i]]))
                    $data[$tabFormation[$i]]="Aucune";  
            }
            
            if(is_null($data["categorie"]))
                $data["categorie"]="A"; //par default
           
            array_push($donnees, array("cycle"=>$data["cycle"], "mention"=>$data["mention"],"specialite"=>$data["specialite"],"categorie"=>$data["categorie"],"montant"=>$data["montant"]));
        }
        
    }
    
    echo json_encode($donnees);
        
?>
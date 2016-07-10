<?php
    require("security.php");    
    require("../db_connect.php");

    function verifTableauInt($tab)
    {
        $all_numeric = true;
        foreach ($tab as $key) 
        { 
            if (!(is_numeric($key))) {
                $all_numeric = false;
                break;
            } 
        }

        return $all_numeric;
    }

  	
    if(isset($_POST['nomEntreprise']) && isset($_POST['donnees']) && verifTableauInt($_POST['donnees']))
    {
        
        $donnees=$_POST['donnees'];
        $nomEntreprise=$_POST['nomEntreprise'];
        $presenceDonnees=(count($donnees)>0) ? true : false;

        //que le tableau soit vide ou non on supprime
        $sql="DELETE FROM a_Entreprise_Action WHERE Entreprise_nomEntreprise = :nomEntreprise; ";

        if($presenceDonnees)
        {
            $sql.="INSERT INTO a_Entreprise_Action VALUES ";
            for($i=0;$i<count($donnees);$i++)
            {
                $sql.="( :nomEntreprise, :donnee".$i." ),";
            }
            $sql=rtrim($sql, ',');
        }
        //echo $sql;
        $rep=$conn->prepare($sql);

        $rep->bindValue(':nomEntreprise',$nomEntreprise,PDO::PARAM_STR);
        if($presenceDonnees)
        {
            for($j=0;$j<count($donnees);$j++)
            {
                $rep->bindValue(':donnee'.$j,$donnees[$j],PDO::PARAM_INT);
            }
        }

        if($rep->execute())
            echo "ok";
        else
            echo "erreur";
    }
    else
    {
        echo "erreur";
    }
        
?>
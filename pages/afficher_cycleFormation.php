<?php
    
    require'db_connect.php';
    
    if(isset($_POST['nomEntreprise']) && $_POST['nomEntreprise']!="")
    {
        $nomEntreprise=$_POST['nomEntreprise'];
        $rep=$conn->prepare("DELETE FROM Entreprise where nomEntreprise = :nomEntreprise ");
        $rep->bindValue(':nomEntreprise',"$nomEntreprise",PDO::PARAM_STR);
      
        if($rep->execute())
        {
            echo "ok";
        }
        else
        {
            echo "erreur suppression";
        }
    }
    else
    {
        echo "erreur";
    }
        
        
?>

<?php
    
    require'db_connect.php';
    
    if(isset($_POST['nomEntreprise']))
    {
        $nomEntreprise=$_POST['nomEntreprise'];
        $nb=$conn->exec("DELETE FROM Entreprise where nomEntreprise ='$nomEntreprise' ");
        
        if($nb==1)
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

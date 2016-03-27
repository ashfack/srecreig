<?php
    
    require'db_connect.php';
    
    $nomEntreprise=$_POST['nomEntreprise'];
    $nb=$conn->exec("DELETE FROM entreprise where nomEntreprise ='$nomEntreprise' ");
    
    if($nb==1)
    {
        echo "ok";
    }
    else
    {
        echo "erreur";
    }
?>

<?php
    
    require'db_connect.php';
    
	
	
    if(isset($_POST['nomEntreprise']) && $_POST['nomEntreprise']!="")
    {
        $nomEntreprise=$_POST['nomEntreprise'];
		$groupe=$_POST['groupe'];
		$adresse=$_POST['adresse'];
		$complementAdresse=$_POST['complementAdresse'];
		$codePostal=$_POST['codePostal'];
		$ville=$_POST['ville'];
		$commentaires=$_POST['commentaires'];
		
		$req = $conn->prepare("UPDATE Entreprise  SET 
												groupe= ?,
												adresse= ?,
												complementAdresse= ?,
												codePostal= ?,
												ville= ?,
												commentairesEntreprise= ?
												where nomEntreprise = ? ");
		
		
	   /* $rep=$conn->prepare("UPDATE Entreprise SET 
												groupe='".addslashes($groupe)."',
												adresse='".addslashes($adresse)."',
												complementAdresse='".addslashes($complementAdresse)."',
												codePostal='".addslashes($codePostal)."',
												ville='".addslashes($ville)."'
												where nomEntreprise = :nomEntreprise ");
        $rep->bindValue(':nomEntreprise',"$nomEntreprise",PDO::PARAM_STR);*/
      
        if($req->execute(array($groupe,$adresse,$complementAdresse,$codePostal,$ville,$commentaires,$nomEntreprise)))
        {
            echo "ok";
        }
        else
        {
            echo "erreur edition";
        }
    }
    else
    {
        echo "erreur";
    }
        
?>
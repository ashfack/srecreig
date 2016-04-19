<?php
    
    require'db_connect.php';

    function colonne_null(&$tab_donnees)
    {
        foreach ($tab_donnees as $key => $value) 
        {
            if(is_null($value))
                $tab_donnees[$key]="";
        }
    }

    $tab_donnees=array();
    
    if(isset($_POST['choix_entreprise']) && $_POST['choix_entreprise']!="")
    {
        $nomEntreprise=$_POST['choix_entreprise'];
        $rep = $conn->prepare("SELECT * FROM Entreprise where nomEntreprise LIKE :nomEntreprise");
        $rep->bindValue(':nomEntreprise',"%$nomEntreprise%",PDO::PARAM_STR);
        $rep->execute();
        while ($donnees = $rep->fetch())
        {
            colonne_null($donnees);
            $entreprise=array('nomEntreprise' => $donnees['nomEntreprise'],'groupe'=> $donnees['groupe'],
                'adresse'=>$donnees['adresse'],'complementAdresse'=>$donnees['complementAdresse'],
                'codePostal'=>$donnees['codePostal'],'ville'=>$donnees['ville'],'commentairesEntreprise'=> $donnees['commentairesEntreprise']);
            array_push($tab_donnees, $entreprise);  
        }
    }
  
    echo json_encode($tab_donnees);
?>


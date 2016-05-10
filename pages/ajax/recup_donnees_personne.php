<?php
    require("security.php");    
    require("../db_connect.php");
    function colonne_null(&$tab_donnees)
    {
        foreach ($tab_donnees as $key => $value) 
        {
            if(is_null($value))
                $tab_donnees[$key]="";
        }
    }

    $tab_donnees=array();
    
    if(isset($_POST['nom']&&$_POST['prenom']) 
    {
       
        $nomAlternant=$_POST['choix_alternant'];
      
        $rep = $conn->prepare("SELECT idCoordonneesPersonne,nom, prenom,fonction FROM CoordonneesPersonne where (nom LIKE ?) and (prenom LIKE ?)");
        $rep->execute(array($_POST['nom'],$_POST['prenom']));
        while ($donnees = $rep->fetch())
        {
        
            colonne_null($donnees);       
            $personne=array('idCoordonneesPersonne' => $donnees['idCoordonneesPersonne'],
                            'nom' => $donnees['nom'],'prenom'=> $donnees['prenom'],
                            'fonction'=>$donnees['fonction']);
            array_push($tab_donnees, $personne);  
        }
    }
    echo json_encode($tab_donnees);
?>

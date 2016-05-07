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
    
    if(isset($_POST['choix_alternant']) && $_POST['choix_alternant']!="")
    {
       
        $nomAlternant=$_POST['choix_alternant'];
      
        $rep = $conn->prepare("SELECT a.Entreprise_nomEntreprise,cp.civilite,cp.nom,cp.prenom,cp.mail,cp.telephoneMobile,a.typeContrat,a.formationAlternance".
            " FROM Alternance a left join CoordonneesPersonne cp on (a.CoordonneesPersonne_alternant=cp.idCoordonneesPersonne) where (cp.nom LIKE :nomAlternant) or (cp.prenom LIKE :nomAlternant)");
        $rep->bindValue(':nomAlternant',"%$nomAlternant%",PDO::PARAM_STR);
        $rep->execute();
        while ($donnees = $rep->fetch())
        {
        
            colonne_null($donnees);       
            $entreprise=array('Entreprise_nomEntreprise' => $donnees['Entreprise_nomEntreprise'],'civilite'=> $donnees['civilite'],
                'nom'=>$donnees['nom'],'prenom'=>$donnees['prenom'],
                'mail'=>$donnees['mail'],'telephoneMobile'=>$donnees['telephoneMobile'],'typeContrat'=> $donnees['typeContrat'],'formationAlternance'=> $donnees['formationAlternance']);
            array_push($tab_donnees, $entreprise);  
        }
    }
  
    echo json_encode($tab_donnees);
?>


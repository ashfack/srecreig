<?php
    
    require'db_connect.php';
    $tab_donnees=array();
    
    if(isset($_POST['choix_alternant']) && $_POST['choix_alternant']!="")
    {
        $nomEntreprise=$_POST['choix_alternant'];
        $rep = $conn->prepare("SELECT a.Entreprise_nomEntreprise,cp.civilite,cp.nom,cp.prenom,cp.mail,a.anneeEntree,a.typeContrat,a.formationAlternance".
            "FROM Alternance a left join CoordonneesPersonne cp on a.CoordonneesPersonne_alternant=cp.idCoordonneesPersonne where cp.nom LIKE :nomAlternant or cp.prenom LIKE :nomAlternant");
        $rep->bindValue(':nomAlternant',"%$nomAlternant%",PDO::PARAM_STR);
        $rep->execute();
        while ($donnees = $rep->fetch())
        {
            $entreprise=array('Entreprise_nomEntreprise' => $donnees['Entreprise_nomEntreprise'],'civilite'=> $donnees['civilite'],
                'nom'=>$donnees['nom'],'prenom'=>$donnees['prenom'],
                'mail'=>$donnees['mail'],'anneeEntree'=>$donnees['anneeEntree'],'typeContrat'=> $donnees['typeContrat'],'formationAlternance'=> $donnees['formationAlternance']);
            array_push($tab_donnees, $entreprise);  
        }
    }
  
    echo json_encode($tab_donnees);
?>


<?php
    
    require'db_connect.php';
    $tab_donnees=array();
    
    $nomEntreprise=$_POST['choix_entreprise'];
    $req = $conn->query("SELECT * FROM entreprise where nomEntreprise LIKE '%$nomEntreprise%' ");
    
    while ($donnees = $req->fetch())
    {
        $entreprise=array('nomEntreprise' => $donnees['nomEntreprise'],'groupe'=> $donnees['groupe'],
            'adresse'=>$donnees['adresse'],'complementAdresse'=>$donnees['complementAdresse'],
            'codePostal'=>$donnees['codePostal'],'ville'=>$donnees['ville'],'commentaires'=> $donnees['commentaires']);
        array_push($tab_donnees, $entreprise);  
    }
   
    echo json_encode($tab_donnees);
?>

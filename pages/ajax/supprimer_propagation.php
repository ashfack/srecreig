<?php
    
    require'../db_connect.php';
    
    if(isset($_POST['nomEntreprise']) && isset($_POST['table'])  && isset($_POST['niveau']) && isset($_POST['donnees'])  )
    {
        if($_POST['nomEntreprise']!="" && $_POST['table']!="" && $_POST['niveau']!="" && $_POST['donnees']!="")
        {
            $nomEntreprise=$_POST['nomEntreprise'];
            $table=$_POST['table'];

            $donnees=$_POST['donnees'];
            $niveau=$_POST['niveau'];
            //echo "<p> $nomEntreprise $table $niveau </p>";
            //print_r($donnees);
      

           $tabCorrespondanceColonnes=array("EntrepriseNiveau1"=>array("nomEntreprise"),
                                                "CoordonneesPersonneNiveau1"=>array("Entreprise_nomEntreprise","CoordonneesPersonne_id"),
                                                "AlternanceNiveau1"=>array("Entreprise_nomEntreprise","CoordonneesPersonne_alternant"),
                                                "TaxeApprentissageNiveau1"=>array("idTA"),
                                                "AtelierRHNiveau1"=>array("idAtelierRH"),
                                                "AtelierRHNiveau2"=>array("AtelierRH_id","CoordonneesPersonne_id"),
                                                "ConferenceNiveau1"=>array("idConference"),
                                                "ConferenceNiveau2"=>array("Conference_id","CoordonneesPersonne_id"),
                                                "ForumSGNiveau1"=>array("Entreprise_nomEntreprise","anneeDeParticipation")
                                                );


           $tabCorrespondanceTables=array("EntrepriseNiveau1"=>"Entreprise",
                                            "CoordonneesPersonneNiveau1"=>"a_Entreprise_CoordonneesPersonne",
                                            "AlternanceNiveau1"=>"Alternance",
                                            "TaxeApprentissageNiveau1"=>"TaxeApprentissage",
                                            "AtelierRHNiveau1"=>"AtelierRH",
                                            "AtelierRHNiveau2"=>"a_AtelierRH_CoordonneesPersonne",
                                            "ConferenceNiveau1"=>"Conference",
                                            "ConferenceNiveau2"=>"a_Conference_CoordonneesPersonne",
                                            "ForumSGNiveau1"=>"ForumSG"
                                            );
            $sql;
            $rep;
            $deuxColonnes=false;

            if($table=="Alternance" && ($niveau==3 || $niveau==4))
            {
                $colonne=($niveau==3) ? "CoordonneesPersonne_maitre" : "CoordonneesPersonne_RH";
                $sql="UPDATE Alternance SET $colonne = NULL WHERE CoordonneesPersonne_alternant= :donnee1 and $colonne= :donnee2";
                $deuxColonnes=true;
            }
            else
            {
                $cle=$table."Niveau".$niveau;
                
                $sql="DELETE FROM ".$tabCorrespondanceTables[$cle]." WHERE ".$tabCorrespondanceColonnes[$cle][0]." = :donnee1";
                if(count($tabCorrespondanceColonnes[$cle])==2)
                {
                    $sql.=" and ".$tabCorrespondanceColonnes[$cle][1]." = :donnee2";
                    $deuxColonnes=true;
                }

                    
            }
       
            $rep=$conn->prepare($sql);
            $rep->bindValue(':donnee1',trim($donnees[0]),PDO::PARAM_STR);
            if($deuxColonnes)
                $rep->bindValue(':donnee2',trim($donnees[1]),PDO::PARAM_INT);

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
            echo "erreur";
    }
    else
        echo "erreur";

        
        
?>
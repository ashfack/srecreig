<!DOCTYPE html>
<html>
   <head>
      <title>Exporter avec critères </title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css" />
      <?php
         require('header_link.html');
         require('header_script.html');
         require "db_connect.php";
         
         ?>
   </head>
   <body>
      <?php require('header.php');  ?>
      <div class="container">
      <h1 class="text-center"> Exporter avec sélection de critères </h1>
      <div class="col-md-4"> 
      </div>
      <div class="panel panel-primary">
      <div class="panel-heading">
         <h3 class="panel-title text-center">Choix des critères </h3>
      </div>
      <div class="panel-body">
         </br>
               <div class="col-md-4"> 
      </div>
      <div class="col-md-4"> 
      
            <?php 
               require("db_connect.php");   
               $table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
               $table_array= array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
               echo " <div id=\"jstree\">";
               
               for($i=0;$i<count($table_array);$i++)
               {
               $sql = "Describe ".$table_array[$i]."";
               try
               {
                  $rep=$conn->query($sql); 
               }
                catch(PDOException $e)
                {
                  // echo "Incident: " . $e->getMessage();
                  echo "Impossible de joindre le serveur de base de données";
                }  
                 echo " <ul > 
                           <li data-jstree='{\"icon\":\"glyphicon glyphicon-folder-open\"}'>".$table_array[$i]." 
                             <ul>  ";
                                while( $row = $rep->fetch()) 
                             {
                              echo " <li data-jstree='{\"icon\":\"glyphicon glyphicon-file\"}'>           ";                      
                              echo $row['Field'] ;  
                            }
                            echo"
                               </li>        
                             </ul>      
                           </li>    
                         </ul>  
                        ";        
                }
                echo"     </div> ";                             
              ?>
                
                  <div class="col-md-4">  </div>
                  <div class="col-md-12">
                     <div class="col-md-5">  
                     </div>
                     <p>
                     </br>
                        <input type="submit" value="Envoyer" />
                     </p>
                  </div>


  <?php 

      require "db_connect.php";
      require "utilities.php";
      if(isset($_GET['nomEntreprise']) && $_GET['nomEntreprise']!="")
      {
          $nomEntreprise=$_GET['nomEntreprise'];
    ?>

    <h1> Informations concernant l'entreprise:  <span> <?php echo $nomEntreprise; ?> </span> </h1>
    
    <div id="tabs">
      <ul> 
        <?php 
          $table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
        $table_array= array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
        for($i=0;$i<count($table_array);$i++)
        {
          echo "<li> <a href=\"#menu_".$table_array[$i]."\">".$table_onglet_array[$i]."</a> </li>";
        }
        echo "</ul>";

        
        // faut ajouter la formation, orgine , action mené et naf  !
        $tab_niveaux_Entreprise=array("niveau1"=>array("nomEntreprise","groupe","adresse","complementAdresse","codePostal","ville","pays","commentairesEntreprise"),
              "niveau2" => array("nomEntreprise","numeroSIRET","NAF_codeNAF","origine","typeContact","partenariatOfficiel","taille","alias"));


        $tab_niveaux_CoordonneesPersonne=array("niveau1"=>array("idCoordonneesPersonne","civilite","nom","prenom","fonction","telephoneFixe","telephoneMobile",
                          "mail","commentaires"));

    

        $tab_niveaux_Alternance=array("niveau1"=>array("formationAlternance","anneeEntree","typeContrat","CoordonneesPersonne_alternant"),
                        "niveau2"=>array("CoordonneesPersonne_alternant","dateRVpreparation","dateRVsimulation","dateDebutContrat","dateFinContrat","dateEnvoiFLAuCFA","docAAttacher"),
                        "niveau3"=>array("CoordonneesPersonne_alternant","CoordonneesPersonne_maitre"),
                        "niveau4"=>array("CoordonneesPersonne_alternant","CoordonneesPersonne_maitre"));

    

        $tab_niveaux_TaxeApprentissage=array("niveau1"=>array("idTA","anneedeVersement","montantPromesseVersement","montantVerse","versementVia","rapprochementAC"),
                          "niveau2"=>array("idTA","OCTA","dateEnregistrement","dateDerniereModification","modePaiement","dateTransmissionCheque","commentairesTaxe"));

        

        $tab_niveaux_AtelierRH=array("niveau1"=>array("dateAtelier","creneauAtelier","CoordonneesPersonne_RH","commentairesAtelier"));

    

        $tab_niveaux_Conference=array("niveau1"=>array("typeConference","dateConference","heureDebut","heureFin","lieuConference","themeConference"),
                        "niveau2"=>array("CoordonneesPersonne_conferencier","commentairesConference")); 

    

        $tab_niveaux_ForumSG=array("niveau1"=>array("Entreprise_nomEntreprise","anneeDeParticipation","questionDeSatisfaction","commentairesForum"));

        $pk=array("nomEntreprise","idCoordonneesPersonne","CoordonneesPersonne_alternant","idTA","idAtelierRH","idConference","Entreprise_nomEntreprise");
        $niveaux=array($tab_niveaux_Entreprise,$tab_niveaux_CoordonneesPersonne,$tab_niveaux_Alternance,$tab_niveaux_TaxeApprentissage,$tab_niveaux_AtelierRH,$tab_niveaux_Conference,$tab_niveaux_ForumSG);

        for($i=0;$i<count($table_array);$i++)
        {
          
          genererDataTable($table_array[$i],$nomEntreprise,$pk[$i],$niveaux[$i]);
        } 
      ?>

      <?php
        }
        else
          echo "Erreur table ";
      ?>
    </div>
                  </div>
      <div class="col-md-4"> 
      </div>

   </body>
</html>
<script src="../js/jquery.min.js"></script>
<script src="../framework/jsTree/dist/jstree.min.js"></script>
<script>
   $(function () {
     $('#jstree')

     .on("changed.jstree", function (e, data) {
       console.log(data.selected);
     })   

     .jstree({  
      
       types : {
       "default" : {
         "icon" : "glyphicon glyphicon-flash"
       }
    }, 
       plugins : [ 'wholerow', 'checkbox', 'types' ]
     })
 });

</script>
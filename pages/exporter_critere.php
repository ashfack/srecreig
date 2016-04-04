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
      <h1 class="text-center"> Exporter avec séléction de critères </h1>
      <div class="col-md-4"> 
      </div>
      <div class="col-md-4">
      <div class="panel panel-primary">
      <div class="panel-heading">
         <h3 class="panel-title text-center">Choix des critères </h3>
      </div>
      <div class="panel-body">
         </br>
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
         </div>
      </div>
      <div class="col-md-4"> 
      </div>
      <div class="col-md-12">
         <div class="col-md-6"> 
         </div>
         <div class="col-md-6">
            <p>
               <br/>
               <input type="submit" value="Envoyer" />
               <input type="reset" value="Annuler" />
            </p>
         </div>
      </div>
   </body>
</html>
<script src="../js/jquery.min.js"></script>
<script src="../framework/jsTree/dist/jstree.min.js"></script>
<script>
   $(function () {
     $('#jstree').jstree({  
       "plugins" : [ "wholerow", "checkbox", "types" ]
     });
   
     $('#jstree').on("changed.jstree", function (e, data) {
       console.log(data.selected);
     });
   
   
     $("#plugins1").jstree({
       "checkbox" : {
         "keep_selected_style" : false
         }
     });
         $("#plugins7").jstree({
     "types" : {
       "default" : {
         "icon" : "glyphicon glyphicon-flash"
       },
       "child_node_1" : {
         "icon" : "glyphicon glyphicon-ok"
       }
     }
   });
   });
   
</script>
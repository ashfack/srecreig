<!DOCTYPE html>
<html>
<head>
  <title>Exporter avec critères</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css" />
  <?php
    require('header_link.html');
    require('header_script.html');
  ?>
</head>
<script src="../js/script_ajax_export.js"></script>

<body>
  <?php require('header.php');  ?>
  <div class="container">
    <h1 class="text-center">Exporter avec sélection de critères</h1>
    <div class="col-md-4"></div>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Choix des critères</h3>
      </div>
      <div class="panel-body">
        <br>
        <div class="col-md-4"></div>
        <div class="col-md-4">

          <?php 
      require("db_connect.php");   
      $table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
      $table_array= array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
      echo " <div id=\"jstree\">
          ";
      
      for($i=0;$i
          <count($table_array);$i++)
      {
       $sql = "Describe ".$table_array[$i]."";
       try
       {
        $rep=$conn->
            query($sql); 
      }
      catch(PDOException $e)
      {
                  // echo "Incident: " . $e->getMessage();
        echo "Impossible de joindre le serveur de base de données";
      }  
      echo "
            <ul >
              <li data-jstree='{\"icon\":\"glyphicon glyphicon-folder-open\"}' id =".$table_array[$i]." >
                ".$table_onglet_array[$i]."
                <ul>
                  ";
        while( $row = $rep->fetch()) 
        {
          echo "
                  <li data-jstree='{\"icon\":\"glyphicon glyphicon-file\"}'    id=".$table_array[$i].".".$row['Field'].">
                    ";                      
          echo $row['Field'];  
        }
        echo"
                  </li>
                </ul>
              </li>
            </ul>
            ";        
}
echo"
          </div>
          ";                             
?>
          <div class="col-md-4"></div>
          <div class="col-md-12">
            <p>
              <br>
              <input type="button" value="Rechercher" id="bRechercher"/>
            </p>
          </div>

          <div class="col-md-4"></div>
        </div>
      </div>
    </div>

    <div class="col-md-4"></div>
    <div class="col-md-4">
        <input placeholder="Entreprise" type="text" id="choix_entreprise" name="choix_entreprise"/>

    </div>
    <div class="col-md-4"></div>
    <!-- </form>
    -->
    <div id="div_datatable"></div>

    <div id="dialog_supprimer_confirmation" title="Confirmation !">
      <p>
        Vous avez allez supprimer l'entreprise
        <span id="emplacement_supprimer_nomEntreprise"></span>
        et toutes les données qui lui sont liées (Contacts, alternants, taxe d'apprentissage...)
        <br/>
        Etes vous sûr de vouloir continuer ?
      </p>
    </div>

    <div id="dialog_refus"  title="Refus">
      <p>Vous devez selectionner une entreprise</p>
    </div>

    <div id="dialog_aucune_entreprise"  title="Aucune entreprise !">
      <p>Aucune entreprise ne répond au nom que vous avez entré !</p>
    </div>
  </div>






</body>
</html>
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
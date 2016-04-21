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
<script type="text/javascript" src="../framework/tableExport/tableExport.js"></script>
<script type="text/javascript" src="../framework/tableExport/jquery.base64.js"></script>
<script type="text/javascript" src="../framework/tableExport/html2canvas.js"></script>
<script type="text/javascript" src="../framework/tableExport/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="../framework/tableExport/jspdf/jspdf.js"></script>
<script type="text/javascript" src="../framework/tableExport/jspdf/libs/base64.js"></script>


<body>
  <?php require('header.php');  ?>
  <div class="container">
    <h1 class="text-center">Exporter avec sélection de champs</h1>
    <div class="col-md-4"></div>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Choix des champs</h3>
      </div>
      <div class="panel-body">
        <br>
        <div class="col-md-4"></div>
        <div class="col-md-4">

          <?php 
      require("db_connect.php");   
      $table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
      $table_array= array("Entreprise","Contact","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
      echo " <div id=\"jsTree\"> ";
      
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
  
   <li data-jstree='{\"icon\":\"glyphicon glyphicon-folder-open\"}' id =".$table_array[$i]." >   ".$table_onglet_array[$i]."  <ul>
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
                  <div class="col-md-4">
        <div class="btn-group">
              <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
              <ul class="dropdown-menu " role="menu">

                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'excel',escape:'false'});"> <img src='../img/xls.png' width='24px'> XLS</a></li>

              </ul>
            </div>                

    </div>
            </p>
          </div>

          <div class="col-md-4"></div>
        </div>
      </div>
    </div>

    <div class="col-md-4"></div>

    <div class="col-md-4"></div>
    <!-- </form>
    -->
    <div id="div_datatable"></div>



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
     checkbox: {

          rules:{
            multiple : false
          } 

     },
     plugins : [ 'wholerow', 'checkbox', 'types' ]
   })
 });

</script>
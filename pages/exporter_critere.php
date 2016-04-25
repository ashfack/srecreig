<!DOCTYPE html>
<html>
<head>
  <title>Exporter</title>
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
      $table_array= array("vueEntreprise","vueContact","vueAlternance","vueTaxeApprentissage","vueAtelierRH","vueConference","vueForumSG");
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
                  <div class="col-md-4">
        <div class="btn-group">
              <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
              <ul class="dropdown-menu " role="menu">
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'csv',escape:'false'});"> <img src='icons/csv.png' width='24px'> CSV</a></li>
                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'txt',escape:'false'});"> <img src='icons/txt.png' width='24px'> TXT</a></li>
                <li class="divider"></li>       
                
                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'excel',escape:'false'});"> <img src='icons/xls.png' width='24px'> XLS</a></li>
                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'doc',escape:'false'});"> <img src='icons/word.png' width='24px'> Word</a></li>
                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'powerpoint',escape:'false'});"> <img src='icons/ppt.png' width='24px'> PowerPoint</a></li>
                <li class="divider"></li>
                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'png',escape:'false'});"> <img src='icons/png.png' width='24px'> PNG</a></li>
                <li><a href="#" onClick ="$('#div_datatable').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src='icons/pdf.png' width='24px'> PDF</a></li>
                
                
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

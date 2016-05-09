<!DOCTYPE html>
<html>
<head>
  <title>Exporter</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css">

  <?php
  require('header_link.html');
  require('header_script.html');
  ?>
  <script src="../js/script_ajax_export.js" ></script>


</head>
<body >
  <div class="se-pre-con">
    <?php require('header.php');  ?>
  </div>
  <?php require('header.php');  ?>

  <div class="container">
    <?php
    if($_SESSION['profil']=='super')
    {
      ?>  
      <h1 class="text-center">Exporter</h1>
      <div class="col-md-3"></div>
      <div class="col-md-6">

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title text-center">Choix des champs</h4>
          </div>
          <div class="panel-body">
            <br>
            <div class="col-md-4"></div>
            <?php 
            require("db_connect.php");   
            $table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
            $table_array= array("vueEntreprise","vueContact","vueAlternance","vueTaxeApprentissage","vueAtelierRh","vueConference","vueForumSG");
            echo " <div id=\"jstree\">
            ";

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
              echo "Impossible d'accéder aux vues";
            }  
            echo "
            <ul >
            <li class = \"tableExport\" data-jstree='{\"icon\":\"glyphicon glyphicon-folder-open\"}' id =".$table_array[$i]." >
            ".$table_onglet_array[$i]."
            <ul>
            ";
            while( $row = $rep->fetch()) 
            {
          //echo $row['Field'];
          //echo " = " ; 
              $sql4 = "Select nomCorrespondant FROM CorrespondanceNom where nomSql = '".$row['Field']."' ";
              $stmt = $conn->prepare($sql4);
          //echo "Requete = ".$sql4 ;
              $stmt->execute();

              $row3 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT) ; 
              $data = $row3[0] ;

              echo "
              <li data-jstree='{\"icon\":\"glyphicon glyphicon-file\"}'    id=".$table_array[$i].".".$row['Field'].">
              ";           print $data;

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
              <?php
    if($_SESSION['profil']=='super') {   ?>  
          <div class="col-md-12">
            <center>
              <p>
                <br>
                <input type="button" value="Rechercher" id="bRechercher"/>
                  <div class="btn-group">
                    <button id="bExport" class="btn btn-sm dropdown-toggle" onclick="tablesToExcel(['datatable_entreprise'], ['Export'], 'Export.xls', 'Excel')"  data-toggle="dropdown"><i class="fa fa-bars"></i> Exporter la table</button>
                    </ul>
                </div>
              </center>
            </p>
          </div>
    <?php  } ?>  
          <div class="col-md-4"></div>
        </div>
      </div>
    </div>


    <div class="col-md-3"></div>
    <!-- </form>
  -->
  <div id="div_datatable"></div>
  </div>
  <?php
}     
else {
  echo "Vous n'avez pas les droits ! " ;
}
?>  

</body>
</html>
<!-- JQUERY DATATABLE CSS -->
<link href="../css/jquery.dataTables.min.css" rel="stylesheet">
<script src="../framework/jsTree/dist/jstree.min.js" ></script>
  <script type="text/javascript" src="../js/export_zip.js"></script>

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

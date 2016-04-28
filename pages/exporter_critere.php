<!DOCTYPE html>
<html>
<head>
  <title>Exporter</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/style.css">
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
    <h1 class="text-center">Exporter</h1>
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Choix des champs</h3>
      </div>
      <div class="panel-body">
      <?php 
      require("db_connect.php");   
      $table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
      $table_array= array("vueEntreprise","vueContact","vueAlternance","vueTaxeApprentissage","vueAtelierRh","vueConference","vueForumSG");
      echo " <div style=\"margin-left:60px\" id=\"choixTable\">";
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
      echo " <ul >
      <input type=\"radio\" name=\"iCheck\" id =\"radio".$table_array[$i]."\"> ".$table_onglet_array[$i]."
            </ul>
            ";        
}
echo"</div>";                             
?>

      <?php 
      require("db_connect.php");   
      $table_onglet_array=array("Entreprise","Contacts","Alternance","Taxe d'apprentissage","Atelier RH","Conference","Forum SG");
      $table_array= array("vueEntreprise","vueContact","vueAlternance","vueTaxeApprentissage","vueAtelierRh","vueConference","vueForumSG");
      echo " <div id=\"choixChamps\">";
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
      echo "<div class =\"Choix\" id = \"nomTableChoix".$table_array[$i]."\" ><input type=\"radio\" name=\"iCheck\" id =\"radio".$table_array[$i]."\"> ".$table_onglet_array[$i]."
             <div id =Champs.".$table_array[$i]." style=\"margin-left:60px\" > <ul>";
        while( $row = $rep->fetch()) 
        {
          $sql4 = "Select nomCorrespondant FROM CorrespondanceNom where nomSql = '".$row['Field']."' ";
          $stmt = $conn->prepare($sql4);
          $stmt->execute();
           $row3 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT) ; 
  
          echo "       <div class=\"checkbox\"><input type=\"checkbox\" id=".$table_array[$i].".".$row['Field'].">  ".$row3[0]."</div>";           
        }
        echo"
          </ul>  </div>  </div>" ;        
}
echo"</div>";                             
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


    <div class="col-md-3"></div>
    <!-- </form>
    -->
    <div id="div_datatable"></div>


</body>
</html>

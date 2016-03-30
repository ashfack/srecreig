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
      ?>
   </head>
   <body>
      <?php require('header.php');  ?>
      <div class="container">
	      <div class="row" id="content">
		      <h1 class="text-center"> Exporter avec séléction de critères </h1>
		      <div class="panel panel-primary">
			      <div class="panel-heading">
			         <h3 class="panel-title text-center">Choix des critères </h3>
			      </div>

			         <div class="panel-body">
			            </br>
			            <div class="col-md-4"> 

  <div id="jstree">
    <!-- in this example the tree is populated from inline HTML -->
    <ul >
      <li data-jstree='{"icon":"glyphicon glyphicon-folder-open"}'>Entreprise
  <ul>
    <li data-jstree='{"icon":"glyphicon glyphicon-file"}'>
      Nom</li>
    <li data-jstree='{"icon":"glyphicon glyphicon-leaf"}'>
      Groupe</li>
  </ul>
</li>
      <li data-jstree='{"icon":"glyphicon glyphicon-flash"}'>Contact
        <ul>
          <li id="child_node_1"> Nom    
</li>
          <li>Prénom</li>
        </ul>
          <li>Alternance</li>
        </ul>
      </li>
    </ul>

  </div>

  <!-- 4 include the jQuery library -->
<script src="../js/jquery.min.js"></script>
  <!-- 5 include the minified jstree source -->
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

<div class="checkbox" name="champsSelected" id="champsSelected">
 
  <h3>Champs a exporter
  </h3></br>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="entreprise">
Entreprise
  </label>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="nameContact">
Nom Contact
  </label>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="Montant">
Montant Taxe
  </label>
</div>




			            </div>
			            <div class="col-md-4"> 
<div class="checkbox" name="champsSelected" id="champsSelected">
  <h3>Conditions
  </h3></br>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="entreprise">
>
  </label>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="nameContact">
<
  </label>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="Montant">
=
  </label>
</div>
			            </div>
			            <div class="col-md-4"> 
<div class="checkbox" name="champsSelected" id="champsSelected">
  <h3>Valeurs
  </h3></br>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="entreprise">
100
  </label>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="nameContact">
200
  </label>
</div>
<div class="checkbox" name="champsSelected" id="champsSelected">
  <label>
    <input type="checkbox" value="Montant">
300
  </label>
</div>
					   </div>			        

			   </div>
		   </div>
      </div>
                     <div class="col-md-12">
                        <div class="col-md-5">	
                        </div>
                        <p>
                           <input type="submit" value="Envoyer" />
                           <input type="reset" value="Annuler" />
                        </p>
                     </div>



    </body>
</html>

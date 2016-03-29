<!DOCTYPE html>
<html>
   <head>
		<title>Exporter avec critÃ¨res </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/style.css">
		<?php
			require('header_link.html');
		?>
   </head>
   <body>
      <?php require('header.php');  ?>
      <div class="container">
	      <div class="row" id="content">
		      <h1 class="text-center"> Exporter avec sÃ©lÃ©ction de critÃ¨res </h1>
		      </br>
		      <div class="panel panel-primary">
			      <div class="panel-heading">
			         <h3 class="panel-title text-center">Choix des critÃ¨res </h3>
			      </div>

			         <div class="panel-body">
			            </br>
			            <div class="col-md-4"> 


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

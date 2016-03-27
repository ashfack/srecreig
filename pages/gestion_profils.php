<!DOCTYPE html>
<html>
   <head>
      <title>Gestion des profils</title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="../css/style.css">
   </head>
         <script src="../js/jquery-1.11.0.min.js"></script>
   <script>
   function ma_func(nom)
       {
         // alert(nom);
         // alert($("\""+nom+"\"").value);
       }
   $(document).ready(function() 
   {
       // $("select").change(function() 
       // {
       //   $conteneur_principal=$(this).parent().parent().children()[0]; 
       //   $conteneur_bis=$($conteneur_principal).children()[0];
       //   console.log($texte=$($conteneur_bis).children()[1].value);
       // });
       $("button").click(function() 
       {
         $("button").replaceWith("<div class=\"col-md-9\"> <div class=\"col-md-4\"> <div class=\"input-group\"> <span class=\"input-group-addon\">Identifiant</span> <input type=\"text\" class=\"form-control\" placeholder=\"Identifiant\" aria-describedby=\"sizing-addon1\"> </div> </div> <div class=\"col-md-2\"> <select name=\"profils\" class=\"profils\" type=\"select\" id=\"new\"  > <option value=\"read\">Lecture</option> <option value=\"write\">Ecriture</option> <option value=\"super\">Super Utilisateur</option> </select> </div> </div> ");
       });
       $("#new").change(function()
       {
         
       });

   });

   </script>


   <body>
      <?php include('header.php'); ?>
      <div class="container">
      <div class="row" id="content">
      <h1 class="text-center"> Fiche de gestion des profils </h1>
      </br>
      <form action="#" method="post" class="form-vertical" >
         <fieldset>
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h3 class="panel-title">Gestion des profils</h3>
               </div>
               <div class="panel-body">
               <?php
                     require("db_connect.php");
                     $sql = "Select * from Connexion";
                     $rep=$conn->query($sql);
                     while( $row = $rep->fetch()) 
                     {
                     ?>   
                        <div class="col-md-9">
                           <div class="col-md-4">
                              <div class="input-group">
                                 <span class="input-group-addon">Identifiant</span>
                              <input disabled type="text" class="form-control" placeholder="Identifiant" aria-describedby="sizing-addon1" value="<?php echo $row['id']; ?>">
                              </div>
                           </div>
                           <div class="col-md-2">
                           <select name="profils" class="profils" type="select" id="<?php echo $row['id']; ?>"  >
                                 <option value="read"  <?php if($row['profile']=="read") echo "selected=\"selected\""; ?>>Lecture</option>
                                 <option value="write" <?php if($row['profile']=="write") echo "selected=\"selected\""; ?>>Ecriture</option>
                                 <option value="super" <?php if($row['profile']=="super") echo "selected=\"selected\""; ?>>Super Utilisateur</option>
                              </select>
                           </div>
                        </div>
                     <?php  
                     }
                     ?>
               </div>
            </div>
         </fieldset>
         <button>Ajouter personne</button>

      </form>     
   </body>
</html>
<!DOCTYPE html>
<html>
   <head>
        <title>Gestion des profils</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <?php
            require('header_link.html');
        ?>
        <script src="../js/script_gestion-profils.js"></script>
   </head>
   <body>
      <?php require('header.php'); ?>
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
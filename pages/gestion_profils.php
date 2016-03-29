<!DOCTYPE html>
<html>
   <head>
        <title>Gestion des profils</title>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="../css/style.css">
        <?php
            require('header_link.html');
        ?>
        <?php
          require('header_script.html');
        ?>
        <script src="../js/script_gestion-profils.js"></script>
   </head>
   <body>
      <?php require('header.php'); ?>
      <div class="container">
      <div class="row" id="content">
      <h1 class="text-center"> Fiche de gestion des profils </h1>
      </br>
        <div class="panel panel-primary">
           <div class="panel-heading">
              <h3 class="panel-title">Gestion des profils</h3>
           </div>
           <div class="panel-body">
           <?php
                 require("db_connect.php");
                 $sql = "Select * from Connexion";
                 try
                 {
                    $rep=$conn->query($sql); 
                 }
                 catch(PDOException $e)
                 {
                    // echo "Incident: " . $e->getMessage();
                    echo "Impossible de joindre le serveur de base de données";
                  }
                 $i=0;
                 while( $row = $rep->fetch()) 
                 {
                 ?>   
                    <div class="col-md-9" id="<?php echo str_replace(".","_", $row['id']); ?>">
                       <div class="col-md-4">
                          <div class="input-group">
                             <span class="input-group-addon">Identifiant</span>
                          <input disabled type="text" class="form-control" placeholder="Identifiant" aria-describedby="sizing-addon1" value="<?php echo $row['id']; ?>">
                          </div>

                       </div>
                       <div class="col-md-2">
                       <!-- id="<?php echo str_replace(".","_", $row['id']); ?>" -->
                       <select name="profils" class="profils" type="select"   >
                             <option value="read"  <?php if($row['profil']=="read") echo "selected=\"selected\""; ?>>Lecture</option>
                             <option value="write" <?php if($row['profil']=="write") echo "selected=\"selected\""; ?>>Ecriture</option>
                             <option value="super" <?php if($row['profil']=="super") echo "selected=\"selected\""; ?>>Super Utilisateur</option>
                          </select>
                       </div>
                       <div class="col-md-3">
                          <button class="supprimer btn btn-danger btn-responsive">Supprimer</button>
                       </div>    
                    </div>
                 <?php  
                 $i++;
                 }
                 ?>
           </div>
        </div>
         <button id="add" class="btn btn-info btn-responsive">Nouvelle personne</button>    
   </body>
</html>
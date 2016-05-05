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
        <!-- Pour centrer, div de gauche -->
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <h1 class="text-center"> Gestion des profils </h1>
        </br>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title text-center">Profils disponibles</h4>
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
                   <div>
                    <div class="input-group my-group">
                        <input type="text" disabled class="form-control" name="snpid" placeholder="Identifiant" value="<?php echo $row['id'];?>">
                        <select name="profils" class="selectpicker form-control" type="select">
                            <option value="read" <?php if($row[ 'profil']=="read" ) echo "selected=\"selected\""; ?>>Lecture</option>
                            <option value="write" <?php if($row[ 'profil']=="write" ) echo "selected=\"selected\""; ?>>Ecriture</option>
                            <option value="super" <?php if($row[ 'profil']=="super" ) echo "selected=\"selected\""; ?>>Super Utilisateur</option>
                        </select>
                        <span class="input-group-btn">
                            <button class="supprimer btn btn-danger btn-responsive">Supprimer</button>
                        </span>
                    </div>
                </div>
                <?php  
                $i++;
            }
            ?>                    
            <button id="add" class="btn btn-info btn-responsive">Nouvelle personne</button>
        </div>
    </div>
</div>
<!-- Pour centrer, div de droite -->
<div class="col-md-3">
</div>
</div>
</body>
</html>
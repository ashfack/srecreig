<!DOCTYPE html>
<html>
    <head>
        <title>Rechercher Alternant </title>
        <meta charset="UTF-8">
        <?php
            require('header_script.html');
        ?>
        <?php
            require('header_link.html');
        ?>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <script type="text/javascript" src="../js/script_rechercher-alternant.js"></script>
    </head>


    <body>
        <?php require('header.php'); ?>
        <div class="container">
            <div class="row" id="content">
                <h1 class="text-center"> Rechercher un Alternant </h1>
                <!-- <form id="form_rechercher" > -->
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                <center>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-graduation-cap"></i></span>
                           <input type="text" id="choix_alternant" name="choix_alternant" class="form-control" required="true" placeholder="Alternant" aria-describedby="sizing-addon1">
                        </div>
                <p> 
                </br>
                    <input type="button" value="Rechercher" id="bRechercher"/>
                </p>
            </center>
                </div>
                <div class="col-md-4">
                </div>
                <!-- </form> -->
                <div id="div_datatable">    
                </div>

                <div id="dialog_supprimer_confirmation" title="Confirmation !">
                    <p>
                      Vous allez supprimer l'alternant <span id="emplacement_supprimer_alternant"> </span> <br/>
                      Etes vous sûr de vouloir continuer ?
                    </p>
                </div>

                <div id="dialog_refus"  title="Refus">
                    <p> Vous devez selectionner une alternant </p>
                </div>

                <div id="dialog_aucun_alternant"  title="Aucun alternant !">
                    <p> Aucun alternant ne répond au nom que vous avez entré ! </p>
                </div>
            </div>
        </div>
    </body>
</html>

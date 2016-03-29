<!DOCTYPE html>
<html>
    <head>
        <title>Rechercher Entreprise</title>
        <meta charset="UTF-8">
        <?php
            require('header_link.html');
        ?>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <?php
            require('header_script.html');
        ?>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/script_rechercher.js"></script>
    </head>


    <body>
        <?php require('header.php'); ?>
        <div class="container">
            <div class="row" id="content">
                <h1 class="text-center"> Page de recherche </h1>
                <!-- <form id="form_rechercher" > -->
                <label for="choix_entreprise">Entreprise : </label> <input type="text" id="choix_entreprise" name="choix_entreprise"/>
                <p> 
                    <input type="button" value="Rechercher" id="bRechercher"/>
                </p>
                <!-- </form> -->
                <div id="div_datatable">    
                </div>
          
                <div id="dialog_info_confirmation" title="Confirmation !">
                    <p>
                      Vous avez choisit l'entreprise : <span id="emplacement_info_nomEntreprise"> </span> <br/>
                      Vous allez être redirigé vers une page contenant énormément d'information concernant cette entreprise. Etes vous sûr de vouloir continuer ?
                    </p>
                </div>

                <div id="dialog_supprimer_confirmation" title="Confirmation !">
                    <p>
                      Vous avez allez supprimer l'entreprise <span id="emplacement_supprimer_nomEntreprise"> </span> et toutes les données qui lui sont liées (Contacts, alternants, taxe d'apprentissage...) <br/>
                      Etes vous sûr de vouloir continuer ?
                    </p>
                </div>

                <div id="dialog_refus"  title="Refus">
                    <p> Vous devez selectionner une entreprise </p>
                </div>

                <div id="dialog_aucune_entreprise"  title="Aucune entreprise !">
                    <p> Aucune entreprise ne répond au nom que vous avez entré ! </p>
                </div>
            </div>
        </div>
    </body>
</html>

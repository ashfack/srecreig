
<!DOCTYPE html>
<html>
   <head>
      <title>Ajout Entreprise</title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="../css/style.css">
      <?php
require ('header_link.html');

require ('header_script.html');

?>
      <script type="text/javascript" src="../js/ajout_entreprise.js"></script> 
      
      <!-- Necessaire pour l'affichage de la jstree -->
      <link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css" />
      <script src="../framework/jsTree/dist/jstree.min.js"></script>
      <script  src="../js/jstree_cycle.js"></script>

   </head>
   <body>
  <div class="se-pre-con">
        <?php require('header.php');  ?>
      </div>
      <?php require('header.php');  ?>
      <div class="container">
         <div class="row" id="content">
            <h1 class="text-center"> Fiche d'ajout d'une entreprise </h1>
            <form id="ajoutEntreprise" method="post" class="form-vertical" >
               <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h4 class="panel-title text-center">Informations sur l'entreprise</h4>
                  </div>
                  <div class="panel-body">
                     </br>
                     <div class="col-md-3" id="panelInforEntreprise1">
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                           <input type="text" id="nom" name="nom" style='text-transform:uppercase' class="form-control" required="true" placeholder="Nom" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-group"></i></span>
                           <input type="text" id="groupe" name="groupe" class="form-control" placeholder="Groupe" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-pencil-square-o"></i></span>
                           <!-- <input type="text" id="codeNAF" name="codeNAF" class="form-control" placeholder="Code NAF" pattern="[0-9]{3}[A-Z]" aria-describedby="sizing-addon1"> -->
                            <select name="libellesNAF" id="libellesNAF" class='form-control libellesNAF'>
                                 
                           </select>
                        </div>

                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-group"></i></span>
                           <input type="text" id="siret" name="siret" class="form-control" placeholder="N° SIRET" pattern="[0-9]{14}" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-home"></i></span>
                           <input type="text"  id="adresse" name="adresse" class="form-control" placeholder="Adresse" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-home"></i></span>
                           <input type="text"  id="complAdr" name="complAdr" class="form-control" placeholder="Complément d'adresse" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-map-marker"></i></span>
                           <input type="text"  id="codeP" name="codeP" class="form-control" placeholder="Code postal" pattern="[0-9]{5}" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-map-marker"></i></span>
                           <input type="text"  id="ville" name="ville" style="text-transform: capitalize;"  class="form-control" placeholder="Ville" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-globe"></i></span>
                           <input type="text"  id="pays" name="pays" class="form-control" value="France" placeholder="Pays" aria-describedby="sizing-addon1">
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="panel panel-primary">
                           <div class="panel-heading">
                              <h4 class="panel-title text-center">Origine, type de contact et actions menées</h4>
                           </div>
                           <div class="panel-body">
                              <div>
                                 <label for="origineContact" > Origine du contact : </br></label>
                                 <select name="origineContact" id="origineContact" type="select" multiple size="10">
                                    <option value="sre">SRE</option>
                                    <option value="aisg">AISG</option>
                                    <option value="aimg">AMIG</option>
                                    <option value="cavam">CAVAM</option>
                                    <option value="cedip">CEDIP</option>
                                    <option value="corpsPeda">Corps Pédagogique</option>
                                    <option value="dig">Direction Institut Galilée</option>
                                    <option value="dsg">Direction Sup Galilée</option>
                                    <option value="estEns">Est Ensemble</option>
                                    <option value="mecig">Membre exterieur Conseil Institu Galilée</option>
                                    <option value="meCAsg">Membre exterieur CA Sup Galilée</option>
                                    <option value="pc">Plaine Commune</option>
                                    <option value="presidence">Présidence</option>
                                    <option value="rp">Responsable pédagogique</option>
                                    <option value="scuio">SCUIO-IP</option>
                                 </select>
                              </div>
                              <label for="typeContact" type="radio"> </br> Type de contact : </label>
                              <div class="radio">
                                 <label> <input  type="radio"  name="typeContact" value="entreprise"/>Entreprise </label>
                              </div>
                              <div class="radio">
                                 <label>   <input type="radio" name="typeContact" value="personne" />Personne</label>
                              </div>
                              <div class="radio">
                                 <label>   <input type="radio" name="typeContact" value="ct"/>Collectivité territoriale </label>
                              </div>
                              <div class="radio">
                                 <label>    <input type="radio" name="typeContact" value="ca"/>Communauté d'agglomérations<br /></label>
                              </div>
                              
                              <label for="actions[]" type="checkbox"> </br>Actions menées : </label>
                              <div class="input-group">
                                 <input type="checkbox" name="actions[]" value="1" class="actionsCheckbox"> <span> Accueil d'apprentis en Energetique </span></br>
                                  <input type="checkbox" name="actions[]" value="2" class="actionsCheckbox"> <span> Accueil d'apprentis en Informatique et Réseaux </span> </br>
                                  <input type="checkbox" name="actions[]" value="3" class="actionsCheckbox"> <span> Animation d'ateliers RH de simulations d'entretiens </span> </br>
                                  <input type="checkbox" name="actions[]" value="4" class="actionsCheckbox"> <span> Animation de conférences métiers </span> </br>
                                  <input type="checkbox" name="actions[]" value="5" class="actionsCheckbox"> <span> Partenariat officiel </span> </br>
                                  <input type="checkbox" name="actions[]" value="6" class="actionsCheckbox"> <span> Participation au Forum Sup Galilée Entreprises </span> </br>
                                  <input type="checkbox" name="actions[]" value="7" class="actionsCheckbox"> <span> Recrutement de stagiaires </span> </br>
                                  <input type="checkbox" name="actions[]" value="8" class="actionsCheckbox"> <span> Recrutement des jeunes diplômé(e)s </span> </br>
                                  <input type="checkbox" name="actions[]" value="9" class="actionsCheckbox"> <span> Soutien financier par le versement de taxe d'apprentissage </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="comment">Commentaires:</label>
                           <textarea class="form-control" rows="14" id="commentairesEntreprise"></textarea>
                        </div>
                        <?php
                           include ("jstree_cycle.php");
                        ?>
                     <div class="col-md-10"></div>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <div class="col-md-4">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           <h3 class="panel-title text-center">Contact Principal</h3>
                        </div>
                        <div class="panel-body">
                           <label>Civilite :</label>
                           <label for="civiliteCP" class="radio-inline"><input type="radio"  value="Monsieur" name="civiliteCP" checked="checked">Monsieur</label>
                           <label for="civiliteCP" class="radio-inline"><input type="radio"  value="Madame"   name="civiliteCP">Madame</label><br />
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                              <input type="text"  id ="nomCP" name="nomCP" class="form-control" style='text-transform:uppercase' placeholder="Nom" pattern="[a-zA-Z-_]*" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
                              <input type="text"  id="prenomCP" name="prenomCP" class="form-control"  style="text-transform: capitalize;" placeholder="Prénom" pattern="[a-zA-Z-_]*" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-briefcase"></i></span>
                              <input type="text"  id="fonctionCP" name="fonctionCP" class="form-control" style="text-transform: capitalize;"  placeholder="Fonction" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
                              <input type="tel"  id="telCP_f" name="telCP_f" class="form-control"  placeholder="Téléphone fixe" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">							
						   </div>
						   <div class="input-group">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mobile"></i></span>
								<input type="tel"  id="telCP_m"   name="telCP_m" class="form-control"  placeholder="Téléphone mobile" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
							</div>
						   <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mail"></i>@</span>
                              <input type="email"  id="emailCP" name="emailCP" class="form-control" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" aria-describedby="sizing-addon1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           <h3 class="panel-title text-center">Contact Secondaire</h3>
                        </div>
                        <div class="panel-body">
                           <label>Civilite :</label>
                           <label for="civiliteCS" class="radio-inline"><input type="radio"   value="Monsieur" name="civiliteCS" checked="checked">Monsieur</label>
                           <label for="civiliteCS" class="radio-inline"><input type="radio"   value="Madame"   name="civiliteCS">Madame</label><br />
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                              <input type="text" style='text-transform:uppercase' id ="nomCS" name="nomCS" class="form-control" placeholder="Nom" pattern="[a-zA-Z-_]*" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
                              <input type="text"  id="prenomCS" name="prenomCS" class="form-control" placeholder="Prénom"  style="text-transform: capitalize;" pattern="[a-zA-Z-_]*" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-briefcase"></i></span>
                              <input type="text"  id="fonctionCS" name="fonctionCS" class="form-control" placeholder="Fonction" style="text-transform: capitalize;" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
                              <input type="tel"  id="telCS_f" name="telCS_f" class="form-control"  placeholder="Téléphone fixe" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
                           </div>
						   <div class="input-group">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mobile"></i></span>
								<input type="tel"  id="telCS_m"   name="telCS_m" class="form-control"  placeholder="Téléphone mobile" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
							</div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mail"></i>@</span>
                              <input type="email"  id="emailCS" name="emailCS" class="form-control" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" aria-describedby="sizing-addon1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           <h3 class="panel-title text-center">Contact TA-LR</h3>
                        </div>
                        <div class="panel-body">
                           <label>Civilite :</label>
                           <label for="civiliteTA" class="radio-inline"><input type="radio"  value="Monsieur" name="civiliteTA" checked="checked">Monsieur</label>
                           <label for="civiliteTA" class="radio-inline"><input type="radio"  value="Madame"   name="civiliteTA">Madame</label><br/>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                              <input type="text" style='text-transform:uppercase'  id ="nomTA" name="nomTA" class="form-control" placeholder="Nom" pattern="[a-zA-Z-_]*" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
                              <input type="text"  id="prenomTA" name="prenomTA" class="form-control" placeholder="Prénom"  style="text-transform: capitalize;" pattern="[a-zA-Z-_]*" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-briefcase"></i></span>
                              <input type="text" style="text-transform: capitalize;"  id="fonctionTA" name="fonctionTA" class="form-control" placeholder="Fonction" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
                              <input type="tel"  id="telTA_f" name="telTA_f" class="form-control"  placeholder="Téléphone fixe" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
                           </div>
						   <div class="input-group">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mobile"></i></span>
								<input type="tel"  id="telTA_m"   name="telTA_m" class="form-control"  placeholder="Téléphone mobile" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
							</div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mail"></i>@</span>
                              <input type="email"  id="emailTA" name="emailTA" class="form-control" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" aria-describedby="sizing-addon1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">  </div>
                  <div class="col-md-12">
                     <div class="col-md-5">  
                     </div>
                     <p>
                        <input type="submit" value="Ajouter" />
                        <input type="reset" value="Annuler" />
                     </p>
                  </div>
            </form>
            </div>
         </div>
      </div>
      </div>
      </div></div> </div>                 
   </body>
</html>


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
      <script src="../js/script_ajout_entreprise.js"></script>
      <script type="text/javascript" src="../js/ajout_entreprise.js"></script> 
      <link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css" />
   </head>
   <body>
      <?php
require ('header.php');
 ?>
      <div class="container">
         <div class="row" id="content">
            <h1 class="text-center"> Fiche d'ajout d'une entreprise </h1>
            <form id="ajoutEntreprise" method="post" class="form-vertical" >
               <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h3 class="panel-title text-center">Informations sur l'entreprise</h3>
                  </div>
                  <div class="panel-body">
                     </br>
                     <div class="col-md-4">
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                           <input type="text" id="nom" name="nom" class="form-control" required="true" placeholder="Nom" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-group"></i></span>
                           <input type="text" id="groupe" name="groupe" class="form-control" placeholder="Groupe" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-pencil-square-o"></i></span>
                           <input type="text" id="codeNAF" name="codeNAF" class="form-control" placeholder="Code NAF" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-arrow-right"></i></span>
                           <input type="text" id="libelleNAF" name="libelleNAF" class="form-control" disabled="disabled"  placeholder="Libellé NAF" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-group"></i></span>
                           <input type="text" id="siret" name="siret" class="form-control" placeholder="N° SIRET" aria-describedby="sizing-addon1">
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
                           <input type="text"  id="codeP" name="codeP" class="form-control" placeholder="Code postal" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-map-marker"></i></span>
                           <input type="text"  id="ville" name="ville" class="form-control" placeholder="Ville" aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group">
                           <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-globe"></i></span>
                           <input type="text"  id="pays" name="pays" class="form-control" value="France" placeholder="Pays" aria-describedby="sizing-addon1">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="panel panel-primary">
                           <div class="panel-heading">
                              <h3 class="panel-title">Origine</h3>
                           </div>
                           <div class="panel-body">
                              <select name="origineContact" id="origineContact" type="select" multiple size="10">
                                 <optgroup label = "Origine du contact : ">
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
                              <label for="typeContact" type="radio"> </br>Type de contact : </label>
                              <div class="radio">
                                 <label> <input  type="radio"  name="optradio" />Entreprise </label>
                              </div>
                              <div class="radio">
                                 <label>   <input type="radio" name="optradio" />Personne</label>
                              </div>
                              <div class="radio">
                                 <label>   <input type="radio" name="typeContact" />Collectivité territoriale </label>
                              </div>
                              <div class="radio">
                                 <label>    <input type="radio" name="typeContact" />Communauté d'agglomérations<br /></label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="comment">Commentaires:</label>
                           <textarea class="form-control" rows="14" id="comment"></textarea>
                        </div>
                        <?php
require ("jstree_cycle.php");

?>
                     <div class="col-md-10"></div>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <div class="col-md-4">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           <h3 class="panel-title">Contact Principal</h3>
                        </div>
                        <div class="panel-body">
                           <label>Civilite :</label>
                           <label for="civiliteCP" class="radio-inline"><input type="radio"  value="Monsieur" name="civiliteCP">Monsieur</label>
                           <label for="civiliteCP" class="radio-inline"><input type="radio"  value="Madame"   name="civiliteCP">Madame</label><br />
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                              <input type="text"  id ="nomCP" name="nomCP" class="form-control" placeholder="Nom" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
                              <input type="text"  id="prenomCP" name="prenomCP" class="form-control" placeholder="Prénom" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-briefcase"></i></span>
                              <input type="text"  id="fonctionCP" name="fonctionCP" class="form-control" placeholder="Fonction" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
                              <input type="tel"  id="telCP_f" name="telCP_f" class="form-control"  placeholder="Téléphone fixe" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">							
						   </div>
						   <div class="input-group">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
								<input type="tel"  id="telCP_m"   name="telCP_m" class="form-control"  placeholder="Téléphone mobile" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
							</div>
						   <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mail"></i>@</span>
                              <input type="email"  id="emailCP" name="emailCP" class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           <h3 class="panel-title">Contact Secondaire</h3>
                        </div>
                        <div class="panel-body">
                           <label>Civilite :</label>
                           <label for="civiliteCS" class="radio-inline"><input type="radio"   value="Monsieur" name="civiliteCS">Monsieur</label>
                           <label for="civiliteCS" class="radio-inline"><input type="radio"   value="Madame"   name="civiliteCS">Madame</label><br />
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                              <input type="text"  id ="nomCS" name="nomCS" class="form-control" placeholder="Nom" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
                              <input type="text"  id="prenomCS" name="prenomCS" class="form-control" placeholder="Prénom" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-briefcase"></i></span>
                              <input type="text"  id="fonctionCS" name="fonctionCS" class="form-control" placeholder="Fonction" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
                              <input type="tel"  id="telCS_f" name="telCS_f" class="form-control"  placeholder="Téléphone fixe" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
                           </div>
						   <div class="input-group">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
								<input type="tel"  id="telCS_m"   name="telCS_m" class="form-control"  placeholder="Téléphone mobile" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
							</div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mail"></i>@</span>
                              <input type="email"  id="emailCS" name="emailCS" class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           <h3 class="panel-title">Contact TA-LR</h3>
                        </div>
                        <div class="panel-body">
                           <label>Civilite :</label>
                           <label for="civiliteTA" class="radio-inline"><input type="radio"  value="Monsieur" name="civiliteTA">Monsieur</label>
                           <label for="civiliteTA" class="radio-inline"><input type="radio"  value="Madame"   name="civiliteTA">Madame</label><br/>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user">*</i></span>
                              <input type="text"  id ="nomTA" name="nomTA" class="form-control" placeholder="Nom" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
                              <input type="text"  id="prenomTA" name="prenomTA" class="form-control" placeholder="Prénom" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-briefcase"></i></span>
                              <input type="text"  id="fonctionTA" name="fonctionTA" class="form-control" placeholder="Fonction" aria-describedby="sizing-addon1">
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
                              <input type="tel"  id="telTA_f" name="telTA_f" class="form-control"  placeholder="Téléphone fixe" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
                           </div>
						   <div class="input-group">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone"></i></span>
								<input type="tel"  id="telTA_m"   name="telTA_m" class="form-control"  placeholder="Téléphone mobile" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
							</div>
                           <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-mail"></i>@</span>
                              <input type="email"  id="emailTA" name="emailTA" class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">  </div>
                  <div class="col-md-12">
                     <div class="col-md-5">  
                     </div>
                     <p>
                        <input type="submit" value="Envoyer" />
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

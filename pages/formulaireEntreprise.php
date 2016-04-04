
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
require ("db_connect.php");

$table_onglet_array = array(
   "Cycle",
   "Contacts",
   "Alternance",
   "Taxe d'apprentissage",
   "Atelier RH",
   "Conference",
   "Forum SG"
);
$table_array = array(
   "cycle",
   "mention",
   "specialite"
);
echo " <div id=\"jstree\">";
$sql = "Select distinct cycle from CycleFormation ";
try
   {
   $rep = $conn->query($sql);
   }

catch(PDOException $e)
   {

   // echo "Incident: " . $e->getMessage();

   echo "Impossible de joindre le serveur de base de données";
   }

while ($row = $rep->fetch())
   {
   echo " <ul > 
                                       <li data-jstree='{\"icon\":\"glyphicon glyphicon-folder-open\"}'>" . $row['cycle'] . " 
                                         <ul>  ";
   $sql2 = "Select distinct mention from CycleFormation where mention is not null and cycle = \"" . $row['cycle'] . "\" ";
   try
      {
      $rep2 = $conn->query($sql2);
      }

   catch(PDOException $e)
      {

      // echo "Incident: " . $e->getMessage();

      echo "Impossible de joindre le serveur de base de données";
      }

   while ($row2 = $rep2->fetch())
      {

      echo " <li data-jstree='{\"icon\":\"glyphicon glyphicon-file\"}'>";

      echo $row2['mention'];
                  echo " <ul> ";

      $sql3 = "Select distinct specialite from CycleFormation where specialite is not null and cycle is not null and cycle = \"". $row['cycle'] . "\" and mention = \"" . $row2['mention'] . "\"";
      try
         {
         $rep3 = $conn->query($sql3);
         }

      catch(PDOException $e)
         {
         echo "Impossible de joindre le serveur de base de données";
         }

      while ($row3 = $rep3->fetch())
         {
         echo " <li data-jstree='{\"icon\":\"glyphicon glyphicon-file\"}'>".$row3['specialite']." </li>  ";
         }

      echo "</ul></li> ";
      }
   echo "
        </ul>      
       </li>    
    </ul>  ";
   }

echo "     </div> ";
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
                           <label for="civiliteCP" class="radio-inline"><input type="radio"  name="optradio">Monsieur</label>
                           <label for="civiliteCP" class="radio-inline"><input type="radio"  name="optradio">Madame</label><br />
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
                              <input type="tel"  id="telCP" name="telCP" class="form-control"  placeholder="Numéro de téléphone" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
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
                           <label for="civiliteCS" class="radio-inline"><input type="radio"  name="optradio">Monsieur</label>
                           <label for="civiliteCS" class="radio-inline"><input type="radio"  name="optradio">Madame</label><br />
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
                              <input type="tel"  id="telCS" name="telCS" class="form-control"  placeholder="Numéro de téléphone" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
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
                           <label for="civiliteTA" class="radio-inline"><input type="radio"  name="optradio">Monsieur</label>
                           <label for="civiliteTA" class="radio-inline"><input type="radio"  name="optradio">Madame</label><br/>
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
                              <input type="tel"  id="telTA" name="telTA" class="form-control"  placeholder="Numéro de téléphone" aria-describedby="sizing-addon1" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
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
<script src="../js/jquery.min.js"></script>
<script src="../framework/jsTree/dist/jstree.min.js"></script>
<script>
   $(function () {
     $('#jstree')
      .on("init.jstree", function (e, data) {
      data.instance.settings.checkbox.cascade = '';
     })
     .on("changed.jstree", function (e, data) {
       console.log(data.selected);
     })   

     .jstree({  
      checkbox : {
        three_state : false,
    },
       types : {
       "default" : {
         "icon" : "glyphicon glyphicon-flash"
       }
    }, 
       plugins : [ 'wholerow', 'checkbox', 'types' ]
     })
 });
</script>
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
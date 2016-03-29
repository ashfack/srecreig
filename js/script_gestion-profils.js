function f_new()
{
   $profil= $("#new").val();
   $identifiant=$("#new_nom").val();
   $.ajax(
   { 
     type: "POST", 
     url : "maj_profil.php", 
     data: "id="+$identifiant+"&profil="+$profil+"&type=ins", 
     success: function(msg)
     { 
          if(msg==1) //Succes
          {
              window.location.reload();
          }
     }
   });
}

$(document).ready(function() 
{
   
   $("#add").click(function() 
   {
      $("#add").replaceWith("<div class=\"col-md-9\"> <div class=\"col-md-4\"> <div class=\"input-group\"> <span class=\"input-group-addon\">Identifiant</span> <input type=\"text\" class=\"form-control\" id=\"new_nom\" placeholder=\"Identifiant\" aria-describedby=\"sizing-addon1\"> </div> </div> <div class=\"col-md-2\"> <select name=\"profils\" class=\"profils\" type=\"select\" id=\"new\"  > <option value=\"read\">Lecture</option> <option value=\"write\">Ecriture</option> <option value=\"super\">Super Utilisateur</option> </select> </div> <div class=\"col-md-3\"> <button class=\"btn btn-success btn-responsive\" id=\"ajouter\" onclick=\"f_new()\">Ajouter</button></div> </div>");
   });
   
   $("select").change(function() 
   {
       
      $profil= $(this).val();
      $identifiant=$($(this).parents("div")[1]).find("input").val();
      $.ajax(
        { 
           type: "POST", 
           url : "maj_profil.php", 
           data: "id="+$identifiant+"&profil="+$profil+"&type=upd", 
           success: function(msg)
           { 
                if(msg==1) //Succes
                {
                    window.location.reload();
                }
           }
        });
   });

   $(".supprimer").click(function() 
   {
      $identifiant=$($(this).parents("div")[1]).find("input").val();
      $.ajax(
        { 
           type: "POST", 
           url : "maj_profil.php", 
           data: "id="+$identifiant+"&type=del", 
           success: function(msg)
           { 
                if(msg==1) //Succes
                {
                    // window.location.replace("gestion_profils.php");
                    window.location.reload();
                }
           }
        });  
   });

});
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
      $("#add").replaceWith("<div> <div class=\"input-group my-group\"> <input type=\"text\" class=\"form-control\" name=\"snpid\" placeholder=\"Identifiant\" id=\"new_nom\"value=\"\"> <select name=\"profils\" class=\"selectpicker form-control\" id=\"new\" type=\"select\"> <option value=\"read\">Lecture</option> <option value=\"write\">Ecriture</option> <option value=\"super\">Super Utilisateur</option> </select> <span class=\"input-group-btn\"> <button class=\"btn btn-success btn-responsive\" id=\"ajouter\" onclick=\"f_new()\">Ajouter</button> </span> </div> </div>");
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
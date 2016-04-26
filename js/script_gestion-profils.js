function supp()
{
  if(confirm("Etes vous sur de supprimer cet Utilisateur?")==true)
  {
    return 1;
  }
  return 0;
}

function surligne(champ, erreur)
{
   if(erreur)
      $(champ).css("backgroundColor", "#fba");
   else
      $(champ).css("backgroundColor", "rgb(170, 255, 177)");
}
function verifFormat(champ)
{
   var regex = /^[a-zA-Z]+\.[a-zA-Z]+$/;
   if(!regex.test($(champ).val()))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function f_new()
{
   // alert(verifFormat($("#new_nom")));
   if(verifFormat($("#new_nom"))==true)
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
    else
    {
      alert('Vous alliez ajouter un Utilisateur avec un nom incorrect');
    }
   
}

$(document).ready(function() 
{
   
   $("#add").click(function() 
   {
      $("#add").replaceWith("<div> <div class=\"input-group my-group\"> <input type=\"text\" class=\"form-control\" name=\"snpid\" placeholder=\"Identifiant\" id=\"new_nom\"value=\"\" onblur=\"verifFormat(this)\"> <select name=\"profils\" class=\"selectpicker form-control\" id=\"new\" type=\"select\"> <option value=\"read\">Lecture</option> <option value=\"write\">Ecriture</option> <option value=\"super\">Super Utilisateur</option> </select> <span class=\"input-group-btn\"> <button class=\"btn btn-success btn-responsive\" id=\"ajouter\" onclick=\"f_new()\">Ajouter</button> </span> </div> </div>");
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

    if(supp() ==1)
    {
      
      profil=$($(this).parents("div")[1]).find("select").val();      
      if(profil =='super')
      {
        cpt=0;
        for(j=0;j<$("select").length;j++)
        {
          if($($("select")[j]).val()=="super")
          {
            cpt++;
          }
        }
        if (cpt ==1)
        {
            alert('impossible de supprimer cet Utilisateur car c\'est le seul administrateur');
            return;
        }
      }
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
                    window.location.reload();
                }
           }
        });
    }  
   });

});
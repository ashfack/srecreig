$(document).ready( function () { 
    $("#Connect").submit( function() {  
        $.ajax(
        { 
           type: "POST", 
           url : "login.php", 
           data: "pseudo="+$("#pseudo").val()+"&mdp="+$("#mdp").val(), 
           success: function(msg)
           { 
                if(msg==1) //Succes
                {
                    window.location.replace("rechercher.php");
                }
                else // si la connexion en php n'a pas fonctionnée
                {
                    if (msg!=0)
                        alert('Vous vous êtes trompés'); 
                }
           }
        });
        return false;
    });
});
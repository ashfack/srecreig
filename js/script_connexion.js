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
// $(document).ready( function () { 
//     $("#Connect").submit( function() {  
//         $.ajax(
//         { 
//            type: "POST", 
//            url : "https://cas.univ-paris13.fr/cas/login?service=https%3A%2F%2Fent.univ-paris13.fr", 
//            data: "username="+$("#pseudo").val()+"&password="+$("#mdp").val(), 
//            success: function(msg)
//            { 
//                 if(msg==1) //Succes
//                 {
//                     window.location.replace("rechercher.php");
//                 }
//                 else // si la connexion en php n'a pas fonctionnée
//                 {
//                     if (msg!=0)
//                         alert('Vous vous êtes trompés'); 
//                 }
//            }
//         });
//         return false;
//     });
// });

function supp()
{
	if(confirm("Etes vous sur de supprimer cette tâche ?")==true)
	{
		return 1;
	}
	return 0;
}



$(document).ready(function() 
{


	$(".modifier").click(function() 
		{
		$cont=$(this).parents("div");
		// console.log($cont);
		// console.log("personne "+$cont.find("[name='personne']").val());
		$id=$cont.find("[name='id']").val();
		$nomEntreprise=$cont.find("[name='nomEntreprise']").val();
		$commentaires=$cont.find("[name='commentaires']").val();
		$module=$cont.find("[name='module']").val();
		$statut=$cont.find("[name='statut']").val();
		$d=$cont.attr('class');

		$type="upd";

		$.ajax(
		{ 
		   type: "POST", 
		   url : "maj_agenda.php", 
		   data: "id="+$id+"&type="+$type+"&nomEntreprise="+$nomEntreprise+"&commentaires="+$commentaires+"&module="+$module+"&statut="+$statut+"&date="+$d, 
		   success: function(msg)
		   { 
		        if(msg==1) //Succes
		        {
		            // window.location.replace("gestion_profils.php");
		            window.location.reload();
		        }
		        else
		        {
		        	alert('un incident est survenu pour la modificiation');
		        }
		   }
		});  
		});
		$(".supprimer").click(function() 
		{
		if(supp() ==1)
		{
			$cont=$(this).parents("div");
			$id=$cont.find("[name='id']").val();
			$type="del";
			$.ajax(
			{ 
			   type: "POST", 
			   url : "maj_agenda.php", 
			   data: "id="+$id+"&type="+$type, 
			   success: function(msg)
			   { 
			        if(msg==1) //Succes
			        {
			            // window.location.replace("gestion_profils.php");
			            window.location.reload();
			        }
			        else
			        {
			        	alert('un incident est survenu pour la suppression');
			        }
			   }
			}); 
		}
		});
		$(".nouvelle").click(function() 
		{
			// alert('hi');
			$date=$(this).attr('name');
			// console.log($date);
			$(".nouvelle").replaceWith("<div class=\"panel panel-primary\" name="+$date+"> <div class=\"panel-heading\"> <h3 class=\"panel-title\">Nouvelle tâche</h3> </div> <div class=\"panel-body\"> <table class=\"table table-stripped\"> <tr> <td><strong>Nom Entreprise</strong></td> <td><input type=\"text\" name=\"nomEntreprise\"></td> </tr> <tr> <td><strong>Commentaires</strong></td> <td><textarea name=\"commentaires\"></textarea></td> </tr> <tr> <td><strong>Module</strong></td> <td><input type=\"text\" name=\"module\"></td> </tr> <tr> <td><strong>Statut</strong></td> <td><input type=\"text\" name=\"statut\"></td> <td><input type='hidden' class=\"form-control\" name='id'></td> </tr> <tr><td><button class=\"nouvelle_entree btn btn-success btn-responsive\" onclick=\"add()\">Finaliser</button></td> </span></tr> </table> </div> </div>");
			
		});
		
});
function add()
{
	// alert('hi');
	$cont=$(".nouvelle_entree").parents("div")[1];
	console.log($cont);
	$id=$($cont).find("[name='id']").val();
	$nomEntreprise=$($cont).find("[name='nomEntreprise']").val();
	$commentaires=$($cont).find("[name='commentaires']").val();
	$module=$($cont).find("[name='module']").val();
	$statut=$($cont).find("[name='statut']").val();
	$d=$($cont).attr('name');
	// console.log($id);
	// console.log($nomEntreprise);
	// console.log($commentaires);
	// console.log($module);
	// console.log($statut);
	// console.log($d);
	$type="ins";
	$.ajax(
	{ 
	   type: "POST", 
	   url : "maj_agenda.php", 
	   data: "type="+$type+"&nomEntreprise="+$nomEntreprise+"&commentaires="+$commentaires+"&module="+$module+"&statut="+$statut+"&date="+$d,
	   success: function(msg)
	   { 
	        if(msg==1) //Succes
	        {
	            // window.location.replace("gestion_profils.php");
	            window.location.reload();
	        }
	        else
	        {
	        	alert('un incident est survenu pour insérer');
	        }
	   }
	});
}
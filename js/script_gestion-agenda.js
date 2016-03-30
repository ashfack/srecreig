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

function supp()
{
	if(confirm("Etes vous sur de supprimer cette tâche ?")==true)
	{
		return 1;
	}
	return 0;
}
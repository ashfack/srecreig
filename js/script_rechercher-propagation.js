$(document).ready(function() 
{
	$("#tabs").tabs();
	
	var table_array=new Array("Entreprise","CoordonneesPersonne","Alternance","Taxeapprentissage","AtelierRH","Conference","ForumSG");
	for(var i=0;i<table_array.length;i++)
	{
		$("#"+table_array[i]).dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"oLanguage": { "sUrl": "../js/fr_FR.txt" }
		});	
	}
			
});
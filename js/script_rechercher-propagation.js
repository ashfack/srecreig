$(document).ready(function() 
{
	$("#tabs").tabs();
	

	var table_array=new Array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
	for(var i=0;i<table_array.length;i++)
	{
		for(var j=0;j<5;j++)
		{
				$("#dataTable_"+table_array[i]+"_niveau"+(j+1)).dataTable({
				"bJQueryUI": true,
				responsive : true,
				"sPaginationType": "full_numbers",
				"oLanguage": { "sUrl": "../js/fr_FR.txt" }
				});	
		}
	
	}

	var tableau=document.getElementsByName("cacher");

	for(i=0;i<tableau.length;i++)
    {
        tableau[i].style.display = "none";   
    }
			
});
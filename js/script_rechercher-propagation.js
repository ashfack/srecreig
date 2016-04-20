$(document).ready(function() 
{
	$("#tabs").tabs();
	
	

	var table_array=new Array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");
	for(var i=0;i<table_array.length;i++)
	{
		for(var j=1;j<=4;j++)
		{
			var table=table_array[i];

			$("#dataTable_"+table+"_niveau"+j).dataTable({
			"bJQueryUI": true,
			"responsive" : true,
			"sPaginationType": "full_numbers",
			"oLanguage": { "sUrl": "../js/fr_FR.txt" },
			"aaSorting": []
			});

			if(j>1) 
				$("#dataTable_"+table+"_niveau"+j).css("display","none");
			
			$("#menu_"+table).on(
			  'click',
			  "#titre_"+table+"_niveau"+j,
			  (function(true_j,true_table){
			     return function()
			     {
			     	if(true_j>1)
			      		$("#dataTable_"+true_table+"_niveau"+true_j).toggle();
			     };
			  })(j,table)
			);
		

		}
	
	}

	var tableau=document.getElementsByName("cacher");

	for(i=0;i<tableau.length;i++)
    {
        tableau[i].style.display = "none";   
    }
			
});
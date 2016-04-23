$(document).ready(function() 
{
	$("#tabs").tabs();

	$("#dialog_cycle").dialog(
	{
		height: 520,
		width:500,
		autoOpen:false,
		dialogClass: "alert",
		position: { my: "center bottom", at: "center center", of: window, within: $("#tabs")},
		draggable: false,
		modal:true,
		buttons: 
		[
		    {
		      text: "Valider",
		      icons: 
		      {
		        primary: "ui-icon-check"
		      },
		      click: function() 
		      {
		      	$( this ).dialog( "close" );
		      	requeteAjaxCycle();
		      }
		    },
		    {
		      text: "Annuler",
		      icons: 
		      {
		        primary: "ui-icon-closethick"
		      },
		      click: function() {
		        $( this ).dialog( "close" );
		      }
		    }

		]
	});

	var nomEntreprise=$("#titre_nomEntreprise").text();

	// datatable + systeme pyramidale
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
			     	{
			     		var img=$(this).children()[0];
			     		console.log(img);
			     		var src = ($(img).attr('src') === '../css/images/more.png')
									? '../css/images/minus.png'
									: '../css/images/more.png';
						
						$(img).attr('src', src);
			     		$("#dataTable_"+true_table+"_niveau"+true_j).toggle();
			     	}
			      		
			     };
			  })(j,table)
			);
		

		}
	
	}

	// cacher les id et autres !!
	var tableau=document.getElementsByName("cacher");

	for(i=0;i<tableau.length;i++)
    {
        tableau[i].style.display = "none";   
    }

    // jstree pour les cycles
    $("#bVoirCycle").click(function()
    {
    	$("#dialog_cycle").dialog("open");
    	//requeteAjaxCycle(nomEntreprise);
    });


			
});

function requeteAjaxEntreprise(nomEntreprise)
{

	$.ajax({

	   type: "POST",
	   url: "afficher_cyleFormation.php",
	   dataType: "text",
	   data: 'nomEntreprise='+nomEntreprise,
	   success: function(data)
	   { 
			if(data=="ok")
			{
				requeteAjaxTable();
			}
			else 
			{
				alert("La suppression n'a pas été effectué: une erreur est survenue");
			}
	   }
	});

}
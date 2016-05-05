var nomEntreprise;
$(document).ready(function()
{
		
		$( "#choix_alternant" ).keypress(function(event) 
		{
			  if(event.which==13)
			  	requeteAjaxTable();	  		
		});
		
		$("#bRechercher").click(function(){
				requeteAjaxTable();
			});

		$( "#dialog_refus" ).dialog({
			height:100,
			width:400,
			autoOpen:false,
			dialogClass: "alert",
			position: { my: "center bottom", at: "center top", of: window, within:  window},
			draggable: false,
		 	open: function() {
	            var dialog_refus = $(this);
	            setTimeout(function() {
	              dialog_refus.dialog('close');
	            }, 1500);
	        }
			
		});

		$( "#dialog_aucun_alternant" ).dialog({
			height:100,
			width:420,
			autoOpen:false,
			dialogClass: "alert",
			position: { my: "center bottom", at: "center center", of: window, within: window},
			draggable: false,
		 	open: function() {
	            var dialog_vide = $(this);
	            setTimeout(function() {
	              dialog_vide.dialog('close');
	            }, 1500);
	        }
			
		});
		
		/*$("#dialog_supprimer_confirmation").dialog(
		{
			height: 220,
			width:500,
			autoOpen:false,
			dialogClass: "alert",
			position: { my: "center bottom", at: "center top", of: window, within: $("#div_datatable")},
			draggable: false,
			modal:true,
			buttons: 
			[
			    {
			      text: "Oui",
			      icons: 
			      {
			        primary: "ui-icon-check"
			      },
			      click: function() 
			      {
			      	$( this ).dialog( "close" );
			      	requeteAjaxSuppression();
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
	});*/

	// $("#form_rechercher").submit( requeteAjaxTable );
});

function requeteAjaxTable()
{

	$.ajax({

	   type: "POST",
	   url: "recup_donnees_alternants.php",
	   dataType: "json",
	   data: 'choix_alternant='+$("#choix_alternant").val(),
	   success: function(data)
	   { 
	   		
			$("#div_datatable").children().remove();
			if(data.length>0) 
			{
				var chaine="<table width='100%' border='0' cellspacing='0' cellpadding='0' id='datatable_alternant' class='display'> \
		    	<thead> \
		    		<tr> \
		    			<th> Nom entreprise </th> \
		    			<th> Civilite </th> \
		    			<th> Nom </th> \
		    			<th> Prenom </th>\
		    			<th> Mail </th>\
    					<th> Telephone mobile </th> \
		    			<th> Formation alternance </th> \
		    			<th> Type contrat </th> \
		    		</tr> \
		    	</thead> \
		    	<tbody>";

				for(var i in data)
				{
				   obj = data[i];
				   chaine+="<tr>";
				   chaine+="<td>"+obj['Entreprise_nomEntreprise']+"</td>";
				   chaine+="<td>"+obj['civilite']+"</td>";
				   chaine+="<td>"+obj['nom']+"</td>";
				   chaine+="<td>"+obj['prenom']+"</td>";
				   chaine+="<td>"+obj['mail']+"</td>";
				   chaine+="<td>"+obj['telephoneMobile']+"</td>";
				   chaine+="<td>"+obj['formationAlternance']+"</td>";
				   chaine+="<td>"+obj['typeContrat']+"</td>";
				   chaine+="</tr>";
				   //$("tbody").append(chaine);  
				}
				chaine+="</tbody> \
				    	<tfoot> \
				    		<tr> \
				    			<th colspan='9'></th> \
				    		</tr> \
				    	</tfoot> \
			    	</table>";

				$("#div_datatable").append(chaine);
				$("#div_datatable").append("<button id='bInfo'> Voir les informations </button>");
				//$("#div_datatable").append("<button id='bSupprimer'> Supprimer </button>");

				$("#datatable_alternant").dataTable({
					"bJQueryUI": true,
					responsive : true,
					"sPaginationType": "full_numbers",
					"oLanguage": { "sUrl": "../js/fr_FR.txt",
					"aaSorting": [2] }
				});

				$("#datatable_alternant tr").click(function(){

				   if($(this).hasClass('selected'))
				   		$(this).removeClass('selected');
				   else
				   {
				   		$(this).addClass('selected').siblings().removeClass('selected');    
				   		//$(this).addClass('selected');
				   }
						
				});

				$("#bInfo").click(function()
				{
					var nbSelected=$(".selected").length;
					if( nbSelected == 0)
							$("#dialog_refus").dialog("open");
					else
					{
						nomEntreprise=$(".selected").find('td:first').html();
						$("#emplacement_info_nomEntreprise").text(nomEntreprise);
						
						document.location.href="rechercher_propagation.php?nomEntreprise="+nomEntreprise;
					}
						
				});

				/*$("#bSupprimer").click(function()
				{
					var nbSelected=$(".selected").length;
					if( nbSelected == 0)
							$("#dialog_refus").dialog("open");
					else
					{
						nomEntreprise=$(".selected").find('td:first').html();
						$("#emplacement_supprimer_nomEntreprise").text(nomEntreprise);
						$("#dialog_supprimer_confirmation").dialog("open");
					}
						
				});*/

				
			}
			else 
			{
				$("#dialog_aucun_alternant").dialog("open");
			}
	   }
	});
}

/*function requeteAjaxSuppression()
{

	$.ajax({

	   type: "POST",
	   url: "supprimer_entreprise.php",
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
}*/
var nomEntreprise, groupe, adresse, complementAdresse, codePostal,commentaires;
var ville;
$(document).ready(function()
{
		$("#bRechercher").click(function(){
				requeteAjaxTable();
			});

		$( "#dialog_refus" ).dialog({
			height:100,
			width:400,
			autoOpen:false,
			dialogClass: "alert",
			position: { my: "center bottom", at: "center center", of: window, within: window},
			draggable: false,
		 	open: function() {
	            var dialog_refus = $(this);
	            setTimeout(function() {
	              dialog_refus.dialog('close');
	            }, 1500);
	        }
			
		});

		$( "#dialog_aucune_entreprise" ).dialog({
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
		
		$("#dialog_supprimer_confirmation").dialog(
		{
			height: 220,
			width:500,
			autoOpen:false,
			dialogClass: "alert",
			position: { my: "center bottom", at: "center center", of: window, within: $("#div_datatable")},
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
	});
	$("#dialog_editer").dialog(
		{
			height: 350,
			width:858.778,
			autoOpen:false,
			dialogClass: "alert",
			position: { my: "center bottom", at: "center center", of: window, within: $("#div_datatable")},
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

			      	requeteAjaxEdition(); // oihipihihiii
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

	// $("#form_rechercher").submit( requeteAjaxTable );
});

function requeteAjaxTable()
{

	$.ajax({

	   type: "POST",
	   url: "recup_donnees_entreprises.php",
	   dataType: "json",
	   data: 'choix_entreprise='+$("#choix_entreprise").val(),
	   success: function(data)
	   { 
	   		//alert("jai trouve qq chose");
			$("#div_datatable").children().remove();
			if(data.length>0) 
			{
				var chaine="<table width='100%' border='0' cellspacing='0' cellpadding='0' id='datatable_entreprise' class='display'> \
		    	<thead> \
		    		<tr> \
		    			<th> Nom entreprise </th> \
		    			<th> Groupe </th> \
		    			<th> Adresse </th> \
		    			<th> Complement d'adresse </th>\
		    			<th> Code postal </th> \
		    			<th> Ville </th> \
		    			<th> Commentaires Entreprise</th> \
		    		</tr> \
		    	</thead> \
		    	<tbody>";

				for(var i in data)
				{
				   obj = data[i];
				   chaine+="<tr>";
				   chaine+="<td>"+obj['nomEntreprise']+"</td>";
				   chaine+="<td>"+obj['groupe']+"</td>";
				   chaine+="<td>"+obj['adresse']+"</td>";
				   chaine+="<td>"+obj['complementAdresse']+"</td>";
				   chaine+="<td>"+obj['codePostal']+"</td>";
				   chaine+="<td>"+obj['ville']+"</td>";
				   chaine+="<td>"+obj['commentairesEntreprise']+"</td>";
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
				$("#div_datatable").append("<button id='bSupprimer'> Supprimer </button>");
				$("#div_datatable").append("<button id='bEditer'> Editer </button>");

				$("#datatable_entreprise").dataTable({
					"bJQueryUI": true,
					responsive : true,
					"sPaginationType": "full_numbers",
					"oLanguage": { "sUrl": "../js/fr_FR.txt" }
				});

				$("#datatable_entreprise tr").click(function(){
					//alert("Je vais modifier !!");
				   if($(this).hasClass('selected'))
				   		$(this).removeClass('selected');
				   else
				   {
				   		$(this).addClass('selected').siblings().removeClass('selected');    
				   		//$(this).addClass('selected');
				   }
						
				});
				
				$("#bEditer").click(function()
				{
					var nbSelected=$(".selected").length;
					if( nbSelected == 0)
							$("#dialog_refus").dialog("open");
					else
					{
						nomEntreprise=$(".selected").find('td:first').html();
						groupe=$(".selected").find('td:nth-child(2)').html();
						adresse=$(".selected").find('td:nth-child(3)').html();
						complementAdresse=$(".selected").find('td:nth-child(4)').html();
						codePostal=$(".selected").find('td:nth-child(5)').html();
						ville=$(".selected").find('td:nth-child(6)').html();
						commentaires=$(".selected").find('td:nth-child(7)').html();
						
						$("#emplacement_editer_nomEntreprise").text(nomEntreprise);
						
						// ouverture pop up
						$("#dialog_editer").dialog("open");
						
						//remplissage automatique des champs
						$( "input[name*='nomEntreprise']" ).val(nomEntreprise);
						$( "input[name*='groupe']" ).val(groupe);
						$( "input[name*='adresse']" ).val(adresse);
						$( "input[name*='complementAdresse']" ).val(complementAdresse);
						$( "input[name*='codePostal']" ).val(codePostal);
						$( "input[name*='ville']" ).val(ville);
						$( "input[name*='commentaires']" ).val(commentaires);
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

				$("#bSupprimer").click(function()
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
						
				});

				
			}
			else 
			{
				$("#dialog_aucune_entreprise").dialog("open");
			}
	   }
	});
}

function requeteAjaxSuppression()
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
}

function requeteAjaxEdition()
{
	
	nomEntreprise=$( "input[name*='nomEntreprise']" ).val();
	groupe=$( "input[name*='groupe']" ).val();
	adresse=$( "input[name*='adresse']" ).val();
	complementAdresse=$( "input[name*='complementAdresse']" ).val();
	codePostal=$( "input[name*='codePostal']" ).val();
	ville=$( "input[name*='ville']" ).val();
	commentaires=$( "input[name*='commentaires']" ).val();
	
	alert(ville); //vérifie les variables sont définies
	$.ajax({
	

		

		type: "POST",
		url: "editer_entreprise.php",
		dataType: "text",
		data: 	'nomEntreprise='+nomEntreprise+
				'&groupe='+groupe+
				'&adresse='+adresse+
				'&complementAdresse='+complementAdresse+
				'&codePostal='+codePostal+
				'&ville='+ville+
				'&commentaires='+commentaires,

		success: function(data)
		{ 
			if(data=="ok")
			{
				requeteAjaxTable();
			}
			else 
			{
				alert("L'édition n'a pas été effectuée: une erreur est survenue");
			}
		}
	});
	
	
}
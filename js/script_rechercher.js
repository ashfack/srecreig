var nomEntreprise, groupe, adresse, complementAdresse, codePostal,commentaires;
var ville;
var colVal=new Array();
var colonnes=new Array();
$(document).ready(function()
{ 

		$( "#choix_entreprise" ).keypress(function(event) 
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
			height:200,
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
						

						requeteAjaxEdition(); 
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
		    			<th id=\"nomEntreprise\"> Nom entreprise </th> \
		    			<th id=\"groupe\"> Groupe </th> \
		    			<th id=\"adresse\"> Adresse </th> \
		    			<th id=\"complementAdresse\"> Complement d'adresse </th>\
		    			<th id=\"codePostal\"> Code postal </th> \
		    			<th id=\"ville\"> Ville </th> \
		    			<th id=\"commentairesEntreprise\"> Commentaires Entreprise</th> \
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
				$("#div_datatable").append("<div class=\"col-md-2\"></div> 
											<div class=\"col-md-8\">
												<center> 
													<button id='bInfo'> Voir les informations </button>
													<button id='bSupprimer'> Supprimer </button>
													<button id='bEditer'> Editer </button>
												</center> 
											</div>
											<div class=\"col-md-2\"></div> ");
				$("#datatable_entreprise").dataTable({
					"bJQueryUI": true,
					"responsive" : true,
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
						$("#dialog_editer").children().next().remove();
						colonnes= $("th").map(function() { return $(this).attr("id")});
						
						var chaine="<form action='editer_entreprise.php' method='POST'>";
						
						for(var i=0;i<colonnes.length;i++)
						{
							colVal[i]=$(".selected").find('td:nth-child('+(i+1)+')').html();
							chaine+="<label>"+colonnes[i]+"</label>";
							chaine+="<input type='text' name='"+colonnes[i]+"' id='"+colonnes[i]+"' value='"+ colVal[i] +"'/> <br/>";
						}
						chaine+="</form>";
						$("#dialog_editer").append(chaine);
						console.log(chaine);
						nomEntreprise=$(".selected").find('td:first').html();

						$("#emplacement_editer_nomEntreprise").text(nomEntreprise);
						
						// ouverture pop up
						$("#dialog_editer").dialog("open");
						
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
{	// on réactualise les valeurs 
	colVal[0]=$( "input[name*='"+colonnes[0]+"']" ).val();
	for(var i=1;i<colVal.length;i++)
	{
		colVal[i]=$( "input[name*='"+colonnes[i]+"']" ).val();
		
	}
	/*var chaine1="'"+colonnes[0]+"'="+colVal[0]+
				"'&"+colonnes[1]+"'="+colVal[1]+
				"'&"+colonnes[2]+"'="+colVal[2]+
				"'&"+colonnes[3]+"'="+colVal[3]+
				"'&"+colonnes[4]+"'="+colVal[4]+
				"'&"+colonnes[5]+"'="+colVal[5]+
				"'&"+colonnes[6]+"'="+colVal[6];
	console.log(chaine1);*/
	$.ajax({
	// pour l'ajax, on spécifie les colonnes statiquement récupérées grace à l'id et on attribut les valeurs
		type: "POST",
		url: "editer_entreprise.php",
		dataType: "text",
		data: 	'nomEntreprise='+colVal[0]+
				'&groupe='+colVal[1]+
				'&adresse='+colVal[2]+
				'&complementAdresse='+colVal[3]+
				'&codePostal='+colVal[4]+
				'&ville='+colVal[5]+
				'&commentaires='+colVal[6],

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


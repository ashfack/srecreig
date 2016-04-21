var nomEntreprise;
$(document).ready(function()
{
		//$("#radio").click(function(){
		$("#bRechercher").click(function(){
				requeteAjaxTable();
			});

		$( "#dialog_refus" ).dialog({
			height:100,
			width:400,
			autoOpen:false,
			dialogClass: "alert",
			position: { my: "center bottom", at: "center top", of: window, within: $("#div_datatable")},
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
			position: { my: "center bottom", at: "center top", of: window, within: window},
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
	});

	// $("#form_rechercher").submit( requeteAjaxTable );
});

//cleanArray removes all duplicated elements
function cleanArray(array) {
  var i, j, len = array.length, out = [], obj = {};
  for (i = 0; i < len; i++) {
    obj[array[i]] = 0;
  }
  for (j in obj) {
    out.push(j);
  }
  return out;
}

function requeteAjaxTable()
{
	// récupération des champs cochés
	var longueur = $(".jstree-clicked").length ; 
	var liste_choix = new Array(longueur);
	var table =new Array(); 
	var champs = new Array(); 
	var champ_tmp = new Array(); 
	var selectedFullTable = new Array ; 
	var j = 0 ; 
	for(i=0; i < longueur; i++) 
	{
		var text_tmp = $($(".jstree-clicked")[i]).attr("id");
		var champ_tmp = text_tmp.split("_ancho") ; 
		liste_choix[i] = champ_tmp[0] ;
		var table_tmp = text_tmp.split(".") ;
		table[i] = table_tmp[0] ; 
		var tttt = table_tmp[1] ; 
		if ( tttt != null) champs[i] = tttt.split("_ancho")[0] ;
		else { 
			tttt = table_tmp[0] ; 
			champs[i] = champ_tmp[0].split("_ancho")[0] ;
			if( champs[i] != null ) 
			{
				table[i] = champs[i]; 
				selectedFullTable[j] = table[i] ; 
				j++;
				console.log("entrer");
				}
		}
	}
	table = cleanArray(table) ;
	console.log(liste_choix,table);

	$.ajax({

	   type: "POST",
	   url: "recup_donnees_export.php",
	   dataType: "json",
	   data: 'choix_entreprise='+$("#choix_entreprise").val()+'&liste_choix='+liste_choix+'&table='+table+'&selectedFullTable='+selectedFullTable,
	   success: function(data)
	   { 
	   	console.log(data);
	   		//alert("jai trouve qq chose");
			$("#div_datatable").children().remove();
			if(data.length>0) 
			{
				var chaine="<table width='100%' border='0' cellspacing='0' cellpadding='0' id='datatable_entreprise' class='display'> \
		    	<thead> <tr>";


		    	for(var i in liste_choix)
				{
				
				   chaine+="<th>"+champs[i]+"</th>";
				  
				   //$("tbody").append(chaine);  
				}
				chaine+="</tr></thead> <tbody>";
				for(var i in data)
				{

				   obj = data[i];
				   //console.log(obj);
				   chaine+="<tr>";
				   for(var j in obj)
				   {
				   		chaine+="<td>"+obj[j]+"</td>";
				   }
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

				$("#datatable_entreprise").dataTable({
					"bJQueryUI": true,
					responsive : true,
					"sPaginationType": "full_numbers",
					"aLengthMenu": [
[400, 2, 1],
["All", 2, 1]
],
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
};

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
};
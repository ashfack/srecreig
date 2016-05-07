var nomEntreprise;
$(document).ready(function()
{

		//$("#radio").click(function(){
		$("#bRechercher").click(function(){
				requeteAjaxTable();
			});

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
	   url: "ajax/recup_donnees_export.php",
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
					"responsive" : true,
					"iDisplayLength": -1,

					"sPaginationType": "full_numbers",
					"aLengthMenu": [[-1,10],["tous les",10]],
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


				
			}
			else 
			{
				$("#dialog_aucune_entreprise").dialog("open");
			}
	   }
	});
};

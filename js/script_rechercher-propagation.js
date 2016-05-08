var colVal = new Array();
var colonnes = new Array();
$(document).ready(function() 
{
	$("#tabs").tabs();

	$("#dialog_cycle").dialog(
	{
		height:542,
		width:542,
		autoOpen:false,
		dialogClass: "alert",
		position: { my: "center bottom", at: "center center", of: window, within: $("#tabs")},
		draggable: false,
		modal:true,
		buttons: 
		[
		    {
		      text: "OK",
		      icons: 
		      {
		        primary: "ui-icon-check"
		      },
		      click: function() 
		      {
		      	$( this ).dialog( "close" );
		      }
		    }

		]
	});

	$( "#dialog_cycle_vide" ).dialog({
		height:180,
		width:400,
		autoOpen:false,
		dialogClass: "alert",
		position: { my: "center bottom", at: "center center", of: window, within: window},
		draggable: false,
	 	open: function() {
            var dialog_refus = $(this);
            setTimeout(function() {
              dialog_refus.dialog('close');
            }, 2500);
        }
		
	});
	
	$("#dialog_editer").dialog(
			{
				height: 350,
				width:858.778,
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
						var obj=$(this).data('donneesDialog');
						console.log(obj['table']);
						console.log(obj['niveau']);
						console.log(obj['colVal']);
						
						editionAjax(nomEntreprise,obj['table'],obj['niveau'],obj['colVal']);
						
						
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

	var nomEntreprise=($("#titre_nomEntreprise").text()).trim();

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
			"oLanguage": 
			{ 
				"sUrl": "../js/fr_FR.txt"
			},
			"aaSorting": []
			
			});

			if(j>1)
			{
				$("#dataTable_"+table+"_niveau"+j).css("display","none");
				
				$("#bModifier_"+table+"_niveau"+j).css("display","none");
				$("#bSupprimer_"+table+"_niveau"+j).css("display","none");
				$("#bAjouter_"+table+"_niveau"+j).css("display","none");
			}
				
			
			$("#menu_"+table).on(
			  'click',
			  "#titre_"+table+"_niveau"+j,
			  (function(true_j,true_table){
			     return function()
			     {
			     	if(true_j>1)
			     	{
			     		var img=$(this).children()[0];
			    
			     		var src = ($(img).attr('src') === '../css/images/more.png')
									? '../css/images/minus.png'
									: '../css/images/more.png';
						
						$(img).attr('src', src);
			     		$("#dataTable_"+true_table+"_niveau"+true_j).toggle();

			     		$("#bModifier_"+true_table+"_niveau"+true_j).toggle();
						$("#bSupprimer_"+true_table+"_niveau"+true_j).toggle();
						$("#bAjouter_"+true_table+"_niveau"+true_j).toggle();
			     	}
			      		
			     };
			  })(j,table)
			);
			
			$("#menu_"+table).on(
			  'click',
			  "#bModifier_"+table+"_niveau"+j,
			  (function(true_j,true_table){
			     return function()
			     {
			     	var tabSelectionTable=$("#dataTable_"+true_table+"_niveau"+true_j+" tr.selected");
					//console.log(tabSelectionTable[0]);
					if( tabSelectionTable.length == 0)
						$("#dialog_refus").dialog("open");
					else
					{
						//console.log(tabSelectionTable);
						valueRecup=$(tabSelectionTable[0]).find('td:first').html();
						editer(true_table,true_j,valueRecup);
					}
			      		
			     };
			  })(j,table)
			);
		

		}
	
	}

 	$("tr").click(function(){
	   if($(this).hasClass('selected'))
	   		$(this).removeClass('selected');
	   else
	   {
	   		$(this).addClass('selected').siblings().removeClass('selected');    
	   		//$(this).addClass('selected');
	   }
				
	});

	// cacher les id et autres !!
	var tableau=document.getElementsByName("cacher");

	for(i=0;i<tableau.length;i++)
    {
        tableau[i].style.display = "none";   
    }

    // jstree pour les cycles
    $("#bVoirCycle").click(function()
    {
    	requeteAjaxCycle(nomEntreprise);
    });
	$("#bEditerCycle").click(function()
    {	alert("joj");
    	requeteAjaxCycle(nomEntreprise);
    });

			
});

function editer(true_table,true_j,valueRecup)
{				
				
				//alert("j "+true_j+", table "+true_table);
				$("#bModifier_"+true_table+"_niveau"+true_j).click(function()
				{
					var nbSelected=$(".selected").length;
					if( nbSelected == 0)
							$("#dialog_refus").dialog("open");
					else
					{
						$("#dialog_editer").children().next().remove();
						//colonnes= $($("#dataTable_"+true_table+"_niveau"+true_j+" th")).text();
						
						var j=0;
						while(($($("#dataTable_"+true_table+"_niveau"+true_j+" th")[j]).text())!="")
						{
							
							colonnes[j]= $($("#dataTable_"+true_table+"_niveau"+true_j+" th")[j]).text();
							j++;
						}
						
						//console.log("#dataTable_"+true_table+"_niveau"+true_j+" th");
						//console.log(colonnes);
						var chaine="<form class='form-group' action='editer_entreprise.php' method='POST'>";
						//colVal=$("#dataTable_"+true_table+"_niveau"+true_j+" tr.selected");
						colVal=[];
						for(var i=0;i<colonnes.length;i++)
						{
							if ($("#dataTable_"+true_table+"_niveau"+true_j+" tr.selected").last().find('td:nth-child('+(i+1)+')').is(":visible"))
							{
								colVal[i]=$("#dataTable_"+true_table+"_niveau"+true_j+" tr.selected").last().find('td:nth-child('+(i+1)+')').text();
								chaine+="<label>"+colonnes[i]+"</label>";
								chaine+="<input type='text' class='form-control' name='"+colonnes[i]+"' id='"+colonnes[i]+"' value='"+ colVal[i] +"'/> <br/>";
								
							}
						}
						if(true_table=="Entreprise" && true_j==1)
						{
							chaine+="<td id='cycleFormation'> <input type='button' value='Voir les cycles' id='bEditerCycle'/> </td>";
						}
						chaine+="</form>";
						$("#dialog_editer").append(chaine);
						//console.log(colVal);
						nomEntreprise=$(".selected").find('td:first').html();

						$("#emplacement_editer_nomEntreprise").text(nomEntreprise);
						
						// ouverture pop up
						$("#dialog_editer").data("donneesDialog", { table: true_table, niveau: true_j, colVal: colVal });
						//$("#dialog_cycle").dialog("open");
						$("#dialog_editer").dialog("open");
						
					}
						
				});

			

	   
	
}

function requeteAjaxCycle(nomEntreprise)
{
	alert("on entre");
	$.ajax({

	   type: "POST",
	   url: "recup_cycleFormation.php",
	   dataType: "json",
	   data: 'nomEntFreprise='+nomEntreprise,
	   success: function(data)
	   {
			if(data.length>0) 
			{
				//$.jstree.defaults.checkbox.whole_node=false;
		   		//$.jstree.defaults.checkbox.tie_selection=false;
		   		//$.jstree.reference('#jstree').redraw();
		   		$('#jstree').jstree("deselect_all");

				for(var i in data)
				{
					$('#jstree').jstree('select_node', data[i].toString());
				}
					
				var test = $('#jstree').jstree(true).get_json('#', { 'flat': true });
				
				//$.jstree.reference('#jstree').disable_checkbox();
				//$.jstree.reference('#jstree').hide_checkboxes();

				$("#dialog_cycle").dialog("open");
			
			}
			else
				$("#dialog_cycle_vide").dialog("open");
	   }
	});

	
}

function editionAjax(nomEntreprise,table,niveau,donnees)
{
	donnees[0]=$( "input[name*='"+colonnes[0]+"']" ).val();
	for(var i=1;i<donnees.length;i++)
	{
		donnees[i]=$( "input[name*='"+colonnes[i]+"']" ).val();
		
	}
	$.ajax({

	   type: "POST",
	   url: "ajax/editer_propagation.php",
	   dataType: "text",
	   data: {nomEntreprise: nomEntreprise, table: table, niveau: niveau, donnees: donnees},
	   success: function(data)
	   {
			if(data=="ok") 
			{
				location.reload();
			}
			else
			{
				popupMessage("#dialog_message","<p> L'édition a echouée </p>");
			}
				
	   }
	});
}
	
function popupMessage(idPopup,msg)
{
	$(idPopup).children().remove();
	$(idPopup).append(msg);
	$(idPopup).dialog("open");
}

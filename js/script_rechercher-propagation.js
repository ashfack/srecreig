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

			/*if(j>1)
			{
				$("#dataTable_"+table+"_niveau"+j).css("display","none");
				
				$("#bModifier_"+table+"_niveau"+j).css("display","none");
				$("#bSupprimer_"+table+"_niveau"+j).css("display","none");
				$("#bAjouter_"+table+"_niveau"+j).css("display","none");
			}*/
				
			
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


			
});

function requeteAjaxCycle(nomEntreprise)
{

	$.ajax({

	   type: "POST",
	   url: "recup_cycleFormation.php",
	   dataType: "json",
	   data: 'nomEntreprise='+nomEntreprise,
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
				$.each(test, function( key, value ) 
				{
					
				    if (value.state.selected == false) 
				    {
				        $('#jstree').jstree('disable_node', value.id);
				    }
				    else
				    	$('#jstree').jstree('disable_checkbox', value.id);
				});
				
				//$.jstree.reference('#jstree').disable_checkbox();
				//$.jstree.reference('#jstree').hide_checkboxes();

				$("#dialog_cycle").dialog("open");
			
			}
			else
				$("#dialog_cycle_vide").dialog("open");
	   }
	});

}
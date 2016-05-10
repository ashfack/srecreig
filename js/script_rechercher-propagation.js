var colVal = new Array();
var colonnes = new Array();
var colonnesPattern_ajout={Telephonefixe:"^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$", 
								Telephonemobile: "^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$", 
								Mail: "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 
								Anneeentree: "[1-9]{1}", Datedebutcontrat: "20[0-9]{2}", Datefincontrat: "20[0-9]{2}",  
								Anneedeversement: "20[0-9]{2}", Montantpromesseversement: "\d+", Montantverse: "\d+", 
								Montant:"\d+", Heuredebut: "([01]?[0-9]|2[0-3]):[0-5][0-9]", Heurefin: "([01]?[0-9]|2[0-3]):[0-5][0-9]", 
								Anneedeparticipation: "20[0-9]{2}", Nom: "[a-zA-Z-_]*", Prenom: "[a-zA-Z-_]*", NumeroSIRET: "[0-9]{14}", Codepostal: "[0-9]{5}"   
							};
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

	$( "#dialog_message" ).dialog({
		height:200,
		width:400,
		autoOpen:false,
		dialogClass: "alert",
		position: { my: "center center", at: "center top", of: window, within: $("#tabs")},
		draggable: false,
	 	open: function() {
	        var dialog_message = $(this);
	        setTimeout(function() {
	          dialog_message.dialog('close');
	        }, 2000);
	    }
		
	});

	$("#dialog_supprimer_confirmation").dialog(
    {
        height: 220,
        width: 510,
        autoOpen: false,
        dialogClass: "alert",
        position: 
        {
            my: "center bottom",
            at: "center center",
            of: window,
            within: $("#tabs")
        },
        draggable: false,
        modal: true,
        buttons: [
        {
                text: "Oui",
                icons:
                {
                    primary: "ui-icon-check"
                },
                click: function() 
                {
                	
                    $(this).dialog("close");
                    var obj=$(this).data('donneesDialog');
					/*console.log(obj['table']);
					console.log(obj['niveau']);
					console.log(obj['tabDonnees']);*/
                    
                    requeteAjaxSuppression(nomEntreprise,obj['table'],obj['niveau'],obj['tabDonnees']);
			
                }
        }, 
        {
                text: "Annuler",
                icons: 
                {
                    primary: "ui-icon-closethick"
                },
                click: function() 
                {
                    $(this).dialog("close");
                }
        }

        ]
    });
	
	$("#dialog_editer").dialog(
	{
		height: 600,
		width:810,
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
				var idSelected = $("tr.selected").children().attr('id').split('_')[1] ;
				var idCoordRH = $("tr.selected").last().find('td:nth-child(3)').text();
				var idSelected2 = $("tr.selected").last().find('td:nth-child(1)').text();
				var idCoordRH2 = $("tr.selected").last().find('td:nth-child(4)').text();
				var nom1;
				var prenom1;
				console.log(obj['table']);
				console.log(obj['niveau']);
				console.log(obj['colVal']);
				
				editionAjax(nomEntreprise, idSelected, idSelected2, idCoordRH, idCoordRH2, nom1, prenom1, obj['table'],obj['niveau'],obj['colVal']);
				location.reload();

				
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


	$("#dialog_ajouter").dialog(
    {
        height: 600,
        width: 810,
        autoOpen: false,
        dialogClass: "alert",
        position: 
        {
            my: "center bottom",
            at: "center center",
            of: window,
            within: $("#tabs")
        },
        draggable: false,
        modal: true,
        buttons: [
       {
                text: "Valider",
                icons: 
                {
                    primary: "ui-icon-check"
                },
                click: function() 
                {

                    
                    var obj=$(this).data('donneesDialog');
                    var table=obj['table'];
                    var niveau=obj['niveau'];
                   	
                    //recuperer les valeurs des inputs
                   var fils=$("#form_"+table+"_niveau"+niveau).children();
                   var elem;
                   var data= new Array();
                   for(var i=0;i<fils.length;i++)
                   {
                   		elem=$(fils[i]).find('input');
                   	
                   		if(elem.length!=0)
                   			data.push($(elem).val());
                   		else
                   			data.push($(fils[i]).find('option:selected').val());
                   }
                    $(this).dialog("close");
                    requeteAjaxAjout(nomEntreprise,obj['table'],obj['niveau'], data);

                }
        }, {
                text: "Annuler",
                icons: 
                {
                    primary: "ui-icon-closethick"
                },
                click: function() 
                {
                    $(this).dialog("close");
                }
            }

        ]
    });

	var nomEntreprise=($("#titre_nomEntreprise").text()).trim();
	var colonnesType_ajout={Telephonefixe: "tel", Telephonemobile: "tel", Mail: "email", Anneeentree: "number",
								DateRVpreparation:"text", DateRVsimulation:"text", Datedebutcontrat: "number",  
								Datefincontrat: "number", DateenvoiFLauCFA: "text", Anneedeversement: "number", 
								Montantpromesseversement: "number", Montantverse: "number", RapprochementAC: "text",    
								Dateenregistrement: "text", Montant:"number", Datedernieremodification: "text",
								DatetransmissionchequeAC: "text", Dateatelier: "text", Dateconference: "text",
								Heuredebut: "time", Heurefin: "time", Anneedeparticipation: "number"    
							};

	



	// datatable + systeme pyramidale
	var table_array=new Array("Entreprise","CoordonneesPersonne","Alternance","TaxeApprentissage","AtelierRH","Conference","ForumSG");

	//var colonnesSelect_ajout= {AtelierRHNiveau2: "Dateatelier",ConferenceNiveau2: "Dateconference" }
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
			    
			     		var src = ($(img).attr('src') === '../img/more.png')
									? '../img/minus.png'
									: '../img/more.png';
						
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
			  "#bSupprimer_"+table+"_niveau"+j,
			  (function(true_j,true_table){
			     return function()
			     {
			     	var tabSelectionTable=$("#dataTable_"+true_table+"_niveau"+true_j+" tr.selected");
					if( tabSelectionTable.length == 0)
					{
						popupMessage("#dialog_message","<p> Vous devez selectionner une ligne </p>");
					}
						
					else
					{
						var ligne=tabSelectionTable[0];
						
						var tabDonnees=new Array();
						if(true_table=="Alternance" && (true_j==3 || true_j==4))
						{
							tabDonnees.push($(ligne).find('td:first').html());
							tabDonnees.push($(ligne).find('td:nth-child(4)').html());
						}
						else if( (true_table=="AtelierRH" || true_table=="Conference")  && true_j==2 )
						{
							tabDonnees.push($(ligne).find('td:first').html());
							tabDonnees.push($(ligne).find('td:nth-child(3)').html());
						}
						else if(true_table=="ForumSG")
						{
							tabDonnees.push(nomEntreprise);
							tabDonnees.push($(ligne).find('td:nth-child(2)').html());
						}
						else if(true_table=="CoordonneesPersonne" || (true_table=="Alternance" && (true_j==1 || true_j==2)) )
						{
							tabDonnees.push(nomEntreprise);
							tabDonnees.push($(ligne).find('td:first').html());
						}
						else
							tabDonnees.push($(ligne).find('td:first').html());

						
						$("#dialog_supprimer_confirmation").data("donneesDialog", { table: true_table, niveau: true_j, tabDonnees: tabDonnees });
						
						if(true_table=="Entreprise")
						{
							popupMessage("#dialog_supprimer_confirmation",
								" <p> \
					              Vous allez supprimer l'entreprise <span>"+nomEntreprise+"</span> et toutes les données qui lui sont liées (Contacts, alternants, taxe d'apprentissage...) <br/> \
					              Etes vous sûr de vouloir continuer ? \
					            </p>");
						}
						else
						{
							popupMessage("#dialog_supprimer_confirmation",
								" <p> \
					              Attention votre action peut entrainer la suppression d'autres données ! <br/> \
					              Etes vous sûr de vouloir continuer ? \
					            </p>");
						}

							

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
						popupMessage("#dialog_message","<p> Vous devez selectionner une ligne </p>");
					else
					{
						//console.log(tabSelectionTable);
						valueRecup=$(tabSelectionTable[0]).find('td:first').html();
						editer(true_table,true_j,valueRecup);
					}
			      		
			     };
			  })(j,table)
			);

			$("#menu_"+table).on(
              'click',
              "#bAjouter_"+table+"_niveau"+j,
              (function(true_j,true_table){
                 return function()
                 {
                 	if(true_j != 1 && $("#dataTable_"+true_table+"_niveau1").dataTable().fnGetData().length==0)
                 	{
                 		popupMessage("#dialog_message","<p> Veuillez d'abord entrer des données dans le niveau 1 </p>");
                 		return;
                 	}

                 	if(true_table=="TaxeApprentissage" && true_j==1)
                 	{
                 		popupMessage("#dialog_message","<p> l'ajout de la taxe d'apprentissage n'est pas encore gérée dans cette version </p>");
                 		return;
                 	}

                    var datatable = "#dataTable_"+true_table+"_niveau"+true_j;

                    $("#dialog_ajouter").children().remove();
                    
                    colonnes= $(datatable+" th").map(function() 
                                                    { 
                                                        if($(this).attr('name')!="cacher" && $(this).text()!="")
                                                        {
                                                            return $(this).text();
                                                        }
                                                            
                                                    });


                    var chaine="<form action='#' method='POST' id='form_"+true_table+"_niveau"+true_j+"'>";
                    var idDatePicker= new Array();
                    for(var i=0;i<colonnes.length;i++) 
                    {
                        var colonneSansEspace = colonnes[i].replace(/\s/g,"");
                        var objet_OptionCiviliteType={Civilite: ["Madame", "Monsieur"], Type: ["Primaire","Secondaire","TA","Autre"]};
                        //provisoire --> je vais lies les deux selects
                        if(true_table=="Alternance" && colonneSansEspace=="Prenom" && i==1)
                        {
                        	continue;
                        }
                           
                        else
                        {
                            chaine+=" <div class='form-group row'>";
                            chaine+="<label for='"+true_table+"_"+colonneSansEspace+"' class='col-sm-3 form-control-label'>"+colonnes[i]+": </label>";
                            chaine+="<div class='col-sm-10'>";

                            if(true_table=="Alternance" && colonneSansEspace=="Nom" && i==0 )
                            {
                                
                                var data=$("#dataTable_Alternance_niveau1").dataTable().fnGetData();
                                
                                chaine+="<select name='"+true_table+"_"+colonneSansEspace+"_niveau"+true_j+"_Alternant' id='"+true_table+"_"+colonneSansEspace+"_niveau"+true_j+"_Alternant' class='form-control'>"
                                
                                for(var k=0;k<data.length;k++)
                                {
                                    //var choixData= (i==0) ? data[k][6] : data[k][7];
                                    var id=$($("#dataTable_Alternance_niveau1").find("tbody tr")[k]).children().attr('id').split('_')[1];
                                	//console.log(id);
                                    chaine+="<option value='"+id+"'>"+data[k][6]+"</option>";
                                }
                                chaine+="</select>";
                            }

                            else if((colonneSansEspace=="Dateatelier" || colonneSansEspace=="Dateconference") && true_j==2)
                            {
                                var data=$("#dataTable_"+true_table+"_niveau1").dataTable().fnGetData();

                                
                                chaine+="<select name='"+true_table+"_"+colonneSansEspace+"_niveau2' id='"+true_table+"_"+colonneSansEspace+"_niveau2' class='form-control' >"
                                
                                for(var k=0;k<data.length;k++)
                                {
                                	var id=$($("#dataTable_"+true_table+"_niveau1").find("tbody tr")[k]).children().attr('id').split('_')[1];
                                	console.log(id);
                                    chaine+="<option value='"+id+"'>"+data[k][1]+"</option>";
                                }
                                chaine+="</select>";

                                
                            }
                            else if(colonneSansEspace=="Civilite" || colonneSansEspace=="Type")
                            {
                            	
	                        	chaine+="<select name='"+true_table+"_"+colonneSansEspace+"_niveau"+true_j+"' id='"+true_table+"_"+colonneSansEspace+"_niveau"+true_j+"' class='form-control' >";
	                        	
	                        	var tabOption= objet_OptionCiviliteType[colonneSansEspace];
	                        	for(var k=0;k<tabOption.length;k++)
                                {
                                    chaine+="<option value='"+tabOption[k]+"'>"+tabOption[k]+"</option>";
                                }
	                        	chaine+="</select>";
                            }
                            else
                            {
                                if(has(colonnesType_ajout,colonneSansEspace)) // elle a un type autre que text (sauf pr celles qui seront des datepicker)
                                {
                                    chaine+="<input type='"+colonnesType_ajout[colonneSansEspace]+"' class='form-control' id='"+true_table+"_"+colonneSansEspace+"_niveau"+true_j+"'>";

                                    if(colonnesType_ajout[colonneSansEspace]=="text")
                                        idDatePicker.push(true_table+"_"+colonneSansEspace+"_niveau"+true_j);
                                }
                                else
                                    chaine+="<input type='text' class='form-control' id='"+true_table+"_"+colonneSansEspace+"_niveau"+true_j+"' >";

                                /*if(has(colonnesPattern_ajout,colonneSansEspace))
                                    chaine+=" pattern='"+colonnesPattern_ajout[colonneSansEspace]+"' required>";
                                else
                                chaine+=">";*/
                            }
                                       
                            chaine+="</div> </div>";
                        }
                       
                    }

                    //chaine+="<button type='submit' class='btn btn-default'>Valider</button>";
                    chaine+="</form>";
                    
                    //console.log(chaine);
                    $("#dialog_ajouter").append(chaine);
                    
                    for(var i=0; i< idDatePicker.length;i++)
                    {
                        console.log("#"+idDatePicker[i]);
                        $("#"+idDatePicker[i]).datepicker({
                        	dateFormat: "yy-mm-dd",
                        	altFormat: "dd/mm/yyyy"
                        });
                    }

                    $("#dialog_ajouter").data("donneesDialog", { table: true_table, niveau: true_j}).dialog("open");
                    
                        
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


function editer(true_table,true_j,valueRecup)
{				
		$("#bEditerCycle").click(function()
		{	alert("joj");
			requeteAjaxCycle(nomEntreprise);
		});
		//alert("j "+true_j+", table "+true_table);
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
					if (colonnes[i].substring(0,5)==" Comm")
					{
						chaine+="<textarea class='form-control' name='"+colonnes[i]+"' id='"+colonnes[i]+"'>"+ colVal[i] +"</textarea>";	
					}
					else if(colonnes[i]!=" Montant verse " && colonnes[i]!=" Questionnaire de satisfaction " && colonnes[i]!=" Cycle Formation " )
					{
						chaine+="<input type='text' class='form-control' name='"+colonnes[i]+"' id='"+colonnes[i]+"' value='"+ colVal[i] +"'/> <br/>";	
					}
					
					
				}
			}
			if(true_table=="Entreprise" && true_j==1)
			{
				chaine+="<td id='cycleFormation'> <input type='button' value='Editer les cycles' id='bEditerCycle'/> </td>";
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

}


function editionAjax(nomEntreprise, idSelected, idSelected2, idCoordRH, idCoordRH2, nom1, prenom1, table,niveau,donnees)
{
	donnees[0]=$( "input[name*='"+colonnes[0]+"']" ).val();
	for(var i=1;i<donnees.length;i++)
	{
		if (colonnes[i].substring(0,5)==" Comm")
		{
			donnees[i]=$( "textarea[name*='"+colonnes[i]+"']" ).val();
		}
		else
		{	
			donnees[i]=$( "input[name*='"+colonnes[i]+"']" ).val();
		}
	}
	var nom1=$("form input")[3].value;
	var prenom1=$("form input")[4].value;
	$.ajax({

	   type: "POST",
	   url: "ajax/editer_propagation.php",
	   dataType: "text",
	   data: {nomEntreprise: nomEntreprise, idSelected: idSelected, idSelected2: idSelected2, idCoordRH: idCoordRH, idCoordRH2: idCoordRH2, nom1: nom1, prenom1: prenom1, table: table, niveau: niveau, donnees: donnees},
	   success: function(data)
	   {
			if(data=="ok") 
			{
				window.location.reload();
			}
			else if(data=="erreur édition")
			{
				popupMessage("#dialog_message","<p> L'édition a echouée </p>");
			}
				
	   }
	});
}

function requeteAjaxCycle(nomEntreprise)
{

	$.ajax({

	   type: "POST",
	   url: "ajax/recup_cycleFormation.php",
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
				popupMessage("#dialog_message","<p> L'entreprise n'est liée à aucun cycle/formation <br/> <br/> Cliquez sur le bouton \"Ajouter\" pour lui attribuer des cycles/formations </p>");
	   }
	});

}

function requeteAjaxSuppression(nomEntreprise,table,niveau,donnees)
{
	
	$.ajax({

	   type: "POST",
	   url: "ajax/supprimer_propagation.php",
	   dataType: "text",
	   data: {nomEntreprise: nomEntreprise, table: table, niveau: niveau, donnees: donnees},
	   success: function(data)
	   {
			if(data=="ok") 
			{
				popupMessage("#dialog_message","<p> Suppression effectué avec succès !! </p>");
				if(table=="Entreprise")
					document.location.href="rechercher.php";
				else
					location.reload();
			}
			else
			{
				popupMessage("#dialog_message","<p> La suppression a echoué </p>");
			}
				
	   }
	});
}

function requeteAjaxAjout(nomEntreprise,table,niveau,donnees)
{   
    //console.log("nomEntreprise : "+nomEntreprise+" table : "+table+" niveau: "+niveau+" donnees: "+donnees);
    //popupMessage("#dialog_message","<p> L'ajout n'est pas encore opérationnel !! <br/> On travaille dessus actuellement ! </p>");
    $.ajax({

       type: "POST",
       url: "ajax/ajouter_propagation.php",
       dataType: "text",
       data: {nomEntreprise: nomEntreprise, table: table, niveau: niveau, donnees: donnees},
       success: function(data)
       {
            if(data=="ok") 
            {
                popupMessage("#dialog_message","<p> Ajout effectué avec succès !! </p>");
                location.reload();
            }
            else
            {
                popupMessage("#dialog_message",data);
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

function has(object, key) 
{
      return object ? hasOwnProperty.call(object, key) : false;
}

function verifierPattern(tabDonnees)
{

}


	
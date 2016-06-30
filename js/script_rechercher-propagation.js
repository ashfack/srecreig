var colVal = new Array();
var colonnes = new Array();
var valeurCycleMentionSpecialite=new Array();
var colonnesPattern_ajout={Telephonefixe:/^0[1-68]([-. ]?[0-9]{2}){4}$/,
								Telephonemobile: /^0[1-68]([-. ]?[0-9]{2}){4}$/, 
								Mail: /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/, 
								Anneeentree: /^[123]$/, Datedebutcontrat: /^20[0-9]{2}$/, Datefincontrat: /^20[0-9]{2}$/,  
								Anneedeversement: /^20[0-9]{2}$/, Montantpromesseversement: /^0*([1-9][0-9]*)$|^0*([1-9][0-9]*[\.][0-9]*[1-9])0*$|^0*(0[\.][0-9]*[1-9])0*$/, Montantverse: /^0*([1-9][0-9]*)$|^0*([1-9][0-9]*[\.][0-9]*[1-9])0*$|^0*(0[\.][0-9]*[1-9])0*$/, 
								Montant:/^0*([1-9][0-9]*)$|^0*([1-9][0-9]*[\.][0-9]*[1-9])0*$|^0*(0[\.][0-9]*[1-9])0*$/, Heuredebut: /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/, Heurefin: /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/,
								Dateatelier: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, Dateconference: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								RapprochementAC: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, Dateenregistrement: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								Datedernieremodification: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, DatetransmissionchequeAC: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								DateRVpreparation: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, DateRVsimulation: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								DateenvoiFLauCFA: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, 
								Anneedeparticipation: /^20[0-9]{2}$/, Nom: /^[A-Z-_ ]+$/, Prenom: /^[A-Z]{1}[a-z-_ A-Z]*$/, NumeroSIRET: /^[0-9]{14}$/, Codepostal: /^[0-9]{5}$/   
							};
							
var exemplePattern_ajout={Telephonefixe:"01.00.00.00.00 (. ou - ou espace )", 
								Telephonemobile: "06.00.00.00.00 (. ou - ou espace )", 
								Mail: "exemple@exemple.com", 
								Anneeentree: "1 (ou 2,3)", Datedebutcontrat: "2016", Datefincontrat: "2016",  
								Anneedeversement: "2016", Montantpromesseversement: "1000.00 (nombre strictement positif)", Montantverse: "1000.00 (nombre strictement positif)", 
								Montant:"1000.00 (nombre strictement positif)", Heuredebut: "14:00", Heurefin: "17:00", 
								Anneedeparticipation: "2016", Nom: "EXEMPLE", Prenom: "Exemple", NumeroSIRET: "12345678912345 (14 chiffres)", Codepostal: "75000",
								Dateatelier: "2016-06-05", Dateconference: "2016-06-05",RapprochementAC: "2016-06-05", Dateenregistrement: "2016-06-05",
								Datedernieremodification:"2016-06-05", DatetransmissionchequeAC: "2016-06-05", DateRVpreparation: "2016-06-05", DateRVsimulation: "2016-06-05",
								DateenvoiFLauCFA:"2016-06-05"  
							};

var colonnesObligatoire_ajout={CoordonneesPersonneNiveau1:["Nom","Prenom"],AlternanceNiveau1:["Nom","Prenom"],
								AlternanceNiveau3:["Nom","Prenom"],AlternanceNiveau4:["Nom","Prenom"],
								TaxeApprentissageNiveau1:["Anneedeversement","Montantverse"],
								AtelierRHNiveau1:["Dateatelier"],AtelierRHNiveau2:["Nom","Prenom"],
								ConferenceNiveau1:["Dateconference"],ConferenceNiveau1:["Nom","Prenom"],
								ForumSGNiveau1:["Anneedeparticipation"]
							 };
var colonnesType_ajout={Telephonefixe: "tel", Telephonemobile: "tel", Mail: "email",
								DateRVpreparation:"text", DateRVsimulation:"text", Datedebutcontrat: "number",  
								Datefincontrat: "number", DateenvoiFLauCFA: "text", Anneedeversement: "number", 
								Montantpromesseversement: "number", Montantverse: "number", RapprochementAC: "text",    
								Dateenregistrement: "text", Montant:"number", Datedernieremodification: "text",
								DatetransmissionchequeAC: "text", Dateatelier: "text", Dateconference: "text",
								Heuredebut: "time", Heurefin: "time", Anneedeparticipation: "number"    
							};

var objet_Option={Civilite: ["Monsieur","Madame"], Type: ["Primaire","Secondaire","TA","Autre"], 
								Formationalternance: ["AIR","ENERA"], Anneeentree:[1,2,3], Typecontrat: ["Apprentissage","Contrat de Professionalisation"],
								Typeconference:["Métiers","Technique","Autre"], 
								Origine:["SRE","AISG","CAVAM","CEDIP","Corps Pédagogique","Direction Institut Galilée",
											"Direction Sup Galilée","Est Ensemble","Membre exterieur Conseil Institu Galilée",
											"Membre exterieur CA Sup Galilée","Plaine Commune","Présidence","Responsable pédagogique",
											"SCUIO-IP"],
								Typecontact: ["Entreprise","Personne","Collectivité territoriale","Communauté d'agglomérations"],
								Partenariatofficiel: ["OUI","NON"],
								Categorie: ["A","B","C"],
								Versementvia: ["SRE","Agence Comptable"],
								Modepaiement: ["Cheque","Virement","Inconnu"],
								Actionmenees:["Accueil d'apprentis en Energetique","Accueil d'apprentis en Informatique et Réseaux",
												"Animation d'ateliers RH de simulations d'entretiens","Animation de conférences métiers",
												"Partenariat officiel","Participation au Forum Sup Galilée Entreprises",
												"Recrutement de stagiaires","Recrutement des jeunes diplômé(e)s",
												"Soutien financier par le versement de taxe d'apprentissage"],
								Taille: ["< 10","10 à 249", "250 à 4999", "> 5000"]
								 };
var tabFormations=["cycle","mention","specialite"];
var compteurNbFormations=1;
var nomEntreprise;
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
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

	$("#dialog_cycle_editer").dialog(
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
		      	requeteAjaxCycleUpdate();
		      }
		    }

		]
	});

	$('#jstree_editer')
       .on("init.jstree", function(e, data) 
       {
           data.instance.settings.checkbox.cascade = '';
       })
       .on("changed.jstree", function(e, data) 
       {
           /*console.log("toto");
           console.log(data.selected);*/
       })
       .jstree
       ({
           checkbox: 
           {
               three_state: false,
           },
           types: 
           {
               "default": 
               {
                   "icon": "glyphicon glyphicon-flash"
               }
           },
           plugins: ['wholerow', 'checkbox', 'types']
       }),

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

                    requeteAjaxSuppression(obj['table'],obj['niveau'],obj['tabDonnees']);
			
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
			  	var obj=$(this).data('donneesDialog');
			  	verifierPopupAjoutEdition("editer",obj);
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
			  	verifierPopupAjoutEdition("ajouter",obj);
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
	
	 //reinitialisation de la largeur: la popup pour la taxe necessite une largeur plus grande
	$('div#dialog_ajouter').on('dialogclose', function(event) 
	{
    	$(this).dialog('option','width', 810);
 	});

 	$('div#dialog_editer').on('dialogclose', function(event) 
	{
    	$(this).dialog('option','width', 810);
 	});


	nomEntreprise=($("#titre_nomEntreprise").text()).trim();
	
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
							tabDonnees.push($(ligne).find('td:nth-child(3)').html());
						}
						else if(true_table=="ForumSG")
						{
							tabDonnees.push(nomEntreprise);
							tabDonnees.push($(ligne).find('td:nth-child(2)').html());
						}
						else if(true_table=="Alternance" && true_j==1)
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
					if( tabSelectionTable.length == 0)
						popupMessage("#dialog_message","<p> Vous devez selectionner une ligne </p>");
					else
					{
						var idTA=$(tabSelectionTable[0]).find('td:first').attr('id').split('_')[1]; //utilisé uniquement pr la TA
						creerFormulairePopup(true_table,true_j,"editer",idTA);
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

                 	creerFormulairePopup(true_table,true_j,"ajouter","");
                        
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
    	requeteAjaxCycle("jstree");
    });
	
			
});

function cycle()
{
	requeteAjaxCycle("jstree_editer");
}

function editionAjax(idSelected, idSelected2, idCoordRH, idCoordRH2,table,niveau,donnees)
{
	$.ajax({

	   type: "POST",
	   url: "ajax/editer_propagation.php",
	   dataType: "text",
	   data: {nomEntreprise: nomEntreprise, idSelected: idSelected, idSelected2: idSelected2, idCoordRH: idCoordRH, idCoordRH2: idCoordRH2, table: table, niveau: niveau, donnees: donnees},
	   success: function(data)
	   {
			if(data=="ok") 
			{
				popupMessage("#dialog_message","<p> Edition effectuée avec succès ! </p>");
				window.location.reload();
			}
			else
			{
				popupMessage("#dialog_message",data);
			}
				
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
	});
}

function requeteAjaxCycle(idJstree)
{

	$.ajax({

	   type: "POST",
	   url: "ajax/recup_cycleFormation.php",
	   dataType: "json",
	   data: 'nomEntreprise='+nomEntreprise,
	   success: function(data)
	   {
			if(idJstree=="jstree_editer" || data.length>0) 
			{
		   		$(idJstree).jstree("deselect_all");

				for(var i in data)
				{
					$("#"+idJstree).jstree('select_node', data[i].toString());
				}
					
				var test = $("#"+idJstree).jstree(true).get_json('#', { 'flat': true });
				
				if(idJstree!="jstree_editer")
				{
					$.each(test, function( key, value ) 
					{
						
					    if (value.state.selected == false) 
					    {
					        $('#jstree').jstree('disable_node', value.id);
					    }
					    else
					    	$('#jstree').jstree('disable_checkbox', value.id);
					});
				
				}
				if(idJstree=="jstree_editer")
					$("#dialog_cycle_editer").dialog("open");
				else
					$("#dialog_cycle").dialog("open");
			
			}
			else
				popupMessage("#dialog_message","<p> L'entreprise n'est liée à aucun cycle/formation <br/> <br/> Cliquez sur le bouton \"Modifier\" pour lui attribuer des cycles/formations </p>");
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
	});

}

function requeteAjaxSuppression(table,niveau,donnees)
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
				
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
	});
}

function requeteAjaxCycleUpdate()
{
	var liste_cycle_id= $('#jstree_editer').jstree(true).get_selected();
	$.ajax({

	   type: "POST",
	   url: "ajax/cycle_update.php",
	   dataType: "text",
	   data: "nomEntreprise="+nomEntreprise+"&liste_cycle_id="+liste_cycle_id,
	   success: function(data)
	   {
			if(data=="ok") 
			{
				//popupMessage("#dialog_message","<p> Mise à jour effectuée avec succès !! </p>");
			}
			else
			{
				popupMessage("#dialog_message","<p> La mise à jour a echoué </p>");
			}
				
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
	});
}
function requeteAjaxAjout(table,niveau,donnees)
{   
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
                
       },
       error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
    });
}

function requeteAjaxFormationsPopupEdition(idTA)
{

	$.ajax({

	   type: "POST",
	   url: "ajax/recup_cycleMentionSpecialiteEntreprise.php",
	   data: "idTA="+idTA,
	   dataType: "json",
	   success: function(data)
	   {
	   		
	        if(data.length>0) 
	        {
	        	var couple;
	        	compteurNbFormations=0;
	        	
	        	for(var i=0;i<data.length;i++)
	        	{
	        		$("#form_editer").append(creerSelectFormation(i)); //creation des selects
	        		creerEvenementsSelectFormations(i);
	        	
	        		
	        		//maintenant il faut pré-selectionner les cycle,mention,specialite,categorie de la taxe
	        		couple=data[i];
	        		
        			window.setTimeout(
        			( function(nb)
        			{

        				return function() 
        				{
			        		$("#cycle_"+nb+" option[value='"+data[nb]['cycle']+"']").prop('selected',true).trigger('change');
			        		$("#mention_"+nb+" option[value='"+data[nb]['mention']+"']").prop('selected',true).trigger('change');
			        		$("#specialite_"+nb+" option[value='"+data[nb]['specialite']+"']").prop('selected',true);
        				};
        			}) (i)
        			, 500);
	        		
	        		
	        		$("#categorie_"+i+" option[value='"+couple['categorie']+"']").prop('selected',true);
	        		$("#montant_"+i).val(couple['montant']);

	        		compteurNbFormations++;
	        	}
	        	$("#dialog_editer").append("<button class='btn btn-sm' type='button' value='Ajouter' style ='margin-left: 10px;' id='bAjouterMontantParFormation'><i class='fa fa-plus'></i> Ajouter</button> ");
	        	creerEvenementBoutonAjouter("editer");
	        }
	        else
	        {	
	           	$("#form_editer").append(creerSelectFormation(0));
				$("#form_editer").append("<button class='btn btn-sm' type='button' value='Ajouter' style ='margin-left: 10px;' id='bAjouterMontantParFormation'><i class='fa fa-plus'></i> Ajouter</button> ");
				creerEvenementBoutonAjouter("editer");
				creerEvenementsSelectFormations(0);
				compteurNbFormations=1;
	        }
	            
	   },
	   error : function()
	   {
	   		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
	   }
	});
}

function creerEvenementBoutonAjouter(popup)
{
	$("#bAjouterMontantParFormation").click(function()
	{
		$(this).remove();
		$("#form_"+popup).append(creerSelectFormation(compteurNbFormations));
		$("#form_"+popup).append("<button class='btn btn-sm' type='button' value='Ajouter' style ='margin-left: 10px;' id='bAjouterMontantParFormation'><i class='fa fa-plus'></i> Ajouter</button> ");
		creerEvenementBoutonAjouter(popup);
		creerEvenementsSelectFormations(compteurNbFormations);
		compteurNbFormations++;
	});
}

function creerEvenementsSelectFormations(nb)
{
	$("#cycle_"+nb).change(function(){
		requeteAjaxSelectFormations("cycle",$(this).val(),nb,$(this).val());
	});

	$("#mention_"+nb).change(function(){
		
		requeteAjaxSelectFormations("mention",$(this).val(),nb,$("#cycle_"+nb).val());
	});

	$("#bSupprimer_"+nb).click(function(){
		
		$("#montantParFormation_"+nb).remove();
	});
}

function requeteAjaxSelectFormations(choix,val,nb,cycle)
{   
   
    $.ajax({

       type: "POST",
       url: "ajax/recup_selectCycleMentionSpecialite.php",
       dataType: "json",
       data: {select: choix , selected: val, cycleChoisit: cycle},
       async:false,
       success: function(data)
       {
        	if(data!=null && typeof data == 'object')
        	{
        		if(Object.keys(data).length>0)
        		{
	        		var tabCle=Object.keys(data);
	        		var cle;
	        		var id;
	        		for(var i=0;i<tabCle.length;i++)
		        	{
		        		cle=tabCle[i];
		        		id="#"+cle+"_"+nb
		        		$(id).children().next().remove();
		        		
		        		var chaine="";
		        		for(var j=0;j<data[cle].length;j++)
		        		{
		        			chaine+="<option value=\""+data[cle][j]+"\">"+data[cle][j]+"</option>";
		        		}
		        		$(id).append(chaine);
		        		/*if(j==1) // "Aucune" est seulement retourné
		        			$(id).children().next().prop('selected', true);*/
		        	}
		        }
        	}
        	else
            {
                popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
            }    
       },
       error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
    });
}
function creerSelectFormation(nb)
{ 

    var chaine="<div class='form-inline' name='montantParFormation_"+nb+"' id='montantParFormation_"+nb+"'>";
		
	for(var k=0;k<3;k++)
	{
		chaine+="<select id='"+tabFormations[k]+"_"+nb+"' class='form-control'>";
		if(tabFormations[k]=="cycle")
		{
			chaine+="<option value='cycle'>Cycle</option>";
			chaine+="<option value='LICENCES'>LICENCES</option>";
			chaine+="<option value='MASTER'>MASTER</option>";
			chaine+="<option value='INGENIEURS'>INGENIEURS</option>";
			chaine+="<option value='INSTITUT GALILEE'>INSTITUT GALILEE</option>";
		}
		else
		{
            chaine+="<option value='"+tabFormations[k]+"'>"+tabFormations[k].capitalizeFirstLetter()+"</option>";
        }
		chaine+="</select>";
	}

	chaine+="<select id='categorie_"+nb+"' class='form-control'>";
	chaine+="<option value='Categorie'>Categorie</option>";
	chaine+="<option value='A'>A</option>";
	chaine+="<option value='B'>B</option>";
	chaine+="<option value='C'>C</option>";
	chaine+="</select>";
	chaine+="<input type='number' id='montant_"+nb+"' class='form-control' placeholder='Montant'>";
	chaine+="<span class='btn btn-danger glyphicon glyphicon-remove' id='bSupprimer_"+nb+"'</span>";
	chaine+="</div>";
	
	return chaine;
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

function verifierPattern(idElem,valElem,table,niveau)
{
	//ces id correspondent aux selects présents dans les niveaux 2, 3 et 4 de l'onglet alternance. Ceux-ci sont recuperés directement depuis la datatable niveau 1 
	// et sont forcément au bon format. Les valeurs des options étant des id (de la BDD) on est obligé de traiter le cas
	// Leurs valeurs est l'id de l'alternant pour faciliter le traitement côté serveur !
	//pareil pour l'annee de versement dans le niveau 3 et dateAtelier et dateconference
	if(["Alternance_Nom_niveau2_Alternant","Alternance_Nom_niveau3_Alternant","Alternance_Nom_niveau4_Alternant",
		"TaxeApprentissage_Anneedeversement_niveau3","AtelierRH_Dateatelier_niveau2","Conference_Dateconference_niveau2"].indexOf(idElem)>=0)
	{
		return "ok";
	}

	var nomColonne=idElem.split('_')[1];
	var cle=table+"Niveau"+niveau;
	var nomColonneEspace;

	if(valElem=="")
	{
		if(has(colonnesObligatoire_ajout,cle) && colonnesObligatoire_ajout[cle].indexOf(nomColonne)!=-1)
		{
			nomColonneEspace=($("#"+idElem).parent().prev().html()).replace(":",""); // recuperation du label
			return "<li> L'attribut "+nomColonneEspace+" est obligatoire ! </li>";
		}
			
	}
	else
	{
		if(has(colonnesPattern_ajout,nomColonne) && !colonnesPattern_ajout[nomColonne].test(valElem))
		{
			nomColonneEspace=($("#"+idElem).parent().prev().html()).replace(":","");
			return "<li> L'attribut "+nomColonneEspace+" n'est pas au bon format (exemple: "+exemplePattern_ajout[nomColonne]+" ) </li>";
		}
	}

	return "ok";

}

function creerFormulairePopup(table,niveau,popup,idTA)
{
	compteurNbFormations=1;
    var datatable = "#dataTable_"+table+"_niveau"+niveau;

    $("#dialog_ajouter").children().remove();
    $("#dialog_editer").children().remove();
    
    colonnes= $(datatable+" th").map(function() 
                { 
                    if($(this).attr('name')!="cacher" && $(this).text()!="")
                    {
                        return $(this).text();
                    }
                        
                });

    var chaine="<div class='alert alert-danger' role='alert' style='display:none' id='zone_message'> </div>";
    chaine+="<form action='#' method='POST' id='form_"+popup+"'>";

    if((table=="AtelierRH" || table=="Conference") && niveau==1)
    {
    	chaine+="<input style='height:0px; border:none' id='cacher_datepicker'/>";
    }
    var idDatePicker= new Array();

    var colonneSansEspace;
    var id;
  	colVal=[];
  	var valeur;
    for(var i=0;i<colonnes.length;i++) 
    {
        colonneSansEspace = colonnes[i].replace(/\s/g,"");

        //On affiche que le nom de l'alternant pr les niveaux 4 et 3 (position 1)
        // cycle formation --> jstree
        if((table=="Alternance" && (colonneSansEspace=="Prenom" && i==1 )) || colonneSansEspace=="Cycleformation")
        {
        	continue;
        }

        if(popup=="editer")
        {
        	valeur=$($(datatable+" tr.selected").last().find("td:not([name='cacher'])")[i]).text().trim();
        	colVal[i]=valeur;
        }
        	
        id=table+"_"+colonneSansEspace+"_niveau"+niveau;

        chaine+=" <div class='form-group row'>";
        chaine+="<label for='"+id+"' class='col-sm-4 form-control-label'>"+colonnes[i]+": </label>";
        chaine+="<div class='col-sm-8'>";

        //recupere les noms de la datatable niveau 1 et construit une liste déroulante
        if(table=="Alternance" && colonneSansEspace=="Nom" && i==0 )
        {
            
            var data=$("#dataTable_Alternance_niveau1").dataTable().fnGetData();
            
            chaine+="<select name='"+id+"_Alternant' id='"+id+"_Alternant' class='form-control' ";
            if(popup=="editer")
            	chaine+=" disabled";
            chaine+=">";
            var id_alternant;
            for(var k=0;k<data.length;k++)
            {
                id_alternant=$($("#dataTable_Alternance_niveau1").find("tbody tr")[k]).children().attr('id').split('_')[1];
            	
                chaine+="<option value='"+id_alternant+"'";
                
                if(popup=="editer" && valeur==data[k][6])
                	chaine+=" selected";
                
                chaine+=">"+data[k][6]+"</option>";
            }
            chaine+="</select>";
        }
      	//Pareil qu'au dessus mais avec des dates
        else if(((colonneSansEspace=="Dateatelier" || colonneSansEspace=="Dateconference") && niveau==2) || (colonneSansEspace=="Anneedeversement" && niveau==3))
        {
            var data=$("#dataTable_"+table+"_niveau1").dataTable().fnGetData();

           
            chaine+="<select name='"+id+"' id='"+id+"' class='form-control' ";
            if(popup=="editer")
            	chaine+=" disabled";
            chaine+=">";
            var id_date;
            for(var k=0;k<data.length;k++)
            {
            	id_date=$($("#dataTable_"+table+"_niveau1").find("tbody tr")[k]).children().attr('id').split('_')[1];
            
                chaine+="<option value='"+id_date+"'";
                
                if(popup=="editer" && valeur==data[k][1])
                	chaine+=" selected";

                chaine+=">"+data[k][1]+"</option>";
            }
            chaine+="</select>";

            
        }
        //c'est une colonne qui a plusieurs options ---> création d'une liste déroulante 
        else if(has( objet_Option,colonneSansEspace))
        {
        	
        	chaine+="<select name='"+id+"' id='"+id+"' class='form-control' >";
        	
        	var tabOption= objet_Option[colonneSansEspace];
        	for(var k=0;k<tabOption.length;k++)
            {
                chaine+="<option value='"+tabOption[k]+"'";

                if(popup=="editer" && valeur==tabOption[k])
                	chaine+=" selected";
                
                chaine+=">"+tabOption[k]+"</option>";
            }
        	chaine+="</select>";
        }
        // c'est un commentaire --> un textarea
        else if (colonneSansEspace.substring(0,4)=="Comm")
		{				
			chaine+="<textarea class='form-control' name='"+id+"' id='"+id+"'>";
			if(popup=="editer")
				chaine+=valeur;
			chaine+="</textarea>";
		}

		// La colonne a un type autre que text (sauf pr celles qui seront des datepicker)
        else
        {
            if(has(colonnesType_ajout,colonneSansEspace)) 
            {
                chaine+="<input type='"+colonnesType_ajout[colonneSansEspace]+"' class='form-control' id='"+id+"' ";
                if(popup=="editer")
					chaine+="value='"+valeur+"'";
				chaine+=">"; // fin input

                if(colonnesType_ajout[colonneSansEspace]=="text")
                    idDatePicker.push(id);
            }
            else
            {
            	chaine+="<input type='text' class='form-control' id='"+id+"' ";
            	if(popup=="editer")
					chaine+="value='"+valeur+"'";
				chaine+=">"; // fin input
            }
                
        }

        chaine+="</div> </div>";
             
    }

    //ajout de cycle mention specialite montant dans taxe
   	if(table=="TaxeApprentissage" && niveau==1)
 	{
 		//Ajout OCTA, mode de paiement, date transmission, commentaires
 		chaine+="<div class='form-group row' id='OCTA'>";
		chaine+="<label for='TaxeApprentissage_OCTA_niveau1' class='col-sm-4 form-control-label'> OCTA: </label>";
		chaine+="<div class='col-sm-8'>";
		chaine+="<input type='text' class='form-control' id='TaxeApprentissage_OCTA_niveau1' >";
		chaine+="</div>";
		chaine+="</div>";

		chaine+="<div class='form-group row' id='Modepaiement'>";
		chaine+="<label for='TaxeApprentissage_ModePaiement_niveau1' class='col-sm-4 form-control-label'> Mode de paiement: </label>";
		chaine+="<div class='col-sm-8'>";
		chaine+="<select class='form-control' name='TaxeApprentissage_Modepaiement_niveau1' id='TaxeApprentissage_Modepaiement_niveau1'>";
		chaine+="<option value='cheque'>cheque</option>"; 
		chaine+="<option value='virement'>virement</option>";
		chaine+="</select>";
		chaine+="</div>";
		chaine+="</div>";

		chaine+="<div class='form-group row' id='DatetransmissionchequeAC'>";
		chaine+="<label for='TaxeApprentissage_DatetransmissionchequeAC_niveau1' class='col-sm-4 form-control-label'> Date transmission cheque AC: </label>";
		chaine+="<div class='col-sm-8'>";
		chaine+="<input type='text' class='form-control' id='TaxeApprentissage_DatetransmissionchequeAC_niveau1' >";
		chaine+="</div>";
		chaine+="</div>";

		idDatePicker.push("TaxeApprentissage_DatetransmissionchequeAC_niveau1");

		chaine+="<div class='form-group row' id='CommentairesTaxes'>";
		chaine+="<label for='TaxeApprentissage_CommentairesTaxes_niveau1' class='col-sm-4 form-control-label'> Commentaires Taxes: </label>";
		chaine+="<div class='col-sm-8'>";
		chaine+="<textarea class='form-control' id='TaxeApprentissage_CommentairesTaxes_niveau1' > </textarea>";
		chaine+="</div>";
		chaine+="</div>";

 		chaine+="<div class='form-group row' id='labelMontantFormations'>";
		chaine+="<label for='montantParFormation_0' class='col-sm-4 form-control-label'> Montant par formation: </label>";
    	chaine+="</div>";
    	if(popup=="ajouter")
    	{
    		chaine+=creerSelectFormation(0);
    		chaine+="<button class='btn btn-sm' type='button' value='Ajouter' style ='margin-left: 10px;' id='bAjouterMontantParFormation'><i class='fa fa-plus'></i> Ajouter</button> ";
    	}
			
 	}
   if(popup=="editer" && table=="Entreprise" && niveau==1)
	{
		chaine+="<button type='button' class='btn btn-info' id='bEditerCycle' onclick='cycle()' >Editer les cycles</button> ";
	}
    chaine+="</form>";

    $("#dialog_"+popup).append(chaine);

    if(table=="TaxeApprentissage" && niveau==1)
 	{
 		if(popup=="editer")		
    		requeteAjaxFormationsPopupEdition(idTA);
    	else
    	{
    		creerEvenementsSelectFormations(0);
    		creerEvenementBoutonAjouter("ajouter");
    	}

		$("#dialog_"+popup).dialog('option','width','100%');
 	}
   
   	// generation des datepicker
    for(var i=0; i< idDatePicker.length;i++)
    {
        $("#"+idDatePicker[i]).datepicker({
        	dateFormat: "yy-mm-dd",
        	altFormat: "dd/mm/yyyy",
        	changeMonth: true,
        	changeYear: true,
        	monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
			monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
			dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
			dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        	dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        	showWeek: true,
        	weekHeader: "Sem.",
        	yearRange: "1900:2020"
        });
    }

    $("#dialog_"+popup).data("donneesDialog", { table: table, niveau: niveau, colVal:colVal}).dialog("open");
    
}

function arrayObjectIndexOf(myArray, searchTerm) {
    for(var i = 0, len = myArray.length; i < len; i++) {
        if (myArray[i].trim() === searchTerm.trim()) return i;
    }
    return -1;
}

function verifierPopupAjoutEdition(popup,obj)
{
   
   	var table=obj['table'];
   	var niveau=obj['niveau'];

   	var select;
  	var input;
   	var textarea;

   	var cycle;
   	var mention;
   	var specialite;
   	var montant;

   	var elemPush;
   	var id;
   	var idElem;
   	var valElem;

   	var data= new Array();
   	var groupSelectMontant;

   	var montantVerse=0;
   	var sommeMontant=0;
   	var formationsOK=true;
 	var montantsOK=true;
 	var toutOK=true;
   	var chaineMessageErreur="<ul>";
   	var chaine="";
   	var colonneSansEspace="";

   	var fils=$("#form_"+popup).children();
   
   	for(var i=0;i<fils.length;i++)
   	{
   		
		id=$(fils[i]).attr("id");
		if(id!=null && id=="cacher_datepicker")
			continue;
			
		if(id!=null && id.length>=19 && id.substring(0,19)=="montantParFormation")
   		{
   			
   			select=$(fils[i]).find('select');

   			montant=parseFloat($(fils[i]).find('input').val());
   			if(montant<=0)
   			{
   				if(montantsOK)
   				{
   					toutOK=false;
   					montantsOK=false; 
   					chaineMessageErreur+="<li> Les montants doivent être strictement positifs ! </li>";
   				}
   			}              		
   			sommeMontant+=montant;

   			cycle=$(select[0]).val(); 
   			mention=$(select[1]).val();
   			specialite=$(select[2]).val();
   			categorie=$(select[3]).val();

   			if(cycle=="cycle" || mention=="mention" || specialite=="specialite" || categorie=="Categorie")
   			{
   				if(formationsOK)
   				{
   					toutOK=false;
   					formationsOK=false;
   					chaineMessageErreur+="<li> Veuillez selectionner dans les listes déroulante des valeurs autre que 'cycle','mention','specialite', et 'categorie' ! </li>";	
   				}
   			}
   				
   			else
   			{
   				groupSelectMontant = 
       			{
       				cycle:$(select[0]).val(), 
       				mention:$(select[1]).val(), 
       				specialite:$(select[2]).val(), 
       				categorie: $(select[3]).val(), 
       				montant:montant
       			};
       			
       			data.push(groupSelectMontant);
   			}
   		
   		}
   		else
   		{
   			input=$(fils[i]).find('input');
       		select=$(fils[i]).find('select');
       		textarea=$(fils[i]).find('textarea');

       		if(input.length!=0)
       			elemPush=input;
       		else if(select.length!=0)
       			elemPush=select;
       		else if(textarea.length!=0)
       			elemPush=textarea;
       		else
       			continue;

       		idElem=$(elemPush).attr('id');
       		colonneSansEspace=idElem.split('_')[1];
       		valElem=$(elemPush).val();

       	
       		chaine=verifierPattern(idElem,valElem,table,niveau)
       		if(chaine!="ok")
       		{
       			toutOK=false;
       			chaineMessageErreur+=chaine;
       		}
       		else
       		{
       			if(popup=="ajouter" && niveau==1 && ["Anneedeversement","Dateatelier","Dateconference","Anneedeparticipation"].indexOf(colonneSansEspace)>=0)
	       		{
	       			var dates=$("#dataTable_"+table+"_niveau1 tbody tr td:nth-child(2)").map(function(){
	       				return $(this).text();
	       			});
	       			if(arrayObjectIndexOf(dates,valElem)>=0)
	       			{
	       				toutOK=false;
	       				chaineMessageErreur+="<li> Veuillez vérifier la date renseignée. Il ne peut y avoir plusieurs taxes, conférences, ateliers, forums, à la même année/date pour une même entreprise </li>";
	       			}
	       		}
       		}
       				
       		data.push(valElem);
   		}

    }

	if(table=="TaxeApprentissage" && niveau==1)
  	{
  		montantVerse=parseFloat($("#TaxeApprentissage_Montantverse_niveau1").val());
	    if(sommeMontant!=montantVerse)
	    {
	    	toutOK=false;
	    	chaineMessageErreur+="<li> La somme des montants par formation est différente du montant versé ou ce dernier est invalide ! </li>";
	    }
	}
   
   	chaineMessageErreur+="</ul>";
   
   	$("#dialog_"+popup).dialog("close");

   	if(toutOK)
   	{
   		if(popup=="editer")
   		{
	   		$("#dialog_"+popup).dialog( "close" );
	   		var datatable = "#dataTable_"+table+"_niveau"+niveau;
			
			var idSelected = $(datatable+" tr.selected").children().attr('id').split('_')[1] ;
			var idCoordRH = $(datatable+" tr.selected").last().find('td:nth-child(3)').text();
			var idSelected2 = $(datatable+" tr.selected").last().find('td:nth-child(1)').text();
			var idCoordRH2 = $(datatable+" tr.selected").last().find('td:nth-child(4)').text();

			editionAjax(idSelected, idSelected2, idCoordRH, idCoordRH2,table,niveau,data);
		}
		else
   			requeteAjaxAjout(table,niveau,data);
   	}
   	else
   	{
   		$("#zone_message").children().remove();
   		$("#zone_message").append(chaineMessageErreur);
   		$("#zone_message").css('display','block');
   		$("#dialog_"+popup).dialog("open");
   		if(table=="TaxeApprentissage")
   			$("#dialog_"+popup).dialog('option','width','100%');  		
   	}
            
}



	
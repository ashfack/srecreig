var colVal = new Array();
var colonnes = new Array();
var colonnesPattern_ajout={Telephonefixe:/^0[1-68]([-. ]?[0-9]{2}){4}$/,
								Telephonemobile: /^0[1-68]([-. ]?[0-9]{2}){4}$/, 
								Mail: /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/, 
								Anneeentree: /^[123]$/, Datedebutcontrat: /^20[0-9]{2}$/, Datefincontrat: /^20[0-9]{2}$/,  
								Anneedeversement: /^20[0-9]{2}$/, Montantpromesseversement: /^[0-9]+(\.?[0-9]+)?$/, Montantverse: /^[0-9]+(\.?[0-9]+)?$/, 
								Montant:/^[0-9]+(\.?[0-9]+)?$/, Heuredebut: /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/, Heurefin: /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/,
								Dateatelier: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, Dateconference: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								RapprochementAC: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, Dateenregistrement: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								Datedernieremodification: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, DatetransmissionchequeAC: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								DateRVpreparation: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, DateRVsimulation: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/,
								DateenvoiFLauCFA: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/, 
								Anneedeparticipation: /^20[0-9]{2}$/, Nom: /^[A-Z-_]+$/, Prenom: /^[A-Z]{1}[a-z-_]*$/, NumeroSIRET: /^[0-9]{14}$/, Codepostal: /^[0-9]{5}$/   
							};
							
var exemplePattern_ajout={Telephonefixe:"01.00.00.00.00", 
								Telephonemobile: "06.00.00.00.00", 
								Mail: "exemple@exemple.com", 
								Anneeentree: "1 (ou 2,3)", Datedebutcontrat: "2016", Datefincontrat: "2016",  
								Anneedeversement: "2016", Montantpromesseversement: "1000 (nombre positif)", Montantverse: "1000 (nombre positif)", 
								Montant:"1000 (nombre positif)", Heuredebut: "14:00", Heurefin: "17:00", 
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
var tabFormations=["cycle","mention","specialite"];
var compteurNbFormations=1;
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

	$("#dialog_cycle_edit").dialog(
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
		      	var obj=$('#jstree').jstree(true).get_selected();
		      	console.log('hey '+obj);
		      	requeteAjaxCycleUpdate(nomEntreprise);
		      }
		    }

		]
	});

	$('#jstree_edit')
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
				//location.reload();

				
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
                   var valElm;
      
                   var patternOk=true;
               
               	   var data= new Array();
               	   var groupSelectMontant;

               	   var montantVerse=0;
               	   var sommeMontant=0;
               	   var formationsOK=true;
               	 
               	   var chaineMessageErreur="<ul>";
               	   var chaine="";

               	   var fils=$("#form_ajouter").children();
                   for(var i=0;i<fils.length;i++)
                   {
                   		
               			id=$(fils[i]).attr("id");
               			if(id!=null && id=="cacher_datepicker")
               				continue;
               			
               			if(id!=null && id.length>=20 && id.substring(0,19)=="montantParFormation")
                   		{
                   			
                   			select=$(fils[i]).find('select');

                   			montant=parseInt($(fils[i]).find('input').val());               		
                   			sommeMontant+=montant;

                   			cycle=$(select[0]).val(); 
                   			mention=$(select[1]).val(); 
                   			specialite=$(select[2]).val();
                   			categorie=$(select[3]).val();

                   			if(cycle=="cycle" || mention=="mention" || specialite=="specialite" || categorie=="Categorie")
                   				formationsOK=false;
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
	                   		valElem=$(elemPush).val();

	                   		chaine=verifierPattern(idElem,valElem,table,niveau)
	                   		if(chaine!="ok")
	                   		{
	                   			patternOk=false;
	                   			chaineMessageErreur+=chaine;
	                   		}
	                   				
	                   		data.push(valElem);
                   		}

                   }
                    

                  	if(table=="TaxeApprentissage")
                  	{
                  		montantVerse=$("#TaxeApprentissage_Montantverse_niveau1").val();
                  		if(!formationsOK)
                   			chaineMessageErreur+="<li> Veuillez selectionner dans les listes déroulante des valeurs autre que 'cycle','mention','specialite', et 'categorie' ! </li>";	
                   		if(sommeMontant!=montantVerse)
                   			chaineMessageErreur+="<li> La somme des montants par formations est différente du montant versé ou ce dernier est invalide ! </li>";
                  	}
                   	
                   	chaineMessageErreur+="</ul>";
                   
                   	$(this).dialog("close");

                   	if(patternOk && formationsOK && sommeMontant==montantVerse)
                   		requeteAjaxAjout(nomEntreprise,table,niveau,data);
                   	else
                   	{
                   		$("#zone_message").children().remove();
                   		$("#zone_message").append(chaineMessageErreur);
                   		$("#zone_message").css('display','block');
                   		$(this).dialog("open");
                   		if(table=="TaxeApprentissage")
                   			$(this).dialog('option','width','100%');
                   		
                   	}

                   	
                   		
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
	
	 //reinitialisation de la largeur: la popup pour la taxe necessite une largeur plus grande
	$('div#dialog_ajouter').on('dialogclose', function(event) 
	{
    	$(this).dialog('option','width', 810);
 	});


	var nomEntreprise=($("#titre_nomEntreprise").text()).trim();
	var colonnesType_ajout={Telephonefixe: "tel", Telephonemobile: "tel", Mail: "email",
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

                 	compteurNbFormations=1;
                    var datatable = "#dataTable_"+true_table+"_niveau"+true_j;

                    $("#dialog_ajouter").children().remove();
                    
                    colonnes= $(datatable+" th").map(function() 
	                            { 
	                                if($(this).attr('name')!="cacher" && $(this).text()!="")
	                                {
	                                    return $(this).text();
	                                }
	                                    
	                            });
                    var chaine="<div class='alert alert-danger' role='alert' style='display:none' id='zone_message'> </div>";
                    chaine+="<form action='#' method='POST' id='form_ajouter'>";

                    if((true_table=="AtelierRH" || true_table=="Conference") && true_j==1)
			        {
			        	chaine+="<input style='height:0px; border:none' id='cacher_datepicker'/>";
			        }
                    var idDatePicker= new Array();
                 	var objet_Option={Civilite: ["Monsieur","Madame"], Type: ["Primaire","Secondaire","TA","Autre"], 
                    								Formationalternance: ["AIR","ENERA"], Anneeentree:[1,2,3], Typecontrat: ["Apprentissage","Contrat de Professionalisation"],
                    								Typeconference:["Métiers","Technique","Autre"],
                    								Origine:["SRE","AISG","CAVAM","CEDIP","Corps Pédagogique","Direction Institut Galilée",
                    											"Direction Sup Galilée","Est Ensemble","Membre exterieur Conseil Institu Galilée",
                    											"Membre exterieur CA Sup Galilée","Plaine Commune","Présidence","Responsable pédagogique",
                    											"SCUIO-IP"],
                    								Typecontact: ["Entreprise","Personne","Collectivité territoriale","Communauté d'agglomérations"],
                    								Parternariatofficiel: ["Oui","Non"],
                    								Categorie: ["Catégorie A (niveau 5,4,3)","Catégorie B (niveau 2,1)"],
                    								Versementvia: ["SRE","Agence Comptable"],
                    								Modepaiement: ["Cheque","Virement","Inconnu"],
                    								Actionmenees:["Accueil d'apprentis en Energetique","Accueil d'apprentis en Informatique et Réseaux",
                    												"Animation d'ateliers RH de simulations d'entretiens","Animation de conférences métiers",
                    												"Partenariat officiel","Participation au Forum Sup Galilée Entreprises",
                    												"Recrutement de stagiaires","Recrutement des jeunes diplômé(e)s",
																	"Soutien financier par le versement de taxe d'apprentissage"]
                    								 };
                    var colonneSansEspace;
                    var id;
                  
                    for(var i=0;i<colonnes.length;i++) 
                    {
                        colonneSansEspace = colonnes[i].replace(/\s/g,"");
                      
                        //On affiche que le nom de l'alternant pr les niveaux 4 et 3 (position 1)
                        if(true_table=="Alternance" && ((colonneSansEspace=="Prenom" && i==1) || (colonneSansEspace=="Fonction" && true_j==1 )))
                        {
                        	continue;
                        }
                       
                        id=true_table+"_"+colonneSansEspace+"_niveau"+true_j;

                        chaine+=" <div class='form-group row'>";
                        chaine+="<label for='"+id+"' class='col-sm-4 form-control-label'>"+colonnes[i]+": </label>";
                        chaine+="<div class='col-sm-8'>";

                        //recupere les noms de la datatable niveau 1 et construit une liste déroulante
                        if(true_table=="Alternance" && colonneSansEspace=="Nom" && i==0 )
                        {
                            
                            var data=$("#dataTable_Alternance_niveau1").dataTable().fnGetData();
                            
                            chaine+="<select name='"+id+"_Alternant' id='"+id+"_Alternant' class='form-control'>"
                            var id_alternant;
                            for(var k=0;k<data.length;k++)
                            {
                                id_alternant=$($("#dataTable_Alternance_niveau1").find("tbody tr")[k]).children().attr('id').split('_')[1];
                            	
                                chaine+="<option value='"+id_alternant+"'>"+data[k][6]+"</option>";
                            }
                            chaine+="</select>";
                        }
                      	//Pareil qu'au dessus mais avec des dates
                        else if((colonneSansEspace=="Dateatelier" || colonneSansEspace=="Dateconference") && true_j==2)
                        {
                            var data=$("#dataTable_"+true_table+"_niveau1").dataTable().fnGetData();

                           
                            chaine+="<select name='"+id+"' id='"+id+"' class='form-control' >"
                            var id_date;
                            for(var k=0;k<data.length;k++)
                            {
                            	id_date=$($("#dataTable_"+true_table+"_niveau1").find("tbody tr")[k]).children().attr('id').split('_')[1];
                            
                                chaine+="<option value='"+id_date+"'>"+data[k][1]+"</option>";
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
                                chaine+="<option value='"+tabOption[k]+"'>"+tabOption[k]+"</option>";
                            }
                        	chaine+="</select>";
                        }
                        // c'est un commentaire --> un textarea
                        else if (colonneSansEspace.substring(0,4)=="Comm")
						{				
							chaine+="<textarea class='form-control' name='"+colonneSansEspace+"' id='"+colonneSansEspace+"'></textarea>";	
						}

						// La colonne a un type autre que text (sauf pr celles qui seront des datepicker)
                        else
                        {
                            if(has(colonnesType_ajout,colonneSansEspace)) 
                            {
                                chaine+="<input type='"+colonnesType_ajout[colonneSansEspace]+"' class='form-control' id='"+id+"'>";

                                if(colonnesType_ajout[colonneSansEspace]=="text")
                                    idDatePicker.push(id);
                            }
                            else
                                chaine+="<input type='text' class='form-control' id='"+id+"' >";
                        }
       
                        chaine+="</div> </div>";
                             
                    }

                    //ajout de cycle mention specialite montant dans taxe
                   	if(true_table=="TaxeApprentissage" && true_j==1)
                 	{
						chaine+="<div class='form-group row' id='OCTA'>";
						chaine+="<label for='TaxeApprentissage_OCTA_niveau1' class='col-sm-4 form-control-label'> OCTA: </label>";
						chaine+="<div class='col-sm-8'>";
						chaine+="<input type='text' class='form-control' id='TaxeApprentissage_OCTA_niveau1' >";
						chaine+="</div>";
						chaine+="</div>";
						chaine+="<div class='form-group row' id='labelMontantFormations'>";
						chaine+="<label for='montantParFormation_0' class='col-sm-4 form-control-label'> Montant par formation: </label>";
				    	chaine+="</div>";
             			chaine+=creerSelectFormation(0); 
                 	}
                   
                    chaine+="</form>";

                    $("#dialog_ajouter").append(chaine);

                    if(true_table=="TaxeApprentissage" && true_j==1)
                 	{
             			requeteAjaxSelectCycle(0); 
             			$("#dialog_ajouter").dialog('option','width','100%');
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

function cycle()
{
	// alert("jojo");
	var nomEntreprise=($("#titre_nomEntreprise").text()).trim();
	requeteAjaxCycleEdit(nomEntreprise);
}

function editer(true_table,true_j,valueRecup)
{				
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

					if (colonnes[i].substring(0,5)==" Comm")
					{
						chaine+="<label>"+colonnes[i]+"</label>";						
						chaine+="<textarea class='form-control' name='"+colonnes[i]+"' id='"+colonnes[i]+"'>"+ colVal[i] +"</textarea>";	
					}
					else if(colonnes[i]!=" Montant verse " && colonnes[i]!=" Questionnaire de satisfaction " && colonnes[i]!=" Cycle Formation " )
					{
						chaine+="<label>"+colonnes[i]+"</label>";
						chaine+="<input type='text' class='form-control' name='"+colonnes[i]+"' id='"+colonnes[i]+"' value='"+ colVal[i] +"'/> <br/>";	
					}
					else{}
					
					
					
				}
			}
			if(true_table=="Entreprise" && true_j==1)
			{
				chaine+="<td id='cycleFormation'> <input type='button' value='Editer les cycles' id='bEditerCycle' onclick='cycle()'/> </td>";
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
	if(table=="Alternance")
	{
		var nom1=$("form input")[3].value;
		var prenom1=$("form input")[4].value;
	}
	else
	{
		var nom1="";
		var prenom1="";
	}
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
				
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
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
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
	});

}
function requeteAjaxCycleEdit(nomEntreprise)
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
		   		$('#jstree_edit').jstree("deselect_all");

				for(var i in data)
				{
					$('#jstree_edit').jstree('select_node', data[i].toString());
				}
					
				var test = $('#jstree_edit').jstree(true).get_json('#', { 'flat': true });
				
				//$.jstree.reference('#jstree').disable_checkbox();
				//$.jstree.reference('#jstree').hide_checkboxes();

				$("#dialog_cycle_edit").dialog("open");
			
			}
			else
				popupMessage("#dialog_message","<p> L'entreprise n'est liée à aucun cycle/formation <br/> <br/> Cliquez sur le bouton \"Ajouter\" pour lui attribuer des cycles/formations </p>");
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
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
				
	   },
	   error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
	});
}

function requeteAjaxCycleUpdate(nomEntreprise)
{
	var liste_cycle_id= $('#jstree_edit').jstree(true).get_selected();
	$.ajax({

	   type: "POST",
	   url: "ajax/cycle_update.php",
	   dataType: "text",
	   data: "nomEntreprise="+nomEntreprise+"&liste_cycle_id="+liste_cycle_id,
	   success: function(data)
	   {
			if(data=="ok") 
			{
				popupMessage("#dialog_message","<p> Mise à jour effectuée avec succès !! </p>");
				// location.reload();
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
function requeteAjaxAjout(nomEntreprise,table,niveau,donnees)
{   
    console.log("nomEntreprise : "+nomEntreprise+" table : "+table+" niveau: "+niveau+" donnees: "+donnees);
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
                
       },
       error : function()
       {
       		popupMessage("#dialog_message","<p> Une erreur s'est produite ! </p>");
       }
    });
}

function requeteAjaxSelectCycle(nb)
{   
   
   //console.log("requeteAjaxSelectCycle "+nb);
    $.ajax({

       type: "POST",
       url: "ajax/recup_cycleMentionSpecialite.php",
       dataType: "json",
       success: function(data)
       {
       		
            if(data.length>0) 
            {
            	var chaine="<option value='cycle'>Cycle</option>";
                for(j in data)
                {
                	chaine+="<option value='"+data[j]+"'>"+data[j]+"</option>";
                }
             
                $("#cycle_"+nb).html(chaine);

                $("#mention_"+nb).html("<option value='mention'>Mention</option>");
                $("#specialite_"+nb).html("<option value='specialite'>Specialite</option>");
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
	/*console.log("créer event");
	console.log(nb);*/

	$("#bAjouterMontantParFormation").click(function()
	{
		$(this).remove();
		//console.log(compteurNbFormations);
		$("#form_ajouter").append(creerSelectFormation(compteurNbFormations));
		requeteAjaxSelectCycle(compteurNbFormations); 
		compteurNbFormations++;
	});

	$("#cycle_"+nb).change(function(){
		
		requeteAjaxSelectFormations("cycle",$(this).val(),nb,$(this).val());
	});

	$("#bSupprimer_"+nb).click(function(){
		
		$("#montantParFormation_"+nb).remove();
	});

	$("#mention_"+nb).change(function(){
		
		requeteAjaxSelectFormations("mention",$(this).val(),nb,$("#cycle_"+nb).val());
	});

	/*$("#specialite_"+nb).change(function(){
		
		requeteAjaxSelectFormations(choix,$(this).val(),nb,$("#cycle_"+nb).val());
	});*/
    
   
 
}

function requeteAjaxSelectFormations(choix,val,nb,cycle)
{   
    /*console.log(choix);
    console.log(nb);
    console.log(val);*/
    
    $.ajax({

       type: "POST",
       url: "ajax/recup_selectCycleMentionSpecialite.php",
       dataType: "json",
       data: {select: choix , selected: val, cycleChoisit: cycle},
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
		        			chaine+="<option value='"+data[cle][j]+"'>"+data[cle][j]+"</option>";
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
	/*console.log("créer select");
    console.log(nb);*/
    var chaine="<div class='form-inline' name='montantParFormation_"+nb+"' id='montantParFormation_"+nb+"'>";
		
	for(var k=0;k<3;k++)
	{
		chaine+="<select id='"+tabFormations[k]+"_"+nb+"' class='form-control'>";
		//les options seront ajoutés après avec un appel ajax
		chaine+="</select>";
	}
	//console.log("chaine fin \n \n "+chaine);
	chaine+="<select id='categorie_"+nb+"' class='form-control'>";
	chaine+="<option value='Categorie'>Categorie</option>";
	chaine+="<option value='A'>A</option>";
	chaine+="<option value='B'>B</option>";
	chaine+="<option value='C'>C</option>";
	chaine+="</select>";
	chaine+="<input type='number' id='montant_"+nb+"' class='form-control' placeholder='Montant'>";
	chaine+="<span class='btn btn-danger glyphicon glyphicon-remove' id='bSupprimer_"+nb+"'</span>";
	chaine+="</div>";
	chaine+="<button class='btn btn-sm' type='button' value='Ajouter' style ='margin-left: 10px;' id='bAjouterMontantParFormation'><i class='fa fa-plus'></i> Ajouter</button> ";
	

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
	//ces id correspondent aux selects présents dans les niveaux 3 et 4 de l'onglet alternance. Ceux-ci sont recuperés directement depuis la datatable niveau 1 
	// et sont forcément au bon format. Les valeurs des options étant des id (de la BDD) on est obligé de traiter le cas
	if(idElem=="Alternance_Nom_niveau4_Alternant" || idElem=="Alternance_Nom_niveau3_Alternant")
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



	
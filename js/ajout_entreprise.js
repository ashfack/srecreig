$(document).ready(function(){
	requeteAjaxLibelleNAF();
    $('#ajoutEntreprise').submit(function() {      
	  

	    var nomEntreprise = $("#nom").val();
		var groupe = $("#groupe").val();
		var libelleNAF = $("#libellesNAF").val();
		if(libelleNAF=='0')
			libelleNAF="NULL";
		var siret = $("#siret").val();
		var adresse = $("#adresse").val();
		var complAdr = $("#complAdr").val();
		var codeP = $("#codeP").val();
		var ville = $("#ville").val();
		var pays = $("#pays").val();
		
		
		var nomCP = $("#nomCP").val();
		var prenomCP = $("#prenomCP").val();
		var fonctionCP = $("#fonctionCP").val();
		var telCP_f = $("#telCP_f").val();
		var telCP_m = $("#telCP_m").val();
		var emailCP = $("#emailCP").val();
		var civiliteCP = $("input[name='civiliteCP']:checked").val();
		
		var nomCS = $("#nomCS").val();
		var prenomCS = $("#prenomCS").val();
		var fonctionCS = $("#fonctionCS").val();
		var telCS_f = $("#telCS_f").val();
		var telCS_m = $("#telCS_m").val();
		var emailCS = $("#emailCS").val();
		var civiliteCS = $("input[name='civiliteCS']:checked").val();
		
		var nomTA = $("#nomTA").val();
		var prenomTA = $("#prenomTA").val();
		var fonctionTA = $("#fonctionTA").val();
		var telTA_f = $("#telTA_f").val();
		var telTA_m = $("#telTA_m").val();
		var emailTA = $("#emailTA").val();
		var civiliteTA = $("input[name='civiliteTA']:checked").val();
		

		var typeContact=$("input[name='typeContact']:checked").val();
		if (typeof typeContact === "undefined") 
		{
		    typeContact=null;
		}
		var commentairesEntreprise= $("#commentairesEntreprise").val();
		
		var origine = $("#origineContact").val();
	
		var liste_cycle_id= $('#jstree').jstree(true).get_selected();

		var actions = new Array();
		$.each($("input[name='actions[]']:checked"), function() 
		{
		  actions.push($(this).val());
		});

        $.ajax({		
                url: "ajax/ajouterEntreprise.php", 
                type: "POST", 
                data: "nomEntreprise="+nomEntreprise+"&groupe="+groupe+"&libelleNAF="+libelleNAF+"&siret="+siret+"&adresse="+adresse+"&complAdr="+complAdr+
					  "&codeP="+codeP+"&ville="+ville+"&pays="+pays+
					  
					  "&nomCP="+nomCP+"&prenomCP="+prenomCP+"&fonctionCP="+fonctionCP+
					  "&telCP_f="+telCP_f+"&telCP_m="+telCP_m+"&emailCP="+emailCP+"&civiliteCP="+civiliteCP+
					  
					  "&nomCS="+nomCS+"&prenomCS="+prenomCS+"&fonctionCS="+fonctionCS+
					  "&telCS_f="+telCS_f+"&telCS_m="+telCS_m+"&emailCS="+emailCS+"&civiliteCS="+civiliteCS+
					  
					  "&nomTA="+nomTA+"&prenomTA="+prenomTA+"&fonctionTA="+fonctionTA+
					  "&telTA_f="+telTA_f+"&telTA_m="+telTA_m+"&emailTA="+emailTA+"&civiliteTA="+civiliteTA+
					  
					  "&liste_cycle_id="+liste_cycle_id+
					  "&origine="+origine+
					  "&commentairesEntreprise="+commentairesEntreprise+
					   "&typeContact="+typeContact+"&actions="+actions,

                success: function(msg)
                { 			
					if(msg==1) 
					{
						alert("L'entreprise a été créée avec succès !");
						window.location.reload();
					}
					else 
					{
						if(msg==0)
						{
							alert("L'entreprise existe déjà ! ");
						}	
						else
						{
							// alert(msg.substring(9,14));
							alert("Un incident technique est survenu ! ");

						}
					}
				}							
            });
        return false;
    });
});

function requeteAjaxLibelleNAF()
{   
    $.ajax({
       type: "POST",
       url: "ajax/recup_libelleNAF.php",
       dataType: "json",
       async:false,
       success: function(data)
       {
        	if(data!=null && data.length >0)
        	{
        		var chaine="<option value='0'>Libellé NAF</option>";
        		for(i in data)
        		{
        			chaine+="<option value='"+data[i]['id']+"'>"+data[i]['libelle']+"</option>";
        		}
        		$("#libellesNAF").append(chaine);
        	}
        	else
            {
                alert("Une erreur s'est produite lors de la récupération des libelles NAF !");
            }    
       },
       error : function()
       {
       		alert("Une erreur s'est produite lors de la récupération des libelles NAF !");
       }
    });
}
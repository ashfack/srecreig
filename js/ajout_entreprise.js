$(document).ready(function(){
    $('#ajoutEntreprise').submit(function() {      
	  

	    var nomEntreprise = $("#nom").val();
		var groupe = $("#groupe").val();
		var codeNAF = $("#codeNAF").val();
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
		
		var typeContact=$("input:checked").map(function() { return $(this).val(); } );
		var typeContact0= typeContact[0];
		var typeContact1= typeContact[1];
		var typeContact2= typeContact[0];
		
		var commentairesEntreprise= $("#commentairesEntreprise").val();
		
		var origine = $("select").val();
		
		// var jstree=$.jstree.reference('#jstree');
        // var checked=jstree.get_checked();
		var liste_cycle_id= $('#jstree').jstree(true).get_selected();

            $.ajax({		
                url: "ajax/ajouterEntreprise.php", 
                type: "POST", 
                data: "nomEntreprise="+nomEntreprise+"&groupe="+groupe+"&codeNAF="+codeNAF+"&siret="+siret+"&adresse="+adresse+"&complAdr="+complAdr+
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
					  "&typeContact2="+typeContact2,

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
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
		var telCP = $("#telCP").val();
		var emailCP = $("#emailCP").val();
		var civiliteCP = $("input[name='civiliteCP']:checked").val();
		
		var nomCS = $("#nomCS").val();
		var prenomCS = $("#prenomCS").val();
		var fonctionCS = $("#fonctionCS").val();
		var telCS = $("#telCS").val();
		var emailCS = $("#emailCS").val();
		var civiliteCS = $("input[name='civiliteCS']:checked").val();
		
		var nomTA = $("#nomTA").val();
		var prenomTA = $("#prenomTA").val();
		var fonctionTA = $("#fonctionTA").val();
		var telTA = $("#telTA").val();
		var emailTA = $("#emailTA").val();
		var civiliteTA = $("input[name='civiliteTA']:checked").val();
		
            $.ajax({
				
                url: "ajouterEntreprise.php", 
                type: "POST", 
                data: "nomEntreprise="+nomEntreprise+"&groupe="+groupe+"&codeNAF="+codeNAF+"&siret="+siret+"&adresse="+adresse+"&complAdr="+complAdr+
					  "&codeP="+codeP+"&ville="+ville+"&pays="+pays+"&nomCP="+nomCP+"&prenomCP="+prenomCP+"&fonctionCP="+fonctionCP+
					  "&telCP="+telCP+"&emailCP="+emailCP+"&civiliteCP="+civiliteCP+"&nomCS="+nomCS+"&prenomCS="+prenomCS+"&fonctionCS="+fonctionCS+
					  "&telCS="+telCS+"&emailCS="+emailCS+"&civiliteCS="+civiliteCS+"&nomTA="+nomTA+"&prenomTA="+prenomTA+"&fonctionTA="+fonctionTA+
					  "&telTA="+telTA+"&emailTA="+emailTA+"&civiliteTA="+civiliteTA, 
                success: function(msg){ 
								
								
								if(msg==1) 
										{
											 alert("super bien ajouté");
											window.location.reload();
											
										}
								else 
										{
											if(msg==0)
											{
									            
												alert("votre entreprise existe déjà");
									
											}	
											//if (msg.substring(9,14)=="23000")
											//{
												
											//}
											else
											{
												alert(msg.substring(9,14));
												alert("un incident est survenu, contactez les développeurs, surtout Sahar");
											}
											//alert(msg);
											 //alert("phpER");
										}
				}							
            });
        return false;
    });
});
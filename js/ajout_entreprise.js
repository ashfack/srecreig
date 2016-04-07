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
		var civiliteCP = $("input[name='civilite_p']:checked").val();
		
            $.ajax({
				
                url: "ajouterEntreprise.php", 
                type: "POST", 
                data: "nomEntreprise="+nomEntreprise+"&groupe="+groupe+"&codeNAF="+codeNAF+"&siret="+siret+"&adresse="+adresse+"&complAdr="+complAdr+
					  "&codeP="+codeP+"&ville="+ville+"&pays="+pays+"&nomCP="+nomCP+"&prenomCP="+prenomCP+"&fonctionCP="+fonctionCP+
					  "&telCP="+telCP+"&emailCP="+emailCP+"&civiliteCP="+civiliteCP, 
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
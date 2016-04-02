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
            $.ajax({
				
                url: "ajouterEntreprise.php", 
                type: "POST", 
                data: "nomEntreprise="+nomEntreprise+"&groupe="+groupe+"&codeNAF="+codeNAF+"&siret="+siret+"&adresse="+adresse+"&complAdr="+complAdr+
					  "&codeP="+codeP+"&ville="+ville+"&pays="+pays, 
                success: function(msg){ 
								if(msg==1) 
										{
											 alert("super bien ajouté");
											window.location.reload();
											
										}
								else 
										{
											if (msg.substring(9,14)=="23000")
											{
												alert("votre entreprise existe déjà");
											}
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
function autoResize(id)
{
    var newheight;
    var newwidth;

    if(document.getElementById)
    {
        newheight = document.getElementById(id).contentWindow.document.body.scrollHeight;
        newwidth = document.getElementById(id).contentWindow.document.body.scrollWidth;
    }
    document.getElementById(id).height = (newheight) + "px";
    document.getElementById(id).width = (newwidth) + "px";
}

$(document).ready(function(){
    $('#Rechercher').click(function() {
    	$("iframe").contents().unhighlight();
    	var nom = $("#nom").val();
    	$("iframe").contents().find("body").highlight(nom);
    	$("iframe").contents().find(".highlight").css({ backgroundColor: "#8888ff" });
    });
    // 	A factoriser
    $("#nom").keypress(function(event) 
    {
        if (event.which == 13)
       	{
       		$("iframe").contents().unhighlight();
	    	var nom = $("#nom").val();
	    	$("iframe").contents().find("body").highlight(nom);
	    	$("iframe").contents().find(".highlight").css({ backgroundColor: "#8888ff" });
       	}     
    });
});


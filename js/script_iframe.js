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

/* Ce script a été réalisé par Mike Hall (MHall75819@aol.com) */
var NS4 = (document.layers);
var IE4 = (document.all);
var win = window;
var n = 0;
function Rechercher(str) 
{
	var txt, i, found;
	if (str == "")
		return false;
	if (NS4) 
	{
		if (!win.find(str))
			while(win.find(str, false, true))
				n++;
		else
			n++;
		// Si le mot n'a pas été trouvé (Netscape)
		if (n == 0)
			alert("Pas trouvé !");
	}
	if (IE4) 
	{
		txt = win.document.body.createTextRange();
		// Find the nth match from the top of the page.
		for (i = 0; i <= n && (found = txt.findText(str)) != false; i++) 
		{
			txt.moveStart("character", 1);
			txt.moveEnd("textedit");
		}
		if (found) 
		{
			txt.moveStart("character", -1);
			txt.findText(str);
			txt.select();
			txt.scrollIntoView();
			n++;
		}
		else 
		{
			if (n > 0) 
			{
				n = 0;
				Rechercher(str);
			}
			// Si le mot n'a pas été trouvé (Explorer)
			else
				alert("Pas trouvé !");
		}
	}
	return false;
}
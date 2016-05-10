	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});


$(document).ready(function() 
{
var flag=1;
$("ul.nav.navbar-top-links.navbar-right").children().click(function(){
    if(flag==1){
		$(".infobulle").hide(); 
        flag=0;
    } else {
         flag=1;   
         $(".infobulle").show(); 

    }
});
$("ul.nav.navbar-top-links.navbar-right").children().blur(function(){
		$(".infobulle").show(); 
         flag=1; 
});


});
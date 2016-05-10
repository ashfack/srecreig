	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});


$(document).ready(function() 
{

var flag=1;
$(".dropdown").click(function(){
    if(flag==1){
			$("span").hide(); 
        flag=0;
    } else {
         flag=1;   
    }
});
$(".dropdown").blur(function(){
		$("span").show(); 
         flag=1; 
});


});
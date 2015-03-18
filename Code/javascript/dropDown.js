$(document).ready(function() {

	$("p").hide();
	$("h3").click(function(){
		$(this).next().slideToggle(300);
		});
	
	});
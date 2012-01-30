$(document).ready(function () {
	if($("#eqowner").attr("checked") == "checked") {$("#owner").fadeOut(350);}
	
	$("#eqowner").click(function() {
		$("#owner").fadeToggle(650);
  
});});
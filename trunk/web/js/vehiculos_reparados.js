var PHP_BACKEND_SCRIPT = "php/vehiculos_reparados.php";

$(document).ready(function(){
	$.get(
		PHP_BACKEND_SCRIPT,
		{data: ""},
		function(data){
			$("#vehiculos").html(data);
		}
	);
	
});

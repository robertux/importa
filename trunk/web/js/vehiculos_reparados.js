var PHP_BACKEND_SCRIPT = "php/vehiculos_reparados.php";

$(document).ready(function(){
	loadVehiculos();	
});


function loadVehiculos(){
	$("#vehiculos").append($("<img>").attr("src", "images/loading.gif"));
	$.get(
		PHP_BACKEND_SCRIPT,
		{action: "listv"},
		function(data){
			$("#vehiculos").html(data);
			
			$("#listaVehiculos").accordion();
			$(".prize").formatCurrency();
		}
	);
}

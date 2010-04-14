var PHP_BACKEND_SCRIPT = "php/vehiculos_reparados.php";

$(document).ready(function(){
	loadComboAnios();
	loadMarcas();
	loadVehiculos();
	
	$(".add-button").click(function(){
		$("#addEditDialog").dialog({
			modal: true,
			height: 400,
			width: 500,
			title: "Agregar nuevo automóvil"
		});
	});
	
	$(".edit-button").click(function(){
		$("#addEditDialog").dialog({
			modal: true,
			height: 400,
			width: 500,
			title: "Editar automóvil existente"
		});
	});  
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

function loadComboAnios(){
	var currentYear = new Date().getFullYear();
	for(var i=currentYear-20; i<=currentYear; i++)
		$("#cmbAnio").append($("<option>").val(i).html(i));
}

function loadMarcas(){
	$("#txtMarca").autocomplete({
		source: PHP_BACKEND_SCRIPT + "&action=listm"
	});
}

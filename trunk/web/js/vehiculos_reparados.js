var PHP_BACKEND_SCRIPT = "php/vehiculos_reparados.php";
var brandArray = [];

$(document).ready(function(){
	loadComboAnios();
	loadMarcas();
	loadVehiculos();
	
	$("#txtPrecio").numeric();
	
	$(".add-button").click(function(){
		$("#addEditDialog").dialog({
			modal: true,
			height: 380,
			width: 480,
			title: "Agregar nuevo automóvil",
			open: function(){
				
			}
		});
	});
	
	$(".edit-button").click(function(){
		$("#addEditDialog").dialog({
			modal: true,
			height: 650,
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
	$.get(PHP_BACKEND_SCRIPT, {action: "listm"}, function(data){ 
		brandArray = data.split("|");
		$("#txtMarca").autocomplete({
			source: brandArray
		});
	});
}

function closeDialog(){
	$("#addEditDialog").dialog("close");
}

function addVehiculo(){
	$("#frmAddEditVehiculo").ajaxForm(function(){
		closeDialog();
	});
}

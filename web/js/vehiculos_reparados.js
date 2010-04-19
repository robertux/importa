var PHP_BACKEND_SCRIPT = "php/vehiculos_reparados.php";
var brandArray = [];
var editMode = false;
var uploader;
var imgSelected = false;

$(document).ready(function(){
	loadComboAnios();
	loadMarcas();
	loadVehiculos();
	
	$("#txtPrecio").numeric();
	
	$(".add-button").click(function(){
		editMode = false;
		imgSelected = false;
		$("#addEditDialog").dialog({
			modal: true,
			height: 380,
			width: 480,
			title: "Agregar nuevo automóvil"
		});
		
		$("#frmAddEditVehiculo").find(".input-field").attr("value", "");
		$("#frmAddEditVehiculo").find("select").attr("selectedIndex", 0);
	});
	
	$(".edit-button").click(function(){
		editMode = true;
		imgSelected = false;
		$("#addEditDialog").dialog({
			modal: true,
			height: 650,
			width: 500,
			title: "Editar automóvil existente"
		});
	});
	
	uploader = new AjaxUpload("imgUpload", {
		action: PHP_BACKEND_SCRIPT,
		data: {action: "upldimg"},
		autoSubmit: false,
		onChange: function(file, extension){
			$("#btnSelImg").val(file);
			if(file.length > 0)
				imgSelected = true;
		},
		onComplete: function(file, response){
			if(!response.indexOf("FAIL") >= 0)
				addVehiculo(response); 
		} 
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

function beforeAddVehiculo(){
	$("#frmAddEditVehiculo").find(".input-field").attr("disabled", "disabled");
	
	if(imgSelected){
		uploader.submit();
	}
	else
		addVehiculo("");
	
}

function addVehiculo(imgName){
	$.post(PHP_BACKEND_SCRIPT, {	
			action: "addv", 
			marca: $("#txtMarca").val(),
			modelo: $("#txtModelo").val(),
			anio: $("#cmbAnio").val(),
			precio: $("#txtPrecio").val(),
			desc: $("#txtDescripcion").val(),
			img: imgName
		},
		function(data){
			closeDialog();
			
			if(data.indexOf("OK") >= 0){
				loadMarcas();
				loadVehiculos();
				showInfo("Vehículo agregado satisfactoriamente");
			}
			else
				showInfo("Error al agregar vehículo");
				
	});
	
	$("#frmAddEditVehiculo").find(".input-field").removeAttr("disabled");
}

function delVehiculo(vid){
	if(confirm("Está seguro que desea eliminar este vehículo?")==1){
		$.post(PHP_BACKEND_SCRIPT, 
			{action: "delv", vehiculo: vid},
			function(data){
				if(data.indexOf("OK") >= 0){
					loadMarcas();
					loadVehiculos();
					showInfo("Vehículo eliminado satisfactoriamente");
				}
				else
					showInfo("Error en la eliminación del vehículo");

			});
	}
}

function showInfo(text){
	$("#infoDialog").html(text);
	$("#infoDialog").dialog({ buttons: { "Ok": function() { $(this).dialog("close"); } } });
}

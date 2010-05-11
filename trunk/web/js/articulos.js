var PHP_BACKEND_SCRIPT = "php/articulos.php";
var brandArray = [];
var editMode = false;
var uploader;
var imgSelected = false;
var currentArticulo = -1;

$(document).ready(function(){
	loadComboAnios();
	loadMarcas();
	loadArticulos();
	
	$("#txtPrecio").numeric();
	
	$(".add-button").click(function(){
		editMode = false;
		imgSelected = false;
		
		$("#btnAceptar").unbind();
		$("#btnAceptar").click(function(){  beforeAddArticulo()  });
		
		$("#addEditDialog").dialog({
			modal: true,
			height: 380,
			width: 480,
			title: "Agregar nuevo artículo"
		});
		
		$("#frmAddEditArticulo").find(".input-field").attr("value", "");
		$("#frmAddEditArticulo").find("select").attr("selectedIndex", 0);
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
			if(!response.indexOf("FAIL") >= 0){
				if(editMode)
					editArticulo(response);
				else
					addArticulo(response);
			} 
		} 
	});  
});


function loadArticulos(){
	$("#articulos").append($("<img>").attr("src", "images/loading.gif"));
	$.get(
		PHP_BACKEND_SCRIPT,
		{action: "listv"},
		function(data){
			$("#articulos").html(data);
			
			$("#listaArticulos").accordion();
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
	$("#frmAddEditArticulo").find(".input-field").removeAttr("disabled");
}

function beforeAddArticulo(){
	$("#frmAddEditArticulo").find(".input-field").attr("disabled", "disabled");
	
	if(imgSelected){
		uploader.submit();
	}
	else
		addArticulo("");
	
}

function addArticulo(imgName){
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
				loadArticulos();
				showInfo("Artículo agregado satisfactoriamente");
			}
			else
				showInfo("Error al agregar artículo");
				
	});
	
	$("#frmAddEditArticulo").find(".input-field").removeAttr("disabled");
}

function delArticulo(vid){
	if(confirm("Está seguro que desea eliminar este artículo?")==1){
		$.post(PHP_BACKEND_SCRIPT, 
			{action: "delv", vehiculo: vid},
			function(data){
				if(data.indexOf("OK") >= 0){
					loadMarcas();
					loadArticulos();
					showInfo("Artículo eliminado satisfactoriamente");
				}
				else
					showInfo("Error en la eliminación del artículo");

			});
	}
}

function showArticulo(articulo){
	$.post(PHP_BACKEND_SCRIPT,
		{action: "showv", vid: articulo},
		function(data){
			editMode = true;
			imgSelected = false;
			trama = data.split("|");
			
			currentArticulo = trama[0];
			$("#txtMarca").val(trama[1]);
			$("#txtModelo").val(trama[2]);
			$("#cmbAnio").val(trama[3]);
			$("#txtPrecio").val(trama[4]);
			$("#txtDescripcion").val(trama[5]);
			
			$("#btnAceptar").unbind();
			$("#btnAceptar").click(function(){  beforeEditArticulo()  });
			
			$("#addEditDialog").dialog({
				modal: true,
				height: 380,
				width: 480,
				title: "Editar automóvil existente"
			});
		});
}

function beforeEditArticulo(){
	$("#frmAddEditArticulo").find(".input-field").attr("disabled", "disabled");
	
	if(imgSelected){
		uploader.submit();
	}
	else
		editArticulo("");

}

function editArticulo(imgName){
	$.post(PHP_BACKEND_SCRIPT, {	
			action: "editv", 
			vid: currentArticulo,
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
				loadArticulos();
				showInfo("Artículo modificado satisfactoriamente");
			}
			else
				showInfo("Error al modificar artículo");
				
	});
	
	$("#frmAddEditArticulo").find(".input-field").removeAttr("disabled");
}

function showInfo(text){
	alert(text);
}

e<?php
	require_once("acceso_datos.php");	
	
	$action = (isset($_POST["action"])? $_POST["action"]: (isset($_GET["action"])? $_GET["action"]: ""));
	switch($action){
		case "listv": listVehiculos(); break;
		case "listm": listMarcas(); break;
		case "listt": listTipos(); break;
		default: 
	}
	

	
	
	/******************************** Main methods ********************************/
	
	function listVehiculos(){
		$lista = fetchVehiculos();
		$html = renderVehiculos($lista);
		echo $html;
	}
	

	
	
	/******************************** Fetchers ********************************/
	
	function fetchVehiculos($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT v.id, v.tipo, tv.id AS tipo_id, tv.nombre AS tipo_desc, v.modelo, v.anio, v.marca, m.id AS marca_id, m.nombre AS marca_desc, v.estado, v.url_imagen, v.precio " .
			" FROM vehiculo v " .
			" INNER JOIN tipo_vehiculo tv ON v.tipo  = tv.id " .
			" INNER JOIN marca m ON v.marca = m.id " . $condicion;
		
		$lista = fetchListAssoc($sql, $cn);
		return $lista;
	}
	
	function fetchTipos($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT t.id, t.nombre FROM tipo_vehiculo " . $condicion;
		
		$lista = fetchListAssoc($sql, $cn);
		return $lista;
	}
	
	function fetchMarcas($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT m.id, m.nombre, m.url_imagen FROM marca " . $condicion;
		
		$lista = fetchListAssoc($sql, $cn);
		return $lista;
	}
	
	
	
	
	
	
	
	/******************************** Renderers ********************************/
	
	
	function renderVehiculos($lista){ 
		$html = "<div id='listaVehiculos'>";
		foreach($lista as $obj){
			$html .= "<h3 id='header-" . $obj->id . "'><a href='#'>" 
				. $obj->marca . " " . $obj->modelo . " - " . $obj->anio
				. "</a></h3>";
				
			$html .= "<div id='body-" . $fila["id"] . "'>";
			$html .= "<p>" . $fila["descripcion"] . "<p>";
			$html .= "</div>";
		}
		$html .= "</div>";
		
		return $html;
	}
	
	function renderTipos($lista){
		$html = "";
		
		return $html;
	}
	
	function renderMarcas($lista){
		$html = "";
		
		return $html;
	}
?>

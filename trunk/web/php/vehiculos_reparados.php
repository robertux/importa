<?php
	require_once("acceso_datos.php");	
	
	$action = (isset($_POST["action"])? $_POST["action"]: (isset($_GET["action"])? $_GET["action"]: ""));
	switch($action){
		case "listv": listVehiculos(); break;
		case "listm": listMarcas(); break;
		case "listt": listTipos(); break;
		case "delv": delVehiculo(); break;
		default: echo("error");
	}
	

	
	
	/******************************** Main methods ********************************/
	
	function listVehiculos(){
		$lista = fetchVehiculos();
		$html = renderVehiculos($lista);
		echo $html;
	}
	
	function listMarcas(){
		$lista = fetchMarcas("where m.id > 0");
		$html = renderMarcas($lista);
		//header('Content-type: application/json');
		echo $html;
	}
	
	function delVehiculo(){
		$vid = $_POST["vehiculo"];
		$cn = getDefaultConnection();
		$sql = "DELETE FROM vehiculo WHERE id=" . $vid;
		$rowsAffected = executeQuery($sql, $cn);
		echo($rowsAffected>0? "OK": "FAIL");
	}
	
	
	/******************************** Fetchers ********************************/
	
	function fetchVehiculos($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT v.id, v.tipo, tv.id AS tipo_id, tv.nombre AS tipo_desc, v.modelo, v.anio, v.marca, m.id AS marca_id, m.nombre AS marca_desc, v.estado, v.url_imagen, v.precio, v.descripcion " .
			" FROM vehiculo v " .
			" INNER JOIN tipo_vehiculo tv ON v.tipo  = tv.id " .
			" INNER JOIN marca m ON v.marca = m.id " . $condicion;
		
		$lista = fetchListAssoc($sql, $cn);
		return $lista;
	}
	
	function fetchTipos($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT t.id, t.nombre FROM tipo_vehiculo t " . $condicion;
		
		$lista = fetchListAssoc($sql, $cn);
		return $lista;
	}
	
	function fetchMarcas($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT m.id, m.nombre, m.url_imagen FROM marca m " . $condicion;
		
		$lista = fetchListAssoc($sql, $cn);
		return $lista;
	}
	
	/******************************** Renderers ********************************/
	
	
	function renderVehiculos($lista){ 
		$html = "<div id='listaVehiculos'>";
		foreach($lista as $obj){
			$html .= "<h3 id='header-" . $obj->id . "' class='listav-header'><a href='#'>" 
				. $obj->marca_desc . " " . $obj->modelo_desc . " - " . $obj->anio
				. "</a></h3>";
				
			$html .= "<div id='body-" . $obj->id . "' class='listav-body'>";
			$html .= "<img src='images/vehiculos/" . $obj->url_imagen . "' alt='imagen' height='128' width='128'>";
			$html .= "<p>" . $obj->descripcion . "</p>";
			$html .= "<div id='footer-" . $obj->id . "' class='listav-footer'>";
			$html .= "<label class='prizeLabel'>Precio: <span class='prize'>" . $obj->precio . "</span></label>";
			$html .= "<span class='actions'>";
			$html .= "<input type='button' class='edit-button' value='editar' />";
			$html .= "<input type='button' class='delete-button' value='eliminar' onClick='delVehiculo(" . $obj->id . ")' />";
			$html .= "</span>";
			$html .= "</div>";
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
		$nombres = array();
		foreach($lista as $obj)
			$nombres[] = $obj->nombre;
			
		$html = implode("|", $nombres);
		
		return $html;
	}
?>

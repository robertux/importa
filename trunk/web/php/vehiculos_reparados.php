<?php
	require_once(acceso_datos.php);	
	
	function getVehiculos($condicion){
		$cn = getConnection();
		$sql = "SELECT v.id, v.tipo, tv.id AS tipo_id, tv.nombre AS tipo_desc, v.modelo, v.anio, v.marca, m.id AS marca_id, m.nombre AS marca_desc, v.estado, v.url_imagen " +
			" FROM vehiculo v " +
			" INNER JOIN tipo_vehiculo tv ON v.tipo  = tv.id " +
			" INNER JOIN marca m ON v.marca = m.id " . $condicion;
		
		$lista = fetchListAssoc($cn, $sql);
	}
	
	function getTipos($condicion){
		$cn = getConnection();
		$sql = "SELECT t.id, t.nombre FROM tipo_vehiculo " . $condicion;
		
		$lista = fetchListAssoc($cn, $sql);
	}
	
	function getMarcas($condicion){
		$cn = getConnection();
		$sql = "SELECT m.id, m.nombre, m.url_imagen FROM marca " . $condicion;
		
		$lista = fetchListAssoc($cn, $sql);
	}
	
	
	function renderVehiculos($lista){
		$html = "";
		
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

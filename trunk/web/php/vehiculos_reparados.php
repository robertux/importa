<?php
	require_once("acceso_datos.php");
	
	$action = (isset($_POST["action"])? $_POST["action"]: (isset($_GET["action"])? $_GET["action"]: ""));
	switch($action){
		case "listv": listarticulos(); break;
		case "listm": listMarcas(); break;
		case "listt": listTipos(); break;
		case "addv": addarticulo(); break;
		case "delv": delarticulo(); break;
		case "upldimg": uploadImage(); break;
		case "showv": getarticulo(); break;
		case "editv": editarticulo(); break;
		default: echo("error");
	}
	

	
	
	/******************************** Main methods ********************************/
	
	function listarticulos(){
		$lista = fetcharticulos("where v.tipo=1");
		$html = renderarticulos($lista);
		echo $html;
	}
	
	function listMarcas(){
		$lista = fetchMarcas("where m.id > 0");
		$html = renderMarcas($lista);
		echo $html;
	}
	
	function addarticulo(){
		$marca = $_POST["marca"];
		$modelo = $_POST["modelo"];
		$anio = $_POST["anio"];
		$precio = $_POST["precio"];
		$desc = $_POST["desc"];
		$img = $_POST["img"];
		$marcaObj = getMarca($marca); 
		
		if($marcaObj == null){
			addMarca($marca);
			$marcaObj = getMarca($marca);
		}
		
		if(strlen($img) == 0)
			$img = "default.jpg";
		
		$cn = getDefaultConnection();
		$sql = "INSERT INTO articulo(tipo, modelo, anio, marca, estado, url_imagen, precio, descripcion)"
		. " VALUES (" . 1 . ", '" . $modelo . "', " . $anio . ", '" . $marcaObj->id . "', " . 0 . ", '" . $img . "', " . $precio . ", '" . $desc . "')";
		
		$rowsAffected = executeQuery($sql, $cn);
		echo($rowsAffected>0? "OK": "FAIL");
	}
	
	function editarticulo(){
		$vid = $_POST["vid"];
		$marca = $_POST["marca"];
		$modelo = $_POST["modelo"];
		$anio = $_POST["anio"];
		$precio = $_POST["precio"];
		$desc = $_POST["desc"];
		$img = $_POST["img"];
		$marcaObj = getMarca($marca); 
		
		if($marcaObj == null){
			addMarca($marca);
			$marcaObj = getMarca($marca);
		}
		
		if(strlen($img) == 0)
			$imgSql = "";
		else
			$imgSql = ", url_imagen='" . $img . "' ";
		
		$cn = getDefaultConnection();
		$sql = "UPDATE articulo SET marca=" . $marcaObj->id . ", modelo='" . $modelo . "', anio=" . $anio . ", precio=" . $precio . ", descripcion='" . $desc . "'" . $imgSql .
			" WHERE id=" . $vid;
		
		echo($sql);
		$rowsAffected = executeQuery($sql, $cn);
		echo($rowsAffected>0? "OK": "FAIL");
	}
	
	function delarticulo(){
		$vid = $_POST["vehiculo"];
		$cn = getDefaultConnection();
		$sql = "DELETE FROM articulo WHERE id=" . $vid;
		$rowsAffected = executeQuery($sql, $cn);
		echo($rowsAffected>0? "OK": "FAIL");
	}
	
	function getMarca($desc){
		$cn = getDefaultConnection();
		$sql = "SELECT * FROM marca WHERE nombre = '" . $desc . "'";
		return fetchObject($sql, $cn);
	}
	
	function addMarca($desc){
		$cn = getDefaultConnection();
		$sql = "INSERT INTO marca(nombre) VALUES ('" . $desc . "')";
		executeQuery($sql, $cn);
	}
	
	function uploadImage(){
		$uploadDir = "../images/vehiculos/";
		$fileName = explode(".", basename($_FILES['userfile']['name']));
		
		clearstatcache();
		$fileSuffix = "";
		$i = 1;
		while(file_exists(realpath($uploadDir) . "/" . $fileName[0] . $fileSuffix . "." . $fileName[1])){
			$fileSuffix = "(" . $i++ . ")";
		}
		$uploadFile = realpath($uploadDir) . "/" . $fileName[0] . $fileSuffix . "." . $fileName[1];
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile)) 
			echo $fileName[0] . $fileSuffix . "." . $fileName[1];
		else
			echo "FAIL";
	}
	
	function getarticulo(){
		$vid = $_POST["vid"];
		$cn = getDefaultConnection();
		$articulos = fetcharticulos("WHERE v.id = " . $vid);
		$trama = renderVechiculo($articulos[0]);
		//header('Content-type: application/json');
		echo($trama);
	}
	
	
	/******************************** Fetchers ********************************/
	
	function fetcharticulos($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT v.id, v.tipo, tv.id AS tipo_id, tv.nombre AS tipo_desc, v.modelo, v.anio, v.marca, m.id AS marca_id, m.nombre AS marca_desc, v.estado, v.url_imagen, v.precio, v.descripcion " .
			" FROM articulo v " .
			" INNER JOIN tipo_articulo tv ON v.tipo  = tv.id " .
			" INNER JOIN marca m ON v.marca = m.id " . $condicion;
		
		$lista = fetchListAssoc($sql, $cn);
		return $lista;
	}
	
	function fetchTipos($condicion=""){
		$cn = getDefaultConnection();
		$sql = "SELECT t.id, t.nombre FROM tipo_articulo t " . $condicion;
		
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
	
	
	function renderarticulos($lista){ 
		$html = "<div id='listaVehiculos'>";
		foreach($lista as $obj){
			$html .= "<h3 id='header-" . $obj->id . "' class='listav-header' font-family: Arial, Helvetica;'><a href='#'>" 
				. $obj->marca_desc . " " . ($obj->modelo === "default"? "": $obj->modelo) . " - " . $obj->anio
				. "</a></h3>";
				
			$html .= "<div id='body-" . $obj->id . "' class='listav-body'>";
			$html .= "<img src='images/vehiculos/" . $obj->url_imagen . "' alt='imagen' height='128' width='128'>";
			$html .= "<p>" . $obj->descripcion . "</p>";
			$html .= "<div id='footer-" . $obj->id . "' class='listav-footer'>";
			$html .= "<label class='prizeLabel'>Precio: <span class='prize'>" . $obj->precio . "</span></label>";
			$html .= "<span class='actions'>";
			$html .= "<input type='button' class='edit-button' value='editar' onClick='showVehiculo(" . $obj->id . ")' />";
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
	
	function renderVechiculo($articulo){
		$trama = $articulo->id . "|" . 
			$articulo->marca_desc . "|" .
			$articulo->modelo . "|" .
			$articulo->anio . "|" .
			$articulo->precio . "|" .
			$articulo->descripcion;
		return $trama;
	}
?>

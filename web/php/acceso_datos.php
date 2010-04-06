<?php

$DEFAULT_HOST = "localhost";
$DEFAULT_PORT = "3306";
$DEFAULT_USER = "importauser";
$DEFAULT_PWD =  "importapwd";
$DEFAULT_DB = "importa";


function getConnection($host, $port, $user, $pwd, $db){
	$cn  = mysql_pconnect($host, $user, $pwd) or die("fallo conexion");
	mysql_select_db($db, $cn) or die("fallo seleccion base");
	return $cn;
}

function getDefaultConnection(){
	global $DEFAULT_HOST, $DEFAULT_PORT, $DEFAULT_USER, $DEFAULT_PWD, $DEFAULT_DB;
	return getConnection($DEFAULT_HOST, $DEFAULT_PORT, $DEFAULT_USER, $DEFAULT_PWD, $DEFAULT_DB);
}

function closeConnection($cn){
	mysql_close($cn);
}

function fetchListAssoc($sql, $cn, $autoCloseCn = true){
	$arr = array();
	$res = mysql_query($sql, $cn);
	while($row = mysql_fetch_assoc($res)){
		$arr[] = $row;
	}
	
	if($autoCloseCn)
		closeConnection($cn);
		
	return $row;
}

?>

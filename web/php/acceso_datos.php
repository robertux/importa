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
	while($obj = mysql_fetch_object($res))		
		$arr[] = $obj;
	
	if($autoCloseCn)
		closeConnection($cn);
		
	return $arr;
}

function fetchObject($sql, $cn, $autoCloseCn = true){
	$res = mysql_query($sql, $cn);
	if($obj = mysql_fetch_object($res))
		return $obj;
	else
		return null;
}

function executeQuery($sql, $cn){
	$res = mysql_query($sql, $cn);
	return mysql_affected_rows();
}

?>

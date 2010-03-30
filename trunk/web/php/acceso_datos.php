<?php

$DEFAULT_HOST = "localhost";
$DEFAULT_PORT = "3306";
$DEFAULT_USER = "importauser";
$DEFAULT_PWD =  "importapwd";
$DEFAULT_DB = "importa";


function getConnection($host, $port, $user, $pwd, $db){
	$cn  = mysql_connect($host, $port, $user, $pwd);
	mysql_select_db($db, $cn);
	return $cn;
}

function getConnection(){
	return getConnection($DEFAULT_HOST, $DEFAULT_PORT, $DEFAULT_USER, $DEFAULT_PWD, $DEFAULT_DB);
}

function closeConnection($cn){
	mysql_close($cn);
}

function fetchListAssoc($cn, $sql, $autoCloseCn){
	$arr = array();
	$res = mysql_query($cn, $sql);
	while($row = mysql_fetch_assoc($res))
		$arr[] = $row;
		
	if($autoCloseCn)
		closeConnection($cn);
		
	return $row;
}

function fetchListAssoc($cn, $sql){
	fetchListAssoc($cn, $sql, true);
}

?>

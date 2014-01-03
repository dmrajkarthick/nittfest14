<?php
if(!defined('NAMESPACE111222333')){
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	echo '<h1>403 Forbidden<h1><h4>You are not authorized to access the page.</h4>';
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}
/*
connects to the MySQL database using the password and login details given in the "MySQL.ini" file in the SETTING directory
return the connection resource if connection made,
false if connection could not be made
 argument: path to root project folder. takes on after that to locate the config file
*/
function connectMySQL($pathh){
	require_once($pathh.'config/mySQL.php');
	$c=@mysql_connect($SQLserver.':'.$SQLport,$SQLuser,$SQLpassword);
	if(!$c)
		return false;
	if(!@mysql_select_db($SQLdatabase,$c))
		return false;
	return $c;
}
function run_query($str,$con){
	$res=@mysql_query($str,$con);
	if(!$res)
		throw new Exception('MySQL Error: '.mysql_error());
	else return $res;
}
?>

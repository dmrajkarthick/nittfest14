<?php
if(!defined('NAMESPACE111222333')){
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	echo '<h1>403 Forbidden<h1><h4>You are not authorized to access the page.</h4>';
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}
require_once($PATH.'config/variables.php');
session_set_cookie_params(time()+$TIME);
session_start();
try{
	if(!isset($_COOKIE['check']))
		throw new Exception();
	$a=explode('.',$_SERVER['SERVER_ADDR']);
	$s=$a[0].$a[1].$_SERVER['HTTP_USER_AGENT'].session_id().$KEY1;
	if($_COOKIE['check']!= md5($_SESSION['hasher'].$KEY2.$s))
		throw new Exception();
	if(!$_SESSION['userid'] || !isset($_COOKIE['checkdata']))
		throw new Exception();
	$data=explode(';',base64_decode($_COOKIE['checkdata']));
	if(md5($data[0].$KEY1)!=$data[1] || $_SESSION['userid']!=$data[0])
		throw new Exception();
	setcookie('checkdata',$_COOKIE['checkdata'],time()+$TIME,'/');
	setcookie('check',$_COOKIE['check'],time()+$TIME,'/');
	require_once($PATH.'assets/mysqlconnector.php');
	$c=connectMySQL($PATH);
	if(!$c)
		throw new Exception('Database not connected.');
}catch(Exception $e){
	header('Location: '.$PATH.'index.php');
	die();
}
?>

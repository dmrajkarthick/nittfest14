<?php
if(!defined('NAMESPACE111222333')){
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	echo '<h1>403 Forbidden<h1><h4>You are not authorized to access the page.</h4>';
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}

//security keys
$KEY1='23r3rf276urd6gu7yru7';
$KEY2='qnN32JJ23j42JKNJJj34n2jkklnakjsd3';
$KEY3='jkhn32hBH1x4B3Hj4bkj3j2k23jhb4sa';

$IMAGEPATH="/html/fuzzy-hipster";
//session persistence time
$TIME=1800;
$TABLEPREFIX="";

/*
 * $T_PATH=;
 * $T_TITLE=;
 * $T_HEADER=;
 * $T_CONTENT=;
 * $T_FOOTER=;
$T_TITLE=;
$T_HEADER=;
$T_CONTENT=;
$T_PATH="templates";
require_once($T_PATH."/index.php");
 * optional:
 * $T_HEADSTYLES
 * $T_HEADSCRIPTS
 * $T_ERROR
 * $T_INFO
 * */
$T_FOOTER="&copy; NITTFEST 2013 Core, NIT Trichy";
?>

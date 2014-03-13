<?php
require_once __DIR__."/admin/assets/mysqlconnector.php";

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {
	echo json_encode(array(
		'description' => '',
	));
	exit;
}

if(!isset($_GET['name'])) {
	echo json_encode(array(
		'description' => '',
	));
	exit;
}

if(strlen($_GET['name']) > 128) {
	echo json_encode(array(
		'description' => '',
	));
	exit;
}

$name = $_GET['name'];
$parentid = 272;
$sql = "SELECT title,description FROM pages WHERE parentid=:parentid AND name=:name";

$res = $c['db']->query($sql, array(':parentid' => $parentid, ':name' => $name));

if(!$res) {
	echo json_encode(array(
		'description' => '',
	));
	exit;
}


$data = $res->fetch(PDO::FETCH_ASSOC);

echo json_encode($data);

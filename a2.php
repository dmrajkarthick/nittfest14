<?php
require_once __DIR__."/admin/assets/mysqlconnector.php";

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {
	echo json_encode(array(
		'title' => 'Unknown Request',
		'description' => '',
		'language' => 'English'
	));
	die();
	exit;
}

if(!isset($_GET['q'])) {
	exit;
}

$limit_start = $_GET['q']-3;

if($limit_start < 0) {
	echo json_encode(array(
		'title' => '',
		'description' => '',
		'language' => 'English'
	));
	die();
}

$result = $c['db']->query(
	'SELECT title, language, description FROM pages WHERE type = "" ORDER BY parentid, rank LIMIT 1 OFFSET :ls',
	array(':ls' => $limit_start)
);

if(!$result) {
	echo json_encode(array(
		'title' => 'Error',
		'description' => '',
		'language' => 'English'
	));
	die();
}

echo json_encode($result->fetch(PDO::FETCH_ASSOC));
die();
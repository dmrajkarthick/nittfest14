<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
try{
	$event=intval($_GET['event']);
	if(!$event) throw new Exception();
	$stmt=$c['db']->query("SELECT pageid,name,title FROM pages WHERE parentid=:parentid",array(':parentid' => $event));
	$thing='<option></option>';
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$thing.="<option value='{$row['pageid']}'>{$row['name']} - {$row['title']}</option>";
	}
	echo $thing;
} catch(Exception $e){
}

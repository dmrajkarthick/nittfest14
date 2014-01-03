<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
try{
	$event=intval($_GET['event']);
	if(!$event) throw new Exception();
	$res=run_query("SELECT `pageid`,`name`,`title` FROM `pages` WHERE `parentid`='$event';",$c);
	$thing='<option></option>';
	while($row=mysql_fetch_assoc($res)){
		$thing.="<option value='{$row['pageid']}'>{$row['name']} - {$row['title']}</option>";
	}
	echo $thing;
} catch(Exception $e){
}
?>
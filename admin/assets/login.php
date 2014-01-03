<?php
define('NAMESPACE111222333','##$$');
require_once('../config/variables.php');
session_set_cookie_params(time()+$TIME,'/');
session_start();
$a=explode('.',$_SERVER['SERVER_ADDR']);
$s=$a[0].$a[1].$_SERVER['HTTP_USER_AGENT'].session_id().$KEY1;
if($_COOKIE['check']!= md5($_SESSION['hasher'].$KEY2.$s))
	header('Location: ../index.php');
if(isset($_SESSION['error'])) $_SESSION['error']='';
if(isset($_POST['loginSubmit']))
try{
$user=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
$pw=sha1($_POST['password'].md5($KEY2));
require_once('mysqlconnector.php');
$c=connectMySQL('../');
if(!$c)
	throw new Exception('Some internal database error occured! Please try again later.');
$res=mysql_fetch_assoc(run_query("SELECT 1 FROM `{$TABLEPREFIX}config` WHERE `name`='admin_login' AND `value`='{$user};{$pw}';",$c));
if(!$res)
	throw new Exception('Username and password do not match!');
$userid=mt_rand()+2;
$_SESSION['userid']=$userid;
$data=implode(';',array($userid,md5($userid.$KEY1)));
setcookie('checkdata',base64_encode($data),time()+$TIME,'/');
header('Location: ../index.php');

}catch(Exception $e){
	$_SESSION['error']=$e->getMessage();
	header('Location: ../index.php');
}
else header('Location: ../index.php');
?>

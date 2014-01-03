<?php
define('NAMESPACE111222333','##$$$$23@');
require_once('config/variables.php');
session_set_cookie_params(time()+$TIME,'/');
session_start();
$a=explode('.',$_SERVER['SERVER_ADDR']);
if(!isset($a[0]))
$a=explode(':',$_SERVER['SERVER_ADDR']);
$s=$a[0].$a[1].$_SERVER['HTTP_USER_AGENT'].session_id().$KEY1;
if(!isset($_SESSION['hasher'])) $_SESSION['hasher']=md5(time());
$parallel=md5($_SESSION['hasher'].$KEY2.$s);
setcookie('check',$parallel,time()+$TIME);
$logged=0;
if(!isset($_SESSION['userid']))
	$_SESSION['userid']=0;
if(isset($_COOKIE['checkdata'])){
	$data=explode(';',base64_decode($_COOKIE['checkdata']));
	if(md5($data[0].$KEY1)==$data[1] && $_SESSION['userid']==$data[0]){
		$logged=1;
	}
}
$T_TITLE='NITTFEST Admin';
if(!$logged){
	$T_HEADER='NITTFEST Admin';
	if(isset($_SESSION['error'])){
		$T_ERROR=$_SESSION['error'];
		unset($_SESSION['error']);
	}
	$rn=isset($_SESSION['rn'])?$_SESSION['rn']:'';
	$T_CONTENT=<<<BODY
 <div id='login'>
 <form action="assets/login.php" method="post" autocomplete="off" >
	<table>
	 <tbody><tr>
     <td>Username</td>
     <td><input type="text" name="username" ></td>
	 </tr>
	 <tr>
	 <td>Password</td>
	 <td><input type="password" name="password" ></td>
	 </tr>
	 <tr>
	 <td><input type="submit" value="Log In" name="loginSubmit" ></td>
	 </tr></tbody>
     </form>
    </table>
 </div>
BODY;
} else {
	$T_HEADER='Welcome!';
	$T_CONTENT="
<div id='login-actions'><ul>
<li><a href='assets/score.php'>Manage Scorecard</a></li>
<li><a href='assets/events.php'>Manage Events</a></li>
<li><a href='assets/upload.php'>Manage Uploads</a></li>
<li><a href='assets/updates.php'>Manage Updates</a></li>
<li><a href='assets/sponsors.php'>Manage Sponsors</a></li>
<li><a href='assets/edit_login.php'>Change Login Details</a></li>
</ul></div>
<div id='logout'><a href='assets/logout.php'>Logout</a></div>
";
}
$PATH="";
require_once("template/index.php");
?>

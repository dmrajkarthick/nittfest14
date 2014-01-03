<?php
if(!defined('NAMESPACE111222333')){
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	echo '<h1>403 Forbidden<h1><h4>You are not authorized to access the page.</h4>';
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}
?>
<!DOCTYPE HTML >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title><?php echo $T_TITLE; ?></title>
 <link rel="stylesheet" href="<?php echo $PATH; ?>template/style/main.css" type="text/css">
 <?php
	if(isset($T_HEADSTYLES))
		echo $T_HEADSTYLES;
 ?>
<!-- <script type ="text/javascript" src="<?php echo $PATH; ?>template/scripts/main.js"></script> -->
 <?php
	if(isset($T_HEADSCRIPTS))
		echo $T_HEADSCRIPTS;
 ?>
</head>
<body>
<div id="header"><h2><?php echo ($PATH?"<a href='{$PATH}index.php'>Home</a>&nbsp;>&nbsp;":"").$T_HEADER; ?></h2></div>
<?php
if(isset($T_ERROR))
	echo "
<div class='error'>{$T_ERROR}</div>";
if(isset($T_INFO))
	echo "
<div class='info'>{$T_INFO}</div>";
?>
<div id="content">
 <?php echo $T_CONTENT; ?>
</div>
<div id="footer">
<?php echo $T_FOOTER; ?>
</div>
<div class="clear"></div>
</body>
</html>

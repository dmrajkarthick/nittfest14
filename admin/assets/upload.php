<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
if(isset($_POST['uploadSubmit']))
try{
	if($_FILES['picture']['name']){
		if($_FILES['picture']['error']>0)
			throw new Exception('Upload error occured! '.$_FILES['picture']['error']);
	if($_FILES['picture']['size']>10500000)
		throw new Exception('Too large upload! Please degrade resolution or compress.');
	$type=0;
	if(in_array($_FILES['picture']['type'],array('image/gif','image/jpeg','image/png')))
		$type=2;
	$path=str_replace(' ','_',$_FILES['picture']['name']);
	$tempfile="./../../uploads/".$path;
	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$tempfile))
		throw new Exception('Upload save error!');
	}else throw new Exception('Please select a file');
	$q=run_query("INSERT INTO `uploads` VALUES (NULL,'$path','$type','{$_FILES['picture']['type']}',NULL);",$c);
	if($q) $T_INFO='Upload successful!';
	else throw new Exception('Not added. '.mysql_error());
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['delete']))
try{
	$uploader=intval($_GET['delete']);
	$res=mysql_fetch_row(run_query("SELECT `name` FROM `uploads` WHERE `uploadid`='$uploader';",$c));
	if(!$res)
		throw new Exception('Invalid upload specified.');
	$name=$res[0];
	@unlink("./../../uploads/".$name);
	run_query("DELETE FROM `uploads` WHERE `uploadid`='$uploader';",$c);
	$T_INFO="'$name' deleted.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
$T_TITLE='NITTFEST Uploads Management';
$T_HEADER='Uploads';
$T_CONTENT='';
$q=run_query("SELECT * FROM `uploads` ORDER BY `time` DESC;",$c);
if(mysql_num_rows($q)){
	$con="<ul>";
	while($res=mysql_fetch_assoc($q)){
		$image=$res['type']==2?"<img class='thumbnail' src='{$IMAGEPATH}/uploads/{$res['name']}' alt='' >":'';
		$con.="<li><a class='action' href='./upload.php?delete={$res['uploadid']}' title='Delete'><img src='{$PATH}template/images/delete.png' onclick=\"return confirm('Are you sure you want to delete {$res['name']}?')\" alt='Delete' ></a>{$res['name']}&nbsp;&nbsp;{$image}</li>";
	}
	$con.="</ul>";
}else
	$con="<p><h3>No uploads yet!</h3></p>";
$T_CONTENT.=<<<BODY
<fieldset><legend>Upload new file</legend>
<form action="./upload.php" method="post" enctype='multipart/form-data'>
<table>
<tr><td>File</td><td><input type="file" name="picture" ></td></tr>
<tr><td><input type="submit" name="uploadSubmit" /></td></tr>
</table>
</form>
</fieldset>
<fieldset><legend>Uploads</legend>
$con
</fieldset>
<br />
BODY;
require_once($PATH."/template/index.php");
?>

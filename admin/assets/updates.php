<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
function pagepath($sponsorid){
	global $c;
	$a=array();
	while(1){
		$res=mysql_fetch_row(run_query("SELECT `parentid`,`name` FROM `updates` WHERE `sponsorid`='$sponsorid';",$c));
		$a[]=array($sponsorid,$res[1]);
		$sponsorid=$res[0];
		if(!$sponsorid) break;
	}
	$a=array_reverse($a);
	return $a;
}
if(isset($_GET['update']))
	$sponsor=intval($_GET['update']);
else $sponsor=1;
if(isset($_POST['editSubmit']))
try{
	if(!$_POST['name'])
		throw new Exception('Please fill all starred fields.');
	$name=addslashes($_POST['name']);
	$type='';
	$url=$_POST['url']?addslashes(filter_var($_POST['url'],FILTER_SANITIZE_URL)):'';
	$res=mysql_fetch_row(run_query("SELECT MAX(`rank`)+1 from `updates` where `parentid`='$sponsor';",$c));
	$rank=$res[0];
	if($_FILES['picture']['name']){
		if($_FILES['picture']['error']>0)
			throw new Exception('Upload error occured! '.$_FILES['picture']['error']);
	if($_FILES['picture']['size']>1050000)
		throw new Exception('Too large image! Please degrade resolution or compress image.');
	if(!in_array($_FILES['picture']['type'],array('image/gif','image/jpeg','image/png')))
		throw new Exception('Use JPG, GIF or PNG files');
	$path=str_replace(' ','_',$_FILES['picture']['name']);
	$tempfile=$PATH."../updates/".$path;
	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$tempfile))
		throw new Exception('Upload save error!');
	}else $path='';
	$q=run_query("INSERT INTO `updates` VALUES (NULL,'$sponsor','$type','$name','$url','$path','$rank');",$c);
	if($q) $T_INFO='Update Added!';
	else throw new Exception('Not added. '.mysql_error());
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_POST['updateSubmit']))
try{
	$editsponsor=intval($_GET['edit']);
	$res=mysql_fetch_row(run_query("SELECT `image` FROM `updates` WHERE `sponsorid`='$editsponsor'",$c));
	if(!$res) throw new Exception('Invalid request');
	$oldpath=$res[0];
	$name=addslashes($_POST['name']);
	$type='';
	$url=$_POST['url']?filter_var($_POST['url'],FILTER_SANITIZE_URL):'';
	if($_FILES['picture']['name']){
		if($_FILES['picture']['error']>0)
			throw new Exception('Upload error occured! '.$_FILES['picture']['error']);
	if($_FILES['picture']['size']>1050000)
		throw new Exception('Too large image! Please degrade resolution or compress image.');
	if(!in_array($_FILES['picture']['type'],array('image/gif','image/jpeg','image/png')))
		throw new Exception('Use JPG, GIF or PNG files');
	unlink($PATH."../updates/".$oldpath);
	$path=str_replace(' ','_',$_FILES['picture']['name']);
	$tempfile=$PATH."../updates/".$path;
	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$tempfile))
		throw new Exception('Upload save error!');
	}else $path=$oldpath;
	run_query("UPDATE `updates` SET `name`='$name',`type`='$type',`url`='$url',`image`='$path' WHERE `sponsorid`='$editsponsor';",$c);
	$T_INFO='Event details updated!';
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['up']))
try{
	$sponsorid=intval($_GET['up']);
	$res=mysql_fetch_row(run_query("SELECT `parentid`,`rank`,`name` FROM `updates` WHERE `sponsorid`='$sponsorid';",$c));
	if(!$res)
		throw new Exception('Sponsor to move up not found');
	$rank=$res[1];
	$parent=$res[0];
	$name=$res[2];
	$res=mysql_fetch_row(run_query("SELECT `sponsorid`,`rank` FROM `updates` WHERE `rank`<'$rank' AND `parentid`='$parent' ORDER BY `rank` DESC LIMIT 0,1",$c));
	if(!$res)
		throw new Exception("Update '$name' is already on top of list.");
	run_query("UPDATE `updates` SET `rank`='$rank' WHERE `sponsorid`='{$res[0]}';",$c);
	run_query("UPDATE `updates` SET `rank`='{$res[1]}' WHERE `sponsorid`='$sponsorid';",$c);
	$T_INFO="Event '$name' moved up.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['down']))
try{
	$sponsorid=intval($_GET['down']);
	$res=mysql_fetch_row(run_query("SELECT `parentid`,`rank`,`name` FROM `updates` WHERE `sponsorid`='$sponsorid';",$c));
	if(!$res)
		throw new Exception('Update to move down not found');
	$rank=$res[1];
	$parent=$res[0];
	$name=$res[2];
	$res=mysql_fetch_row(run_query("SELECT `sponsorid`,`rank` FROM `updates` WHERE `rank`>'$rank' AND `parentid`='$parent' ORDER BY `rank` ASC LIMIT 0,1",$c));
	if(!$res)
		throw new Exception("Event '$name' is already on bottom of list.");
	run_query("UPDATE `updates` SET `rank`='$rank' WHERE `sponsorid`='{$res[0]}';",$c);
	run_query("UPDATE `updates` SET `rank`='{$res[1]}' WHERE `sponsorid`='$sponsorid';",$c);
	$T_INFO="Event '$name' moved down.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['delete']))
try{
	$sponsor=intval($_GET['delete']);
	$res=mysql_fetch_row(run_query("SELECT `name` FROM `updates` WHERE `sponsorid`='$sponsor';",$c));
	if(!$res)
		throw new Exception('Invalid update.');
	$name=$res[0];
	if($sponsor<=1)
		throw new Exception('Invalid update.');
	$list=array($sponsor);
	while($list){
		$listn=array();
		foreach($list as $l){
		$q=run_query("SELECT `sponsorid` FROM `updates` WHERE `parentid`='$l';",$c);
		while($res=mysql_fetch_row($q))
			$listn[]=$res[0];
		}
		$list="'".implode("','",$list)."'";
		$res=run_query("SELECT `sponsorid`,`image` FROM `updates` WHERE `sponsorid` IN ($list);",$c);
		while($row=mysql_fetch_row($res))
			if($row[1])
				@unlink($PATH."../updates/".$row[1]);
		run_query("DELETE FROM `updates` WHERE `sponsorid` IN ($list);",$c);
		$list=$listn;
	}
	$list=array();
	$sponsor=1;
	$T_INFO="Update '$name' deleted.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
$T_TITLE='NITTFEST Updates Management';
$T_HEADER='Updates';
$label=pagepath($sponsor);
$T_CONTENT='';
foreach($label as $a)
	$T_CONTENT.="<a href='./updates.php?sponsor={$a[0]}'>{$a[1]}</a>&nbsp;>&nbsp;";
$T_CONTENT.="<br /><br />
";
$show=1;
if(isset($_GET['edit']))
try{
	$editsponsor=intval($_GET['edit']);
	$res=mysql_fetch_assoc(run_query("SELECT * FROM `updates` WHERE `sponsorid`='$editsponsor';",$c));
	if(!$res) throw new Exception();
	$image=$res['image']?"<img class='thumbnail' src='{$PATH}../updates/{$res['image']}' alt='' >":'';
	$T_CONTENT.=<<<BODY
<div>
<form action="./updates.php?edit={$editsponsor}" method="post" enctype='multipart/form-data'>
<table>
<tr><td>Name</td><td><textarea rows=5 cols=30 name="name">{$res['name']}</textarea></td></tr>
<tr><td>URL</td><td><input type="text" name="url" value="{$res['url']}" ></td></tr>
<tr><td>Image</td><td><input type="file" name="picture"></td><td>{$image}</td></tr>
</table>
<input type="submit" value="Update" name="updateSubmit" >
</form><br /><br />
<a class='action' href='./updates.php?delete=$editsponsor' title='Delete'><img src='{$PATH}/template/images/delete.png' alt='Delete' >&nbsp;Delete update</a>
</div>
BODY;
	$show=0;
}catch(Exception $e){
	$show=1;
}
if($show){
$res=mysql_fetch_row(run_query("SELECT MAX(`rank`),MIN(`rank`) FROM `updates` WHERE `parentid`='$sponsor';",$c));
$minp='';$maxp='';
if(!($res[0]==='')){ $minp=$res[0]; $maxp=$res[1]; }//rank opp
$q=run_query("SELECT * FROM `updates` WHERE `parentid`='$sponsor' ORDER BY `rank`;",$c);
if(mysql_num_rows($q)){
	$con="<ol>";
	while($res=mysql_fetch_assoc($q)){
		$image=$res['image']?"<a href='{$res['url']}' target='blank'><img class='thumbnail' src='{$PATH}../updates/{$res['image']}' alt='' ></a>":'';
		$up=$res['rank']==$maxp?"<img class='disabled' src='{$PATH}/template/images/up.png' alt='Up' >":"<a class='action' href='./updates.php?up={$res['sponsorid']}' title='Move Up'><img src='{$PATH}/template/images/up.png' alt='Up' ></a>";
		$down=$res['rank']==$minp?"<img class='disabled' src='{$PATH}/template/images/down.png' alt='Down' >":"<a class='action' href='./updates.php?down={$res['sponsorid']}' title='Move Down'><img src='{$PATH}/template/images/down.png' alt='Down' ></a>";
		$path=realpath("{$PATH}/../updates/{$res['image']}");
		$con.="<li><a class='action' href='./updates.php?edit={$res['sponsorid']}' title='Edit'><img src='{$PATH}/template/images/edit.png' alt='Edit' ></a>&nbsp;&nbsp;&nbsp;
		{$up}{$down}&nbsp;&nbsp;&nbsp;
		<a href='./updates.php?update={$res['sponsorid']}'>{$res['name']}</a>&nbsp;&nbsp;&nbsp;{$image}</li>";
	}
	$con.="</ol>";
}else
	$con="<p><h3>No Update added yet</h3></p>";
$T_CONTENT.=<<<BODY
<fieldset><legend>Updates</legend>
$con
</fieldset>
<br />
<fieldset><legend>Add Update</legend>
<form action="./updates.php?update=$sponsor" method="post" enctype='multipart/form-data'>
<table>
<tr><td>Name *</td><td><textarea rows=5 cols=30 name="name"></textarea></td></tr>
<tr><td>URL</td><td><input type="text" name="url" /></td></tr>
<tr><td>File</td><td><input type="file" name="picture" ></td></tr>
<tr><td><input type="submit" name="editSubmit" /></td></tr>
</table>
</form>
</fieldset>
BODY;
}
require_once($PATH."/template/index.php");
?>
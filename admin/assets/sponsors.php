<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
function pagepath($sponsorid){
	global $c;
	$a=array();
	while(1){
		$res=mysql_fetch_row(run_query("SELECT `parentid`,`name` FROM `sponsors` WHERE `sponsorid`='$sponsorid';",$c));
		$a[]=array($sponsorid,$res[1]);
		$sponsorid=$res[0];
		if(!$sponsorid) break;
	}
	$a=array_reverse($a);
	return $a;
}
if(isset($_GET['sponsor']))
	$sponsor=intval($_GET['sponsor']);
else $sponsor=1;
if(isset($_POST['editSubmit']))
try{
	if(!$_POST['name'])
		throw new Exception('Please fill all starred fields.');
	$name=addslashes(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
	$type=$_POST['type']?filter_var($_POST['type'],FILTER_SANITIZE_STRING):'';
	$url=$_POST['url']?filter_var($_POST['url'],FILTER_SANITIZE_URL):'';
	$res=mysql_fetch_row(run_query("SELECT MAX(`rank`)+1 from `sponsors` where `parentid`='$sponsor';",$c));
	$rank=$res[0];
	if($_FILES['picture']['name']){
		if($_FILES['picture']['error']>0)
			throw new Exception('Upload error occured! '.$_FILES['picture']['error']);
	if($_FILES['picture']['size']>1050000)
		throw new Exception('Too large image! Please degrade resolution or compress image.');
	if(!in_array($_FILES['picture']['type'],array('image/gif','image/jpeg','image/png')))
		throw new Exception('Use JPG, GIF or PNG files');
	$path=str_replace(' ','_',$_FILES['picture']['name']);
	$tempfile=$PATH."../sponsors/".$path;
	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$tempfile))
		throw new Exception('Upload save error!');
	}else $path='';
	$q=run_query("INSERT INTO `sponsors` VALUES (NULL,'$sponsor','$type','$name','$url','$path','$rank');",$c);
	if($q) $T_INFO='Sponsor Added!';
	else throw new Exception('Not added. '.mysql_error());
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_POST['updateSubmit']))
try{
	$editsponsor=intval($_GET['edit']);
	$res=mysql_fetch_row(run_query("SELECT `image` FROM `sponsors` WHERE `sponsorid`='$editsponsor'",$c));
	if(!$res) throw new Exception('Invalid request');
	$oldpath=$res[0];
	$name=addslashes(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
	$type=$_POST['type']?filter_var($_POST['type'],FILTER_SANITIZE_STRING):'';
	$url=$_POST['url']?filter_var($_POST['url'],FILTER_SANITIZE_URL):'';
	if($_FILES['picture']['name']){
		if($_FILES['picture']['error']>0)
			throw new Exception('Upload error occured! '.$_FILES['picture']['error']);
	if($_FILES['picture']['size']>1050000)
		throw new Exception('Too large image! Please degrade resolution or compress image.');
	if(!in_array($_FILES['picture']['type'],array('image/gif','image/jpeg','image/png')))
		throw new Exception('Use JPG, GIF or PNG files');
	unlink($PATH."../sponsors/".$oldpath);
	$path=str_replace(' ','_',$_FILES['picture']['name']);
	$tempfile=$PATH."../sponsors/".$path;
	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$tempfile))
		throw new Exception('Upload save error!');
	}else $path=$oldpath;
	run_query("UPDATE `sponsors` SET `name`='$name',`type`='$type',`url`='$url',`image`='$path' WHERE `sponsorid`='$editsponsor';",$c);
	$T_INFO='Event details updated!';
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['up']))
try{
	$sponsorid=intval($_GET['up']);
	$res=mysql_fetch_row(run_query("SELECT `parentid`,`rank`,`name` FROM `sponsors` WHERE `sponsorid`='$sponsorid';",$c));
	if(!$res)
		throw new Exception('Sponsor to move up not found');
	$rank=$res[1];
	$parent=$res[0];
	$name=$res[2];
	$res=mysql_fetch_row(run_query("SELECT `sponsorid`,`rank` FROM `sponsors` WHERE `rank`<'$rank' AND `parentid`='$parent' ORDER BY `rank` DESC LIMIT 0,1",$c));
	if(!$res)
		throw new Exception("Event '$name' is already on top of list.");
	run_query("UPDATE `sponsors` SET `rank`='$rank' WHERE `sponsorid`='{$res[0]}';",$c);
	run_query("UPDATE `sponsors` SET `rank`='{$res[1]}' WHERE `sponsorid`='$sponsorid';",$c);
	$T_INFO="Event '$name' moved up.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['down']))
try{
	$sponsorid=intval($_GET['down']);
	$res=mysql_fetch_row(run_query("SELECT `parentid`,`rank`,`name` FROM `sponsors` WHERE `sponsorid`='$sponsorid';",$c));
	if(!$res)
		throw new Exception('sponsor to move down not found');
	$rank=$res[1];
	$parent=$res[0];
	$name=$res[2];
	$res=mysql_fetch_row(run_query("SELECT `sponsorid`,`rank` FROM `sponsors` WHERE `rank`>'$rank' AND `parentid`='$parent' ORDER BY `rank` ASC LIMIT 0,1",$c));
	if(!$res)
		throw new Exception("Event '$name' is already on bottom of list.");
	run_query("UPDATE `sponsors` SET `rank`='$rank' WHERE `sponsorid`='{$res[0]}';",$c);
	run_query("UPDATE `sponsors` SET `rank`='{$res[1]}' WHERE `sponsorid`='$sponsorid';",$c);
	$T_INFO="Event '$name' moved down.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['delete']))
try{
	$sponsor=intval($_GET['delete']);
	$res=mysql_fetch_row(run_query("SELECT `name` FROM `sponsors` WHERE `sponsorid`='$sponsor';",$c));
	if(!$res)
		throw new Exception('Invalid sponsor.');
	$name=$res[0];
	if($sponsor<=1)
		throw new Exception('Invalid sponsor.');
	$list=array($sponsor);
	while($list){
		$listn=array();
		foreach($list as $l){
		$q=run_query("SELECT `sponsorid` FROM `sponsors` WHERE `parentid`='$l';",$c);
		while($res=mysql_fetch_row($q))
			$listn[]=$res[0];
		}
		$list="'".implode("','",$list)."'";
		$res=run_query("SELECT `sponsorid`,`image` FROM `sponsors` WHERE `sponsorid` IN ($list);",$c);
		while($row=mysql_fetch_row($res))
			if($row[1])
				@unlink($PATH."../sponsors/".$row[1]);
		run_query("DELETE FROM `sponsors` WHERE `sponsorid` IN ($list);",$c);
		$list=$listn;
	}
	$list=array();
	$T_INFO="Event '$name' and its subsponsors deleted.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
$T_TITLE='NITTFEST Sponsors Management';
$T_HEADER='Sponsors';
$label=pagepath($sponsor);
$T_CONTENT='';
foreach($label as $a)
	$T_CONTENT.="<a href='./sponsors.php?sponsor={$a[0]}'>{$a[1]}</a>&nbsp;>&nbsp;";
$T_CONTENT.="<br /><br />
";
$show=1;
if(isset($_GET['edit']))
try{
	$editsponsor=intval($_GET['edit']);
	$res=mysql_fetch_assoc(run_query("SELECT * FROM `sponsors` WHERE `sponsorid`='$editsponsor';",$c));
	if(!$res) throw new Exception();
	$image=$res['image']?"<img class='thumbnail' src='{$PATH}../sponsors/{$res['image']}' alt='' >":'';
	$T_CONTENT.=<<<BODY
<div>
<form action="./sponsors.php?edit={$editsponsor}" method="post" enctype='multipart/form-data'>
<table>
<tr><td>Name</td><td><input type="text" name="name" value="{$res['name']}" ></td></tr>
<tr><td>Type</td><td><input type="text" name="type" value="{$res['type']}" ></td></tr>
<tr><td>URL</td><td><input type="text" name="url" value="{$res['url']}" ></td></tr>
<tr><td>Image</td><td><input type="file" name="picture"></td><td>{$image}</td></tr>
</table>
<input type="submit" value="Update" name="updateSubmit" >
</form><br /><br />
<a class='action' href='./sponsors.php?delete=$editsponsor' title='Delete'><img src='{$PATH}/template/images/delete.png' alt='Delete' >&nbsp;Delete sponsor</a>
</div>
BODY;
	$show=0;
}catch(Exception $e){
	$show=1;
}
if($show){
$res=mysql_fetch_row(run_query("SELECT MAX(`rank`),MIN(`rank`) FROM `sponsors` WHERE `parentid`='$sponsor';",$c));
$minp='';$maxp='';
if(!($res[0]==='')){ $minp=$res[0]; $maxp=$res[1]; }//rank opp
$q=run_query("SELECT * FROM `sponsors` WHERE `parentid`='$sponsor' ORDER BY `rank`;",$c);
if(mysql_num_rows($q)){
	$con="<ol>";
	while($res=mysql_fetch_assoc($q)){
		$image=$res['image']?"<a href='{$res['url']}' target='blank'><img class='thumbnail' src='{$PATH}../sponsors/{$res['image']}' alt='' ></a>":'';
		$up=$res['rank']==$maxp?"<img class='disabled' src='{$PATH}/template/images/up.png' alt='Up' >":"<a class='action' href='./sponsors.php?up={$res['sponsorid']}' title='Move Up'><img src='{$PATH}/template/images/up.png' alt='Up' ></a>";
		$down=$res['rank']==$minp?"<img class='disabled' src='{$PATH}/template/images/down.png' alt='Down' >":"<a class='action' href='./sponsors.php?down={$res['sponsorid']}' title='Move Down'><img src='{$PATH}/template/images/down.png' alt='Down' ></a>";
		$path=realpath("{$PATH}/../sponsors/{$res['image']}");
		$con.="<li><a class='action' href='./sponsors.php?edit={$res['sponsorid']}' title='Edit'><img src='{$PATH}/template/images/edit.png' alt='Edit' ></a>&nbsp;&nbsp;&nbsp;
		{$up}{$down}&nbsp;&nbsp;&nbsp;
		<a href='./sponsors.php?sponsor={$res['sponsorid']}'>{$res['name']}</a>&nbsp;&nbsp;&nbsp;{$image}</li>";
	}
	$con.="</ol>";
}else
	$con="<p><h3>No sponsor added yet</h3></p>";
$T_CONTENT.=<<<BODY
<fieldset><legend>Sponsors</legend>
$con
</fieldset>
<br />
<fieldset><legend>Add Sponsor</legend>
<form action="./sponsors.php?sponsor=$sponsor" method="post" enctype='multipart/form-data'>
<table>
<tr><td>Name *</td><td><input type="text" name="name" /></td></tr>
<tr><td>URL</td><td><input type="text" name="url" /></td></tr>
<tr><td>Type</td><td><input type="text" name="type" /></td></tr>
<tr><td>File</td><td><input type="file" name="picture" ></td></tr>
<tr><td><input type="submit" name="editSubmit" /></td></tr>
</table>
</form>
</fieldset>
BODY;
}
require_once($PATH."/template/index.php");
?>
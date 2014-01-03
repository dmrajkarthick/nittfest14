<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
function pagepath($pageid){
	global $c;
	$a=array();
	while(1){
		$res=mysql_fetch_row(run_query("SELECT `parentid`,`name` FROM `pages` WHERE `pageid`='$pageid';",$c));
		$a[]=array($pageid,$res[1]);
		$pageid=$res[0];
		if(!$pageid) break;
	}
	$a=array_reverse($a);
	return $a;
}
if(isset($_GET['page']))
	$page=intval($_GET['page']);
else $page=1;
if(isset($_POST['editSubmit']))
try{
	if(!($_POST['name'] && $_POST['title'] && $_POST['language']))
		throw new Exception('Please fill all starred fields.');
	$name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
	$name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $name=str_replace(' ','-',strtolower($name));
	$title=filter_var($_POST['title'],FILTER_SANITIZE_STRING);
	$type=$_POST['type']?filter_var($_POST['type'],FILTER_SANITIZE_STRING):'';
	$lang=in_array($_POST['language'],array('English','Hindi','Tamil'))?$_POST['language']:'English';
	$res=mysql_fetch_row(run_query("SELECT MAX(`rank`)+1 from `pages` where `parentid`='$page';",$c));
	$rank=$res[0];
	$q=run_query("INSERT INTO `pages` VALUES (NULL, '$page', '$name', '$title', '$type', '', '$rank', '$lang', '');",$c);
	if($q) $T_INFO='Event Added!';
	else throw new Exception('Not added. '.mysql_error());
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_POST['updateSubmit']))
try{
	$editpage=intval($_GET['edit']);
	$name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
	if(!$name)
		throw new Exception('Please enter name');
	$name=str_replace(' ','-',strtolower($name));
	$title=filter_var($_POST['title'],FILTER_SANITIZE_STRING);
	if(!$title)
		throw new Exception('Please enter title');
	$type=$_POST['type']?filter_var($_POST['type'],FILTER_SANITIZE_STRING):$type='';
	$score='';
	if(isset($_POST['score']))
	if($_POST['score']){
		$_POST['score'][]=0;
		$score=array();
		for($i=0,$l=count($_POST['score'])-1;$i<$l && intval($_POST['score'][$i]);++$i){
			if($_POST['score'][$i]<$_POST['score'][$i+1])
				throw new Exception('Inconsistent scores. Please recheck.');
			$score[]=$_POST['score'][$i];
		}
		if(!$score) $score='';
		else $score=implode(';',$score);
	}
	$lang=in_array($_POST['language'],array('English','Hindi','Tamil'))?$_POST['language']:'English';
	$desc=addslashes($_POST['description']);
	run_query("UPDATE `pages` SET `name`='$name',`title`='$title',`type`='$type',`scores`='$score',`language`='$lang',`description`='$desc' WHERE `pageid`='$editpage';",$c);
	$T_INFO='Event details updated!';
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['up']))
try{
	$pageid=intval($_GET['up']);
	$res=mysql_fetch_row(run_query("SELECT `parentid`,`rank`,`name` FROM `pages` WHERE `pageid`='$pageid';",$c));
	if(!$res)
		throw new Exception('Page to move up not found');
	$rank=$res[1];
	$parent=$res[0];
	$name=$res[2];
	$res=mysql_fetch_row(run_query("SELECT `pageid`,`rank` FROM `pages` WHERE `rank`<'$rank' AND `parentid`='$parent' ORDER BY `rank` DESC LIMIT 0,1",$c));
	if(!$res)
		throw new Exception("Event '$name' is already on top of list.");
	run_query("UPDATE `pages` SET `rank`='$rank' WHERE `pageid`='{$res[0]}';",$c);
	run_query("UPDATE `pages` SET `rank`='{$res[1]}' WHERE `pageid`='$pageid';",$c);
	$T_INFO="Event '$name' moved up.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['down']))
try{
	$pageid=intval($_GET['down']);
	$res=mysql_fetch_row(run_query("SELECT `parentid`,`rank`,`name` FROM `pages` WHERE `pageid`='$pageid';",$c));
	if(!$res)
		throw new Exception('Page to move down not found');
	$rank=$res[1];
	$parent=$res[0];
	$name=$res[2];
	$res=mysql_fetch_row(run_query("SELECT `pageid`,`rank` FROM `pages` WHERE `rank`>'$rank' AND `parentid`='$parent' ORDER BY `rank` ASC LIMIT 0,1",$c));
	if(!$res)
		throw new Exception("Event '$name' is already on bottom of list.");
	run_query("UPDATE `pages` SET `rank`='$rank' WHERE `pageid`='{$res[0]}';",$c);
	run_query("UPDATE `pages` SET `rank`='{$res[1]}' WHERE `pageid`='$pageid';",$c);
	$T_INFO="Event '$name' moved down.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
else if(isset($_GET['delete']))
try{
	$page=intval($_GET['delete']);
	$res=mysql_fetch_row(run_query("SELECT `name` FROM `pages` WHERE `pageid`='$page';",$c));
	if(!$res)
		throw new Exception('Invalid page.');
	$name=$res[0];
	if($page<=1)
		throw new Exception('Invalid page.');
	$list=array($page);
	while($list){
		$listn=array();
		foreach($list as $l){
		$q=run_query("SELECT `pageid` FROM `pages` WHERE `parentid`='$l';",$c);
		while($res=mysql_fetch_row($q))
			$listn[]=$res[0];
		}
		$list="'".implode("','",$list)."'";
		run_query("DELETE FROM `pages` WHERE `pageid` IN ($list)",$c);
		$list=$listn;
	}
	$list=array();
	$T_INFO="Event '$name' and its subpages deleted.";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
$language='';
$res=mysql_fetch_row(run_query("SELECT `language` FROM `pages` WHERE `pageid`='$page';",$c));
if(!$res) $page=1;
else $language=$res[0];
$T_TITLE='NITTFEST Events Management';
$T_HEADER='Events';
if(isset($_GET['edit'])){
	$editpage=intval($_GET['edit']);
	$label=pagepath($editpage);
}else
$label=pagepath($page);
$T_CONTENT='';
foreach($label as $a)
	$T_CONTENT.="<a href='./events.php?page={$a[0]}'>{$a[1]}</a>&nbsp;>&nbsp;";
$T_CONTENT.="<br /><br />
";
$show=1;
if(isset($_GET['edit']))
try{
	$T_HEADSCRIPTS="<script type ='text/javascript' src='{$PATH}template/scripts/ckeditor.js'></script>
	";
	$res=mysql_fetch_assoc(run_query("SELECT * FROM `pages` WHERE `pageid`='$editpage';",$c));
	if(!$res) throw new Exception();
	$score=explode(';',$res['scores']);
	$sc='';
	if($res['scores']){
		foreach($score as $s)
			$sc.="<li><input type='text' name='score[]' value='{$s}'></li>";
	}
	$text=stripslashes($res['description']);
	$lang='';
foreach(array('English','Hindi','Tamil') as $l)
	$lang.="<option".($l==$res['language']?' SELECTED':'').">$l</option>";
	$T_CONTENT.=<<<BODY
<div>
<script type="text/javascript">
window.onload=function(){
	document.getElementById('addscore').onclick=function(){
	document.getElementById('scoreslist').innerHTML+="<li><input type='text' name='score[]' ></li>";
};
for(var i=3;i>0;--i)
	document.getElementById('addscore').onclick();
};
</script>
<form action="./events.php?edit={$editpage}" method="post">
<table>
<tr><td><input type="submit" value="Update" name="updateSubmit" ></td><td>&nbsp;</td></tr>
<tr><td>Name</td><td><input type="text" name="name" value="{$res['name']}" ></td></tr>
<tr><td>Title</td><td><input type="text" name="title" class="{$res['language']}" value="{$res['title']}" ></td></tr>
<tr><td>Type</td><td><input type="text" name="type" value="{$res['type']}" ></td></tr>
<tr><td>Scores<br /><input type="button" value="Add Score" id="addscore"></td><td><ol id="scoreslist">{$sc}</ol></td></tr>
<tr><td>Language:</td><td><select size="1" name="language">{$lang}</select>
<script type="text/javascript">
a=function(){
document.forms[0].title.className=this.options[this.selectedIndex].value;
}
document.forms[0].language.onchange=a;
</script>
</td></tr>
</table>
<div id="descwrapper" class="{$res['language']}"><textarea id='editbox' class='ckeditor' name="description">{$text}</textarea></div><br />
<input type="submit" value="Update" name="updateSubmit" >
</form><br /><br />
<a class='action' href='./events.php?delete=$editpage' title='Delete' onclick="return confirm('Delete the page {$res['name']}?')"><img src='{$PATH}/template/images/delete.png' alt='Delete' >&nbsp;Delete Page</a>
</div>
BODY;
	$show=0;
}catch(Exception $e){
	$show=1;
}
if($show){
$res=mysql_fetch_row(run_query("SELECT MAX(`rank`),MIN(`rank`) FROM `pages` WHERE `parentid`='$page';",$c));
$minp='';$maxp='';
if(!($res[0]==='')){ $minp=$res[0]; $maxp=$res[1]; }//rank opp
$q=run_query("SELECT `pageid`,`name`,`title`,`rank`,`language` FROM `pages` WHERE `parentid`='$page' ORDER BY `rank`;",$c);
if(mysql_num_rows($q)){
	$con="<ol>";
	while($res=mysql_fetch_assoc($q)){
		$up=$res['rank']==$maxp?"<img class='disabled' src='{$PATH}/template/images/up.png' alt='Up' >":"<a class='action' href='./events.php?up={$res['pageid']}' title='Move Up'><img src='{$PATH}/template/images/up.png' alt='Up' ></a>";
		$down=$res['rank']==$minp?"<img class='disabled' src='{$PATH}/template/images/down.png' alt='Down' >":"<a class='action' href='./events.php?down={$res['pageid']}' title='Move Down'><img src='{$PATH}/template/images/down.png' alt='Down' ></a>";
		$con.="<li><a class='action' href='./events.php?edit={$res['pageid']}' title='Edit'><img src='{$PATH}/template/images/edit.png' alt='Edit' ></a>&nbsp;&nbsp;&nbsp;
		{$up}{$down}&nbsp;&nbsp;&nbsp;
		<a href='./events.php?page={$res['pageid']}'>{$res['name']} - <span class='{$res['language']}'>{$res['title']}</span></a></li>";
	}
	$con.="</ol>";
}else
	$con="<p><h3>No page added yet</h3></p>";
$lang='';
foreach(array('English','Hindi','Tamil') as $l)
	$lang.="<option".($l==$language?' SELECTED':'').">$l</option>";
$T_CONTENT.=<<<BODY
<fieldset><legend>Pages</legend>
$con
</fieldset>
<br />
<fieldset><legend>Add Page</legend>
<form action="./events.php?page=$page" method="post">
<table>
<tr><td>Name *</td><td><input type="text" name="name" /></td></tr>
<tr><td>Title *</td><td><input class="English" type="text" name="title" /></td></tr>
<tr><td>Type</td><td><input type="text" name="type" /></td></tr>
<tr><td>Language</td><td><select size="1" name="language">$lang</select>
<script type="text/javascript">
a=function(){
document.forms[0].title.className=this.options[this.selectedIndex].value;
}
document.forms[0].language.onchange=a;
</script>
</td></tr>
<tr><td><input type="submit" name="editSubmit" /></td></tr>
</table>
</form>
</fieldset>
BODY;
}
require_once($PATH."/template/index.php");
?>

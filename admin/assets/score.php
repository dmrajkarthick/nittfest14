<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
if(isset($_POST['scoreSubmit']))
try{
	$event=intval($_POST['event']);
	$subevent=intval($_POST['subevent']);
	$res=mysql_fetch_row(run_query("SELECT `name` FROM `pages` WHERE `pageid`='$subevent' AND `parentid`='$event' AND `type`='1';",$c));
	if(!$res)
		throw new Exception('Select event and subevent properly');
	$name=$res[0];
	for($i=0,$l=count($_POST['position']);$i<$l && intval($_POST['position'][$i])>0 && floatval($_POST['points'][$i])>0;++$i);
	if($i!=$l)
		throw new Exception('Please enter valid scores and positions.');
	for($i=0,$l=count($_POST['position'])-1;$i<$l;++$i)
		if($_POST['position'][$i]>$_POST['position'][$i+1]+1)
			throw new Exception('Please enter positions in correct order.');
		else if($_POST['points'][$i]<$_POST['points'][$i+1])
			throw new Exception('Please enter positions in correct order.');
	if($i!=$l)
		throw new Exception('Please enter valid scores');
	$res=mysql_fetch_row(run_query("SELECT `name` FROM `pages` WHERE `pageid`='$event';",$c));
	$catname=$res[0];
	for($i=0,$l=count($_POST['position']);$i<$l;++$i){
		$branch=intval($_POST['branch'][$i]);
		$pos=intval($_POST['position'][$i]);
		$pts=floatval($_POST['points'][$i]);
		$desc=addslashes($_POST['desc'][$i]);
		$time=time();
		if(!$branch)
			throw new Exception('Please select branch names.');
		$res=mysql_fetch_row(run_query("SELECT `initial` FROM `score_main` WHERE `branchid`='$branch';",$c));
		if(!$res) throw new Exception('Please select branch names.');
		run_query("DELETE FROM `score_details` WHERE `branchid`='$branch' AND `pageid`='$subevent';",$c);
		run_query("INSERT INTO `score_details` VALUES (NULL,'$branch','$event','$subevent','$pos','$pts','$desc','$time');",$c);
		run_query("INSERT INTO `score_log` VALUES (NULL,'$branch','$event','$subevent','$pos','$pts','$time');",$c);
		run_query("UPDATE `score_main` SET `$catname`= ( SELECT SUM(score) FROM `score_details` WHERE `branchid`='$branch' AND `category`='$event') WHERE `branchid`='$branch';",$c);
	}
	$T_INFO="Event '$name' scores added!";
}catch(Exception $e){
	$T_ERROR=$e->getMessage();
}
$T_TITLE='NITTFEST Score';
$T_HEADER='Scoreboard';
$T_HEADSCRIPTS='<script type="text/javascript" src="datatable/jquery.min.js" ></script>';
$res=run_query("SELECT `pageid`,`name`,`title` FROM `pages` WHERE `parentid`='1';",$c);
$eventselect='';
while($row=mysql_fetch_assoc($res)){
	$eventselect.="<OPTION value='{$row['pageid']}'>{$row['name']} - {$row['title']}</OPTION>";
}
$res=run_query("SELECT `branchid`,`initial` FROM `score_main`;",$c);
$brsel="<OPTION></OPTION>";
while($row=mysql_fetch_assoc($res))
	$brsel.="<OPTION value='{$row['branchid']}'>{$row['initial']}</OPTION>";
$T_CONTENT=<<<BODY
<script type="text/javascript">
$(document).ready(function(){
if(window.XMLHttpRequest)
	subajax=new XMLHttpRequest();
else
	subajax=new ActiveXObject('Microsoft.XMLHTTP');
$('#eventselect').click(function(){
	var ev=document.forms[0].event.options[document.forms[0].event.options.selectedIndex].value;
	subajax.open("GET", "get_subevent.php?event="+ev,true);
	subajax.send();
});
subajax.onreadystatechange=function(){
	if(subajax.readyState==4 && subajax.status==200){
		console.log(subajax.responseText)
		document.getElementById('subeventselect').innerHTML=subajax.responseText;
	}
};
$('#addWinner').click(function(){
	$('#scoresubmittable').append("<tr><td>Branch</td><td><SELECT size='1' name='branch[]'><?php echo $brsel; ?></SELECT></td><td>Rank</td><td><SELECT size='1' name='position[]'> <option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option></select></td> <td>Points</td><td><input type='text' name='points[]' size='4'></td><td><textarea rows='3' cols='50' name='desc[]' ></textarea></td></tr>");
});
for(var i=3;i>0;--i)
	$('#addWinner').click();
});
</script>
<fieldset><legend>Add Entry</legend>
<div id="scoresubmit">
<form action="./score.php" method="post">
<table id="scoresubmittable">
<tr><td><input type="submit" value="Update" name="scoreSubmit" /></td></tr>
<tr><td>Event</td><td><SELECT size="1" name="event" id="eventselect">
<option></option>{$eventselect}</SELECT></td></tr>
<tr><td>Sub event</td><td colspan="2"><SELECT size="1" id="subeventselect" name="subevent">
</select></td></tr>
<tr><td>Scores:</td><td><input type="button" value="Add Position" id="addWinner" /></td></tr>
</table></form></div>
</fieldset>
<p><a href="scorelog.php" target="blank">Score Log</a></p>
BODY;
require_once($PATH."template/index.php");
?>

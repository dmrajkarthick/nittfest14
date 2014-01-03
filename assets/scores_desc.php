<?php
//dept cat
//b c
define('NAMESPACE111222333','##$$$$23@');
if(!isset($PATH))
	$PATH="../admin/";
require_once($PATH.'config/variables.php');
require_once($PATH.'assets/mysqlconnector.php');
$c=connectMySQL($PATH);
if(!$c)
throw new Exception('Database not connected.');
?>
<html>
<body>
<div id="content" class="english">
<?php
try{
	if(isset($_GET['b'])){
		$branch=intval($_GET['b']);
		$res=mysql_fetch_row(run_query("SELECT `name` FROM `score_main` WHERE `branchid`='$branch';",$c));
		if(!$res)
			throw new Exception('Selected branch is not participationg in NITTFEST 13!');
		else	$bname=$res[0];
	} else $branch='';
	if(isset($_GET['e'])){
		$event=filter_var($_GET['e'],FILTER_SANITIZE_STRING);
		$res=mysql_fetch_row(run_query("SELECT `pageid`,`title`,`language` FROM `pages` WHERE `name`='$event';",$c));
		if(!$res)
			throw new Exception('Selected Event is not recognized!');
		else	{ $event=$res[0]; $ename=$res[1]; $cls=$res[2]; }
	} else $event='';
	if(!$branch && !$event)
		throw new Exception('Illegal Query');
	$con='';
	if($event)
		$con="`parentid`='$event'";
	if($branch)
		$con.=($con?' AND ':'')."`score_details`.`branchid`='$branch'";
	$res=run_query("SELECT `score_details`.*,`title`,`score_main`.`name` 'bname',`language` FROM `score_details`,`pages`,`score_main` WHERE {$con} AND `pages`.`pageid`=`score_details`.`pageid` AND `score_details`.`branchid`=`score_main`.`branchid` ORDER BY `rank` ASC,`time` DESC;",$c);
	if($event)
	if($_GET['e']=='hindi')
		$ename="Hindi Lits";
	else if($_GET['e']=='tamil')
		$ename="Tamil Lits";
	$bname1='';
	$ename1='';
	if($branch)
		echo "<div class='popupbranch'>$bname</div>";
	else $bname1='<th>Department</th>';
	if($event)
		echo "<div class='popupevent'>$ename</div>";
	else $ename1='<th>Section</th>';
	echo "<table width='780' id='popuptable'><tr>{$bname1}{$ename1}<th>Event</th><th>Position</th><th>Points</th><th>Description</th></tr>";
	$bname1='';
	$ename1='';
	while($row=mysql_fetch_assoc($res)){
		if(!$branch)
			$bname1="<td>{$row['name']}</td>";
		if(!$event)
			if($row['language']=='Tamil')	$ename1="<td>Tamil Lits</td>";
			else if($row['language']=='Hindi')	$ename1="<td>Hindi Lits</td>";
			else	$ename1="<td><div class='{$row['language']}'>$ename</div></td>";
		$desc=htmlspecialchars_decode($row['description'],ENT_QUOTES).'<br /><span class="popuptime">At '.date('g:i a, F j',$row['time']).'</span>';
		$subevent=htmlspecialchars_decode($row['title'],ENT_QUOTES);
		echo "<tr>{$bname1}{$ename1}<td><div class='{$row['language']}'>{$subevent}</div></td><td>{$row['rank']}</td><td>{$row['score']}</td><td class='popupcomment'>$desc</td></tr>";
	}
	echo '</table>';
} catch(Exception $e){
	$err=$e->getMessage();
	echo $err;
}
if($c)
	mysql_close();
?>
</div>
</body>
</html>
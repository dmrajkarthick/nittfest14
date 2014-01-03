<?php
define('NAMESPACE111222333','##$$');
$PATH='../';
require_once('security.php');
$T_TITLE='NITTFEST Scoreboard Log';
$T_HEADER='Scoreboard Log';
$T_HEADSTYLES='<link rel="stylesheet" type="text/css" href="datatable/demo_table.css" >';
$T_HEADSCRIPTS='<script type="text/javascript" src="datatable/jquery.min.js" ></script>
<script type="text/javascript" src="datatable/jquery.dataTables.min.js" ></script>
';
try{
$result=run_query("SELECT `score_log`.*,`pages`.`name`,`initial` FROM `score_log`,`pages`,`score_main` WHERE `pageid`=`subevent` AND `branch`=`branchid` ORDER BY `time` DESC;",$c);
$i=mysql_num_rows($result);
$con='';
while($row=mysql_fetch_assoc($result)){
	$time=date('F j, Y, g:i a',$row['time']);
	$con.="<tr><td>$i</td><td>{$row['name']}</td><td>{$row['initial']}</td><td>{$row['position']}</td><td>{$row['points']}</td><td>{$time}</td></tr>";
	--$i;
}
} catch(Exception $e){
	$error=$e->getMessage();
}
$T_CONTENT.=<<<BODY
<table id="rankTable"><thead><tr><th>#</th><th>Event</th><th>Department</th><th>Position</th><th>Points</th><th>Time</th></tr></thead><tbody>
{$con}
</tbody></table>
		</div>
<script type="text/javascript">$(document).ready(function() { $("#rankTable").dataTable(); });</script>
BODY;
require_once($PATH."template/index.php");
?>

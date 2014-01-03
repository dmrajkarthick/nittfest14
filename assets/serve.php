<?php
try{
define('NAMESPACE111222333','##$$$$23@');
if(!isset($PATH))
	$PATH="../admin/";
require_once($PATH.'config/variables.php');
require_once($PATH.'assets/mysqlconnector.php');
$c=connectMySQL($PATH);
if(!$c)
throw new Exception('Database not connected.');
$sub=htmlspecialchars($_GET['q']);
$sub=explode("_",$sub);
$cat=$sub[0];
$q=$sub[1];
if($cat=="e"){
if($q=="notification"){
$res=run_query("SELECT * FROM `pages` WHERE `name`='prelims' AND `parentid`='1';",$c);
$row=mysql_fetch_assoc($res);
if(!$row)	throw new Exception();
$cls=$row['language'];
$title=$row['title'];
$content= "<div id='content' pollingclass='event' polling=''>";
if(defined('MOBILE'))
$content.="<a class='hometop English' href='./'>Home</a>";
$content.='<h2 class="eventname">'.htmlspecialchars_decode($row['title']).'</h2><div name="contentArea">'.$row['description'].'</div>
';
$res=run_query("SELECT `name`,`title`,`type` FROM `pages` WHERE `parentid`='{$row['pageid']}' ORDER BY `type`;",$c);
$row=mysql_fetch_assoc($res);
$pr='';
if($row){
	do{
		if($row['type']!=$pr) { if($pr) $content.="</ul>"; $content.="<ul class='eventlist'>{$row['type']}"; }
		$pr=$row['type'];
		$content.= "<li><a class='ajaxSubevent' name='{$row['name']}' href='?q=s_{$row['name']}'>".htmlspecialchars_decode($row['title']);
		if(!defined('MOBILE')) $content.="<img src='images/loading.gif' class='et-load' alt=''>";
		$content.="</a></li>";
	}while($row=mysql_fetch_assoc($res));
	$content.= '</ul>';
}
$content.="</div>";
}else{
$res=run_query("SELECT * FROM `pages` WHERE `name`='$q' AND `parentid`='1';",$c);
$row=mysql_fetch_assoc($res);
if(!$row)	throw new Exception();
$cls=$row['language'];
$title=$cls=="English"?$row['title']:$cls." Lits";
$content= "<div id='content' pollingclass='event' polling=''>";
if(defined('MOBILE'))
$content.="<a class='hometop English' href='./'>Home</a>";
$content.= '<h2 class="eventname">'.htmlspecialchars_decode($row['title']).'</h2><div name="contentArea">'.$row['description'].'</div>
';
if($row['scores'])
$content.="<div class='event-points English'>Total Points: {$row['scores']}</div>
";
$res=run_query("SELECT `name`,`title` FROM `pages` WHERE `parentid`='{$row['pageid']}';",$c);
		$row=mysql_fetch_assoc($res);
		if($row){
			$content.= '<h4 id="subeventname" class="English">Events</h4><ul class="eventlist">';
			do{
			$content.= "<li><a class='ajaxSubevent' name='{$row['name']}' href='?q=s_{$row['name']}'>".htmlspecialchars_decode($row['title']);
			if(!defined('MOBILE')) $content.="<img src='images/loading.gif' class='et-load' alt=''>";
			$content.="</a></li>";
			}while($row=mysql_fetch_assoc($res));
			$content.= '</ul>';
		}
}
}else if($cat=="s"){
$res=run_query("SELECT * FROM `pages` WHERE `name`='$q';",$c);
$row=mysql_fetch_assoc($res);
if(!$row)	throw new Exception();
$scores=$row['scores'];
$res1=mysql_fetch_assoc(run_query("SELECT `name`,`title` FROM `pages` WHERE `pageid`='{$row['parentid']}';",$c));
$parentname=$res1['name'];
$parenttitle=$res1['title'];
if($row['language']=='Tamil'){
	$cls='Tamil';
	$title='Tamil Lits';
}
else if($row['language']=='Hindi'){
	$cls='Hindi';
	$title='Hindi Lits';
}
else{
	$cls='English';
	$title=htmlspecialchars_decode($row['title']);
}
$content= "<div id='content' pollingclass='subevent' polling=''>";
if(defined('MOBILE'))
$content.="<a href='./'>Home</a><span>&nbsp;&gt;&nbsp;</span><a class='eventcat' href='index.php?q=e_{$parentname}'>$parenttitle</a><span>&nbsp;&gt;&nbsp;</span><br /><br />";
$content.= "
<span class='eventname $cls'>".htmlspecialchars_decode($row['title']).'</span>'.(defined('MOBILE')?"<hr />":"").'<div class="subdesc">'.$row['description'].'</div><div class="contentArea">';
$res=run_query("SELECT * FROM `pages` WHERE `parentid`='{$row['pageid']}';",$c);
$head='';
if($scores){
$points=array();
$ptr=array('First','Second','Third','Fourth','Fifth','Sixth','Seventh');
$temp=explode(';',$scores);
foreach($temp as $temp1=>$temp2)
	$points[]=$ptr[$temp1]." Position : $temp2";
$points="<div class='event-points'><strong>Points:</strong><br/>".implode('<br />',$points)."</div>";
}else $points='';
$body='';$i=0;
if(defined('MOBILE')){
$content.="<hr />";
$tab=intval($_GET['t']);
if(!$tab) $tab=0;
while($row=mysql_fetch_assoc($res)){
$head.="<a class='tabHead ".($i==$tab?"selected":"")."' name='$i' href='index.php?q={$_GET['q']}&t={$i}'>".$row['title']."</a>";
if($i==$tab) $body.="<div class='tabBody tab{$i}'>{$row['description']}</div>";
$i++;
}
}else{
while($row=mysql_fetch_assoc($res)){
$head.="<a class='tabHead ".($i?"":"selected")."' name='$i' href='#'>".$row['title']."</a>";
$body.="<div class='tabBody tab{$i}'>{$row['description']}</div>";
$i++;
}

}
$content.="$points<div class='tabBox'>$head</div><div class='bodyBox'>$body</div></div>";

}else throw new Exception();
if(!defined('MOBILE'))
echo json_encode(array("content"=>$content,"c"=>intval($_GET['c']),"title"=>$title,"language"=>$cls));
else{
$CONTENT=$content;
$TITLE="NITTFEST '13 - ".$title;
$LANGUAGE=$cls;
}
}catch(Exception $e){
	if(!defined('MOBILE')) echo "-1";
}
?>

<?php
require_once __DIR__."/admin/assets/mysqlconnector.php";

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {
	echo "unknown request";
	exit;
}

if(!isset($_GET['q'])) {
	echo "error";
	exit;
}

$pageno=$_GET['q'];
if($pageno==3)
{
	echo json_encode(array(
		'title' => 'RuleBook',
		'desc' => "<div onclick='p(1)'>General rules</div>
    		<div onclick='p(5)'>English Lits</div>
    		<div onclick='p(44)'>Arts</div>
    		<div onclick='p(55)'>Hindi Lits</div>
    		<div onclick='p(77)'>Tamil Lits</div>
    		<div onclick='p(88)'>Culturals</div>
    		<div onclick='p(99)'>Design & Media</div>"
	));
	die();
}

//english lits///////////////////////////////////////////////////////////////////////////////
if($pageno==4 or $pageno == 5)
{
	echo json_encode(array(
		'title' => 'Summa',
		'desc' => 'fasdfadf',
	));
	die();
}

if($pageno==6)
{
	echo json_encode(array(
		'title' => 'Summa',
		'desc' => 'fasdfadf',
	));
	die();
}
if($pageno>=7 && $pageno<=22)
	{

		$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='english'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();

		for($i=7,$j=0;$i<=22;$i++)
		{
			if(isset($res[$j]) && $pageno==$i)
			{
				$tmp = array(
					'title' => $res[$j]['title'],
					'desc' => $res[$j]['description']
				);
				echo json_encode($tmp);
				die();
			}
			if(!isset($res[$j])) {
				echo json_encode(array('title'=>'', 'desc'=>''));
				die();
			}
			$j++;
		}
	}	

//arts////////////////////////////////////////////////////////////////////////////////////////
if($pageno>=23 and $pageno<=32)
	{
		$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='arts'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=23;$i<=32;$i++)
		{
			if(isset($res[$j]) && $pageno==$i)
			{
				$tmp = array(
					'title' => $res[$j]['title'],
					'desc' => $res[$j]['description']
				);
				echo json_encode($tmp);
				die();
			}
			if(!isset($res[$j])) {
				echo json_encode(array('title'=>'', 'desc'=>''));
				die();
			}
			$j++;
		}

	}	

//Culturals/////////////////////////////////////////////////////////////////////////////////////
if($pageno>=33 && $pageno<=50)
	{
		$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='culturals'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=33;$i<=50;$i++)
		{
			if(isset($res[$j]) && $pageno==$i)
			{
				$tmp = array(
					'title' => $res[$j]['title'],
					'desc' => $res[$j]['description']
				);
				echo json_encode($tmp);
				die();
			}
			if(!isset($res[$j])) {
				echo json_encode(array('title'=>'', 'desc'=>''));
				die();
			}
			$j++;
		}

	}	

//design///////////////////////////////////////////////////////////////////////////////////////////
	if($pageno>=51 && $pageno<=62)
	{
	$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='design'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=51;$i<=62;$i++)
		{
			if(isset($res[$j]) && $pageno==$i)
			{
				$tmp = array(
					'title' => $res[$j]['title'],
					'desc' => $res[$j]['description']
				);
				echo json_encode($tmp);
				die();
			}
			if(!isset($res[$j])) {
				echo json_encode(array('title'=>'', 'desc'=>''));
				die();
			}
			$j++;
		}
	}	

//hindi////////////////////////////////////////////////////////////////////////////////
	if($pageno>=63 && $pageno<=79)
	{
	$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='hindi'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=63;$i<=79;$i++)
		{
			if(isset($res[$j]) && $pageno==$i)
			{
				$tmp = array(
					'title' => $res[$j]['title'],
					'desc' => $res[$j]['description']
				);
				echo json_encode($tmp);
				die();
			}
			if(!isset($res[$j])) {
				echo json_encode(array('title'=>'', 'desc'=>''));
				die();
			}
			$j++;
		}
	}	

//tamil////////////////////////////////////////////////////////////////////////////////////////////
if($pageno>=80 && $pageno<=96)
	{
	$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='tamil'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=80;$i<=96;$i++)
		{
			if(isset($res[$j]) && $pageno==$i)
			{
				$tmp = array(
					'title' => $res[$j]['title'],
					'desc' => $res[$j]['description']
				);
				echo json_encode($tmp);
				die();
			}
			if(!isset($res[$j])) {
				echo json_encode(array('title'=>'', 'desc'=>''));
				die();
			}
			$j++;
		}
	}	

//impromptu/////////////////////////////////////////////////////////////////////////////////////////
	if($pageno>=97 && $pageno<=101)
	{
	$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='impromptu'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=97;$i<=101;$i++)
		{
			if(isset($res[$j]) && $pageno==$i)
			{
				$tmp = array(
					'title' => $res[$j]['title'],
					'desc' => $res[$j]['description']
				);
				echo json_encode($tmp);
				die();
			}
			if(!isset($res[$j])) {
				echo json_encode(array('title'=>'', 'desc'=>''));
				die();
			}
			$j++;
		}
	}

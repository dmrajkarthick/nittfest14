<?php
require_once("admin/assets/mysqlconnector.php");
$pageno=$_GET['q'];
if($pageno==3)
    {
        echo "<div onclick='p(1)'>General rules</div>";
        echo "<div onclick='p(5)'>English Lits</div>";
        echo "<div onclick='p(44)'>Arts</div>";
        echo "<div onclick='p(55)'>Hindi Lits</div>";
        echo "<div onclick='p(77)'>Tamil Lits</div>";
        echo "<div onclick='p(88)'>Culturals</div>";
        echo "<div onclick='p(99)'>Design & Media</div>";
	}

//english lits///////////////////////////////////////////////////////////////////////////////
if($pageno==5)
{
	echo "put the links for the pages in english lits";
}

if($pageno==6)
{
	echo "General rules for english wil come here";
}
if($pageno>=7 && $pageno<=20)
	{

		$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='english'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=7;$i<=21;$i++)
		{
			if($pageno==$i)
			{
			echo " Note: Put the scores in the description itself and display it";
			echo $res[$j]['description'];
			}
			$j++;
		}
	}	

//arts////////////////////////////////////////////////////////////////////////////////////////
if($pageno>=23 and $pageno<=31)
	{
		$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='arts'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=23;$i<=31;$i++)
		{
			if($pageno==$i)
			{
			echo $res[$j]['description'];
			}
			$j++;
		}

	}	

//Culturals/////////////////////////////////////////////////////////////////////////////////////
if($pageno>=33 && $pageno<=49)
	{
		$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='culturals'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=33;$i<=49;$i++)
		{
			if($pageno==$i)
			{
			echo $res[$j]['description'];
			}
			$j++;
		}

	}	

//design///////////////////////////////////////////////////////////////////////////////////////////
	if($pageno>=51 && $pageno<=61)
	{
	$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='design'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=51;$i<=61;$i++)
		{
			if($pageno==$i)
			{
			echo $res[$j]['description'];
			}
			$j++;
		}
	}	

//hindi////////////////////////////////////////////////////////////////////////////////
	if($pageno>=63 && $pageno<=78)
	{
	$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='hindi'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=63;$i<=78;$i++)
		{
			if($pageno==$i)
			{
			echo $res[$j]['description'];
			}
			$j++;
		}
	}	

//tamil////////////////////////////////////////////////////////////////////////////////////////////
if($pageno>=80 && $pageno<=95)
	{
	$stmt=$c['db']->query_simple("SELECT pageid  FROM pages where name='tamil'");
		$res=$stmt->fetch();
		$parentid=intval($res[0]);

		$stmt=$c['db']->query_simple("SELECT * FROM pages WHERE parentid='{$parentid}'");
		$res=$stmt->fetchAll();
		$j=0;

		for($i=80;$i<=95;$i++)
		{
			if($pageno==$i)
			{
			echo $res[$j]['description'];
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
			if($pageno==$i)
			{
			echo $res[$j]['description'];
			}
			$j++;
		}
	}	
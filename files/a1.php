<?php
$pageno=$_GET['q'];
if($pageno<=10)
	{
	echo "english";
	}
else if($pageno<=20)
	{
	echo "tamil";
	}	
else if($pageno<=30)
	{
	echo "hindi";
	}	
else if($pageno<=40)
	{
	echo "math";
	}	
else if($pageno<=50)
	{
	echo "cult";
	}	

?>
<?php
header('Content-type: text/css');

for($i=1;$i<4;++$i){
	for($j=1;$j<5;++$j){
		foreach(array('r','l') as $k){
		echo "#container{$i} .tree-{$k} .tree{$j}{width:".mt_rand(55,70)."%;  left:".(($j-1)*25+mt_rand(-5,0))."%;}
";
		}
	}
}
?>
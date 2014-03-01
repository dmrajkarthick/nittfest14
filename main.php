<?php

define('NAMESPACE111222333','##$$$$23@');
require_once('admin/config/variables.php');
$site=$IMAGEPATH;
$PATH="admin/";
require_once($PATH.'assets/mysqlconnector.php');
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>NITTFEST '14
    </title>
    <link href="files/style.css" rel="stylesheet" type="text/css">
    <link href="files/hover.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <script src="./files/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./files/turn.js"></script>
    <script type="text/javascript" src="./files/jqueryRotate.js"></script>
    <script type="text/javascript" src="./files/script.js"></script>

</head>
<body>

<button id='b'>Click</button>

<!--<div id="score"><img src="./img/scorecard.png" /></div>-->
<div id='dragonfire' >
    <img src='' />
</div>
<div id='maindiv' >

    <div id="flipbook" class='showdiv'>
        
    </div>
    <div id='aboutus' class='showdiv' >
        <div class='innerdiv'></div>
    </div>
    <div id='updates' class='showdiv' >
        <div class='innerdiv'>

            Updates:
            Coming soon!!
        </div>


    </div>
    <div id='scorecard' class='showdiv' >
        <div class='innerdiv'>


            Coming soon!!
        </div>
    </div>
    <div id='contacts' class='showdiv' >
        <div class='innerdiv' >
        <?php
            $stmt=$c['db']->query_simple("select * from pages where name='contacts' and parentid=1");
            $res=$stmt->fetch(PDO::FETCH_ASSOC);
            echo $res['description'];
        ?>
        </div>
    </div>
    <div id='partners' class='showdiv' >
        <div class='innerdiv'>
            Coming Soon!!
        </div>
    </div>
    <button id='hide'>Hide</button><br />
</div>





<div id='rulebook_button' class='links grow' name='book'><img src='./images/warrior1.png' /></div>
<div id='updates_button' class='links grow' name='updates'><img src='./images/warrior2.png' /></div>
<div id='scorecard_button' class='links grow' name='scorecard'><img src='./images/warrior3.png' /></div>
<div id='aboutus_button' class='links grow' name='aboutus'><img src='./images/warrior4.png' /></div>
<div id='contacts_button' class='links grow' name='contacts'><img src='./images/warrior5.png' /></div>
<div id='partners_button' class='links grow' name='partners'><img src='./images/warrior6.png' /></div>

<div id='rulebook_text' class="text" >Rulebook</div>
<div id='updates_text' class="text" >Updates</div>
<div id='scorecard_text' class="text" >Scorecard</div>
<div id='aboutus_text' class="text" >About Us</div>
<div id='contacts_text' class="text" >Contacts</div>
<div id='partners_text' class="text" >Partners</div>

<div id="hammer">
    <img src="images/hammer.png"></img>
</div>




</body>


</html>


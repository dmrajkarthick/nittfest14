<html> <head> <title><?php echo "NITTFEST'14"; ?></title> <link rel="shortcut
icon" type="image/x-icon" href="favicon.ico"></link> <style type="text/css">
        body
        {
            width: 100%;
            max-width: 600px;
            min-width: 230px;
            margin: 0px auto;
            background-color: #c4c4c4;
            /*background-color: #6c3700;*/
            color: #222222;
            /*color: #ff8300;*/
            font-size:1.0em;
            border:5px solid #000;
            font-family: serif;
        }

        li
        {
            color: #222222;
        }

        a:link,a:visited
        {
            color: #e5e5e5;
            /*color:#fea;*/
        }

        .English
        {
            font-family: serif;
        }

        #header
        {
            display: block;
            width: 100%;
            margin: 3% 0%;
        }

        #header a
        {
            width: 100%;
            display: block;
        }

        #logo-top
        {
            width: 40%;
            margin-left: 30%;
        }

        .mainlist,.sublist
        {
            list-style-type:none;
            text-align: center;
            width:100%;
            margin: 5% 0px;
            padding: 0px;
        }

        .mainli{} .mainli a:link,.mainli
a:visited,.subli a:link,.subli a:visited
                  {
                      display:block;
                      padding: 3% 0%;
                      border: 1px solid #c4c4c4/*552d05*/;
                      border-radius: 10px;
                      text-decoration: none;
                  }

        .mainli a:link,.mainli a:visited
        {
            background-color: #222222;
            text-decoration: none;
            /*background-color: #824508;*/
        }
        .sublist
        {
            margin: 0px;
            width:80%;
            margin: 0px auto;
        }
        .subli	a:link,.subli a:visited
        {
            background-color: #222222;
            text-decoration: none;
            /*background-color: #924f09;*/
        }

        #content
        {
            padding: 2%;
            overflow:auto;
        }


        .hometop
        {
            padding: 3%;
            display: block;
            background-color: #222222;
            text-decoration: none;
            border-radius: 5px;
            /*background-color: #924f09;*/
        }

        .eventlist li,.eventlist li a
        {
            text-decoration: none;
            color: #111111;
            padding: 2% 0%;
        }


        .eventlist li
        {margin: 5px;}

        .eventname
        {
            font-size: 2em;
            text-align: center;
            width: 100%;
        }

        .tabHead
        {
            background-color: #222222;
            color: #c4c4c4;
            display:block;
            margin: 2% 0%;
            padding: 3% 2%;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        .selected
        {
            /*background-color: #824508;*/
            background-color: #222222;
        }

        .contactstable
        {
            font-size: 0.7em;
        }

        .contactstable img
        {
            margin: 3% 0%;
        }

        .breadcrumbs a
        {
            color: #222222;
        }
        .event-points
        {
            padding: 2%;
            background-color: #222222;
            color: #c4c4c4;
            border-radius: 5px;
        }

        #footer
        {
            text-align: center;
            font-size: 0.7em;
            color: #111111;
            width: 100%;
        }

        #footer a:link,#footer a:visited
        {
            color: #111111;
        }

    </style>

    <script type="text/javascript">
    </script>
</head>
<body>
<div id="body-wrapper">
    <div id="header"> <a href="./"><img id="logo-top" src="images/logo.png" alt=""></a> </div> <div id="content-wrap">
<?php
        if(!isset($CONTENT)){
?>
<ul class="mainlist">
<li class="mainli"><a href="index.php?q=e_scoreboard<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">SCOREBOARD</a></li>
<li 
class="mainli"><a href="index.php?q=e_notification<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">UPDATES</a></li>
<li>
<ul class="sublist"> <li class="mainli">
<a href="index.php?q=e_rule<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">RULEBOOK</a><ul class="sublist">
<li class="subli"><a href="index.php?q=e_culturals<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">CULTURALS</a></li>
<li class="subli"><a href="index.php?q=e_tamil<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">TAMIL LITS</a></li>
<li class="subli"><a href="index.php?q=e_hindi<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">HINDI LITS</a></li>
<li class="subli"><a href="index.php?q=e_english<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">ENGLISH LITS</a></li>
<li class="subli"><a href="index.php?q=e_arts<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">ARTS</a></li>
<li class="subli"><a href="index.php?q=e_design<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">DESIGN &amp; MEDIA</a></li>
</ul></li>
    <li class="mainli"><a href="index.php?q=e_about-us<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">ABOUT US</a></li>
<li class="mainli"><a
href="index.php?q=e_contacts<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">CONTACTS</a></li> <li class="mainli"><a
href="index.php?q=e_partners<?php echo (isset($_GET['mobile'])? '&mobile':'') ?>">PARTNERS</a></li> </ul>
<?php 

        } else {
            if($LANGUAGE=="Tamil"){
    	    echo " <style> @font-face{ font-family: tamil; src:
            url(files/ADAANA.TTF); } #content{	font-family: tamil !important;
            }</style>
            $CONTENT";
            }

            else if($LANGUAGE=="Hindi")
            {
                echo "<style> @font-face{ font-family: hindi; src:
                url(files/SHREE-DV0726-OT.TTF); } #content{	font-family: hindi;
                }</style>
                $CONTENT";
            }
            else
            echo $CONTENT;
} ?>
</div> <div id="footer"> &copy; NITTFEST '13 Core<br /> <a 
href="index.php?desktop">View Desktop Site</a><br />&nbsp; </div> </div> 
<script> var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38882508-1']);
  _gaq.push(['_setDomainName', 'nittfest.in']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 
'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; 
s.parentNode.insertBefore(ga, s);
  })();
</script> </body> </html>

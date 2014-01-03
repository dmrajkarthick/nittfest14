<html> <head> <title><?php echo $TITLE; ?></title> <link rel="shortcut 
icon" type="image/x-icon" href="favicon.ico"></link> <style 
type="text/css"> body{width: 100%; max-width: 600px; min-width: 230px; 
margin: 0px auto; background-color: #6c3700; color: 
#ff8300;font-size:1em;border:1px solid #000;font-family: serif;}
li{color: #ff8300} a:link,a:visited{color:#fea;}
.English{font-family: serif;}
#header{display: block;width: 100%;margin: 3% 0%;}#header a{width: 100%; display: block;} #logo-top{width: 30%; 
margin-left: 35%;}
.mainlist,.sublist{list-style-type:none;text-align: center;width: 
100%;margin: 5% 0px;padding: 0px;} .mainli{} .mainli a:link,.mainli 
a:visited,.subli a:link,.subli a:visited{display:block;padding: 3% 
0%;border: 1px solid #552d05;} .mainli a:link,.mainli 
a:visited{background-color: #824508;} .sublist{margin: 0px; width: 
80%;margin: 0px auto;} .subli	a:link,.subli 
a:visited{background-color: #924f09;}
#content{padding: 2%;overflow:auto;}
.hometop{padding: 3%; display: block; background-color: #924f09;} 
.eventlist li,.eventlist li a{padding: 2% 0%;} .eventlist li{margin: 
5px;} .eventname{font-size: 2em;text-align: center; width: 100%;} 
.tabHead{display:block; margin: 2% 0%;padding: 3% 2%; text-align: 
center;} .selected{background-color: #824508;} .contactstable{font-size: 
0.7em;} .contactstable img{margin: 3% 0%;} .event-points{padding: 
2%;background-color: #924f09;}
#footer{text-align: center;font-size: 0.6em;color: #999;width: 100%;} 
#footer a:link,#footer a:visited{color: #999;}
</style> <script type="text/javascript"> </script> </head> <body> <div 
id="body-wrapper"> <div id="header"> <a href="./"><img id="logo-top" 
src="images/logo-thumb.png" alt=""></a> </div> <div id="content-wrap"> 
<?php if(!isset($CONTENT)){ ?> <ul class="mainlist">
<li class="mainli"><a href="index.php?q=e_scoreboard">Scoreboard</a></li>
<li 
class="mainli"><a href="index.php?q=e_notification">Updates</a></li>
<li>
<ul class="sublist"> <li class="mainli">
<a href="index.php?q=e_rule">Rulebook</a><ul class="sublist">
<li class="subli"><a href="index.php?q=e_culturals">Culturals</a></li>
<li class="subli"><a href="index.php?q=e_tamil">Tamil Lits</a></li>
<li class="subli"><a href="index.php?q=e_hindi">Hindi Lits</a></li>
<li class="subli"><a href="index.php?q=e_english">English Lits</a></li>
<li class="subli"><a href="index.php?q=e_arts">Arts</a></li>
<li class="subli"><a href="index.php?q=e_design">Design &amp; Media</a></li>
</ul></li>
    <li class="mainli"><a href="index.php?q=e_about-us">About Us</a></li>
<li class="mainli"><a
href="index.php?q=e_contacts">Contacts</a></li> <li class="mainli"><a 
href="index.php?q=e_partners">Partners</a></li> </ul> <?php }else { 
if($LANGUAGE=="Tamil"){
	echo " <style> @font-face{ font-family: tamil; src: 
url(files/ADAANA.TTF); } #content{	font-family: tamil !important; 
}</style>
$CONTENT";
}else
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

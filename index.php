<?php
// checking for non web connection ///////////////////////////////////////////////////////////////
function isMobile(){
    $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
    if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
        return true;
    } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
        return true;
    }
    return false;
}

//after checking for mob or web. Connecting to database accordingly with diff assets loaded respectively///////////////

try
{
    if((isMobile() && !isset($_GET['desktop']))||isset($_GET['mobile']))
    {
        define('MOBILE','asd');
        $PATH='admin/';
        if(isset($_GET['q']))
            require_once('assets/serve.php');
        else
        {
            $TITLE="NITTFEST '13";
            $LANGUAGE="English";
        }
        require_once("assets/mobile.php");
        die();
    }

    define('NAMESPACE111222333','##$$$$23@');
    require_once('admin/config/variables.php');
    $site=$IMAGEPATH;
    $PATH="admin/";
    require_once($PATH.'assets/mysqlconnector.php');
    $c=connectMySQL($PATH);
    if(!$c)
        throw new Exception('Database not connected.');
}
catch(Exception $e)
{
}

//changing the back ground as per day and night.////////////////////////////////////////////////////
date_default_timezone_set('Asia/Calcutta');
$ca=getdate();
$ca=$ca['hours']+0;
$backtype=($ca>18 || $ca<8)?'night':'day';

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>NITTFEST '13
    </title>
    <link href="files/style1.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body class="stretch">
    <div id="loading-container" class="stretch"><div id="loader">
        <img src="images/loading.gif" class="l-image" alt=""><br /><br />
        <span id="l-progress">Loading...</span><br />
        <span id="l-error"></span><br />
    </div></div>
<script src="files/jquery.min.js" type="text/javascript"></script>
<script src="files/assets.custom.js" type="text/javascript"></script>
<script type="text/javascript" src="files/script1.js"></script>
<div id="top-container" class="stretch">
<div id="container" class="stretch">
    <div id="container1" class="stretch containers">
        <img src="images/background-<?php echo $backtype; ?>.png" alt="" class="stretch">
        <div id="r-container">
            <a id="s-english" name="e_english" class="stone historye" href="<?php echo $site; ?>/?q=e_english"><img src="images/stone.png" alt=""><br /><span>English Lits</span><br /><img class="st-load" src="images/loading.gif" alt=""></a>
            <a id="s-hindi" name="e_hindi" class="stone historye" href="<?php echo $site; ?>/?q=e_hindi"><img src="images/stone.png" alt=""><br /><span>Hindi Lits</span><br /><img class="st-load" src="images/loading.gif" alt=""></a>
            <a id="s-tamil" name="e_tamil" class="stone historye" href="<?php echo $site; ?>/?q=e_tamil"><img src="images/stone.png" alt=""><br /><span>Tamil Lits</span><br /><img class="st-load" src="images/loading.gif" alt=""></a>
            <a id="s-arts" name="e_arts" class="stone historye" href="<?php echo $site; ?>/?q=e_arts"><img src="images/stone.png" alt=""><br /><span>Arts</span><br /><img class="st-load" src="images/loading.gif" alt=""></a>
            <a id="s-culturals" name="e_culturals" class="stone historye" href="<?php echo $site; ?>/?q=e_culturals"><img src="images/stone.png" alt=""><br /><span>Culturals</span><br /><img class="st-load" src="images/loading.gif" alt=""></a>
            <a id="s-design" name="e_design" class="stone historye" href="<?php echo $site; ?>/?q=e_design"><img src="images/stone.png" alt=""><br /><span>Design &<br />Media</span><br /><img class="st-load" src="images/loading.gif" alt=""></a>
            <a id="s-rule" name="e_rule" class="stone historye" href="<?php echo $site; ?>/?q=e_rule"><img src="images/stone.png" alt=""><br /><span>General Rules</span><br /><img class="st-load" src="images/loading.gif" alt=""></a>
            <div id="r-tablet">
                <img class="imagemain" src="images/tablet.png">
                <div id="r-content-outer" class="contentloader"><div id="r-content-inner"></div></div>
            </div>
        </div>

        <div id="n-container">
            <div id="n-tablet">
                <img class="imagemain" src="images/tablet.png">
                <div id="prelimscache">
                    <?php
                    $res=run_query("SELECT * FROM `pages` WHERE `name`='prelims' AND `parentid`='1';",$c);
                    $row=mysql_fetch_assoc($res);
                    if(!$row)	throw new Exception();
                    $cls=$row['language'];
                    $title=$row['title'];
                    $content= "<div id='content' pollingclass='event' polling=''>";
                    if(defined('MOBILE'))
                        $content.="<a class='hometop' href='./'>Home</a>";
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
                    echo $content;
                    ?>
                </div>
                <div id="n-content-outer" class="contentloader"><div id="n-content-inner">
                    </div></div>
            </div>
        </div>

        <div id="s-container">
            <div id="s-tablet">
                <img class="imagemain" src="images/tablet.png">
                <div id="s-content-outer" class="contentloader"><div id="s-content-inner">
                        <?php
                        $res=mysql_fetch_assoc(run_query("SELECT * FROM `pages` WHERE `name`='scoreboard' AND `parentid`='1';",$c));
                        echo $res['description'];
                        ?>
                    </div></div>
            </div>
        </div>
    </div><!-- end container 1 -->
    <div id="container2" class="stretch containers">
        <div class="fb-like-wrap"><div class="fb-like" data-href="https://www.facebook.com/NITTFEST" data-send="false" data-layout="button_count" data-width="80" data-show-faces="false" data-font="arial"></div></div>
        <img src="images/background-<?php echo $backtype; ?>.png" alt="" class="stretch">
        <div class="guard" id="guard-left"><img src="images/guard1.png" alt=""></div>
        <div class="guard" id="guard-right"><img src="images/guard2.png" alt=""></div>
        <div id="logo">
            <div class="nittfest"><img src="images/logo.png"></div>
            <div class="podium"><img src="images/podium.png"></div>
            <div id="torch-left"><img src="images/post2-<?php echo $backtype; ?>.png" alt=""></div>
            <div id="torch-right"><img src="images/post1-<?php echo $backtype; ?>.png" alt=""></div>
            <div id="fire-left"><img src="images/fire.gif" alt=""></div>
            <div id="fire-right"><img src="images/fire.gif" alt=""></div>
        </div>
        <?php
        //var_dump(strtotime("March 21, 2013, 05:00 pm"));
        $r=time();
        if($r<1363865400){
            $r=1363804200-$r;
            if($r<0) $d=0;
            else $d=ceil($r/86400);
            $d=$d.($d==1?" day":" days");
            echo "<div id='daysremaining'>$d to go!
</div>";
        }
        ?>
    </div><!-- end container 2 -->
    <div id="container3" class="stretch containers">
        <img src="images/background-<?php echo $backtype; ?>.png" alt="" class="stretch">
        <div id="a-container">
            <div id="a-tablet">
                <img class="imagemain" src="images/tablet.png">
                <div id="a-content-outer" class="contentloader"><div id="a-content-inner">
                        <?php
                        $res=mysql_fetch_assoc(run_query("SELECT * FROM `pages` WHERE `name`='about-us' AND `parentid`='1';",$c));
                        echo $res['description'];
                        ?>
                    </div></div>
            </div>
        </div>
        <div id="c-container">
            <div id="c-tablet">
                <img class="imagemain" src="images/tablet.png">
                <div id="c-content-outer" class="contentloader"><div id="c-content-inner">
                        <?php
                        $res=mysql_fetch_assoc(run_query("SELECT * FROM `pages` WHERE `name`='contacts' AND `parentid`='1';",$c));
                        echo $res['description'];
                        ?>
                    </div></div>
            </div>
        </div>
        <div id="p-container">
            <div id="p-tablet">
                <img class="imagemain" src="images/tablet.png">
                <div id="p-content-outer" class="contentloader"><div id="p-content-inner">
                        <?php
                        $res=mysql_fetch_assoc(run_query("SELECT * FROM `pages` WHERE `name`='partners' AND `parentid`='1';",$c));
                        echo $res['description'];
                        ?>
                    </div></div>
            </div>
        </div>
    </div><!-- end container 3 -->
</div>
<div id="logo-thumb"><a href="<?php echo $site; ?>" title="Home" class="historye"><img src="images/logo-thumb.png" alt=""></a></div>
<div id="kookoo-slider">
    <div class="pole">
        <img src="images/trunk.png" alt="">
    </div>
    <div class="length"><span class="start"></span><div class="monkey">
            <img src="images/kookoo.png" alt="">
            <div class="hover"></div>
        </div>
        <span class="end"></span></div>
</div>
<div id="footer">
    <div id="bush-back">
        <?php
        for($i=1;$i<4;++$i)
            echo "<div class='bush' id='bush-back{$i}'><img src='images/grass-{$backtype}.png' alt=''></div>";
        ?>
    </div>
    <div id="tribal">
        <div class='tribe' id='tribe1'><img src='images/tribal1.png' alt=''></div><a href='<?php echo $site; ?>/?q=rulebook' class='tribe-hover historye' id='tribe-hover1' member='1'></a><div class='tribe-name' id='tribe-name1'><img src='images/board.png' alt=''><br /><span>Rulebook</span></div>
        <div class='tribe' id='tribe2'><img src='images/tribal2.png' alt=''></div><a href='<?php echo $site; ?>/?q=e_notification' class='tribe-hover historye' id='tribe-hover2' member='2'></a><div class='tribe-name' id='tribe-name2'><img src='images/board.png' alt=''><br /><span>Updates</span></div>
        <div class='tribe' id='tribe3'><img src='images/tribal3.png' alt=''></div><a href='<?php echo $site; ?>/?q=e_scoreboard' class='tribe-hover historye' id='tribe-hover3' member='3'></a><div class='tribe-name' id='tribe-name3'><img src='images/board.png' alt=''><br /><span>Scorecard</span></div>
        <div class='tribe' id='tribe4'><img src='images/tribal4.png' alt=''></div><a href='<?php echo $site; ?>/?q=e_about-us' class='tribe-hover historye' id='tribe-hover4' member='4'></a><div class='tribe-name' id='tribe-name4'><img src='images/board.png' alt=''><br /><span>About Us</span></div>
        <div class='tribe' id='tribe5'><img src='images/tribal5.png' alt=''></div><a href='<?php echo $site; ?>/?q=e_contacts' class='tribe-hover historye' id='tribe-hover5' member='5'></a><div class='tribe-name' id='tribe-name5'><img src='images/board.png' alt=''><br /><span>Contacts</span></div>
        <div class='tribe' id='tribe6'><img src='images/tribal6.png' alt=''></div><a href='<?php echo $site; ?>/?q=e_partners' class='tribe-hover historye' id='tribe-hover6' member='6'></a><div class='tribe-name' id='tribe-name6'><img src='images/board.png' alt=''><br /><span>Partners</span></div>
    </div>
    <div id="bush-front">
        <?php
        for($i=1;$i<4;++$i)
            echo "<div class='bush' id='bush-front{$i}'><img src='images/grass-{$backtype}.png' alt=''></div>";
        ?>
    </div>
    <div id="shoe">
        <?php
        $q="SELECT `name`,`url`,`image` FROM `updates` WHERE `sponsorid`>'1' ORDER BY `rank` DESC;";
        $r=run_query($q,$c);
        $qt=mysql_fetch_assoc($r);
        if($qt){
            echo '<div id="updates"><div class="slides_container">
';
            do{
                $q=stripslashes($qt['url']);
                if($q) { $lb="<a href='$q'>"; $le="</a>";}
                else {$lb=''; $le=''; }
                $q=$qt['image'];
                if($q) $im="<img src='updates/{$q}' alt=''>";
                else $im='';
                $q=stripslashes($qt['name']);
                echo '
<div class="update">'."{$lb}{$im}{$q}{$le}</div>";
            }while($qt=mysql_fetch_assoc($r));
            echo '
</div></div>';
        }
        $q="SELECT `name`,`url`,`image` FROM `sponsors` WHERE `sponsorid`>'1' ORDER BY `rank` DESC;";
        $r=run_query($q,$c);
        $qt=mysql_fetch_assoc($r);
        if($qt){
            echo '<div id="sponsors"><div class="slides_container">
';
            do{
                $q=stripslashes($qt['url']);
                if($q) { $lb="<a href='$q' target='_blank'>"; $le="</a>";}
                else {$lb=''; $le=''; }
                $q=$qt['image'];
                if($q) $im="";
                else $im='';
                $q=stripslashes($qt['name']);
                echo "
<div class='sponsor' title='{$q}'>"."{$lb}<img src='sponsors/{$qt['image']}' alt=''>{$le}</div>";
            }while($qt=mysql_fetch_assoc($r));
            echo '
</div></div>';
        }
        ?>
        <div id="links-container">
            <a href="https://www.facebook.com/NITTFEST" target="_blank" title="Facebook"><img src="images/icon-fb.png" alt=""></a>
            <a href="http://www.youtube.com/NITTFESTOfficial" target="_blank" title="YouTube"><img src="images/icon-yt.png" alt=""></a>
            <a href="http://en.wikipedia.org/wiki/Nittfest" target="_blank" title="Wikipedia"><img src="images/icon-wiki.png" alt=""></a>
        </div>
        <!--
        <div id="timekeeper">
        <table border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><embed src="http://www.worldtimeserver.com/clocks/wtsclock001.swf?color=CC6600&wtsid=IN" width="70" height="70" wmode="transparent" type="application/x-shockwave-flash" /></td></tr><tr><td align="center"></td></tr></table>
        </div>
        -->
    </div>
</div>
</div>
<div id="fb-root"></div>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-38882508-1']);
    _gaq.push(['_setDomainName', 'nittfest.in']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
</html>

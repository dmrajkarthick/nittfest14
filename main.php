<?php

define('NAMESPACE111222333','##$$$$23@');
require_once __DIR__.'/admin/config/variables.php';

$PATH = __DIR__."/admin/";
require_once $PATH.'assets/mysqlconnector.php';
$ctype = '';
$p = 1;
if(isset($_GET['ctype'])) {
    $ctype=$_GET['ctype']; 
}

if(isset($_GET['p']) && is_numeric($_GET['p'])) {
    $p=$_GET['p'];
}

$PAGE_POSITION = array(
    0 => array(1=>1),
    1 => array(1=>1),
    2 => array(1=>1),
    3 => array(1=>1),
    4 => array(1=>1),
    5 => array(1=>1),
    6 => array(1=>1),
);
$res = $c['db']->query("SELECT parentid, count(parentid) FROM pages WHERE type = '' GROUP BY parentid");
if($res) {
    $PAGE_POSITION = $res->fetchAll();
}

?>
<!doctype html>
<html>
<head>
    <link href="./files/style.css?4" rel="stylesheet" type="text/css">
    <link href="./files/jquery.mCustomScrollbar.css?4" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- scripts show be at last -->
    <script type="text/javascript" src="./files/jquery.js"></script>
    <script type="text/javascript" src="./files/jquery.loader.js"></script>
    <script type="text/javascript" src="./files/turn.js"></script>
    <script type="text/javascript" src="./files/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="./files/jquery.slides.min.js"></script>
    <script type="text/javascript" src="./files/jquery.rotate.min.js"></script>
    <script type="text/javascript" src="./script.js?q"></script>
    <script type="text/javascript" src="./files/script.js"></script>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>Loading</title>
</head>
<body class="stretch">
    <div id="loading-container" class="stretch">
        <div id="loading">
            <span id="loading-progress"></span>
        </div>
    </div>
    <div id="dragonfire">
        <img src="images/fire1.gif"/>
    </div>
    <img src="images/final1.png" alt="" id="background" class="stretch"/>
    <img src="images/mountain.png" alt="" id="mountain" class="stretch"/>
<div id="top-container" class="stretch">
    <img src="images/dragon.png" alt="" id="dragon" class=""/>
    <div id="maindiv" data-open="">
        <div id="rulebook" class="showdiv">
            <ul class="bookmark">
            <?php
                $sum = 3;
                for($i=1;$i<8;$i++) {
                    $sum += $PAGE_POSITION[$i-1][1];
                    echo "<li id=\"b$i\" data-page=\"$sum\"></li>";
                }
            ?>
            </ul>
            <div id="book">
                <div class="cover hard">
                    <img src="images/rulebook.jpg">
                </div>
            </div>
        </div>
        <div id="aboutus" class="showdiv">
            <div class="innerdiv">
                <?php 
                    $stmt=$c['db']->query_simple("SELECT * FROM pages where name='about-us' and parentid=1");
                    $res=$stmt->fetch(PDO::FETCH_ASSOC);
                    echo $res['description'];
                ?>
            </div>
        </div>
        <div id="updates" class="showdiv">
            <div class="innerdiv">
                <?php
                    $stmt=$c['db']->query("SELECT title, pageid,description from pages where name='prelims' and parentid=1");
                    $res=$stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<div class=\"page-header\">",$res['title'],"</div><br/>";
                    echo $res['description'] . "<br/>";
                    $parentid=$res['pageid'];
                    $stmt=$c['db']->query("SELECT title, name, type from pages where parentid='{$parentid}' order by type");
                    $content="";
                    while($value = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $content .= '<a href="#" class="prelim-link" data-name="' . $value['name'] . '">' . $value['title'] . '</a><br/><div class="prelim-content" id="' . $value['name'] . '-content"></div>';
                    }
                    echo $content;
                ?>
            </div>
        </div>
        <div id="scorecard" class="showdiv">
            <div class="innerdiv">
                Coming soon!!
            </div>
        </div>
        <div id="contacts" class="showdiv">
            <div class="innerdiv">
            <?php
                $stmt=$c['db']->query_simple("select * from pages where name='contacts' and parentid=1");
                $res=$stmt->fetch(PDO::FETCH_ASSOC);
                echo $res['description'];
            ?>
            </div>
        </div>
        <div id="partners" class="showdiv">
            <div class="innerdiv">
                Coming Soon!!
            </div>
        </div>
        <button id="hide" class="button"></button><br />
    </div>
    <div id="link-bar" class="stretch">
        <div id="rulebook_button" class="links grow" data-target="rulebook" data-weapon="hammer"><img src="./images/warrior1.png" /></div>
        <div id="updates_button" class="links grow" data-target="updates" data-weapon="mace"><img src="./images/warrior2.png" /></div>
        <div id="scorecard_button" class="links grow" data-target="scorecard" data-weapon="spear"><img src="./images/warrior3.png" /></div>
        <div id="aboutus_button" class="links grow" data-target="aboutus" data-weapon="hammer"><img src="./images/warrior4.png" /></div>
        <div id="contacts_button" class="links grow"  data-target="contacts" data-weapon="mace"><img src="./images/warrior5.png" /></div>
        <div id="partners_button" class="links grow"  data-target="partners" data-weapon="spear"><img src="./images/warrior6.png" /></div>
    </div>
    <div id="rulebook_text" class="text">Rulebook</div>
    <div id="updates_text" class="text">Updates</div>
    <div id="scorecard_text" class="text">Scorecard</div>
    <div id="aboutus_text" class="text">About Us</div>
    <div id="contacts_text" class="text">Contacts</div>
    <div id="partners_text" class="text">Partners</div>

    <div id="hammer" class="weapon">
        <img src="./images/hammer.png">
    </div>
    <div id="spear" class="weapon">
        <img src="./images/spear.png">
    </div>
    <div id="mace" class="weapon">
        <img src="./images/mace.png">
    </div>

    <div class="container partners">
        <div id="slides">
        <!-- dynamic -->
            <img src="images/spear.png">
            <img src="images/hammer.png">
            <img src="images/mace.png">
            <img src="images/spear.png">
        </div>
    </div>
    <script type="text/javascript">
        var pn;
        if(!pn){
            pn = "<?php echo $p; ?>";
            var q = "<?php echo $ctype; ?>";
            pn=parseInt(pn);
            if(q != "") {
                if(q != "rulebook") {
                    window.history.pushState("test", "Title", "?ctype="+q);
                }else{
                    window.history.pushState("test", "Title", "?ctype="+q+"&p="+pn);
                }
            }
        }
        function p(o){
            $("#book").turn("page", o);
        }
        var numberOfPages = 200; 
        function addPage(page, book) {
            var con;
            if (!book.turn("hasPage", page)) {
                var element = $("<div />",
                    {
                        "class": "page "+((page%2==0) ? 'odd' : 'even'),
                        "id": "page-"+page
                    }).html('Loading ...');
                book.turn('addPage', element, page);
                setTimeout(function(){
                        $.ajax({
                            url: "a2.php?q="+page,
                            async: false,
                            success: function (data) {
                                con=JSON.parse(data);
                            },
                            failure:function(data){
                                con = {
                                    'title': 'Error',
                                    'description': '',
                                    'language': 'English'
                                };
                            }
                        });   

                        element.html('<div class="data ' + con.language.toLowerCase() + '"><div class="page-header">' + con.title + '</div><div class="page-content">' + con.description + '</div><div class="page-footer">'+page+'</div></div>');
                }, 1000);
            }
        }

        $(window).ready(function(){
            var proper=0, broken=0;
            var load=$('#top-container').imagesLoaded();
            load.always( function(){
                $("#loading-container").fadeOut("fast");
                document.title="NITTFEST '14 - Dominate or Submit";
            });
            load.progress(function(instance, image){
                if(!image.isLoaded) {
                    console.log(instance, image);
                    broken++;
                } else {
                    proper++;
                }
                
                var p=(proper + broken)/instance.images.length;
                $("#loading-progress").html(Math.floor(p*100)+"% Complete");
            });
            $('#book').turn({
                acceleration: true,
                pages: numberOfPages,
                elevation: 50,
                gradients: !$.isTouch,
                when: {
                    turning: function(e, page, view) {
                        if(view[1] == 1 || view[1] == 3) {
                            $('.bookmark').css('display','none');
                        }
                        // Gets the range of pages that the book needs right now
                        var range = $(this).turn('range', page);
                        if(view[1] != 1 && view[0] != 2) {
                            $('.bookmark').css('display','block');
                        }
                        // Check if each page is within the book
                        for (page = range[0]; page<=range[1]; page++) {
                            addPage(page, $(this));
                        }
                    },
                    turned: function(e, page, view) {
                        if($('#maindiv').data('open') != 'rulebook') {
                            return;
                        }
                        pn = page;
                        window.history.pushState("test", "Title", "?ctype=rulebook&p="+pn);
                        setTimeout(
                            function() {
                                if(!$('#page-'+view[0]).find('.page-content').hasClass('mCustomScrollbar')) {
                                    $('#page-'+view[0]).find('.page-content').mCustomScrollbar({
                                        theme:'dark-thick',
                                        advanced:{
                                            updateOnContentResize: true
                                        }
                                    });
                                }
                                if(!$('#page-'+view[1]).find('.page-content').hasClass('mCustomScrollbar')) {
                                    $('#page-'+view[1]).find('.page-content').mCustomScrollbar({
                                        theme:'dark-thick',
                                        advanced:{
                                            updateOnContentResize: true
                                        }
                                    });
                                }
                            },
                            700
                        );
                    }
                }
            });
        });

        $(window).bind('keydown', function(e) {
            var div_name='rulebook';
            if (e.target && e.target.tagName.toLowerCase()!='input')
                if (e.keyCode==37){
                    $('#book').turn('previous');
                }
                else if (e.keyCode==39){
                    $('#book').turn('next');
                }
        });
    </script>
    <script>
        $(document).ready(function() {
            if(q != '') {
                nittfest.showDiv(q);
            }
            if(p != 0) {
                p(pn);
            }
        });
    </script>
</div>
</body>
</html>
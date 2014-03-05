<?php

define('NAMESPACE111222333','##$$$$23@');
require_once __DIR__.'/admin/config/variables.php';

$PATH = __DIR__."/admin/";
require_once $PATH.'assets/mysqlconnector.php';
$ctype = '';
$p = 0;
if(isset($_GET['ctype'])) {
    $ctype=$_GET['ctype']; 
}

if(isset($_GET['p']) && is_numeric($_GET['p'])) {
    $p=$_GET['p'];
}
?>
<!doctype html>
<html>
<head>
     <link href="./files/style.css?1" rel="stylesheet" type="text/css">
     <!-- use only certain classes -->
    <link href="./files/hover.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- scripts show be at last -->
    <script src="./files/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="./script.js"></script>
    <script type="text/javascript" src="./files/fullbg.js"></script>
    <script type="text/javascript" src="./files/turn.js"></script>
    <script type="text/javascript" src="./files/jqueryRotate.js"></script>
    <script type="text/javascript" src="./files/script.js"></script>
    <script type="text/javascript" src="./files/jquery.slides.min.js"></script>    
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>NITTFEST '14</title>
</head>
<body>
<div id='dragonfire' >
    <img src=''/>
</div>
<img src="images/back.jpg" alt="" id="background" />

<div id="maindiv" data-open="">
    <div id="rulebook" class="showdiv">
        <div id='book'>
            <div class="cover">
                <img src="images/rulebook.jpg">
            </div>
        </div>
    </div>
    <div id='aboutus' class='showdiv'>
        <div class='innerdiv'>
            <?php 
                $stmt=$c['db']->query_simple("SELECT * FROM pages where name='about-us' and parentid=1");
                $res=$stmt->fetch(PDO::FETCH_ASSOC);
                echo $res['description'];
            ?>
        </div>
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
    <button id='hide' class='button'></button><br />
</div>

<div id='rulebook_button' class='links grow' data-target="rulebook" data-weapon="hammer"><img src='./images/warrior1.png' /></div>
<div id='updates_button' class='links grow' data-target="updates" data-weapon="mace"><img src='./images/warrior2.png' /></div>
<div id='scorecard_button' class='links grow' data-target="scorecard" data-weapon="spear"><img src='./images/warrior3.png' /></div>
<div id='aboutus_button' class='links grow' data-target="aboutus" data-weapon="hammer"><img src='./images/warrior4.png' /></div>
<div id='contacts_button' class='links grow'  data-target="contacts" data-weapon="mace"><img src='./images/warrior5.png' /></div>
<div id='partners_button' class='links grow'  data-target="partners" data-weapon="spear"><img src='./images/warrior6.png' /></div>

<div id='rulebook_text' class="text" >Rulebook</div>
<div id='updates_text' class="text" >Updates</div>
<div id='scorecard_text' class="text" >Scorecard</div>
<div id='aboutus_text' class="text" >About Us</div>
<div id='contacts_text' class="text" >Contacts</div>
<div id='partners_text' class="text" >Partners</div>

<div id="hammer" class="weapon">
    <img src="./images/hammer.png" />
</div>
<div id="spear" class="weapon">
    <img src="./images/spear.png" />
</div>
<div id="mace" class="weapon">
    <img src="./images/mace.png" />
</div>

<div class="container">
    <div id="slides">
    <!-- dynamic -->
        <img src="images/spear.png" >
        <img src="images/hammer.png" >
        <img src="images/mace.png" >
        <img src="images/spear.png"     >
    </div>
</div>
<script type="text/javascript">
    // Sample using dynamic pages with turn.js
    var pn;
    if(!pn){
        var pn = "<?php echo $p; ?>";
        var q = "<?php echo $ctype ?>";
        pn=parseInt(pn);
        if(q != 'rulebook'){
            window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+q);
        }else{
            window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+q+"&p="+pn);
        }
    }
    function p(o){
        $('#book').turn('page', o);
    }
    var numberOfPages = 1000; 
    // Adds the pages that the book will need
    function addPage(page, book) {
        var con;
        //  First check if the page is already in the book
        if (!book.turn('hasPage', page)) {
            // Create an element for this page
            var element = $('<div />', {'class': 'page '+((page%2==0) ? 'odd' : 'even'), 'id': 'page-'+page}).html('<i class="loader"></i>');
            // If not then add the page
            book.turn('addPage', element, page);
            // Let's assum that the data is comming from the server and the request takes 1s.
            setTimeout(function(){
                        $.ajax({
                                                url: "a1.php?q="+page,
                                                async: false,
                                                success: function (data2) {
                                                  con=data2;
                                                
                                                },
                                                failure:function(data){
                                                    alert('Failure');
                                                }
                                              });   
                    element.html('<div class="data">'+con+page+'</div>');
            }, 1000);
        }
    }
    $(window).load(function() {
            $("#background").fullBg();
    });
    $(window).ready(function(){
        $('#book').turn({acceleration: true,
                            pages: numberOfPages,
                            elevation: 50,
                            gradients: !$.isTouch,
                            when: {
                                turning: function(e, page, view) {

                                    // Gets the range of pages that the book needs right now
                                    var range = $(this).turn('range', page);

                                    // Check if each page is within the book
                                    for (page = range[0]; page<=range[1]; page++) 
                                        addPage(page, $(this));

                                },

                                turned: function(e, page) {
                                    $('#page-number').val(page);
                                }
                            }
                        });

        $('#number-pages').html(numberOfPages);
        $('#page-number').keydown(function(e){
            if (e.keyCode==13)
                $('#book').turn('page', $('#page-number').val());               
        });
    });

    $(window).bind('keydown', function(e){
        var div_name='rulebook';
        if (e.target && e.target.tagName.toLowerCase()!='input')
            if (e.keyCode==37){
                $('#book').turn('previous');
                pn-=2;
                window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+div_name+'&p='+pn);
            }
            else if (e.keyCode==39){
                $('#book').turn('next');
                pn+=2;
                window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+div_name+'&p='+pn);
            }

    });
</script>


</body>

<?php
        

        if($ctype){
         echo '<script>$(document).ready(function(){
                  divArrive("'.$ctype.'");';
        if($p){
            echo 'p('.$p.');';
        }
        echo '});';
        
        echo '</script>';
        }

?>

</html>
<?php

define('NAMESPACE111222333','##$$$$23@');
require_once('admin/config/variables.php');
$site=$IMAGEPATH;
$PATH="admin/";
require_once($PATH.'assets/mysqlconnector.php');
$ctype=$_GET['ctype']; 
$p=$_GET['p'];
if(!$p) $p=0;

?>


<html>
<head>
     <link href="./files/style.css" rel="stylesheet" type="text/css">
    <link href="./files/hover.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <script src="./files/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="./files/turn.js"></script>
    <script type="text/javascript" src="./files/jqueryRotate.js"></script>
    <script type="text/javascript" src="./files/script.js"></script>
    <script type="text/javascript" src="./files/jquery.slides.min.js"></script>    
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <title>NITTFEST '14
    </title>
   

</head>
<body id='body'>


<!-- <div id='background' ><img src='./images/back.jpg' e='aboutus'/></div> -->
<!--<div id="score"><img src="./img/scorecard.png" /></div>-->
<div id='dragonfire' >
    <img src='' />
</div>
<div id='maindiv' >

    <div id="flipbook" class='showdiv'>
     <!--   <img id='arrow' src='./images/arrow.png' /> -->
        <div id='book'>
            <div class="cover">
                <img src="images/rulebook.jpg">
            </div>
        </div>
         <div id="controls">
    <label for="page-number">Page:</label> <input type="text" size="3" id="page-number"> of <span id="number-pages"></span>
    </div>

    </div>
   
        
    
    <div id='aboutus' class='showdiv' >
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






<div id='rulebook_button' class='links grow' name='flipbook'><img src='./images/warrior1.png' /></div>
<div id='updates_button' class='links grow' name='updates'><img src='./images/warrior2.png' /></div>
<div id='scorecard_button' class='links grow' name='scorecard'><img src='./images/warrior3.png' /></div>
<div id='aboutus_button' class='links grow' name='aboutus'><img src='./images/warrior4.png' /></div>
<div id='contacts_button' class='links grow' name='contacts'><img src='./images/warrior5.png' /></div>
<div id='partners_button' class='links grow' name='partners'><img src='./images/warrior6.png' /></div>

<div id='flipbook_text' class="text" >Rulebook</div>
<div id='updates_text' class="text" >Updates</div>
<div id='scorecard_text' class="text" >Scorecard</div>
<div id='aboutus_text' class="text" >About Us</div>
<div id='contacts_text' class="text" >Contacts</div>
<div id='partners_text' class="text" >Partners</div>

<div id="hammer" class='weapon'>
    <img src="./images/hammer.png" />
</div>
<div id='spear' class='weapon'>
    <img src='./images/spear.png' />
</div>
<div id='mace' class='weapon'>
    <img src="./images/mace.png" />
</div>
<div class="container">
    <div id="slides">
        <img src="images/spear.png" >
        <img src="images/hammer.png" >
        <img src="images/mace.png" >
        <img src="images/spear.png"     >
    </div>
</div>
<div id='arrows' >
    <img src='./images/arrow.png' />
</div>
<script type="text/javascript">
    // Sample using dynamic pages with turn.js
    var pn;
    if(!pn){
        var pn = "<?php echo $p; ?>";
        var q = "<?php echo $ctype ?>";
        pn=parseInt(pn);
        if(q != 'flipbook'){
            window.history.pushState("test", "Title", "/nittfest14/main.php?ctype="+q);
        }else{
            window.history.pushState("test", "Title", "/nittfest14/main.php?ctype="+q+"&p="+pn);
        }
    }
    function p(o){
        $('#page-number').val(o);
        $('#book').turn('page', $('#page-number').val());
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
        var div_name='flipbook';
        if (e.target && e.target.tagName.toLowerCase()!='input')
            if (e.keyCode==37){
                $('#book').turn('previous');
                
                pn-=2;
                window.history.pushState("test", "Title", "/nittfest14/main.php?ctype="+div_name+'&p='+pn);
            }
            else if (e.keyCode==39){
                $('#book').turn('next');
                

                pn+=2;


                window.history.pushState("test", "Title", "/nittfest14/main.php?ctype="+div_name+'&p='+pn);

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


var destroy,running=0;

var rotation = function (){
    $("#hammer").rotate({
        angle:0,
        animateTo:-720,
        callback: rotation,
        easing: function (x,t,b,c,d){        // t: current time, b: begInnIng value, c: change In value, d: duration
            return c*(t/d)+b;
        }

    });
}
var windowWidth=$(window).width();


var windowHeight=window.innerHeight;
//var windowWidth=window.innerHeight;

//alert(windowWidth+','+windowHeight);
var w=windowWidth*0.55,h=windowHeight*0.9,t=windowHeight*0.05,l=windowWidth*0.20;

function reinit(){
    windowWidth=$(window).width();


    windowHeight=window.innerHeight;
    //var windowWidth=window.innerHeight;

    //alert(windowWidth+','+windowHeight);
    w=windowWidth*0.55,h=windowHeight*0.9,t=windowHeight*0.05,l=windowWidth*0.20;
    $("#flipbook").height(h);
    $("#maindiv").css('height',windowHeight);
    $("#maindiv").css('width',windowWidth);
    $(".showdiv").css('width',0);
    $(".showdiv").css('height',0);
    $(".showdiv").css("position","absolute");
    $(".showdiv").css('left',w/2+l);
    $(".showdiv").css('top',h/2+t);
    $(".innerdiv").css('width',0.8*w);
    $(".innerdiv").css('height',0.8*h);
    $(".innerdiv").css('top',0.1*h);
    $(".innerdiv").css('left',0.1*w);
    $('#maindiv').css('top',"0px");
    $('#maindiv').css('left',"0px");
    $('#hide').css('left',l+w);
    $('#hide').css('top',t);
    $('#dragonfire').css('top',t+30);
    $('#dragonfire').css('left',l-80);

}
function divArrive(div_name){

    $('#maindiv').css("visibility",'visible');
    $('#maindiv').css('z-index','10');
    $(".showdiv").css("top",h/2+t);
    $(".showdiv").css("left",w/2+l);
    $(".showdiv").css("width","0");
    $(".showdiv").css("height","0");

    if(div_name=='flipbook') $(".showdiv").css('background','url("../images/scroll.png")');
    else $(".showdiv").css('background','');

    $("#"+div_name).fadeIn(0);
    $( "#"+div_name ).animate({
        width: "+="+w,
        left: "-="+w/2,
        height: "+="+h,
        top: "-="+h/2
    }, 300, function() {
        $(".showdiv").css("top",t);
        $(".showdiv").css("left",l);
        $(".showdiv").css("width",w);
        $(".showdiv").css("height",h);
    });


}
function Hammeranim(th,div_name){

    var targetx=0.1*windowWidth,targety=0.1*windowHeight;
    var tp=parseInt(th.css("top"));
    var lf=parseInt(th.css("left"));
    var hh=50;
    var hw=30;
    var xdec=0.1;

    $("#hammer").css("top",tp-20);
    $("#hammer").css("left",lf-10);
    $("#hammer").css("visibility","visible");
    var x=lf-10,y=tp-20;
    var ydiff=targety-tp+20;
    if(running){
        running=0;
        clearInterval(destroy);
        $("#hammer").css("visibility","hidden");
        $("#hammer img").css('height',50);
        $("#hammer img").css('width',30);

        return;
    }
    running=1;
    destroy=setInterval(function(){

        if(x<targetx && y<targety){
            clearInterval(destroy);
            $("#hammer").css("visibility","hidden");
            $("#hammer img").css('height',50);
            $("#hammer img").css('width',30);
            running=0;
            $('#dragonfire').show();
            $('#dragonfire img').attr('src','./images/fire1.gif');
            setTimeout(function(){
                $('#dragonfire').hide();
                $('#dragonfire img').attr('src','');

            },450);

            setTimeout(function(){
                divArrive(div_name);
            },700);
        }
        x-=xdec;
        xdec+=0.07;
        y=y-(ydiff*0.01);
        ydiff=y-10;
        $('#hammer').css('top',y);
        $('#hammer').css('left',x);
        hh+=0.5;
        hw+=0.5;

        $("#hammer img").css('height',hh);
        $("#hammer img").css('width',hw);
    },8);




}

function pageturn(){


    /* $('#book').turn({acceleration: true,
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
     });*/
}

//var windowHeight=652;//$(window).height();






//fireContext.fillStyle="rgba(255,255,255,0.01)";
$(document).ready( function(){


    reinit();
    pageturn();

    $(".showdiv").hide();
    $(".text").hide();




    //$('#rulebook_button').css('left',l+w+10+'px');

    $('#hide').click(function(){


        $( ".showdiv" ).animate({
            width: "-="+w,
            left: "+="+w/2,
            height: "-="+h,
            top: "+="+h/2
        }, 300, function() {
            $(".showdiv").css("top",h/2+t);
            $(".showdiv").css("left",w/2+l);
            $(".showdiv").css("width","0");
            $(".showdiv").css("height","0");
            $('.showdiv').fadeOut(0);
            $('#maindiv').css('z-index','0');
            $('#maindiv').css('visibility','hidden');
            $("#hammer").css("visibility","hidden");
        });

        //$("#maindiv").fadeOut(300);
        //$("#flipbook").fadeOut(300);/*( "blind",
        //       {direction: "horizontal"}, 1000 );*/



    });

    $("#maindiv").mousedown(function(e){
        var mx=e.clientX;
        var my=e.clientY;

        if((mx<l) || (mx>l+w) || (my>t+h) || (my<t)){

            {

                $( ".showdiv" ).animate({
                    width: "-="+w,
                    left: "+="+w/2,
                    height: "-="+h,
                    top: "+="+h/2
                }, 300, function() {
                    $(".showdiv").css("top",h/2+t);
                    $(".showdiv").css("left",w/2+l);
                    $(".showdiv").css("width","0");
                    $(".showdiv").css("height","0");
                    $('.showdiv').fadeOut(0);

                    $('#maindiv').css('visibility','hidden');
                    $('#maindiv').css('z-index','0');
                    $("#hammer").css("visibility","hidden");

                });


            }
        }

    });

    $(window).keydown(function(e){


        if(e.keyCode==27){

            {

                $( ".showdiv" ).animate({
                    width: "-="+w,
                    left: "+="+w/2,
                    height: "-="+h,
                    top: "+="+h/2
                }, 300, function() {
                    $(".showdiv").css("top",h/2+t);
                    $(".showdiv").css("left",w/2+l);
                    $(".showdiv").css("width","0");
                    $(".showdiv").css("height","0");
                    $('.showdiv').fadeOut(0);

                    $('#maindiv').css('visibility','hidden');
                    $('#maindiv').css('z-index','0');
                    $("#hammer").css("visibility","hidden");

                });


            }
        }

    });


    $('.links').click(function(){
        var div_name=$(this).attr("name")

        //alert(div_name);

        $( ".showdiv" ).animate({
            width: "-="+w,
            left: "+="+w/2,
            height: "-="+h,
            top: "+="+h/2
        }, 300, function() {
            $(".showdiv").css("top",h/2+t);
            $(".showdiv").css("left",w/2+l);
            $(".showdiv").css("width","0");
            $(".showdiv").css("height","0");
            $('.showdiv').fadeOut(0);

        });

        rotation();

        var delay=1000;

        Hammeranim($(this),div_name);


        //divArrive(div_name);






    });
    $("#b").hide();
    $("hide").hide();
    $("#flipbook").turn({
        width: w,
        height: h,
        autoCenter: true
    });

    $("#flipbook img").css("height",h);
    $("#flipbook img").css("width",w/2);


    // Hover animations for values

    $(".links").mouseover(function(e){

        //rotation();
        var hovertext=$(this).attr("name");
        if(hovertext=="flipbook") hovertext="rulebook";
        var tp=parseInt($(this).css("top"));
        var lf=parseInt($(this).css("left"));
        var d_name='#'+hovertext+"_text";
        $(d_name).css("top",tp-25+'px');
        $(d_name).css("left",lf+10+'px');
        //alert(tp);
        $(d_name).show();

    });


    $(".links").mouseleave(function(){
        $(".text").hide();

    });

});
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
                url: "./a1.php?q="+page,
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


$(window).bind('keydown', function(e){

    if (e.target && e.target.tagName.toLowerCase()!='input')
        if (e.keyCode==37)
            $('#book').turn('previous');
        else if (e.keyCode==39)
            $('#book').turn('next');

});


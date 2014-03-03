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
var rotatemace = function (){
    $("#mace").rotate({
        angle:0,
        animateTo:-720,
        callback: rotation,
        easing: function (x,t,b,c,d){        // t: current time, b: begInnIng value, c: change In value, d: duration
            return c*(t/d)+b;
        }

    });
}
var rotatespear = function(){
     $("#spear").rotate({
        angle:50,
        animateTo:-40   ,
        

    });
}
var windowWidth;


var windowHeight;
//var windowWidth=window.innerHeight;

//alert(windowWidth+','+windowHeight);
var w,h,t,l;
function reinit(){
    windowWidth=$(window).width();


    windowHeight=window.innerHeight;
    
    if(windowHeight<667) windowHeight=667;
    if(windowWidth<1366) windowWidth=1366;
    //var windowWidth=window.innerHeight;
    $('#body').css('background-size',windowWidth+'px '+windowHeight+'px');
    //alert(windowWidth+','+windowHeight);

    // Div dimensions    00000000000000000000000000000000000000000000000000000000000000000000000000

    w=windowWidth*0.60,h=windowHeight*0.9,t=windowHeight*0.05,l=windowWidth*0.20;
    $("#book").height(h);
    $("#maindiv").css('height',windowHeight);
    $("#maindiv").css('width',windowWidth);
    $(".showdiv").css('width',0);
    $(".showdiv").css('height',0);
    $(".showdiv").css("position","absolute");
    $(".showdiv").css('left',l);
    $(".showdiv").css('top',t);
    $(".innerdiv").css('width',0.76*w);
    $(".innerdiv").css('height',0.77*h);
    $(".innerdiv").css('top',0.1*h+20);
    $(".innerdiv").css('left',0.1*w+20);
    $('#maindiv').css('top',"0px");
    $('#maindiv').css('left',"0px");
    $('#hide').css('left',l+w+50);
    $('#hide').css('top',t);
    $('#dragonfire').hide();

    // oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo00

}
function divArrive(div_name){
    
        $('#maindiv').css("visibility",'visible');
        $('#maindiv').css('z-index','10');
        $(".showdiv").css("top",h/2+t);
        $(".showdiv").css("left",w/2+l);
        $(".showdiv").css("width","0");
        $(".showdiv").css("height","0");

        

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

    var targetx=0.2*windowWidth,targety=0.1*windowHeight;
    var tp=parseInt(th.css("top"));
    var lf=parseInt(th.css("left"));
    var hh=15;
    var hw=15;
    var xdec=0.1;
    var weapon;
    if(div_name=='contacts') weapon='spear';
    else if(div_name=='scorecard') {
        weapon='mace';
        hh=25;
        hw=25;
    }
    else weapon='hammer';
    $("#"+weapon).css("top",tp-20);
    $("#"+weapon).css("left",lf-10);
    $("#"+weapon).css("visibility","visible");
    var x=lf-10,y=tp-20;
    var ydiff=targety-tp+20;
    if(running){
        running=0;
        clearInterval(destroy);
        $("#"+weapon).css("visibility","hidden");
        $("#"+weapon+" img").css('height',50);
        $("#"+weapon+" img").css('width',30);

        return;
    }
    running=1;
    destroy=setInterval(function(){

        if(x<targetx || y<targety){
            clearInterval(destroy);
            $("#"+weapon).css("visibility","hidden");
            $("#"+weapon+" img").css('height',50);
            $("#"+weapon+" img").css('width',30);
            running=0;
            $('#dragonfire').show();
            $('#dragonfire img').attr('src','./images/fire1.gif');
            setTimeout(function(){
                $('#dragonfire').hide();
                $('#dragonfire img').attr('src','');

            },450);

            setTimeout(function(){
                divArrive(div_name);
                if(div_name=='flipbook'){
                setTimeout(function(){
                    $('#arrows').fadeIn(500);
                },200);
            }
            setTimeout(function(){
                $('#arrows').fadeOut(300);
            },1000);
            },700);

        }
        x-=xdec;
        xdec+=0.07;    
        y=y-(ydiff*0.01);
        ydiff=y-10;
        $('#'+weapon).css('top',y);
        $('#'+weapon).css('left',x);
        hh+=0.5;
        hw+=0.5;

        $("#"+weapon+" img").css('height',hh);
        $("#"+weapon+" img").css('width',hw);
    },8);




}


//var windowHeight=652;//$(window).height();
$(function() {
      $('#slides').slidesjs({
        width: 30,
        height: 50,
        play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
    });
});


//fireContext.fillStyle="rgba(255,255,255,0.01)";
$(document).ready( function(){

    $('a').hide();
    $('ul').hide();
    $('#arrows').hide();
    reinit();

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
            $(".weapon").css("visibility","hidden");
        });

        //$("#maindiv").fadeOut(300);
        //$("#book").fadeOut(300);/*( "blind",
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
                    $(".weapon").css("visibility","hidden");
                    window.history.pushState("test", "Title", "/git/nittfest14/main.php");

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
                    $(".weapon").css("visibility","hidden");

                });
                 window.history.pushState("test", "Title", "/git/nittfest14/main.php");
            }
        }
    });


    $('.links').click(function(){
        var div_name=$(this).attr("name")
        if(div_name!='flipbook'){
            window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+div_name);
        }else{
             window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+div_name+"&p="+pn);
        }
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
        rotatespear();
        rotation();
        rotatemace();

        
       //    $('#itype').attr('value',div_name);
        Hammeranim($(this),div_name);
       // f.submit();
        //divArrive(div_name);
    });


    // Hover animations for values

    $(".links").mouseover(function(e){

        //rotation();
        var hovertext=$(this).attr("name");
        if(hovertext=="book") hovertext="rulebook";
        var tp=parseInt($(this).css("top"));
        var lf=parseInt($(this).css("left"));
        var d_name='#'+hovertext+"_text";
        $(d_name).css("top",tp-30+'px');
        $(d_name).css("left",lf-30+'px');

        //alert(tp);
        $(d_name).show();

    });


    $(".links").mouseleave(function(){
        $(".text").hide();

    });

});

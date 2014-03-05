var destroy,running=0;

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
    $(".showdiv").css('left',w/2+l);
    $(".showdiv").css('top',h/2+t);
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
function divArrive(div_name) {
        $('#maindiv').css("display",'block');
        $('#maindiv').css('z-index','10');

        $('#maindiv').data('open',div_name);

        $("#"+div_name).fadeIn(0);
        $("#"+div_name).animate({
            width: "+="+w,
            left: "-="+w/2,
            height: "+="+h,
            top: "-="+h/2
        }, 300, function() {
            $("#"+div_name).css("top",t);
            $("#"+div_name).css("left",l);
            $("#"+div_name).css("width",w);
            $("#"+div_name).css("height",h);
        });
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
    reinit();

    $(".showdiv").hide();
    $(".text").hide();

    //$('#rulebook_button').css('left',l+w+10+'px');
    $('#hide').click(function() {

        if($('#maindiv').data('open') == '') {
            return;
        }

        var div_name = $('#maindiv').data('open');
        $("#"+div_name).animate({
            width: "-="+w,
            left: "+="+w/2,
            height: "-="+h,
            top: "+="+h/2
        }, 300, function() {
            $("#"+div_name).css("top",h/2+t);
            $("#"+div_name).css("left",w/2+l);
            $("#"+div_name).css("width","0");
            $("#"+div_name).css("height","0");
            $("#"+div_name).fadeOut(0);
            $('#maindiv').css('z-index','0');
            $('#maindiv').css('display','none');
            $(".weapon").css("display","none");
        });

        $('#maindiv').data('open', '');
        //$("#maindiv").fadeOut(300);
        //$("#book").fadeOut(300);/*( "blind",
        //       {direction: "horizontal"}, 1000 );*/
    });

    $("#maindiv").mousedown(function(e){
        var mx=e.clientX;
        var my=e.clientY;

        if($('#maindiv').data('open') == '') {
            return;
        }

        var div_name = $('#maindiv').data('open');

        if((mx<l) || (mx>l+w) || (my>t+h) || (my<t)){
            $("#"+div_name).animate({
                width: "-="+w,
                left: "+="+w/2,
                height: "-="+h,
                top: "+="+h/2
            }, 300, function() {
                $("#"+div_name).css("top",h/2+t);
                $("#"+div_name).css("left",w/2+l);
                $("#"+div_name).css("width","0");
                $("#"+div_name).css("height","0");
                $("#"+div_name).fadeOut(0);
                $('#maindiv').css('z-index','0');
                $('#maindiv').css('display','none');
                $(".weapon").css("display","none");
            });
            $('#maindiv').data('open', '');
            window.history.pushState("test", "Title", "/git/nittfest14/main.php");
        }
    });

    $(window).keyup(function(e){

        if($('#maindiv').data('open') == '') {
            return;
        }

        var div_name = $('#maindiv').data('open');
        if(e.keyCode==27) {
            $("#"+div_name).animate({
                width: "-="+w,
                left: "+="+w/2,
                height: "-="+h,
                top: "+="+h/2
            }, 300, function() {
                $("#"+div_name).css("top",h/2+t);
                $("#"+div_name).css("left",w/2+l);
                $("#"+div_name).css("width","0");
                $("#"+div_name).css("height","0");
                $("#"+div_name).fadeOut(0);
                $('#maindiv').css('z-index','0');
                $('#maindiv').css('display','none');
                $(".weapon").css("display","none");
            });
            $('#maindiv').data('open', '');
            window.history.pushState("test", "Title", "/git/nittfest14/main.php");
        }
    });


    $('.links').click(function(){
        var div_name=$(this).data("target");
        if(div_name!='rulebook'){
            window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+div_name);
        }else{
            window.history.pushState("test", "Title", "/git/nittfest14/main.php?ctype="+div_name+"&p="+pn);
        }

        var weapon = $(this).data('weapon');
        nittfest.weaponsAnimate(weapon, div_name, this);
    });


    // Hover animations for values

    $(".links").mouseover(function(e){

        //rotation();
        var hovertext=$(this).data("target");
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

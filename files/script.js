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

$(document).ready( function(){
    $('a').hide();
    $('ul').hide();
    nittfest.init();
    $(".showdiv").hide();
    $(".text").hide();

    $('#hide').click(function() {
        if($('#maindiv').data('open') == '') {
            return;
        }
        var div = $('#maindiv').data('open');
        $("#"+div).animate({
            width: "-="+nittfest.divWidth,
            left: "+="+nittfest.divWidth/2,
            height: "-="+nittfest.divHeight,
            top: "+="+nittfest.divHeight/2
        }, 300, function() {
            nittfest.resetDiv(div);
            $('#maindiv').data('open', '');
            window.history.pushState("test", "Title", "?ctype");
        });
    });

    $("#maindiv").mousedown(function(e){
        var mx=e.clientX;
        var my=e.clientY;
        if($('#maindiv').data('open') == '') {
            return;
        }
        var div = $('#maindiv').data('open');
        if(
            (mx<nittfest.divLeft)
             || (mx>nittfest.divLeft+nittfest.divWidth)
             || (my>nittfest.divTop+nittfest.divHeight)
             || (my<nittfest.divTop)
        ) {
            $("#"+div).animate({
                width: "-="+nittfest.divWidth,
                left: "+="+nittfest.divWidth/2,
                height: "-="+nittfest.divHeight,
                top: "+="+nittfest.divHeight/2
            }, 300, function() {
                nittfest.resetDiv(div);
                $('#maindiv').data('open', '');
                window.history.pushState("test", "Title", "?ctype");
            });
        }
    });

    $(window).keyup(function(e){
        if($('#maindiv').data('open') == '') {
            return;
        }

        var div = $('#maindiv').data('open');
        if(e.keyCode==27) {
            $("#"+div).animate({
                width: "-="+nittfest.divWidth,
                left: "+="+nittfest.divWidth/2,
                height: "-="+nittfest.divHeight,
                top: "+="+nittfest.divHeight/2
            }, 300, function() {
                nittfest.resetDiv(div);
                $('#maindiv').data('open', '');
                window.history.pushState("test", "Title", "?ctype");
            });
        }
    });


    $('.links').click(function(){
        var div = $(this).data("target");
        if(div != 'rulebook'){
            window.history.pushState("test", "Title", "?ctype="+div);
        }else{
            window.history.pushState("test", "Title", "?ctype="+div+"&p="+pn);
        }

        var weapon = $(this).data('weapon');
        nittfest.weaponsAnimate(weapon, div, this);
    });


    // Hover animations for values

    $(".links").mouseover(function(e){
        var hovertext=$(this).data("target");
        var tp=parseInt($(this).css("top"));
        var lf=parseInt($(this).css("left"));
        var d_name='#'+hovertext+"_text";
        $(d_name).css("top",tp-30+'px');
        $(d_name).css("left",lf-30+'px');
        $(d_name).show();
    });


    $(".links").mouseleave(function(){
        $(".text").hide();
    });

});

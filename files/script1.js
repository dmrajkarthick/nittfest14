gh=0;
var sto= new Array("s-culturals","s-tamil","s-hindi","s-rule","s-english","s-design","s-arts");
function load1(){
$("#r-container").css("zIndex","2");
$("#n-container").css("zIndex","1");
$("#s-container").css("zIndex","1");
var i=-35,key1=0;
arr=new Array();
currentr=0;
for(key in sto){
	if(sto[key]=="s-rule"){ window.setTimeout(function(){
	$(".st-load").css("display","none");
	$("#"+sto[key1]).css('display','block').animate( {css:{bezier:[{left:"50%",top:"120%"},{left:"80%",top:"0%"},{left:"45%", top:"52%"}]}},1000);
	key1+=1;
	},80*key);
	}	else{
	d=Math.PI*i/180;
	arr[key]=[45-Math.floor(16*Math.cos(d)),50-Math.floor(40*Math.sin(d))];
	i+=50;
	document.title="NITTFEST '13 - Rulebook";
	window.setTimeout(function(){
	
	$(".st-load").css("display","none");
	$("#"+sto[key1]).css('display','block').animate( {css:{bezier:[{left:"50%",top:"120%"},{left:"80%",top:"0%"},{left:arr[key1][0]+"%", top:arr[key1][1]+"%"}]}},1000);
	key1+=1;
	},80*key);
	}
}
}
df=900;dm=2000;realko="";
function load2(){
$("#r-container").css("zIndex","1");
$("#n-container").css("zIndex","2");
$("#s-container").css("zIndex","1");
$("#n-content-inner").html($("#prelimscache").html());
qw1=function(){
				$(this).find(".et-load").fadeIn("fast");
				gh+=1;
				$.ajax("assets/serve.php?q=s_"+$(this).attr("name")+"&c="+gh).done(function(html){
		if(html=="-1"){
		$(".et-load").fadeOut("fast");
		return;
		}
		html=JSON.parse(html);
		if(gh!=html.c){
		$(".et-load").fadeOut("fast");
		return;
		}
			$(".et-load").fadeOut("fast");
			realko="n-content";
			document.getElementsByClassName("monkey")[0].style.top="0%";
				document.title="NITTFEST '13 - "+html.title;
				$("#n-content-inner").css({top:"0%"}).fadeOut('fast').attr("class",html.language).html("<p><a id='aboutback' href='index.php?q=e_notification'>Go Back</a></p>"+html.content).fadeIn('fast',function(){ $("#aboutback").click(function(){
				$("#n-content-inner").html($("#prelimscache").html());
				$(".ajaxSubevent").click(qw1);
				return false;
				}); attachMouse(); } );
				$(".tab0").fadeIn("fast");
				$(".tabHead").click(function(){
				$(".tabBody").css('display','none');
				$(".tabHead").removeClass("selected");
				$(this).addClass("selected");
				$(".tab"+$(this).attr("name")).fadeIn("fast");
				return false;
				});
		}).fail(function(){
			$(".st-load").fadeOut("fast");
		});
		return false;
}
$(".ajaxSubevent").click(qw1);

document.getElementsByClassName("monkey")[0].style.top="0%";
$("#n-tablet").stop(true).animate( {css:{top:"2%", ease:Back.easeOut}},800,function(){
$("#n-content-inner").css({top:"0%"}).fadeIn("fast");
});
realko="n-content";
attachMouse();
$("#kookoo-slider").stop(true).animate( {css:{top:"5%"}},1000);
document.title="NITTFEST '13 - Updates";
}
function load3(){
$("#r-container").css("zIndex","1");
$("#n-container").css("zIndex","1");
$("#s-container").css("zIndex","2");
document.getElementsByClassName("monkey")[0].style.top="0%";
$("#s-tablet").stop(true).animate( {css:{top:"2%", ease:Back.easeOut}},800,function(){
$("#s-content-inner").css({top:"0%"}).fadeIn("fast");
});
realko="s-content";
attachMouse();
$("#kookoo-slider").stop(true).animate( {css:{top:"5%"}},1000);
document.title="NITTFEST '13 - Scoreboard";
}
function load4(){
$("#c-container").css("zIndex","1");
$("#p-container").css("zIndex","1");
$("#a-container").css("zIndex","2");
document.getElementsByClassName("monkey")[0].style.top="0%";
$("#a-tablet").stop(true).animate( {css:{top:"2%", ease:Back.easeOut}},800,function(){
$("#a-content-inner").css({top:"0%"}).fadeIn("fast");
});
realko="a-content";
attachMouse();
$("#kookoo-slider").stop(true).animate( {css:{top:"5%"}},1000);
document.title="NITTFEST '13 - About Us";
}
function load5(){
$("#p-container").css("zIndex","1");
$("#a-container").css("zIndex","1");
$("#c-container").css("zIndex","2");
document.getElementsByClassName("monkey")[0].style.top="0%";
$("#c-tablet").stop(true).animate( {css:{top:"2%", ease:Back.easeOut}},800,function(){
$("#c-content-inner").css({top:"0%"}).fadeIn("fast");
});
realko="c-content";
attachMouse();
$("#kookoo-slider").stop(true).animate( {css:{top:"5%"}},1000);
document.title="NITTFEST '13 - Contacts";
}
function load6(){
$("#c-container").css("zIndex","1");
$("#a-container").css("zIndex","1");
$("#p-container").css("zIndex","2");
document.getElementsByClassName("monkey")[0].style.top="0%";
$("#p-tablet").stop(true).animate( {css:{left:"13%", ease:Back.easeOut}},800,function(){
$("#p-content-inner").css({top:"0%"}).fadeIn("fast");
});
realko="p-content";
attachMouse();
$("#kookoo-slider").stop(true).animate( {css:{top:"5%"}},1000);
document.title="NITTFEST '13 - Partners";
}
function unload1(){
document.title="NITTFEST '13";
removeMouse();
document.getElementsByClassName("monkey")[0].style.top="0%";
i=0;
$("#r-tablet").animate( {css:{top:"150%", ease:Back.easeIn}},800);
$("#kookoo-slider").animate( {css:{top:"90%"}},1000)
clr=window.setInterval(function(){
if(i>=sto.length) window.clearInterval(clr);
$("#"+sto[i]).stop(true).animate({left:"-20%",top:"50%"},500);
i+=1;
},i*df/10);
}
function unload2(){
document.title="NITTFEST '13";
removeMouse();
$("#n-tablet").animate( {css:{top:"150%", ease:Back.easeIn}},1100);
$("#kookoo-slider").animate( {css:{top:"90%"}},1000);
}
function unload3(){
document.title="NITTFEST '13";
removeMouse();
$("#s-tablet").animate( {css:{top:"150%", ease:Back.easeIn}},1100);
$("#kookoo-slider").animate( {css:{top:"90%"}},1000);
}
function unload4(){
document.title="NITTFEST '13";
removeMouse();
$("#a-tablet").animate( {css:{top:"150%", ease:Back.easeIn}},1100);
$("#kookoo-slider").animate( {css:{top:"90%"}},1000);
}
function unload5(){
document.title="NITTFEST '13";
removeMouse();
$("#c-tablet").animate( {css:{top:"-120%", ease:Back.easeIn}},1100);
$("#kookoo-slider").animate( {css:{top:"90%"}},1000);
}
function unload6(){
document.title="NITTFEST '13";
removeMouse();
$("#p-tablet").animate( {css:{left:"100%", ease:Back.easeIn}},1100);
$("#kookoo-slider").animate( {css:{top:"90%"}},1000);
}
pushallow=1;
$(document).ready(function(){
if(!!(window.history && history.pushState))
$('.historye').click(function(){if(pushallow==1) {history.pushState(null,null,$(this).attr('href') ); }});
var load=$('#top-container').imagesLoaded();
load.always( function(){

$("#loading-container").fadeOut("fast");
document.title="NITTFEST '13";

$(".tribe").animate({bottom:"4%", ease:Bounce.easeOut},1000,function(){$(this).stop(true)});

});
load.progress( function( isBroken, $images, $proper, $broken ){
		var p=($proper.length + $broken.length)/$images.length;
    $("#l-progress").html(Math.floor(p*100)+"% Complete");
		if($broken.length)
			$("#l-error").html($broken.length+" resources failed to load. Please refresh.");
});
$(".tribe-hover").mouseover(function(){
var n=$(this).attr("member"),d=500;
$(this).css({height:"22%"});
$("#tribe"+n).stop(true).animate({bottom:"10%", ease:Back.easeOut},d);
$("#tribe-name"+n).stop(true).animate({bottom:"37%",opacity:1},d-200);
}).mouseout(function(){
var n=$(this).attr("member"),d=300;
$(this).css({height:"15%"});
$("#tribe"+n).stop(true).animate({bottom:"4%", ease:Bounce.easeOut},d);
$("#tribe-name"+n).stop(true).animate({bottom:"22%",opacity:0},d);
});

home=-1;
$(".tribe-hover").click(function(){
var n=$(this).attr("member"),d1,d2,d3;
if(n==home) {
window["unload"+home]();
window.setTimeout(window["load"+home],df);
return false;
}
func=function(){
		if(n<4) { d1="100%"; d2="-28%"; d3="-6%";}
		else {d1="-100%"; d2="28%"; d3="6%";}
		$("#container").stop(true).animate({left:d1, ease:Power4.easeOut},dm);
		$("#bush-front").stop(true).animate({left:d2, ease:Power4.easeOut},dm);
		$("#bush-back").stop(true).animate({left:d3, ease:Power4.easeOut},dm);
		$("#logo-thumb").stop(true).animate({top:"2%", ease:Back.easeOut},dm/2);
};
	if(home>0) {
	d=df;
	window["unload"+home]();//takes df time
	if((home<4 && n>3) || (home>3 && n<4)) {
		d+=dm/4; 
		window.setTimeout(func,df);
	}
	}else{
		d=dm/4;
		func();
	}
	window.setTimeout(function(){
		home=n;
		window["load"+home]();
	},d);
return false;
});
$("#logo-thumb").click(function(){
if(home==-1) return;
window["unload"+home]();
window.setTimeout(function(){
$("#container").stop(true).animate({left:"0%", ease:Power4.easeOut},dm);
$("#bush-front").stop(true).animate({left:"4%", ease:Power4.easeOut},dm);
$("#bush-back").stop(true).animate({left:"0%", ease:Power4.easeOut},dm);
$("#logo-thumb").stop(true).animate({top:"-25%", ease:Back.easeIn},dm/2);
home=-1;
},df);
return false;
});

for(key in sto)
$("#"+sto[key]).click(function(){
		$(this).find(".st-load").fadeIn("fast");
		currentr=$(this).attr("id");
		gh+=1;
		$.ajax("assets/serve.php?q="+$(this).attr("name")+"&c="+gh).done(function(html){
		if(html=="-1"){
		$(".st-load").fadeOut("fast");
		return;
		}
		html=JSON.parse(html);
		if(gh!=html.c){
		$(".st-load").fadeOut("fast");
		return;
		}
			$(".st-load").fadeOut("fast");
			for(key2 in sto){
				if(sto[key2]==currentr)
					$("#"+sto[key2]).stop().animate({css:{left:"0%", top:"45%"}},700);
				else $("#"+sto[key2]).fadeOut('fast');
			}
			$("#r-tablet").stop(true).animate( {css:{top:"2%", ease:Back.easeOut}},800,function(){$("#r-content-inner").fadeIn("fast")});
			realko="r-content";
			document.getElementsByClassName("monkey")[0].style.top="0%";
				$("#kookoo-slider").stop(true).animate( {css:{top:"5%"}},1000);
				document.title="NITTFEST '13 - "+html.title;
				$("#r-content-inner").css({top:"0%"}).attr("class",html.language).html(html.content);
				if(!!(window.history && history.pushState))
				$('#r-content-inner .historye').click(function(){if(pushallow==1) {history.pushState(null,null,$(this).attr('href') ); }});
				attachMouse();
				$(".ajaxSubevent").click(function(){
				$(this).find(".et-load").fadeIn("fast");
				gh+=1;
				$.ajax("assets/serve.php?q=s_"+$(this).attr("name")+"&c="+gh).done(function(html){
		if(html=="-1"){
		$(".et-load").fadeOut("fast");
		return;
		}
		html=JSON.parse(html);
		if(gh!=html.c){
		$(".et-load").fadeOut("fast");
		return;
		}
			$(".et-load").fadeOut("fast");
			realko="r-content";
			document.getElementsByClassName("monkey")[0].style.top="0%";
				document.title="NITTFEST '13 - "+html.title;
				$("#r-content-inner").css({top:"0%"}).fadeOut('fast').attr("class",html.language).html(html.content).fadeIn('fast',attachMouse);
				$(".tab0").fadeIn("fast");
				$(".tabHead").click(function(){
				$(".tabBody").css('display','none');
				$(".tabHead").removeClass("selected");
				$(this).addClass("selected");
				$(".tab"+$(this).attr("name")).fadeIn("fast");
				return false;
				});
		}).fail(function(){
			$(".st-load").fadeOut("fast");
		});
		return false;
				});
		}).fail(function(){
			$(".st-load").fadeOut("fast");
		});
		return false;
	});

	$(".update").css('width',$('#updates').css('width'));
	$( '#updates' ).slides({
		preload: false,
		hoverPause: true,
		play: 3000,
		'pause': 100,
		generateNextPrev: false,
		generatePagination: false,
		effect: 'slide'
	});
	$( '#sponsors' ).slides({
		preload: false,
		hoverPause: true,
		play: 3000,
		'pause': 100,
		slideSpeed: 1000,
		generateNextPrev: false,
		generatePagination: false,
		effect: 'slide'
	});

if(!!(window.history && history.pushState))
window.addEventListener("popstate", function(e) {
var q=location.search;
if(q==''){
$("#logo-thumb").click();
return;
}
q=q.split('=')[1];
pushallow=0;
if(q=="rulebook") {$("#tribe-hover1").click(); pushallow=1;}
else if(q=="e_notification") {$("#tribe-hover2").click(); pushallow=1;}
else if(q=="e_scoreboard") {$("#tribe-hover3").click(); pushallow=1;}
else if(q=="e_about-us") {$("#tribe-hover4").click(); pushallow=1;}
else if(q=="e_contacts") {$("#tribe-hover5").click(); pushallow=1;}
else if(q=="e_partners") {$("#tribe-hover6").click(); pushallow=1;}
else if(q[0]=='e'){
	q=q.split('_')[1];
	$("#tribe-hover1").click();
	window.setTimeout(function(){ $("#s-"+q).click(); pushallow=1; },df);	
}
});

});

//scroll
var _startY = 0;
var _offsetY = 0;
var mi,ma,l;
var _dragElement;
var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";
function ExtractNumber(value){
var n = parseInt(value);
return n == null || isNaN(n) ? 0 : n;
}
function kmousedown(e){
	if (e == null) e = window.event; 
	var target = e.target != null ? e.target : e.srcElement;
	if ((e.button == 1 && window.event != null || e.button == 0) && target.className == 'hover'){
		_startY = e.clientY;
		_offsetY = ExtractNumber(_dragElement.style.top);
		mi=$(".start").offset().top;
		ma=$(".end").offset().top-mi;
		document.onmousemove=kmousemove;
		document.body.focus();
		document.onselectstart = function () { return false; };
		target.ondragstart = function() { return false; };
		return false;
	}
};
function kmousemove(e){
	if (e == null) 
		var e = window.event;
	var ex;
	ex=_offsetY + e.clientY - _startY;
	if(ex<0)  ex=0;
	else if(ex>ma)  ex=ma;
	_dragElement.style.top =  ex+'px';
	$("#"+realko+"-inner").css('top','-'+(ex*l/ma)+'px')
};
function kmouseup(e){
	if (_dragElement != null) {
		document.onmousemove = null;
    document.onselectstart = null;
    _dragElement.ondragstart = null;
    }
};
function attachMouse(){
mi=$(".start").offset().top;
ma=$(".end").offset().top-mi;
_dragElement = document.getElementsByClassName("monkey")[0];
l=$("#"+realko+"-inner").height()+100-$("#"+realko+"-outer").height();
document.onmousedown = kmousedown;
document.onmouseup = kmouseup;
document.onkeydown = keyscroll;
if (document.attachEvent)
	document.attachEvent("on"+mousewheelevt, scrollwheel)
else if (document.addEventListener)
	document.addEventListener(mousewheelevt, scrollwheel, false)
}
function removeMouse(){
_dragElement = null;
document.onmousedown = null;
document.onmouseup = null;
document.onkeydown=null;
if (document.detachEvent)
	document.detachEvent("on"+mousewheelevt, scrollwheel)
else if (document.removeEventListener)
	document.removeEventListener(mousewheelevt, scrollwheel, false)
}
function scrollwheel(e){
var evt=window.event || e;
var ex;
var delta=evt.detail? evt.detail : evt.wheelDelta*(-1);
evt.preventDefault();
_offsetY = ExtractNumber(_dragElement.style.top);
ex=(delta>0)?1:-1;
ex=ex*10+ _offsetY;
if(ex<0)  ex=0;
else if(ex>ma)  ex=ma;
_dragElement.style.top =  ex+'px';
$("#"+realko+"-inner").css('top','-'+(ex*l/ma)+'px')
}
function keyscroll(e){
var evt=window.event || e;
var key = evt.keyCode || evt.which;
var ex=0;
if(key==38) ex=-1; else if(key==40) ex=1; else return;
evt.preventDefault();
_offsetY = ExtractNumber(_dragElement.style.top);
ex=ex*3+ _offsetY;
if(ex<0)  ex=0;
else if(ex>ma)  ex=ma;
_dragElement.style.top =  ex+'px';
$("#"+realko+"-inner").css('top','-'+(ex*l/ma)+'px')
}
$(window).load(function(){
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=396225907136056";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
});

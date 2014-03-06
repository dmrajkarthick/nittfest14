var nittfest = {};
nittfest.destroy = 0;
nittfest.running = 0;
nittfest.divHeight = 0;
nittfest.divWidth = 0;
nittfest.divTop = 0;
nittfest.divLeft = 0;
nittfest._windowWidth = 0;
nittfest._windowHeight = 0;

nittfest.resetDiv = function(div) {
	var $div = $('#'+div);
    $div.css("top",nittfest.divHeight/2+nittfest.divTop);
    $div.css("left",nittfest.divWidth/2+nittfest.divLeft);
    $div.css("width","0");
    $div.css("height","0");
    $div.fadeOut(0);
    $('#maindiv').css('z-index','0');
    $('#maindiv').css('display','none');
    $(".weapon").css("display","none");
}

nittfest.init = function() {
	var windowHeight, windowWidth;

	windowWidth = $(window).width();
	windowHeight = window.innerHeight;
    if(windowHeight<667) { 
    	windowHeight=667;
    }
    if(windowWidth<1366) {
    	windowWidth=1366;
    }
    nittfest.divHeight = windowHeight * 0.95;
    nittfest.divWidth = windowWidth * 0.85;
    nittfest.divTop = windowHeight * 0.025;
    nittfest.divLeft = windowWidth * 0.075;

    $("#book").height(nittfest.divHeight);
    $("#book").width(nittfest.divWidth);
    $("#book .cover img").width(nittfest.divWidth/2);
    var showdiv = $(".showdiv");
    showdiv.css('width',0);
    showdiv.css('height',0);
    showdiv.css("position","absolute");
    showdiv.css('left',nittfest.divWidth/2+nittfest.divLeft);
   	showdiv.css('top',nittfest.divHeight/2+nittfest.divTop);
    $(".innerdiv").css('width',0.5*nittfest.divWidth);
    $(".innerdiv").css('height',0.76*nittfest.divHeight);
    $(".innerdiv").css('top',0.12*nittfest.divHeight);
    $(".innerdiv").css('left',0.25*nittfest.divWidth);
    $('#maindiv').css('top',"0");
    $('#maindiv').css('left',"0");
    $('#hide').css('left',nittfest.divLeft+nittfest.divWidth+50);
    $('#hide').css('top',nittfest.divTop);
    $('#dragonfire').hide();

    nittfest._windowHeight = windowHeight;
    nittfest._windowWidth = windowWidth;
}
nittfest.showDiv = function (div) {
	var $div = $('#'+div);

    $('#maindiv').css("display",'block');
    $('#maindiv').css('z-index','10');
    $('#maindiv').data('open',div);

    $div.fadeIn(200);
    $div.animate({
        width: "+="+nittfest.divWidth,
        left: "-="+nittfest.divWidth/2,
        height: "+="+nittfest.divHeight,
        top: "-="+nittfest.divHeight/2
    }, 300, function() {
        $div.css("top",nittfest.divTop);
        $div.css("left",nittfest.divLeft);
        $div.css("width",nittfest.divWidth);
        $div.css("height",nittfest.divHeight);
    });
}
nittfest._easingfunction = function(x, t, b, c, d) {
	return c*(t/d)+b;
}
nittfest.anim_functions = {
	hammerRotate: function() {
		console.log($("#hammer"));
		$("#hammer").rotate({
			angle:0,
			animateTo:-720,
			callback: function() {
				nittfest.anim_functions.hammerRotate();
			},
			easing: nittfest._easingfunction
		});
	},
	maceRotate: function() {
		$("#mace").rotate({
			angle:0,
			animateTo:-720,
			callback: function() {
				nittfest.anim_functions.maceRotate();
			},
			easing: nittfest._easingfunction
		});
	},
	spearRotate: function() {
		$("#spear").rotate({
			angle:50,
			animateTo:-40,
		});
	},
	throwWeapon: function (weapon, target, button) {
		var targetx=0.2*nittfest._windowWidth;
		var targety=0.1*nittfest._windowHeight;
		var tp=parseInt($(button).css("top"));
		var lf=parseInt($(button).css("left"));
		var hh=15;
		var hw=15;
		var xdec=0.1;
		
		if(weapon=='mace') {
			hh=25;
			hw=25;
		}
		
		$("#"+weapon).css("top",tp-20);
		$("#"+weapon).css("left",lf-10);
		$("#"+weapon).css("display","block");

		var x=lf-10;
		var y=tp-20;
		var ydiff=targety-tp+20;

		if(nittfest.running) {
			nittfest.running=0;
			clearInterval(nittfest.destroy);
			$("#"+weapon).css("display","none");
			$("#"+weapon+" img").css('height',50);
			$("#"+weapon+" img").css('width',30);

			return;
		}

		nittfest.running = 1;
		nittfest.destroy = setInterval(
			function() {
				if( x < targetx || y < targety) {
					nittfest.running=0;
					clearInterval(nittfest.destroy);
					$("#"+weapon).css("display","none");
					$("#"+weapon+" img").css('height',50);
					$("#"+weapon+" img").css('width',30);
					running=0;
					$('#dragonfire').show();
					$('#dragonfire img').attr('src','./images/fire1.gif');
					setTimeout(
						function() {
							$('#dragonfire').hide();
							$('#dragonfire img').attr('src','');
						},
						450
					);

					setTimeout(
						function() {
							nittfest.showDiv(target);
						},
						700
					);
					return;
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
			},
			8
		);
	}
};

nittfest.weaponsAnimate = function (weapon, target, button) {
	switch(weapon) {
		case 'hammer':
			nittfest.anim_functions.hammerRotate();
			nittfest.anim_functions.throwWeapon(weapon, target, button);
			break;
		case 'mace':
			nittfest.anim_functions.maceRotate();
			nittfest.anim_functions.throwWeapon(weapon, target, button);
			break;
		case 'spear':
			nittfest.anim_functions.spearRotate();
			nittfest.anim_functions.throwWeapon(weapon, target, button);
			break;
	}
};

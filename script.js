var nittfest = {};
nittfest.destroy = 0;
nittfest.running = 0;
nittfest.showDiv = function () {

}

nittfest.anim_functions = {
	hammerRotate: function() {
		$("#hammer").rotate({
			angle:0,
			animateTo:-720,
			callback: function() {
				nittfest.anim_functions.hammerRotate();
			},
			easing: function (x,t,b,c,d) {        // t: current time, b: begInnIng value, c: change In value, d: duration
				return c*(t/d)+b;
			}
		});
	},
	maceRotate: function() {
		$("#mace").rotate({
			angle:0,
			animateTo:-720,
			callback: function() {
				nittfest.anim_functions.maceRotate();
			},
			easing: function (x,t,b,c,d) {        // t: current time, b: begInnIng value, c: change In value, d: duration
				return c*(t/d)+b;
			}
		});
	},
	spearRotate: function() {
		$("#spear").rotate({
			angle:50,
			animateTo:-40,
		});
	},
	throwWeapon: function (weapon, target, button) {
		var targetx=0.2*windowWidth;
		var targety=0.1*windowHeight;
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
							divArrive(target);
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

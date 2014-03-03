<!doctype html>
<html>
<head>
<script type="text/javascript" src="./jquery.js"></script>
<script type="text/javascript" src="./turn.js"></script>

<style type="text/css">
body{
	background:#ccc;
}
#book{
	position: absolute;
	top:125px;
	left:175px;
	width:800px;
	height:500px;
}

#book .turn-page{
	background-color:white;
}

#book .cover{
	background:#333;
}

#book .cover h1{
	color:white;
	text-align:center;
	font-size:50px;
	line-height:500px;
	margin:0px;
}

#book .loader{
	background-image:url(loader.gif);
	width:24px;
	height:24px;
	display:block;
	position:absolute;
	top:238px;
	left:188px;
}

#book .data{
	text-align:center;
	font-size:40px;
	color:#999;
	line-height:500px;
}

#controls{
	width:800px;
	text-align:center;
	margin:20px 0px;
	font:30px arial;
	display: none;
}

#controls input, #controls label{
	font:30px arial;
}

#book .odd{
	background-image:-webkit-linear-gradient(left, #FFF 95%, #ddd 100%);
	background-image:-moz-linear-gradient(left, #FFF 95%, #ddd 100%);
	background-image:-o-linear-gradient(left, #FFF 95%, #ddd 100%);
	background-image:-ms-linear-gradient(left, #FFF 95%, #ddd 100%);
}

#book .even{
	background-image:-webkit-linear-gradient(right, #FFF 95%, #ddd 100%);
	background-image:-moz-linear-gradient(right, #FFF 95%, #ddd 100%);
	background-image:-o-linear-gradient(right, #FFF 95%, #ddd 100%);
	background-image:-ms-linear-gradient(right, #FFF 95%, #ddd 100%);
}
.tabs
{
	height:20px;
	width: 50px;
	background-color:black;
	color: white;
}
#bookmark1
{
	position: absolute;
	top:100px;
	left:175px;
}
#bookmark2
{
	position: absolute;
	top:100px;
		left:308px;
}
#bookmark3
{
	position: absolute;
	top:100px;
		left:441px;
}
#bookmark4
{
	position: absolute;
	top:100px;
		left:574px;
}
#bookmark5
{
	position: absolute;
	top:100px;
		left:707px;
}
#bookmark6
{
	position: absolute;
	top:100px;
		left:840px;
}
</style>
</head>
<body>
<div id='bookmark1' onclick='p(1)' class='tabs'>
1
</div>
<div id='bookmark2' onclick='p(10)' class='tabs'>
2
</div>
<div id='bookmark3' onclick='p(20)' class='tabs'>
3
</div>
<div id='bookmark4' onclick='p(30)' class='tabs'>
4
</div>
<div id='bookmark5' onclick='p(40)' class='tabs'>
5
</div>
<div id='bookmark6' onclick='p(50)' class='tabs'>
6
</div>
<div id="book">
	<div class="cover"><h1>The Bible</h1></div>
</div>
<div id="controls">
	<label for="page-number">Page:</label> <input type="text" size="3" id="page-number"> of <span id="number-pages"></span>
</div>
<script type="text/javascript">
	// Sample using dynamic pages with turn.js
function p(o){
	$('#page-number').val(o);
	$('#book').turn('page', $('#page-number').val());
}
	var numberOfPages = 1000; 
	// Adds the pages that the book will need
	function addPage(page, book) {
		var con;
		// 	First check if the page is already in the book
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

		if (e.target && e.target.tagName.toLowerCase()!='input')
			if (e.keyCode==37)
				$('#book').turn('previous');
			else if (e.keyCode==39)
				$('#book').turn('next');

	});
</script>
</body>
</html>

// DECLARED VARIABLES

var winWidth = $(window).width();  // WINDOW WIDTH
var winHeight = $(window).height(); // WINDOW HEIGHT
var menuHeight;
var scroll = $(window).scrollTop();
var winScroll = $(window).scrollTop();
var menu = 0;

$(document).ready(function() { // will be executed immediately
	winWidth = $(window).width();
	winHeight = $(window).height();

	//FOR SLIDEWRAPPER PUSH DOWN FROM FIXED MENU
	menuHeight = $('#lrnHeader').height();

	$('#lrnWrapper.mblWrapper').css('margin-top',menuHeight);

	if(winWidth <= 768){
		$('#sldWrapper.mblWrapper').css('margin-top',menuHeight);
		//$('#lrnWrapper.mblWrapper').css('margin-top',menuHeight);
	}else{
		$('#sldWrapper.mblWrapper').css('margin-top','0px');
		//$('#lrnWrapper.mblWrapper').css('margin-top',menuHeight);
	}

	$('#menuTxt').text('Menu');
	//alert('true');
	//$('#mobileMenu').slideDown();
});

$(window).on('load', function(){
	winWidth = $(window).width();
	winHeight = $(window).height();

	//FOR SLIDEWRAPPER PUSH DOWN FROM FIXED MENU
	menuHeight = $('#lrnHeader').height();

	$('#lrnWrapper.mblWrapper').css('margin-top',menuHeight);

	if(winWidth <= 768){
		$('#sldWrapper.mblWrapper').css('margin-top',menuHeight);
		//$('#lrnWrapper.mblWrapper').css('margin-top','0px');
	}else{
		$('#sldWrapper.mblWrapper').css('margin-top','0px');
		//$('#lrnWrapper.mblWrapper').css('margin-top',menuHeight);
	}
});

$(window).resize(function(){
	winWidth = $(window).width();
	winHeight = $(window).height();

	//FOR SLIDEWRAPPER PUSH DOWN FROM FIXED MENU
	menuHeight = $('#lrnHeader').height();

	$('#lrnWrapper.mblWrapper').css('margin-top',menuHeight);

	if(winWidth <= 768){
		$('#sldWrapper.mblWrapper').css('margin-top',menuHeight);
		//$('#lrnWrapper.mblWrapper').css('margin-top','0px');
	}else{
		$('#sldWrapper.mblWrapper').css('margin-top','0px');
		//$('#lrnWrapper.mblWrapper').css('margin-top',menuHeight);
	}
	
	if(winWidth <= 768){
		if(menu == 1){
			$('#menuContainer').slideUp('slow');
			$('#lmButton').removeClass('open');
			$('#menuTxt').text('Menu');
			menu = 0;
		}
	}else{
		//$('#menuContainer').slideDown('slow');
	}
	
});

$(window).scroll(function() {
	scroll = $(window).scrollTop();
	/*var mainCnt = $('#clemmyWrapper').offset();
	if(scroll >= mainCnt.top){
		$('.scrollBck').fadeIn();
	}else{
		$('.scrollBck').fadeOut();
	}*/
});


$(window).scroll(function() {
	var winScroll = $(window).scrollTop();
});

function scrollBack(){
	$("html, body").animate({ scrollTop: 0 }, "slow");
}

function mobileMenu(){
	if(menu == 0){

		$('#menuContainer').slideDown('slow');
		$('#lmButton').addClass('open');
		$('#menuTxt').text('Close');
		menu = 1;

	}else{

		$('#menuContainer').slideUp('slow');
		$('#lmButton').removeClass('open');
		$('#menuTxt').text('Menu');
		menu = 0;

	}
}
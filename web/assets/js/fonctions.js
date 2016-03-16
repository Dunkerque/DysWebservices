function scroller(href){
	isScrolling = true;
	var navbarHeight = $('nav').height();
	$('html,body').animate({ scrollTop: ($(href).offset().top)}, 700).promise().done(function(){
		setTimeout(function(){
			isScrolling = false ;
		}, 200);
	});
}
$(document).ready(function(){
 
	$(window).scroll(function(){

		if( $(this).scrollTop() > 0 ){
			$('.HEADER').addClass('estilo2');
		} else {
			$('.HEADER').removeClass('estilo2');
		}
		
	});
 
});


(function($){
	$(function(){
		$( ".site-search-toggle" ).on( "click", function() {
			$( ".wrap-form" ).toggleClass( "form-visible" );
			$( ".search-field" ).focus()
		});
		$(document).ready(function(){
			$(".owl-carousel").owlCarousel({
				items: 1,
				dotsEach: true,
				//dotsContainer: '#carousel-custom-dots',
			})
		});
	});
})(jQuery);
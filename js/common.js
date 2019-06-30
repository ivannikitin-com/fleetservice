(function($){
	$(function(){
		$( ".site-search-toggle" ).on( "click", function() {
			$( ".wrap-form" ).toggleClass( "form-visible" );
			$( ".search-field" ).focus()
		});
		$(document).ready(function(){
			$("#slider_main.owl-carousel").owlCarousel({
				items: 1,
				dotsEach: true,
				//dotsContainer: '#carousel-custom-dots',
			})
		});

		/*Подключение к отзывам на Главной*/
		$(document).ready(function(){
			$(".reviews-list .owl-carousel").owlCarousel ({
				items: 2,
				nav: true,
				margin: 30,
				navText: false,
				//center: true,
				//autoHeight: true,
				responsive: {
					0:{
						items: 1,
					},
					768:{
						items: 2
					}
				}
			})
		});

	});
})(jQuery);
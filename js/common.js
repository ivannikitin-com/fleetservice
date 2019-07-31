(function($){
	$(function(){
		$( ".site-search-toggle" ).on( "click", function() {
			$( ".wrap-form" ).toggleClass( "form-visible" );
			$( ".search-field" ).focus()
		});
		$("#slider_main.owl-carousel").owlCarousel({
			items: 1,
			dotsEach: true,
		})

		/*Подключение к отзывам на Главной*/
		$(".reviews-list .owl-carousel").owlCarousel ({
			items: 2,
			nav: true,
			margin: 30,
			navText: false,
			responsive: {
				0:{
					items: 1,
				},
				768:{
					items: 2
				}
			}
		})
		$(".bestsellers .owl-carousel").owlCarousel ({
			nav: true,
			margin: 30,
			navText: false,
			autoHeight:true,
			responsive: {
				0:{
					items: 1
				},
				768:{
					items: 2
				},				
				992:{
					items: 3
				},
				1199:{
					items: 5
				}
			}
		})
	});
})(jQuery);
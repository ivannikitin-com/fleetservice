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
		$('#menu-catalog-menu .menu-item.current-menu-ancestor > .collapse-menu.collapse').addClass('show');
		/*function toggleDropdownon (e) {
		  const _d = $(this),
		   		_n = $(this).closest('.collapse-menu');
		      _m = $(this).next('.collapse-menu');
		  setTimeout(function(){
		    const shouldOpen = e.type !== 'click';
		    _m.toggleClass('show', shouldOpen);
		    $('[data-toggle="collapse"]', _d).attr('aria-expanded', shouldOpen);
		    $(this).attr('aria-expanded');
		  }, e.type === 'mouseleave' ? 300 : 0);
		}
		function toggleDropdownoff (e) {
		  const _d = $(this),
		   		_n = $(this).closest('.collapse-menu');
		      _m = $(this).next('.collapse-menu');
		    const shouldOpen = e.type !== 'click' && !_n.hasClass('show');
		    _m.toggleClass('show', shouldOpen);
		    $('[data-toggle="collapse"]', _d).attr('aria-expanded', shouldOpen);
		    $(this).attr('aria-expanded');
		}
		$('body')
		  .on('mouseenter','a.collapse',toggleDropdownon)
		  .on('mouseleave','a.collapse',toggleDropdownoff);*/
		  $('a.collapse').mouseenter(function()
			 {
			 _n = $(this).next('.collapse-menu');	
			 _n.css("display")!="block"?
			 _n.show():
			 _n.hide()
			});
	});
})(jQuery);
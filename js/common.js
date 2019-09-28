(function($){
	$(function(){
		$('.wishlist_item input[type="checkbox"], .product-cb input.global-cb[type="checkbox"], .products-per-page .wppp-select, .woocommerce-ordering select').styler();
		if (typeof (imagesLoaded) != "undefined") {
			var $container = $('#masonry_container');
			$container.imagesLoaded().done( function() {
				$container.masonry({
					singleMode: true,
					itemSelector: '.news-item'
				});
			});
		}
		$(".mask, input[type='tel'], input#biling_phone, input#shipping_phone").mask("+7 (999) 999-9999");
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
		$(".related.products .owl-carousel, .up-sells.products .owl-carousel").owlCarousel ({
			nav: true,
			margin: 20,
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
					items: 4
				}
			}
		})		
		$('#menu-catalog-menu .menu-item.current-menu-ancestor > .collapse-menu.collapse').addClass('show');	
		$('li.menu-item.active').parents('collapse-menu').show();
		$('a.collapse').mouseover(function(event)
			 {
			 let target = event.target;
			 let related_target = event.relatedTarget;
			 _sister_a =$(this).parent('li').closest('li').children('a:first');
			 /*if (related_target == _sister_a) {
			 	_sister_a.addClass('show');) 			 	
			 }
			 if (related_target = $(this).parent()) {
			 	_others=_next.parents('li.menu-item').first().siblings().children('.collapse-menu');
			 	_others.removeClass('show');
			 }*/

			 
			});
		$('.oneclickbuy').click(function(){
			var variation_id = $('form#oneclickform.variations_form input[name=variation_id]').val();
			var product_title = $('form#oneclickform input[name="product-title"]').attr("value");
			var product_sku = $('.summary .sku_wrapper .sku').html();
			var variation_name = '';
			$('table.variations .select2-selection__rendered').each(function(i,elem) {
				variation_name = variation_name + ', ' + $(elem).html();
			});
			var variation_quantity = $('.quantity input[type=number]').val();
			
			$('form#oneclickform input[name="product-variation"]').val(variation_name);
			$('form#oneclickform input[name="product-quantity"]').val(variation_quantity);
			$('form#oneclickform input[name="product-sku"]').val(product_sku);
			if (variation_name) {
				product_title = product_title + variation_name;
			}
			if (variation_quantity) {
				product_title = product_title + ', кол-во: '+variation_quantity;
			}		
			$('#modalOneClick div.wpcf7 .order_product_title').html(product_title);
			$('#modalOneClick .sku_wrapper .sku').html(product_sku);
			return true;
		});
		console.log('typeof (select2):'+(typeof (select2) ));
		if (typeof (select2) === "function") {
			$('.single-product table.variations select, select.orderby, select.wppp-select').select2();
		}
		$('body').on('mouseenter mouseleave', '.dropdown', function (e) {
		    var dropdown = $(e.target).closest('.dropdown');
		    var menu = $('.dropdown-menu', dropdown);
		    dropdown.addClass('show');
		    menu.addClass('show');
		    setTimeout(function () {
		        dropdown[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
		        menu[dropdown.is(':hover') ? 'addClass' : 'removeClass']('show');
		    }, 300);
		});
		$('#menu-tip-produktsii,#menu-tip-produktsii-1,#menu-napravleniya-biznesa,#menu-napravleniya-biznesa-1').metisMenu({

		  // enabled/disable the auto collapse.
		  toggle: true,

		  // prevent default event
		  preventDefault: true,

		  // default classes
		  activeClass: 'active',
		  collapseClass: 'collapse',
		  collapseInClass: 'in',
		  collapsingClass: 'collapsing',

		  // .nav-link for Bootstrap 4
		  triggerElement: 'a.my',

		  // .nav-item for Bootstrap 4
		  parentTrigger: 'li',

		  // .nav.flex-column for Bootstrap 4
		  subMenu: 'ul'

		});
	});
})(jQuery);
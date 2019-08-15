(function($){
	$(function(){
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
					items: 4
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
		$('.single-product table.variations select').select2();
	});
})(jQuery);
(function($){
	$(function(){
		$('.wishlist_item input[type="checkbox"], .product-cb input.global-cb[type="checkbox"], .products-per-page .wppp-select, .woocommerce-ordering select, .variations select, .wpcf7 input[type="checkbox"], .mailpoet_checkbox').styler();
		$('.products-per-page .wppp-select, .woocommerce-ordering select').change(function(){
			$('.products-per-page .wppp-select, .woocommerce-ordering select').styler();
		});
	});
})(jQuery);
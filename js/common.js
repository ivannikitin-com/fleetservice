(function($){
	$(function(){
		$( ".site-search-toggle" ).on( "click", function() {
			$( ".wrap-form" ).toggleClass( "form-visible" );
			$( ".search-field" ).focus()
		});
	});
})(jQuery);
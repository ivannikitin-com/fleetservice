(function($){
	$(function(){
		$('.fleet_loadmore').click(function(){
	 
			var button = $(this),
			    data = {
				'action': 'loadmore',
				'query': fleet_loadmore_params.posts, // that's how we get params from wp_localize_script() function
				'page' : fleet_loadmore_params.current_page
			};
	 
			$.ajax({ // you can also use $.post here
				url : fleet_loadmore_params.ajaxurl, // AJAX handler
				data : data,
				type : 'POST',
				beforeSend : function ( xhr ) {
					button.next('span.spinner').addClass('is-active');
				},
				success : function( data ){
					if( data ) { 
						var el = $(data);
						$('#masonry_container, ul.products').append(el);
						$('#masonry_container').imagesLoaded( function() {
							$('#masonry_container').masonry( 'appended', el, true ).masonry('layout');
						});
						if($('.woocommerce-result-count').length > 0) {
							var woocommerce_result_count =$('.woocommerce-result-count').html().split(' ');
							var upper = woocommerce_result_count[1].split('–');
							var new_upper = parseInt(upper[1]) + parseInt(fleet_loadmore_params.posts_per_page);
							var result_count_string = $('.woocommerce-result-count').html().replace('–'+upper[1],'–'+new_upper);

							$('.woocommerce-result-count').html(result_count_string);
						}
						button.next('span.spinner').removeClass('is-active');
						
						fleet_loadmore_params.current_page++;
	 
						if ( fleet_loadmore_params.current_page == fleet_loadmore_params.max_page ) 
							button.remove(); // if last page, remove the button
	 
						// you can also fire the "post-load" event here if you use a plugin that requires it
						// $( document.body ).trigger( 'post-load' );
					} else {
						button.remove();
					}
				}
			});
		});
	});
})(jQuery);
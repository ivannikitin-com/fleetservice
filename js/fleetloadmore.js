(function($){
	$(function(){
		var History = window.History;

		$('.fleet_loadmore').click(function(){
	 
			var button = $(this),
			    data = {
				'action': 'loadmore',
				'query': fleet_loadmore_params.query_vars, // that's how we get params from wp_localize_script() function
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
						fleet_loadmore_params.current_page ++;
						var prevUrl = window.location.href;						
						if(document.location.pathname.indexOf('\/page\/')>-1){
							var newUrl = prevUrl.replace(/(\/?)page(\/|d=)[0-9]+(\/?\??\w*)/, '$1page$2'+ fleet_loadmore_params.current_page+'$3');
						} else {
							var newUrl = document.location.protocol+'//'+document.location.host+document.location.pathname+'page/'+fleet_loadmore_params.current_page+'/'+document.location.search;
						}
	 					
						if ( fleet_loadmore_params.current_page == fleet_loadmore_params.max_page ) 
							button.remove(); // if last page, remove the button
						data = {
							'action': 'refresh_pagination',
							'query': fleet_loadmore_params.query_vars, 
							'page' : fleet_loadmore_params.current_page,
							'posts_per_page' : fleet_loadmore_params.posts_per_page
						};
						$.ajax({ // you can also use $.post here
							url : fleet_loadmore_params.ajaxurl, // AJAX handler
							data : data,
							type : 'POST',
							success : function( data ){
								if( data ) { 
									/*History.pushState(null, null, newUrl);*/
									History.pushState(null, null, newUrl);
									console.log(data);
									var protocol = document.location.protocol;
									var host = document.location.host;
									var cur_path = document.location.pathname;
									var cur_search = '';
									cur_search = document.location.search;
									cur_path = cur_path.replace(/(\/?)page(\/|d=)[0-9]+(\/?\??\w*)/,'');
									data = data.replace(/(href=")[^"]*paged=([0-9]+)[^"]*(">)/g, '$1'+protocol+'\/\/'+host+cur_path+'/page/$2/'+cur_search+'$3');
									console.log(data);
									var el = $(data);									
									$('.wp-pagenavi').html(data);
								}
							}
						});
					} else {
						button.remove();
					}

				}
			});
		});
	});
})(jQuery);
(function($){
	$(function(){
		var loading = false;

		function getUrlParameter(name) {
			name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
			var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
			var results = regex.exec(location.search);
			return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
		}

		function parseQueryString(str) {
			var params = {};
			if (!str) return params;
			str.split('&').forEach(function(pair) {
				var kv = pair.split('=');
				if (kv.length >= 2) {
					params[decodeURIComponent(kv[0])] = decodeURIComponent((kv.slice(1).join('=')).replace(/\+/g, ' '));
				}
			});
			return params;
		}

		function buildPfFilters() {
			var qs = location.search ? location.search.substring(1) : '';
			var params = parseQueryString(qs);
			var orderby = $('select.orderby').val() || params.orderby || fleet_loadmore_params.orderby || 'menu_order title';
			params.orderby = orderby;
			if (fleet_loadmore_params.term_slug && fleet_loadmore_params.taxonomy) {
				params[fleet_loadmore_params.taxonomy] = fleet_loadmore_params.term_slug;
			}
			return { fleet_loadmore: params };
		}

		function loadProducts() {
			if (typeof fleet_loadmore_params === 'undefined') return;

			var currentPage = parseInt(fleet_loadmore_params.current_page, 10) || 1;
			if (loading || currentPage >= fleet_loadmore_params.max_pages) return;

			var $button = $('.fleet_loadmore');
			var $spinner = $button.next('span.spinner');

			loading = true;
			if ($spinner.length) $spinner.addClass('is-active');

			var orderby = $('select.orderby').val() || getUrlParameter('orderby') || fleet_loadmore_params.orderby || 'menu_order title';
			var pfFilters = buildPfFilters();
			var nextPage = currentPage + 1;

			var ajaxData = {
				action: 'load_more_products',
				nonce: fleet_loadmore_params.nonce,
				page: nextPage,
				term_id: fleet_loadmore_params.term_id,
				taxonomy: fleet_loadmore_params.taxonomy,
				orderby: orderby,
				pf_filters: pfFilters,
				posts_per_page: fleet_loadmore_params.posts_per_page
			};
			if (fleet_loadmore_params.initial_meta_key) {
				ajaxData.initial_meta_key = fleet_loadmore_params.initial_meta_key;
			}

			$.ajax({
				url: fleet_loadmore_params.ajaxurl,
				type: 'POST',
				data: ajaxData,
				dataType: 'json',
				success: function(response) {
					if (response.success && response.data.html) {
						var $container = $('#masonry_container, ul.products').first();
						if (!$container.length) $container = $('ul.products');
						var $newItems = $(response.data.html);
						$container.append($newItems);

						if ($('#masonry_container').length && typeof $.fn.imagesLoaded !== 'undefined' && typeof $.fn.masonry !== 'undefined') {
							$('#masonry_container').imagesLoaded(function() {
								$('#masonry_container').masonry('appended', $newItems, true).masonry('layout');
							});
						}

						fleet_loadmore_params.current_page = nextPage;
						if (response.data.max_pages) {
							fleet_loadmore_params.max_pages = response.data.max_pages;
						}

						if ($('.woocommerce-result-count').length) {
							var $resultCount = $('.woocommerce-result-count');
							var html = $resultCount.html();
							var totalMatch = html.match(/из\s*(\d+)/);
							var total = totalMatch ? parseInt(totalMatch[1], 10) : 0;
							var page = fleet_loadmore_params.current_page;
							var perPage = parseInt(fleet_loadmore_params.posts_per_page, 10) || 24;
							var end = Math.min(page * perPage, total);
							var newRange = '1–' + end;
							var result_count_string = html.replace(/\d+–\d+/, newRange);
							$resultCount.html(result_count_string);
						}

						var path = location.pathname.replace(/\/+$/, '');
						var newUrl;
						if (location.pathname.indexOf('/page/') > -1) {
							newUrl = location.href.replace(/(\/?)page(\/|d=)[0-9]+(\/?\??\w*)/, '$1page$2' + fleet_loadmore_params.current_page + '$3');
						} else {
							newUrl = location.protocol + '//' + location.host + path + '/page/' + fleet_loadmore_params.current_page + '/' + (location.search || '');
						}
						if (typeof History !== 'undefined' && History.pushState) {
							History.pushState(null, null, newUrl);
						}

						if (fleet_loadmore_params.current_page >= fleet_loadmore_params.max_pages) {
							$button.remove();
							$spinner.remove();
						}
						$.ajax({
							url: fleet_loadmore_params.ajaxurl,
							type: 'POST',
							data: (function() {
								var d = {
									action: 'refresh_pagination',
									nonce: fleet_loadmore_params.nonce,
									page: fleet_loadmore_params.current_page,
									term_id: fleet_loadmore_params.term_id,
									taxonomy: fleet_loadmore_params.taxonomy,
									orderby: orderby,
									pf_filters: buildPfFilters(),
									posts_per_page: fleet_loadmore_params.posts_per_page
								};
								if (fleet_loadmore_params.initial_meta_key) d.initial_meta_key = fleet_loadmore_params.initial_meta_key;
								return d;
							})(),
							success: function(paginationHtml) {
								if (paginationHtml && $('.wp-pagenavi').length) {
									var protocol = location.protocol;
									var host = location.host;
									var cur_path = location.pathname.replace(/(\/?)page(\/|d=)[0-9]+(\/?\??\w*)/, '').replace(/\/+$/, '');
									var cur_search = location.search || '';
									var fixed = paginationHtml.replace(/(href=")[^"]*paged=([0-9]+)[^"]*(">)/g, '$1' + protocol + '//' + host + cur_path + '/page/$2/' + cur_search + '$3');
									$('.wp-pagenavi').replaceWith(fixed);
								}
							}
						});
					} else {
						$button.remove();
						if ($spinner.length) $spinner.remove();
					}
				},
				error: function() {
					if ($spinner.length) $spinner.removeClass('is-active');
				},
				complete: function() {
					loading = false;
					if ($spinner.length) $spinner.removeClass('is-active');
				}
			});
		}

		$('body').on('click', '.fleet_loadmore', function(e) {
			e.preventDefault();
			loadProducts();
		});
	});
})(jQuery);

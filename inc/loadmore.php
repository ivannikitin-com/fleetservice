<?php
/**
 * Load More products — по образцу casalusso.
 * Передаём orderby и filter_params из URL, чтобы сохранялись фильтры и сортировка.
 */

function fleet_load_more_scripts() {
	global $wp_query;

	// Подключаем только на страницах товаров
	if ( ! function_exists( 'is_shop' ) || ( ! is_shop() && ! is_product_taxonomy() ) ) {
		return;
	}

	wp_register_script( 'fleet_loadmore', get_stylesheet_directory_uri() . '/js/fleetloadmore.js', array( 'jquery' ), null, true );

	$localize = array(
		'ajaxurl'   => admin_url( 'admin-ajax.php' ),
		'nonce'     => wp_create_nonce( 'fleet_loadmore_nonce' ),
		'max_pages' => $wp_query->max_num_pages,
		'current_page' => max( 1, (int) get_query_var( 'paged' ) ),
		'term_id'   => is_product_taxonomy() ? get_queried_object_id() : 0,
		'taxonomy'  => ( is_product_taxonomy() && get_queried_object() ) ? get_queried_object()->taxonomy : '',
		'posts_per_page' => isset( $wp_query->query_vars['posts_per_page'] ) ? $wp_query->query_vars['posts_per_page'] : apply_filters( 'loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page() ),
		'orderby' => isset( $wp_query->query_vars['orderby'] ) ? $wp_query->query_vars['orderby'] : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) ),
	);
	if ( ! empty( $wp_query->query_vars['meta_key'] ) ) {
		$localize['initial_meta_key'] = $wp_query->query_vars['meta_key'];
	}

	wp_localize_script( 'fleet_loadmore', 'fleet_loadmore_params', $localize );

	wp_enqueue_script( 'fleet_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'fleet_load_more_scripts' );

/**
 * Разбирает query string и добавляет параметры в $_GET для WooCommerce
 */
function fleet_parse_filter_params( $query_string ) {
	if ( empty( $query_string ) ) {
		return;
	}
	$query_string = ltrim( $query_string, '?' );
	parse_str( $query_string, $params );
	if ( is_array( $params ) ) {
		foreach ( $params as $key => $value ) {
			$_GET[ $key ] = $value;
		}
	}
}

/**
 * AJAX handler для подгрузки товаров
 */
function fleet_load_more_products() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'fleet_loadmore_nonce' ) ) {
		wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
	}

	$page     = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
	$term_id  = isset( $_POST['term_id'] ) ? absint( $_POST['term_id'] ) : 0;
	$taxonomy = isset( $_POST['taxonomy'] ) ? sanitize_text_field( wp_unslash( $_POST['taxonomy'] ) ) : '';
	$orderby  = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
	$filter_params = isset( $_POST['filter_params'] ) ? sanitize_text_field( wp_unslash( $_POST['filter_params'] ) ) : '';
	$posts_per_page = isset( $_POST['posts_per_page'] ) ? absint( $_POST['posts_per_page'] ) : apply_filters( 'loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page() );

	// Имитируем GET-параметры страницы, чтобы сработали фильтры WooCommerce и Product Filter
	fleet_parse_filter_params( $filter_params );

	$args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged'          => $page,
	);

	if ( $term_id > 0 && ! empty( $taxonomy ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		);
	}

	// Сортировка: при кастомном meta_key (Currency per Product — _alg_wc_cpp_converted_price)
	// используем его, т.к. get_catalog_ordering_args может не применить фильтры плагина в AJAX-контексте
	$initial_meta_key = isset( $_POST['initial_meta_key'] ) ? sanitize_text_field( wp_unslash( $_POST['initial_meta_key'] ) ) : '';
	if ( $initial_meta_key && in_array( $orderby, array( 'price', 'price-desc' ), true ) ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = $initial_meta_key;
		$args['order']    = ( 'price-desc' === $orderby ) ? 'DESC' : 'ASC';
	} else {
		$ordering = WC()->query->get_catalog_ordering_args( $orderby );
		$args['orderby'] = $ordering['orderby'];
		$args['order']   = $ordering['order'];
		if ( ! empty( $ordering['meta_key'] ) ) {
			$args['meta_key'] = $ordering['meta_key'];
		}
	}

	// query_posts, чтобы сработал WC_Query::pre_get_posts (meta_query, tax_query из фильтров)
	query_posts( $args );

	$max_pages = $GLOBALS['wp_query']->max_num_pages;

	ob_start();
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'product' );
		}
	}
	$html = ob_get_clean();

	wp_reset_postdata();

	wp_send_json_success( array(
		'html'      => $html,
		'max_pages' => $max_pages,
	) );
}

add_action( 'wp_ajax_load_more_products', 'fleet_load_more_products' );
add_action( 'wp_ajax_nopriv_load_more_products', 'fleet_load_more_products' );

/**
 * AJAX handler для обновления пагинации
 */
function fleet_refresh_pagination() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'fleet_loadmore_nonce' ) ) {
		die;
	}

	$page     = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
	$term_id  = isset( $_POST['term_id'] ) ? absint( $_POST['term_id'] ) : 0;
	$taxonomy = isset( $_POST['taxonomy'] ) ? sanitize_text_field( wp_unslash( $_POST['taxonomy'] ) ) : '';
	$orderby  = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
	$filter_params   = isset( $_POST['filter_params'] ) ? sanitize_text_field( wp_unslash( $_POST['filter_params'] ) ) : '';
	$posts_per_page  = isset( $_POST['posts_per_page'] ) ? absint( $_POST['posts_per_page'] ) : 12;

	fleet_parse_filter_params( $filter_params );

	// Корректный base URL для ссылок пагинации (get_pagenum_link в AJAX использует admin-ajax.php)
	$base_url = ( $term_id > 0 && ! empty( $taxonomy ) )
		? get_term_link( $term_id, $taxonomy )
		: get_permalink( wc_get_page_id( 'shop' ) );
	if ( is_wp_error( $base_url ) ) {
		$base_url = home_url( '/' );
	}
	$base_path = untrailingslashit( wp_parse_url( $base_url, PHP_URL_PATH ) ?: '' );
	$base_query = wp_parse_url( $base_url, PHP_URL_QUERY );
	if ( $filter_params ) {
		$base_query = $base_query ? $base_query . '&' . $filter_params : $filter_params;
	}

	$pagenum_link_filter = function ( $result, $pagenum ) use ( $base_path, $base_query ) {
		$path = ( $pagenum <= 1 ) ? $base_path . '/' : $base_path . '/page/' . $pagenum . '/';
		$url  = home_url( $path );
		return $base_query ? $url . '?' . $base_query : $url;
	};
	add_filter( 'get_pagenum_link', $pagenum_link_filter, 10, 2 );

	$args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged'          => $page,
	);

	if ( $term_id > 0 && ! empty( $taxonomy ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		);
	}

	$initial_meta_key = isset( $_POST['initial_meta_key'] ) ? sanitize_text_field( wp_unslash( $_POST['initial_meta_key'] ) ) : '';
	if ( $initial_meta_key && in_array( $orderby, array( 'price', 'price-desc' ), true ) ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = $initial_meta_key;
		$args['order']    = ( 'price-desc' === $orderby ) ? 'DESC' : 'ASC';
	} else {
		$ordering        = WC()->query->get_catalog_ordering_args( $orderby );
		$args['orderby'] = $ordering['orderby'];
		$args['order']   = $ordering['order'];
		if ( ! empty( $ordering['meta_key'] ) ) {
			$args['meta_key'] = $ordering['meta_key'];
		}
	}

	// Отдельный WP_Query — query_posts в admin-ajax может давать неверный paged
	$pagination_query = new WP_Query( $args );
	$html             = '';
	if ( function_exists( 'wp_pagenavi' ) ) {
		$html = wp_pagenavi(
			array(
				'query' => $pagination_query,
				'echo'  => false,
			)
		);
	}
	remove_filter( 'get_pagenum_link', $pagenum_link_filter, 10 );
	wp_reset_postdata();

	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	die;
}

add_action( 'wp_ajax_refresh_pagination', 'fleet_refresh_pagination' );
add_action( 'wp_ajax_nopriv_refresh_pagination', 'fleet_refresh_pagination' );

add_filter( 'get_pagenum_link', 'function_get_pagenum_link' );
function function_get_pagenum_link( $result ) {
	$result = str_replace( 'wp-admin/admin-ajax.php', '', $result );
	return $result;
}

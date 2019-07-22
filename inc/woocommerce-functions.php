<?php 
add_theme_support( 'woocommerce' );
/*Product category*/
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count',20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering',30 );
remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination',10 );

add_action( 'woocommerce_before_shop_loop', 'fleet_sorting_wrapper', 9 );
add_action( 'woocommerce_before_shop_loop','before_ordering_text',20 );
add_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering',22 );
add_action( 'woocommerce_before_shop_loop','woocommerce_result_count',23 );
add_action( 'woocommerce_before_shop_loop','before_products_per_page_text',24 );
add_action( 'woocommerce_before_shop_loop', 'fleet_sorting_wrapper_close', 31 );
add_action( 'woocommerce_before_shop_loop','woocommerce_pagination',35 );
add_filter( 'wppp_ppp_text','fleet_products_per_page',1,2 );
function fleet_products_per_page($output_str, $value){
	if ($value=='-1') {
		$value = __('Все','fleetservice');
	}
	return $value;
}
function before_products_per_page_text() {
	echo '<div class="ordering_label">'.__('Показать на странице:','fleetservice').'</div>';
}
add_action( 'woocommerce_after_shop_loop', 'fleet_sorting_wrapper', 9 );
add_action( 'woocommerce_after_shop_loop','woocommerce_result_count',10 );
add_action( 'woocommerce_after_shop_loop','before_products_per_page_text',24 );
add_action( 'woocommerce_after_shop_loop', 'fleet_sorting_wrapper_close', 31 );
add_action( 'woocommerce_after_shop_loop','woocommerce_pagination',35 );
function before_ordering_text() {
	echo '<div class="ordering_label">'.__('Сортировать по:','fleetservice').'</div>';
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'fleet_woocommerce_get_catalog_ordering_args' );

function fleet_woocommerce_get_catalog_ordering_args( $args ) {
$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

if ( 'name_list' == $orderby_value ) {
$args['orderby'] = 'name';
$args['order'] = 'ASC';
$args['meta_key'] = '';
}

return $args;
}

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'fleet_woocommerce_catalog_orderby' );

function fleet_woocommerce_catalog_orderby( $sortby ) {
	$sortby['name_list'] = __('По наименованию товара','fleetservice');
	unset($sortby['rating']);
	unset($sortby['date']);
	unset($sortby['menu_order']);
	return $sortby;
} 

if (function_exists('wp_pagenavi')) {
remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
function woocommerce_pagination() {
		wp_pagenavi(); 		
	}
add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);
}

function fleet_sorting_wrapper() {
	echo '<div class="fleet-sorting">';
}

function fleet_sorting_wrapper_close() {
	echo '</div>';
}



// Отделяем категории от товаров
function tutsplus_product_subcategories( $args = array() ) {

$parentid = get_queried_object_id();

$args = array(
'parent' => $parentid
);

$terms = get_terms( 'product_cat', $args );

if ( $terms ) {

echo '<ul class="product-cats">';

foreach ( $terms as $term ) {

echo '<li class="category product">';
echo '<a href="' . esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
woocommerce_subcategory_thumbnail( $term );

echo '<h3>'.$term->name.'</h3>';
echo '</a>';
}

echo '</ul>';

}

}
add_action( 'woocommerce_before_shop_loop', 'tutsplus_product_subcategories', 50 );
/*Whishlist*/
add_filter( 'tinvwl-general-default_title','fleet_default_wishlist_title' );
function fleet_default_wishlist_title($wishlist_title){
	return '';
}
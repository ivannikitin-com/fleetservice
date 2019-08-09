<?php 
/*******************
*Common Settings
*******************/
add_action( 'after_setup_theme', 'artabr_theme_setup' );
function artabr_theme_setup() {
	add_theme_support( 'woocommerce' );
	//add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	//add_theme_support( 'wc-product-gallery-slider' );
}

remove_action( 'woocommerce_before_main_content','woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content','fleet_woocommerce_output_content_wrapper', 10 );
function fleet_woocommerce_output_content_wrapper() { ?>
<div class="container">
<div class="row">
	<div class="col-md-9 order-12">
<?php }
remove_action( 'woocommerce_after_main_content','woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content','fleet_woocommerce_main_content_wrapper_end' ,10 );
function fleet_woocommerce_main_content_wrapper_end() { ?>
	</div><!--/end col primary-->
<div class="col-md-3 order-1">
<?php }
add_action( 'woocommerce_sidebar','fleet_woocommerce_all_content_wrapper_end', 99 );
function fleet_woocommerce_all_content_wrapper_end() { ?>
	</div><!--/end col aside-->
</div><!--/.row-->
</div><!--/.container-->
<?php }
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
/*******************
*Product category
*******************/
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination', 10 );

add_action( 'woocommerce_before_shop_loop', 'fleet_sorting_wrapper', 9 );
add_action( 'woocommerce_before_shop_loop','before_ordering_text', 20 );
add_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 21 );
add_action( 'woocommerce_before_shop_loop','fleet_catalog_ordering_wrap_close', 22 );
add_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 23 );
add_action( 'woocommerce_before_shop_loop','before_products_per_page_text', 24 );
//add_action( 'woocommerce_before_shop_loop','fleet_catalog_ordering_wrap_close', 31 );
add_action( 'woocommerce_before_shop_loop', 'fleet_sorting_wrapper_close', 34 );
add_action( 'woocommerce_before_shop_loop','woocommerce_pagination', 35 );
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
	echo '<div class="shop_ordering"><div class="ordering_label">'.__('Сортировать по:','fleetservice').'</div>';
}
function fleet_catalog_ordering_wrap_close() { ?>
	</div>
<?php }
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

add_filter( 'woocommerce_default_catalog_orderby_options', 'fleet_woocommerce_catalog_orderby' );
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

add_action( 'woocommerce_before_shop_loop_item','fleet_wish_compare_buttons',5 );
function fleet_wish_compare_buttons(){ ?>
	<div class="product-top d-flex justify-content-end align-items-end">
	<?php echo do_shortcode("[ti_wishlists_addtowishlist loop=yes]"); ?>
	<!--<a href="#" class="compare"></a><a href="#" class="wishlist"></a>-->
	</div>
<?php }

/*Замена html-шаблона кнопки wishlist*/
//add_filter( 'wc_get_template', 'fleet_custom_wc_template', 10, 5 );
function fleet_custom_wc_template( $located, $template_name, $args, $template_path, $default_path ) {
	if ($template_name = 'ti-addtowishlist') {
		$custom_template_name = '';
		$located = trailingslashit( get_stylesheet_directory() ) . 'woocommerce/ti-addtowishlist.php';
	}
	return $located;
}

add_action( 'woocommerce_before_shop_loop_item','fleet_li_inner_wrap_open',1 );
function fleet_li_inner_wrap_open() {
	echo '<div class="product-inner">';
}
add_action( 'woocommerce_after_shop_loop_item','fleet_li_inner_wrap_close',99);
function fleet_li_inner_wrap_close() {
	echo '</div><!--/.product-inner-->';
}
add_action( 'woocommerce_before_shop_loop_item_title','fleet_loop_sku' );
function fleet_loop_sku(){ 
	global $product;?>
	<div class="sku_wrapper"><?php _e('SKU','woocommerce'); ?>: <span class="sku"><?php echo ($product->get_sku())? $product->get_sku():''; ?></span></div>
<?php }
add_action( 'woocommerce_after_shop_loop_item','fleet_loop_quick_view',9 );
function fleet_loop_quick_view() { ?>
	<a href="#" class="quick-view button"><?php _e('Quick view','fleetservice') ?></a>
<?php }
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10 );
add_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_price',6 );

// Отделяем категории от товаров
function fleet_product_subcategories( $args = array() ) {
	$parentid = get_queried_object_id();
	$args = array(
	'parent' => $parentid
	);
	$taxonomy= get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	if ($taxonomy) {
		$terms = get_terms( $taxonomy->taxonomy, $args );
	} else {
		$terms = get_terms( 'product_cat', $args );
	}
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
add_action( 'woocommerce_before_shop_loop', 'fleet_product_subcategories', 1 );

/*******************
*Whishlist page
*******************/
add_filter( 'tinvwl_default_wishlist_title','fleet_default_wishlist_title' );
function fleet_default_wishlist_title($wishlist_title){
	return '';
}

/*******************
*Single product page
*******************/
add_filter( 'woocommerce_product_thumbnails_columns','fleet_single_product_thumbnails_columns');
function fleet_single_product_thumbnails_columns($columns){
	return 3;
}
add_action( 'pwb_before_single_product_brands','fleet_single_product_brands_label');
function fleet_single_product_brands_label(){
	echo '<div class="single-product-brand-label">'._e('Производитель:','fleetservice').'</div>';
}
add_action('woocommerce_single_product_summary','fleet_single_wishlist_lnk',8);
function fleet_single_wishlist_lnk(){
	echo do_shortcode("[ti_wishlists_addtowishlist loop=yes]");
}
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
add_action('woocommerce_single_product_summary','fleet_loop_sku',9 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35 );
add_filter( 'woocommerce_output_related_products_args', 'fleet_related_products_args' );
 function fleet_related_products_args( $args ) {
 
$args['posts_per_page'] = 10; // количество "Похожих товаров"
 return $args;
}
add_filter( 'woocommerce_product_description_heading',function(){ return ''; } );
add_filter( 'woocommerce_product_additional_information_heading',function(){ return ''; } );
add_filter( 'woocommerce_reviews_title', function(){ return ''; } );
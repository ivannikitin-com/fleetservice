<?php 
/*******************
*Common Settings
*******************/
add_action( 'after_setup_theme', 'fleet_theme_setup' );
function fleet_theme_setup (){
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
//add_action( 'woocommerce_before_shop_loop','fleet_catalog_ordering_wrap_close', 33 );
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
	//echo '<div class="products_per_page_wrap">';
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
	echo '</div><!--/.fleet-sorting-->';
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
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : ''; ?></span></span>
	<?php endif; ?>
<?php }
add_action( 'woocommerce_after_shop_loop_item','fleet_loop_quick_view',9 );
function fleet_loop_quick_view() { 
	global $product;
	echo do_shortcode('[woosq id="'.$product->get_id().'"]');
	/*<a href="#" class="quick-view button"><?php _e('Quick view','fleetservice') ?></a>*/
}
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
		echo '</li>';
		}
	echo '</ul>';
	}
}
add_action( 'woocommerce_before_shop_loop', 'fleet_product_subcategories', 1 );

/*******************
*Quick view window
*******************/
//if (function_exists('woosq_product_summary')) :
	remove_action( 'woosq_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woosq_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woosq_product_summary', 'woocommerce_template_single_meta', 30 );

	add_action( 'woosq_product_summary', 'fleet_loop_sku', 2 );
	add_action( 'woosq_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woosq_product_summary', 'fleet_quick_view_product_attribs', 7 );
	add_action( 'woosq_product_summary', 'woocommerce_template_single_price', 15 );
	add_action( 'woosq_product_summary', 'woocommerce_template_single_add_to_cart', 25 );

	function fleet_quick_view_product_attribs() {
		global $product;
		wc_display_product_attributes($product);
	}
//endif;

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
add_filter( 'prdctfltr_show_filter', 'fleet_hide_filter_on_category_function_jkbg4iu3b' );

function fleet_hide_filter_on_category_function_jkbg4iu3b() {
 if ( is_singular( 'product' ) ) {
  return false;
 }
 return true;
}
add_filter( 'woocommerce_product_thumbnails_columns','fleet_single_product_thumbnails_columns');
function fleet_single_product_thumbnails_columns($columns){
	return 3;
}
add_action( 'pwb_before_single_product_brands','fleet_single_product_brands_label');
function fleet_single_product_brands_label(){
	echo '<div class="single-product-brand-label">'.__('Производитель:','fleetservice').'</div>';
}
add_action('woocommerce_single_product_summary','fleet_single_wishlist_lnk',8);
function fleet_single_wishlist_lnk(){
	echo do_shortcode("[ti_wishlists_addtowishlist loop=yes]");
}
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
add_action('woocommerce_single_product_summary','fleet_loop_sku',9 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_before_add_to_cart_quantity', 'fleet_buy_buttons_wrap_open', 99 );
function fleet_buy_buttons_wrap_open(){ ?>
	<div class="buy_block">
<?php }
add_action( 'woocommerce_after_add_to_cart_button', 'fleet_buy_in_1_click', 1 );
function fleet_buy_in_1_click(){ ?>
	<a href="#modalOneClick" class="button btn_brd_light-blue-green oneclickbuy" data-toggle="modal"><?php _e('Купить в 1 клик','fleetservice'); ?></a>
	</div><!--/.buy_block-->
<?php }
add_action( 'woocommerce_after_single_product', 'fleet_form_one_click_html', 99 );
function fleet_form_one_click_html(){ ?>
		<div id="modalOneClick" class="modal hide fade" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"><div class="form_title"><?php _e('Купить в 1 клик','fleetservice');?></div><button class="close" type="button" data-dismiss="modal">&times;</button></div><!--/.modal-header-->
				<div class="modal-body">
					<?php echo do_shortcode('[contact-form-7 id="6810" title="Купить в 1 клик" html_id="oneclickform"]'); ?>
				</div><!--/.modal-body-->
			</div><!--/.modal-content-->
		</div><!--/.modal-dialog-->
	</div><!--/#modalOneClick-->
<?php }

//Определяем ключ для хранения данных
define( 'CF7_COUNTER', 'cf7-counter' );
     
//Создаем шорткод, который устанавливает значение для поля Dynamic Text Extension
function cf7dtx_counter(){
	$val = get_option( CF7_COUNTER, 0) + 1;  //Увеличиваем текущее значение на 1;
	return $val;
}
add_shortcode('CF7_counter', 'cf7dtx_counter');
     
//Включаем счетчик в работу если письмо было действительно отправлено
function cf7dtx_increment_mail_counter(){
	$val = get_option( CF7_COUNTER, 0) + 1; //Увеличиваем текущее значение на 1
		update_option(CF7_COUNTER, $val); //Обновляем параметры в базе данных
			return true;
}
add_action('wpcf7_mail_sent', 'cf7dtx_increment_mail_counter');

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35 );

add_filter( 'woocommerce_output_related_products_args', 'fleet_related_products_args' );
 function fleet_related_products_args( $args ) {
 
$args['posts_per_page'] = 10; // количество "Похожих товаров"
 return $args;
}
add_filter( 'woocommerce_product_description_heading',function(){ return ''; } );
add_filter( 'woocommerce_product_additional_information_heading',function(){ return ''; } );
add_filter( 'woocommerce_reviews_title', function(){ return ''; } );
add_filter( 'woocommerce_product_review_comment_form_args', 'fleet_add_wc_review_notes' );
function fleet_add_wc_review_notes( $review_form ) {

    $review_form['comment_notes_before'] = '<p style="margin: 0;"><small>Your email will not be published.</small></p>';
    return $review_form;
}
add_filter('comment_form_fields', 'fleet_reorder_comment_fields' );
function fleet_reorder_comment_fields( $fields ){
	$fields['comment'] = '<div class="row"><div class="col-lg-12">'.$fields['comment'].'</div><!--/.col-lg-12--></div><!--/.row-->';
	$fields['author'] = '<div class="row"><div class="col-lg-6">'.$fields['author'].'</div><!--/.col-lg-6-->';
	$fields['email'] = '<div class="col-lg-6">'.$fields['email'].'</div><!--/.col-lg-6--></div><!--/.row-->';
	unset( $fields['cookies']);
	$new_fields = array(); // сюда соберем поля в новом порядке

	$myorder = array('author','email','comment'); // нужный порядок

	foreach( $myorder as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	// если остались еще какие-то поля добавим их в конец
	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;

	return $new_fields;
}
add_filter( 'woocommerce_reset_variations_link', function(){ return ''; } );
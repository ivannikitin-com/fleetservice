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

function add_my_currency( $currencies ) {
$currencies['RUB'] = __( 'Русский рубль', 'woocommerce' );
return $currencies;
}
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
 
function add_my_currency_symbol( $currency_symbol, $currency ) {
switch( $currency ) {
case 'RUB': $currency_symbol = 'руб.'; break;
}
return $currency_symbol;
}

add_filter( 'woocommerce_date_format', 'fleet_wc_date_format' );
function fleet_wc_date_format($date_format){
	$date_format = 'd.m.Y';
	return $date_format;
}
/*******************
*Product category
*******************/
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination', 10 );

add_action( 'woocommerce_before_shop_loop', 'fleet_sorting_wrapper', 9 );
add_action( 'woocommerce_before_shop_loop','before_ordering_text', 20 );
add_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 21 );
add_action( 'woocommerce_before_shop_loop','fleet_catalog_ordering_wrap_close', 22);
add_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 23 );
add_action( 'woocommerce_before_shop_loop','before_products_per_page_text', 24 );
add_action( 'woocommerce_before_shop_loop', 'fleet_sorting_wrapper_close', 34 );
add_action( 'woocommerce_before_shop_loop','woocommerce_pagination', 35 );
add_action( 'woocommerce_before_shop_loop','fleet_catalog_ordering_wrap_close', 31);
add_filter( 'wppp_ppp_text','fleet_products_per_page',1,2 );
function fleet_products_per_page($output_str, $value){
	if ($value=='-1') {
		$value = __('Все','fleetservice');
	}
	return $value;
}
function before_products_per_page_text() {
	echo '<div class="products_per_page_wrap">';
	echo '<div class="ordering_label">'.__('Показать на странице:','fleetservice').'</div><!--/.ordering_label-->';
}
add_action( 'woocommerce_after_shop_loop','woocommerce_load_more',5 );
add_action( 'woocommerce_after_shop_loop', 'fleet_sorting_bottom_wrapper_open', 8 );
add_action( 'woocommerce_after_shop_loop', 'fleet_sorting_wrapper', 9 );
add_action( 'woocommerce_after_shop_loop','woocommerce_result_count', 10 );
add_action( 'woocommerce_after_shop_loop','before_products_per_page_text', 24 );
add_action( 'woocommerce_after_shop_loop','fleet_catalog_ordering_wrap_close', 33 );
add_action( 'woocommerce_after_shop_loop', 'fleet_sorting_wrapper_close', 34 );
add_action( 'woocommerce_after_shop_loop','woocommerce_pagination', 36 );
add_action( 'woocommerce_after_shop_loop', 'fleet_sorting_bottom_wrapper_close', 37 );
add_action( 'woocommerce_after_shop_loop', 'fleet_form_one_click_html', 99 );
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
	$args['orderby'] = 'title';
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
function woocommerce_load_more() {
	global $wp_query;
	$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1; 
	if (  $wp_query->max_num_pages > 1 && $current_page!=$wp_query->max_num_pages) { ?>
		<?php echo '<div class="button btn_brd_black-three fleet_loadmore">'.__('Показать еще','fleetservice').'</div><span class="spinner"></span>';
	}
}

function fleet_sorting_wrapper() {
	echo '<div class="fleet-sorting">';
}

function fleet_sorting_bottom_wrapper_open() {
	echo '<div class="wrap brd-bottom pb-1 mt-md-4 mt-2">';
}

function fleet_sorting_wrapper_close() {
	echo '</div><!--/.fleet-sorting-->';
}
function fleet_sorting_bottom_wrapper_close() {
	echo '</div><!--/.wrap-->';
}

add_action( 'woocommerce_before_shop_loop_item','fleet_wish_compare_buttons',5 );
if (function_exists('tm_woocompare_add_button_loop')) {
	remove_action( 'woocommerce_after_shop_loop_item', 'tm_woocompare_add_button_loop', 12 );
}
function fleet_wish_compare_buttons(){ ?>
	<div class="product-top d-flex justify-content-end">
	<?php $args=array();
	if (function_exists('tm_woocompare_add_button_loop')) {
		tm_woocompare_add_button_loop($args); 
	}?>
	<?php echo do_shortcode("[ti_wishlists_addtowishlist loop=yes]"); ?>
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

add_action( 'woocommerce_before_shop_loop_item_title','fleet_wrap_badge_open',5 );
function fleet_wrap_badge_open(){ ?>
	<div class="wrap_badge">
<?php }

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_new_flash', 6 );
function woocommerce_show_product_loop_new_flash() {
		wc_get_template( 'loop/new-flash.php' );
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',7);

add_action( 'woocommerce_before_shop_loop_item_title','fleet_wrap_badge_close',8 );
function fleet_wrap_badge_close(){ ?>
	</div><!--/.wrap_badge-->
<?php }

add_action( 'woocommerce_before_shop_loop_item_title','fleet_loop_img_wrap_open',9 );
function fleet_loop_img_wrap_open(){ ?>
	<div class="img_wrap">
<?php }

add_action( 'woocommerce_before_single_product_summary', 'fleet_wrap_badge_open', 5 );

add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_new_flash', 6 );
function woocommerce_show_product_new_flash() {
		wc_get_template( 'single-product/new-flash.php' );
}

add_action( 'woocommerce_before_single_product_summary', 'fleet_wrap_badge_close', 11 );

add_action( 'woocommerce_before_shop_loop_item_title','fleet_loop_img_wrap_close',12 );
function fleet_loop_img_wrap_close(){ ?>
	</div><!--/.img_wrap-->
<?php }
add_action( 'woocommerce_before_shop_loop_item_title','fleet_loop_sku',13 );
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
/*<a href="#" class="quick-view button"><? _e('Quick view','fleetservice')</a>*/
}
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10 );
add_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_price',6 );

// Отделяем категории от товаров
function fleet_product_subcategories( $args = array() ) {
	if (is_search()) {
		return;
	}
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
		echo '<div class="cat_img_wrap">';
		if (is_tax('pwb-brand')) {
			woocommerce_brand_subcategory_thumbnail( $term );
		} else {
			woocommerce_subcategory_thumbnail( $term );
		}
		echo '</div>';
		echo '<h3>'.$term->name.'</h3>';
		echo '</a>';
		echo '</li>';
		}
	echo '</ul>';
	}
}
add_action( 'woocommerce_before_shop_loop', 'fleet_product_subcategories', 1 );

function woocommerce_brand_subcategory_thumbnail( $category ) {
		$small_thumbnail_size = apply_filters( 'subcategory_archive_thumbnail_size', 'woocommerce_thumbnail' );
		$dimensions           = wc_get_image_size( $small_thumbnail_size );
		$thumbnail_id         = get_term_meta( $category->term_id, 'pwb_brand_banner', true );

		if ( $thumbnail_id ) {
			$image        = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
			$image        = $image[0];
			$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
			$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;
		} else {
			$image        = wc_placeholder_img_src();
			$image_srcset = false;
			$image_sizes  = false;
		}

		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds.
			// Ref: https://core.trac.wordpress.org/ticket/23605.
			$image = str_replace( ' ', '%20', $image );

			// Add responsive image markup if available.
			if ( $image_srcset && $image_sizes ) {
				echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
			} else {
				echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
			}
		}
}

/*******************
*Quick view window
*******************/
//if (function_exists('woosq_product_summary')) :
	remove_action( 'woosq_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woosq_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woosq_product_summary', 'woocommerce_template_single_meta', 30 );

	add_action( 'woosq_product_summary', 'fleet_quick_view_sku', 2 );
	function fleet_quick_view_sku(){ 
		global $product;?>
		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<div class="product_meta">
			<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : ''; ?></span></span>
		<?php endif; ?>
		</div>
	<?php }
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
/*Если товар продается оптом, то кладем в корзину минимальную партию*/
add_filter( 'tinvwl_product_add_to_cart_quantity', 'fleet_wishlist_add_to_cart_quantity',1,2 );
function fleet_wishlist_add_to_cart_quantity($quantity, $product){
	$minimum_quantity = get_post_meta($product->get_id(),'_wpbo_minimum',true);
	if ($minimum_quantity && $quantity == 1) {
		$quantity = $minimum_quantity;
	}
	return $quantity;
}

/*******************
*Compare page
*******************/
add_filter( 'woocommerce_product_add_to_cart_text','fleet_short_text_4_compare',10,2);
function fleet_short_text_4_compare($button_text,$that) {
		if (is_page('compare')) {
			return __('В корзину','fleetservice');
		} else {
			return $button_text;
		}
}
add_filter( 'tm_woocompare_dismiss_icon', 'fleet_delete_item_icon' );
function fleet_delete_item_icon($icon_html) {
	$result = '<i class="ftinvwl ftinvwl-times"></i>';
	return $result;
}

/*******************
*Single product page
*******************/

add_filter( 'woocommerce_display_product_attributes', 'fleet_remove_attribs_links',1,2);
function fleet_remove_attribs_links($product_attributes, $product){

	foreach($product_attributes as $key => $product_attribute) {
		$product_attributes[$key]['value'] = strip_tags( $product_attribute['value']);
	}
	return $product_attributes;
} 

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

add_action('woocommerce_single_product_summary','fleet_single_product_brand', 6);
function fleet_single_product_brand() {
      $brands = wp_get_post_terms( get_the_ID(), 'pwb-brand');

      if( !is_wp_error( $brands ) ){

          if( sizeof( $brands ) > 0 ){

            $show_as = 'brand_image';

            if( $show_as!='no' ){

              do_action( 'pwb_before_single_product_brands', $brands );
              echo '<div class="brand_wrap">';
			  echo '<div class="single-product-brand-label">'.__('Производитель:','fleetservice').'</div>';
              echo '<div class="pwb-single-product-brands pwb-clearfix">';
              foreach( $brands as $brand ){
              		if ($brand->parent !=0 ) continue;
                  $brand_link = get_term_link ( $brand->term_id, 'pwb-brand' );
                  $attachment_id = get_term_meta( $brand->term_id, 'pwb_brand_image', 1 );

                  $image_size = 'thumbnail';
                  $image_size_selected = get_option('wc_pwb_admin_tab_brand_logo_size');
                  if($image_size_selected!=false){
                      $image_size = $image_size_selected;
                  }

                  $attachment_html = wp_get_attachment_image($attachment_id,$image_size);

                  if( !empty($attachment_html) && $show_as=='brand_image' || !empty($attachment_html) && !$show_as ){
                    echo '<a href="'.$brand_link.'" title="'.$brand->name.'">'.$attachment_html.'</a>';
                  }else{
                    echo '<a href="'.$brand_link.'" title="'.__( 'View brand', 'perfect-woocommerce-brands' ).'">'.$brand->name.'</a>';
                  }
              }
              echo '</div>';
              echo '</div>';

              do_action( 'pwb_after_single_product_brands', $brands );

            }

          }

      }

  }

add_action('woocommerce_single_product_summary','fleet_single_wishlist_lnk',8);
function fleet_single_wishlist_lnk(){
	$args = array();
	if (function_exists('tm_woocompare_add_button_loop')) {
		tm_woocompare_add_button_loop($args);
	}
	echo do_shortcode("[ti_wishlists_addtowishlist loop=yes]");
}
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
add_action('woocommerce_single_product_summary','fleet_single_sku',9 );
function fleet_single_sku(){ 
	global $product;?>
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
	<div class="product_meta">
		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : ''; ?></span></span>
	</div>
	<?php endif; ?>
<?php }
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_before_add_to_cart_quantity', 'fleet_buy_buttons_wrap_open', 99 );
function fleet_buy_buttons_wrap_open(){ ?>
	<div class="buy_block">
<?php }

add_action( 'woocommerce_after_add_to_cart_button', 'fleet_buy_in_1_click', 1 );
function fleet_buy_in_1_click(){ ?>
	<span class="oneclick_wrap">
	<a href="#modalOneClick" class="button btn_brd_light-blue-green oneclickbuy" data-toggle="modal"><?php _e('Купить в 1 клик','fleetservice'); ?></a>
</span><span>
	</div><!--/.buy_block-->
<?php }

if (function_exists('tm_woocompare_add_button_single')) {
	remove_action( 'woocommerce_single_product_summary', 'tm_woocompare_add_button_single', 35 );
}

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

/*Получение цены на выбранный товар для формы заказа в 1 клик*/
add_action( 'wp_ajax_get_product_price', 'get_product_price_callback' );
add_action('wp_ajax_nopriv_get_product_price', 'get_product_price_callback');
function get_product_price_callback(){
	if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
		echo '';
		wp_die();
	}

	//$result['product_price'] = get_post_meta($_POST['product_id'],'_price',true).' '.get_woocommerce_currency_symbol();
	$result['product_price'] = strip_tags(wc_price(get_post_meta($_POST['product_id'],'_price',true)));
	$result['product_quantity'] = (isset($_POST['quantity']))?$_POST['quantity']:'';
	$result['product_sku'] = get_post_meta($_POST['product_id'],'_sku',true);
	$product_post = get_post($_POST['product_id']);
	$result['product_title'] = $product_post->post_title;
	$result['product_url'] = get_permalink($_POST['product_id']);
	$result = json_encode($result);
	echo $result;
	wp_die();
}
add_action( 'wp_enqueue_scripts', 'boc_ajax_data', 1999 );
function boc_ajax_data(){
	wp_localize_script( 'common-js', 'bocajax', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);  
}

add_action('wp_footer', 'my_action_javascript', 99); // для фронта
function my_action_javascript() {
	?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {

		jQuery(document).on('click', '.oneclick_wrap', function(e){
			var product_id ='';
			if (jQuery('form.variations_form.cart').length>0) {
				product_id = jQuery('form.cart input[name=variation_id]').val();
			} else {
				product_id = jQuery('form.cart button[name=add-to-cart]').val();
			}
			var quantity = $('form.cart input[name=quantity]').val();
			var product_price = '';
	    
			var data = {
				action: 'get_product_price',
				product_id: product_id,
				quantity: quantity
			};

			jQuery.post( bocajax.url, data, function(response) {
				var features = jQuery.parseJSON(response);
				let minimum2buy = <?php echo get_option( 'fleet_min_cart_total' ); ?>;
				let price = features['product_price'].split('&')[0];
				 if (features['product_quantity'] * price < minimum2buy) {
				 		if (document.querySelector(".woocommerce-error") === null) {
				 			$('.form_one_click').prepend( '<ul class="woocommerce-error" role="alert"><li>Вам нужно указать товара на сумму минимум 2000.</li></ul>' );
				 		}
				 } else {
				 		$('.form_one_click .woocommerce-error').remove();
				 }
				console.log('minimum2buy=' + minimum2buy);
				console.log('product_price  = ' + price);

				//Заполняем скрытые поля формы для формирования тела письма
				$('form#oneclickform input[name="product-title"]').val(features['product_title']);
				$('form#oneclickform input[name="product-quantity"]').val(features['product_quantity']);
				$('form#oneclickform input[name="product-price"]').val(features['product_price']);
				$('form#oneclickform input[name="product-sku"]').val(features['product_sku']);
				$('form#oneclickform input[name="product-url"]').val(features['product_url']);
				//Формируем строку о заказе для всплывающего окна
				var order_text = features['product_title'] + ', Количество: '+ features['product_quantity'] + ', Цена: ' + features['product_price'];
				$('#modalOneClick div.wpcf7 .order_product_title').html(order_text);
				$('#modalOneClick .sku_wrapper .sku').html(features['product_sku']);
				$.magnificPopup.close();
	        });
		});
	});
	</script>
	<?php
}

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

add_filter( 'wc_product_enable_dimensions_display','fleet_disable_dimensions_display');
function fleet_disable_dimensions_display($flag){
        return false;
}

add_filter( 'woocommerce_product_related_posts_relate_by_tag', 'fleet_related_posts_by_tag_remove', 1,2 );
function fleet_related_posts_by_tag_remove($flag, $product_id) {
	return false;
}

/*******************
*Myaccount page
*******************/
function fix_request_query_args_for_woocommerce( $query_args ) {
        if ( isset( $query_args['post_status'] ) && empty( $query_args['post_status'] ) ) {
                unset( $query_args['post_status'] );
        }
        return $query_args;
}
add_filter( 'request', 'fix_request_query_args_for_woocommerce', 1, 1 );

add_filter( 'woocommerce_my_account_my_orders_query', 'fleet_my_account_orders', 10, 1 );
function fleet_my_account_orders( $args ) {

    $args['posts_per_page'] = -1;
    return $args;
}

add_action( 'woocommerce_before_account_navigation','fleet_before_account_navigation',1 );
function fleet_before_account_navigation(){
	echo '<div class="aside_title"><span>'.__('Меню','fleetservice').'</span></div>';
}
add_action( 'woocommerce_account_content','fleet_myaccount_title',1 );
function fleet_myaccount_title(){
	if ( is_wc_endpoint_url( 'view-order' ) ) {
        $title = __( 'Orders', 'woocommerce' );   
    }
    else if ( is_wc_endpoint_url( 'edit-account' ) ) {
        $title = __( 'Account details', 'woocommerce' ); 
    }
    else if ( is_wc_endpoint_url( 'edit-address' ) ) {
        $title =__( 'Addresses', 'woocommerce' ); 
    }
    else if ( is_wc_endpoint_url( 'mailing' ) ) {
        $title =__( 'Рассылки','fleetservice' ); 
    }    
    else {
    	$title = get_the_title();
    }
	echo '<h1 class="entry-title">'. $title.'</h1>';
}
add_filter( 'woocommerce_my_account_my_orders_columns', 'fleet_my_order_columns');
function fleet_my_order_columns($order_table_columns) {
	$temp_str = $order_table_columns['order-actions'];
	unset($order_table_columns['order-actions']);
	$order_table_columns['order-actions'] = $temp_str;
	return $order_table_columns;

}
// Add Link (Tab) to My Account menu
add_filter ( 'woocommerce_account_menu_items', 'misha_log_history_link', 40 );
function misha_log_history_link( $menu_links ){

	$menu_links['edit-address'] = __( 'Addresses', 'woocommerce' );
 
	$menu_links = array_slice( $menu_links, 0, 4, true ) 
	+ array( 'mailing' => __( 'Рассылки','fleetservice' ))
	+ array_slice( $menu_links, 4, NULL, true );
 
	return $menu_links;
 
}
// Register Permalink Endpoint
add_action( 'init', 'fleet_add_endpoint' );
function fleet_add_endpoint() {
 
	// WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
	add_rewrite_endpoint( 'mailing', EP_PAGES );
 
}
// woocommerce_account_{ENDPOINT NAME}_endpoint
add_action( 'woocommerce_account_mailing_endpoint', 'fleet_my_account_endpoint_content' );
function fleet_my_account_endpoint_content() { ?>
 
	<p><?php _e('Здесь Вы можете управлять подпиской по каждому виду рассылок, отписаться или подключить любую из них.','fleetservice'); ?></p>

	<?php echo do_shortcode( '[mailpoet_manage_subscription]');
 
}

remove_action ( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );
add_action ( 'woocommerce_order_details_after_customer_details', 'woocommerce_order_again_button' );

add_filter( 'woocommerce_billing_fields', 'fleet_remove_required', 999);
function fleet_remove_required($fields) {
	if (is_page('my-account')) {
		unset($fields['billing_myfield18']);
	}
	$nonce_value = wc_get_var( $_REQUEST['woocommerce-edit-address-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

	if ( ! wp_verify_nonce( $nonce_value, 'woocommerce-edit_address' ) ) {
			return $fields;
	}
    foreach ($fields as $field_id => $field) {
      	if (!empty($field['conditional']) && !empty($field['conditional_parent_key']) && ($field['conditional_parent_key'] != $field['key'])) {
        // Unset if parent is disabled
        // -----------------------------------------------------------------
	        if (empty($fields[$field['conditional_parent_key']])) {
	          unset($fields[$field['key']]);
	          continue;
	        }
	        // Remove required
	        // -----------------------------------------------------------------
	        // On save
	        if ((!isset($_POST[$field['conditional_parent_key']]) || !isset($field['conditional_parent_value']) || !array_intersect((array) $field['conditional_parent_value'], (array) $_POST[$field['conditional_parent_key']]))) {
	          // Remove required attribute for hidden child fields
	          $field['required'] = false;
	          // Don't save hidden child fields in order
	          unset($fields[$field['key']]);
	          unset($_POST[$field['key']]);
	        }
    	} 
	}
  	return $fields;
}
add_action( 'woocommerce_after_save_address_validation', 'agogo_save_address_validation',1,4);
function agogo_save_address_validation($user_id, $load_address, $address, $customer ){
	if ('billing' == $load_address) {   
        $inn = $_POST['billing_myfield13'];
        if ($inn && strlen($inn)!=10 && strlen($inn)!=12 ) {
        // your function's body above, and if error, call this wc_add_notice
        wc_add_notice( __( 'ИНН должен содержать 10 или 12 цифр.' ), 'error' );
    	}
        $kpp = $_POST['billing_myfield14'];
        if ($kpp && strlen($kpp)!=9 ) {
        // your function's body above, and if error, call this wc_add_notice
        wc_add_notice( __( 'КПП должен содержать 9 цифр.' ), 'error' );
    	}
    	$rs = $_POST['billing_myfield16'];
        if ($rs && strlen($rs)!=20 ) {
        // your function's body above, and if error, call this wc_add_notice
        wc_add_notice( __( 'Р/с должен содержать 20 цифр.' ), 'error' );
    	}
    	$kors = $_POST['billing_myfield17'];
        if ($kors && strlen($kors)!=20 ) {
        // your function's body above, and if error, call this wc_add_notice
        wc_add_notice( __( 'Корр/с должен содержать 20 цифр.' ), 'error' );
        }
	}

}

/*******************
* Checkout page
*******************/

/*Ограничение на минимальную сумму заказа*/
//add_action( 'woocommerce_before_cart' , 'fleet_minimum_order_amount' );
//add_action( 'woocommerce_before_checkout_form_cart_notices', 'fleet_minimum_order_amount');
add_action( 'woocommerce_check_cart_items', 'fleet_minimum_order_amount' );
function fleet_minimum_order_amount() {
    $minimum = get_option( 'fleet_min_cart_total' );

    if ( $minimum && WC()->cart->cart_contents_total < $minimum) {
    	wc_clear_notices();
      wc_print_notice( 
          sprintf( 'Вам нужно положить в корзину товара на сумму минимум %s.' , 
              $minimum, 
          ), 'error' 
      );
    } else {
    	//wc_clear_notices();
    }
}

add_filter( 'woocommerce_get_settings_products', 'fleet_add_settings', 10, 2 );
 
function fleet_add_settings( $settings, $current_section ) {
 
	if ( 'advanced' === $current_section ) {
 
		$settings[] = array(
			'name' => 'Условия для оформления заказа',
			'type' => 'title'
		);

		$settings[] = array(
			'name'     => 'Минимальная стоимость заказа',
			'desc_tip' => 'Если сумма заказа меньше, то заказ оформить нельзя',
			'id'       => 'fleet_min_cart_total',
			'type'     => 'number',
			'css'      => 'max-width:100px;',
		);

		$settings[] = array(
			'type' => 'sectionend'
		);		
 
	}
 
	return $settings;
 
}



//add_action( 'woocommerce_review_order_after_order_total','fleet_shipping_text',10 );
function fleet_shipping_text(){
	echo '<div id="shipping_cost_text">';
	echo '<p>При сумме заказа <3000 руб. доступен только самовывоз.</p>
<p>При сумме заказа >3000 руб. доступен способ «Доставка заказа».</p>
<p>При сумме заказа >9000 руб. доставка внутри МКАД- бесплатно.</p>
<p>При сумме <9000 р. стоимость доставки внутри МКАД - 800 р.</p>
<p>При любой сумме заказа за пределами МКАД первые 1 О км - 100 р., если
больше 10 км, то 25 р./км.</p>';
	echo '</div>';
}
add_filter("woocommerce_checkout_fields", "custom_override_checkout_fields", 1);
function custom_override_checkout_fields($fields) {
    $fields['billing']['billing_first_name']['priority'] = 14;
    $fields['billing']['billing_last_name']['priority'] = 15;
    $fields['billing']['billing_company']['priority'] = 16;	
    $fields['billing']['billing_city']['priority'] = 17;	
    $fields['billing']['billing_address_1']['priority'] = 18;
    $fields['billing']['billing_address_2']['priority'] = 19;
    return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'custom_override_default_locale_fields' );
function custom_override_default_locale_fields( $fields ) {
    $fields['billing_first_name']['priority'] = 14;
    $fields['billing_last_name']['priority'] = 15;
    $fields['billing_company']['priority'] = 16;		
    $fields['city']['priority'] = 17;
    $fields['address_1']['priority'] = 18;
    $fields['address_2']['priority'] = 19;
    return $fields;
}

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( $_POST['billing_myfield12'] == "Физическое лицо" ) {
        add_filter( 'woocommerce_checkout_fields' , 'remove_required_attr',1 );
        function remove_required_attr($fields){
        	$fields['billing']['billing_company']['required'] = false;
        	$fields['billing']['billing_myfield13']['required'] = false;//ИНН
        	$fields['billing']['billing_myfield14']['required'] = false;//КПП
        	$fields['billing']['billing_myfield15']['required'] = false;//Банк
        	$fields['billing']['billing_myfield16']['required'] = false;//Р/с
        	$fields['billing']['billing_myfield17']['required'] = false;//Корр./с
					return $fields;
        }
        return;
    }
    $inn = $_POST['billing_myfield13'];
    if (strlen($inn)!=10 && strlen($inn)!=12 ) {
    // your function's body above, and if error, call this wc_add_notice
    wc_add_notice( __( 'ИНН должен содержать 10 или 12 цифр.' ), 'error' );
	}
    $kpp = $_POST['billing_myfield14'];
    if (strlen($kpp)!=9 ) {
    // your function's body above, and if error, call this wc_add_notice
    wc_add_notice( __( 'КПП должен содержать 9 цифр.' ), 'error' );
	}
	$rs = $_POST['billing_myfield16'];
    if (strlen($rs)!=20 ) {
    // your function's body above, and if error, call this wc_add_notice
    wc_add_notice( __( 'Р/с должен содержать 20 цифр.' ), 'error' );
	}
	$kors = $_POST['billing_myfield17'];
    if (strlen($kors)!=20 ) {
    // your function's body above, and if error, call this wc_add_notice
    wc_add_notice( __( 'Корр/с должен содержать 20 цифр.' ), 'error' );
	}	
}

add_filter( 'woocommerce_package_rates', 'custom_package_rates', 10, 2 );
function custom_package_rates( $rates, $package ) {

    $billing_city = WC()->customer->get_shipping_city();

    if( empty($billing_city)) {
        unset( $rates['moscow_shipping:5'] );
    }

    // etc add the remaining condition

    return $rates;
}
add_filter( 'woocommerce_terms_is_checked_default', '__return_true' );

add_action( 'woocommerce_before_checkout_registration_form', 'fleet_registration_comment' );
function fleet_registration_comment () {
	$custom_field = get_option("registration_comment", 1);
	if ($custom_field) {
		echo '<p>'.$custom_field.'</p>';
	}
}

function registration_comment($settings) {
	$updated_settings = array();
	foreach($settings as $section) {
		if(isset($section["id"]) && "general_options" == $section["id"] && isset($section["type"]) && "sectionend" == $section["type"]) {
			$updated_settings[] = array(
				"name" => "Комментарий к регистрации", // Название поля
				"desc_tip" => "", // Подсказка при наведении
				"id" => "registration_comment", // Уникальный ID
				"type" => "textarea", // Тип поля
				"css" => "min-width: 300px;", // Стили
				"std" => "",
				"default" => "1",
				"desc" => "Выводится на странице оформления заказа, если пользователь отметил опцию регистрации" // Описание поля (инструкция по заполнению)
			);
		}
		$updated_settings[] = $section;
	}
	return $updated_settings;
}

add_filter("woocommerce_general_settings", "registration_comment");

add_filter( 'woocommerce_create_account_default_checked', function( $isChecked) { return true; } );

/*******************
* Additional functions
*******************/
//add_action( 'woocommerce_update_product', 'fleet_set_tag_on_product_save', 10, 1 );
function fleet_set_tag_on_product_save( $product_id ) {
	$cur_product_tags = array();
	$term_list = array();
    $product = wc_get_product( $product_id );
    $otel = array (93,211,407,619,1016,1763,1392,118,1633,37,38);//2400
    $nedvizhimost_i_klining = array(93,211,407,619,1633,37,1878);//2401
    $proizvodstvo = array(93,211,619,118,1633,1878,1445,748);//2407
	$restoran_kuhnya = array(93,211,407,619,118,1878,182);//2403
	$avtoprom = array(93,407,619,118,37,1878,748);//2404
	$meditsina = array(93,211,407,619,1878,1514);//2405
	$sport_i_fitnes = array(93,211,407,619,1763,1015);//2406
	$term_children_list = wp_get_post_terms( $product_id, 'product_cat', array('fields' => 'ids') );	
	foreach ($term_children_list as $term_child)
		$term_id = $term_child;
		while( $parent_id = wp_get_term_taxonomy_parent_id( $term_id, 'product_cat' ) ){
			$term_id = $parent_id;
		}
		$term_list[] = $term_id;
    
	foreach ($term_list as $cur_cat) {
		if (in_array($cur_cat, $otel )) {
			$cur_product_tags[] = 2400;
		}
		if (in_array($cur_cat, $otel )) {
			$cur_product_tags[] = 2401;
		}
		if (in_array($cur_cat, $nedvizhimost_i_klining )) {
			$cur_product_tags[] = 2407;
		}
		if (in_array($cur_cat, $proizvodstvo )) {
			$cur_product_tags[] = 2403;
		}
		if (in_array($cur_cat, $avtoprom )) {
			$cur_product_tags[] = 2404;
		}
		if (in_array($cur_cat, $meditsina )) {
			$cur_product_tags[] = 2405;
		}	
		if (in_array($cur_cat, $sport_i_fitnes )) {
			$cur_product_tags[] = 2406;
		}	

	}
	if ($cur_product_tags) {
		wp_set_post_terms( $product_id, $cur_product_tags, 'product_tag', 'false' );
	}
}
add_shortcode( 'top-level-brands', 'top_level_brands_shortcode' );
add_shortcode( 'brands-on-frontpage', 'top_level_brands_shortcode_4_frontpage' );
add_shortcode( 'top-level-brands-list', 'top_level_brands_list_shortcode' );



//Ajax Обновление кратких данных из корзины
add_filter( 'woocommerce_add_to_cart_fragments', 'fleet_minicart_fragment' );

function fleet_minicart_fragment( $fragments ) {
	// Миникорзина в шапке - для дескотопов
	ob_start();
	?>

	<?php $cart_contents_count = WC()->cart->get_cart_contents_count(); 
	$cart_contents_sum = WC()->cart->get_cart_subtotal( );
	$products_count = 0; //Количество товарных позации (в общем случае отличается от общего количества штук всех товаров в корзине)
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $products_count++;
    }
	?>
	<a href="<?php echo get_permalink( get_option('woocommerce_cart_page_id') ); ?>" class="minicart cart-contents"><span class="d-none d-sm-inline">(<?php echo $products_count; ?>) : <?php echo $cart_contents_sum; ?></span></a>
	<?php
	$fragments['a.cart-contents'] = ob_get_clean();

	// Миникорзина в футере - для мобильных
	ob_start(); 
	?>

						<a class="bottom_navbar__link bottom_navbar__link--minicart" href="<?php echo get_permalink( get_option('woocommerce_cart_page_id') ); ?>">
              <span class="bottom_navbar__quantity"><?php echo $products_count; ?></span>

              <svg class="bottom_navbar__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none">
                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667" clip-path="url(#a)">
                  <path d="M8 16.667a.833.833 0 1 0 0 1.666.833.833 0 0 0 0-1.666Zm9.167 0a.833.833 0 1 0 0 1.667.833.833 0 0 0 0-1.667ZM1.333.833h3.334L6.9 11.992a1.667 1.667 0 0 0 1.667 1.341h8.1a1.666 1.666 0 0 0 1.666-1.341L19.667 5H5.5"></path>
                </g>
                <defs>
                  <clipPath id="a">
                    <path fill="currentColor" d="M.5 0h20v20H.5z"></path>
                  </clipPath>
                </defs>
              </svg>

              <div class="bottom_navbar__txt"><?php _e( 'Cart', 'woocommerce' ); ?></div>
            </a>
  <?php
  	$fragments['a.bottom_navbar__link--minicart'] = ob_get_clean();
	return $fragments;
}


//Добавление колонки с id изображения в таблицу медиафайлов в админке для облегчения
//поиска прикрепленных к заказу карточек клиентов
function fleet_column_id($columns) {
    $columns['colID'] = __('ID');
    return $columns;
}
add_filter( 'manage_media_columns', 'fleet_column_id' );
function fleet_column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_media_custom_column', 'fleet_column_id_row', 10, 2 );
add_filter('manage_edit-media_sortable_columns', 'fleet_add_id_sortable_column');
function fleet_add_id_sortable_column($sortable_columns){
  $sortable_columns['colID'] = 'views_views';
  return $sortable_columns;}

if (function_exists('wcmmq_s_set_min_qt_in_shop_loop')) {
add_filter('woocommerce_loop_add_to_cart_link','wcmmq_s_set_min_qt_in_shop_loop',10,3);
}

function fleet_wc_remove_password() {
	if(wp_script_is("wc-password-strength-meter", "enqueued")) {
	
		wp_dequeue_script("wc-password-strength-meter"); 		
	}	
}
add_action( 'wp_print_scripts', 'fleet_wc_remove_password', 100);

add_filter( 'woocommerce_formatted_address_replacements', 'fleet_formatted_address_replacements', 10, 2 );
function fleet_formatted_address_replacements( $address, $args ) {
	$address['{email}'] = '';
	$address['{phone}'] = '';
    $address['{payer}'] = '';
    $address['{company}'] = '';
    /*$address['{ur_address}'] = '';*/
    /*$address['{fact_address}'] = '';*/
    /*$address['{bik}'] = '';*/
    $address['{inn}'] = '';
    $address['{kpp}'] = '';
    $address['{rs}'] = '';
    $address['{kors}'] = '';
    $address['{bank}'] = '';

    if ($address['{name}'] && !empty( $args['payer'] )) {
        $address['{name}'] = __('ФИО','fleetservice').": ".$address['{name}'];
    }
    if (!empty($args['email']) ) {
        $address['{email}'] = __('Email','woocommerce').": ".$args['email'];
    } 
    if (!empty($args['phone']) ) {
        $address['{phone}'] = __('Phone','woocommerce').": ".$args['phone'];
    }      
    if ($address['{address_1}']) {
        $address['{address_1}'] = esc_html__('Улица, дом', 'woocommerce') . ": ".$address['{address_1}'];
    }
    if ($address['{address_2}']) {
        $address['{address_2}'] = esc_html__('Квартира/офис', 'woocommerce') . ": ".$address['{address_2}'];
    }
    if ($address['{state}']) {
        $address['{state}'] = esc_html__('Region', 'woocommerce') . ": ".$address['{state}'];
    }
    if ($address['{city}']) {    
        $address['{city}'] = esc_html__('City', 'woocommerce') . ": ".$address['{city}'];
    }
    if ($address['{country}'] && !empty( $args['state'] )) {     
        $address['{country}'] = esc_html__('Country', 'woocommerce-checkout-manager') . ": ".$address['{country}'];
    } else {
        $address['{country}'] = '';
    }
    
   	if ( !empty( $args['payer'] ) && ( 'Физическое лицо' ==  $args['payer'])) {
        $address['{payer}'] = esc_html__('Плательщик', 'fleetservice') . ": ".$args['payer'];
        return $address;
    } 
    if ( !empty( $args['payer'] ) && ( 'Юридическое лицо' ==  $args['payer']))  {
        $address['{payer}'] = esc_html__('Плательщик', 'fleetservice') . ": ".$args['payer'];
    }
    if ( ! empty( $args['company'] && ('Юридическое лицо'==  $args['payer'])) ) {
        $address['{company}'] = esc_html__('Компания', 'fleetservice') . ': '.$args['company'];
    }  
    if ( ! empty( $args['ur_address'] ) ) {
        $address['{ur_address}'] = esc_html__('Юридический адрес', 'fleetservice') . ': '.$args['ur_address'];
    } 
    if ( ! empty( $args['fact_address'] ) ) {
        $address['{fact_address}'] = esc_html__('Фактический', 'fleetservice') . ': '.$args['fact_address'];
    } 
    /*if ( ! empty( $args['bik'] ) ) {
        $address['{bik}'] = esc_html__('БИК', 'fleetservice') . ': '.$args['bik'];
    }*/
    if ( ! empty( $args['inn'] ) ) {
        $address['{inn}'] = esc_html__('ИНН', 'fleetservice') . ": ".$args['inn'];
    }
    if ( ! empty( $args['kpp'] ) ) {
        $address['{kpp}'] = esc_html__('КПП', 'fleetservice') . ": ".$args['kpp'];
    }     
    if ( ! empty( $args['rs'] ) ) {
        $address['{rs}'] = esc_html__('Расчетный/с', 'fleetservice') . ": ".$args['rs'];
    }        
    if ( ! empty( $args['kors'] ) ) {
        $address['{kors}'] = esc_html__('Корр/с', 'fleetservice') . ": ".$args['kors'];
    }    
    if ( ! empty( $args['bank'] ) ) {
        $address['{bank}'] = esc_html__('Банк', 'fleetservice') . ": ".$args['bank'];
    }

    return $address;
}

add_filter( 'woocommerce_my_account_my_address_formatted_address', 'custom_my_account_my_address_formatted_address', 10, 3 );
function custom_my_account_my_address_formatted_address( $fields, $customer_id, $type ) {
    if ( $type == 'billing' && (0 == get_user_meta( $customer_id, 'billing_myfield12', true )) ) {
        $fields['payer'] = get_user_meta( $customer_id, 'billing_myfield12', true );
        $fields['email'] = get_user_meta( $customer_id, 'billing_email', true );
        $fields['phone'] = get_user_meta( $customer_id, 'billing_phone', true );
        $fields['company'] = get_user_meta( $customer_id, 'billing_company', true );
        /*$fields['ur_address'] = get_user_meta( $customer_id, 'billing_wooccm12', true );*/
        /*$fields['fact_address'] = get_user_meta( $customer_id, 'billing_wooccm13', true );*/
        /*$fields['bik'] = get_user_meta( $customer_id, 'billing_wooccm15', true );*/
        $fields['inn'] = get_user_meta( $customer_id, 'billing_myfield13', true );
        $fields['kpp'] = get_user_meta( $customer_id, 'billing_myfield14', true );
        $fields['rs'] = get_user_meta( $customer_id, 'billing_myfield16', true );
        $fields['kors'] = get_user_meta( $customer_id, 'billing_myfield17', true );
        $fields['bank'] = get_user_meta( $customer_id, 'billing_myfield15', true );
    }
    if ( $type == 'shipping' ) {
        unset($fields['first_name']);
        unset($fields['last_name']);
        unset($fields['name']);
    }
    return $fields;
}

add_filter( 'woocommerce_localisation_address_formats', 'agogo_woocommerce_custom_address_format' );     
function agogo_woocommerce_custom_address_format( $formats ) {
    $formats[ 'RU' ]  = "{name}\n";
    /*$formats[ 'RU' ]  = "{email}\n";
    $formats[ 'RU' ]  = "{phone}\n";*/
    $formats[ 'RU' ] .= "{country}\n";
    $formats[ 'RU' ] .= "{state}\n";
    $formats[ 'RU' ] .= "{city}\n";
    $formats[ 'RU' ] .= "{address_1}\n";
    $formats[ 'RU' ] .= "{address_2}\n";
    $formats[ 'RU' ] .= "{payer}\n";
    $formats[ 'RU' ] .= "{company}\n";
    /*$formats[ 'RU' ] .= "{ur_address}\n";*/
    /*$formats[ 'RU' ] .= "{fact_address}\n";*/
    $formats[ 'RU' ] .= "{bank}\n";
    /*$formats[ 'RU' ] .= "{bik}\n";   */
    $formats[ 'RU' ] .= "{inn}\n";
    $formats[ 'RU' ] .= "{kpp}\n";    
    $formats[ 'RU' ] .= "{rs}\n";
    $formats[ 'RU' ] .= "{kors}\n";
    return $formats;
}

/*********
* Cart
********/

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

add_filter( 'woocommerce_cross_sells_columns', 'fleet_change_cross_sells_columns' );
function fleet_change_cross_sells_columns( $columns ) { return 4; }

add_filter( 'woocommerce_cross_sells_total', 'fleet_change_cross_sells_product_no' );
  
function fleet_change_cross_sells_product_no( $columns ) {
return 12;
}


//add_filter( 'woocommerce_stock_html', 'ouput_instock_status', 10, 3);
function ouput_instock_status( $html, $availability, $product ){
	if ( $product->get_stock_status() == 'instock' && !$html) {
		$html = '<p class="stock instock">'.__('В наличии','fleetservice').'</p>';
	}
	return $html;
}

/* Добавление настроек для комментариев к статусам остатка в карточке товара */
add_filter( 'woocommerce_get_settings_products', 'add_statuses_comments_settings', 10, 2 );
 
function add_statuses_comments_settings( $settings, $current_section ) {
 
	if ( 'inventory' === $current_section ) {
 
		// заголовок
		$settings[] = array(
			'name' => 'Настройки комментариев к статусам остатка для карточки товара',
			'type' => 'title',
			'desc' => 'Настройки плагина для WooCommerce'
		);
 
		$settings[] = array(
			'name'     => 'Комментарий для статуса "Есть в наличии"',
			'desc_tip' => '',
			'id'       => 'instock_comment',
			'type'     => 'textarea',
		);
 
		$settings[] = array(
			'name'     => 'Комментарий для статуса "Нет в наличии"',
			'desc_tip' => '',
			'id'       => 'outofstock_comment',
			'type'     => 'textarea',
		);
 
		$settings[] = array(
			'name'     => 'Комментарий для статуса "В невыполненом заказе"',
			'desc_tip' => '',
			'id'       => 'inbackorder_comment',
			'type'     => 'textarea',
		);
 
	}
 
	return $settings;
 
}

add_filter( 'woocommerce_get_stock_html', 'output_stock_status_comment', 10, 2  );
function output_stock_status_comment($html, $product) {
	  $status = $product->get_stock_status();
	  $status_comment = '';
  switch( $status ) {
    case 'outofstock':
			$status_comment = get_option( 'outofstock_comment' );
			break;
    case 'onbackorder':
    	$status_comment = get_option( 'inbackorder_comment' );
      break;
    case 'instock':
    	$status_comment = get_option( 'instock_comment' );
      break;
  }
  	if ($status_comment) {
  		$status_comment = '<p>'.$status_comment.'</p>';
  	}
	return $html.$status_comment;
}


/*Прикрепление pdf-счета к письму о заказе по условию*/
add_filter( 'wpo_wcpdf_get_document_file', 'attach_pdf_to_email_by_condition', 99, 3);
function attach_pdf_to_email_by_condition( $file_path, $document, $output_format ){
	$order = wc_get_order( $document->order_id );
	$not_in_stock = false;

	//Проверяем наличие товаров заказа на складе
	$order_items           = $order->get_items();
	foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();
				if (!$product->is_in_stock()) {
					$not_in_stock = true;
					break;
				}
	}

	//Определяем, на какое лицо оформлен заказ
	$person = $order->get_meta( '_billing_myfield12', true );
	file_put_contents('/var/www/fleetservice.ru/www/wp-content/themes/fleetservice/inc/attach_pdf_to_email_by_condition.log',$person.PHP_EOL, FILE_APPEND);

	//Прикрепляем счет к заказу, если условие выполнено
	if ( $person == 'Юридическое лицо' || $not_in_stock ) {
		return '';
	} else {
		return $file_path;
	}
}
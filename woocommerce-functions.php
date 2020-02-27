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
add_action( 'woocommerce_before_shop_loop_item_title','fleet_loop_img_wrap_open',5 );
function fleet_loop_img_wrap_open(){ ?>
	<div class="img_wrap">
<?php }

add_action( 'woocommerce_before_shop_loop_item_title','fleet_wrap_badge_open',6 );
function fleet_wrap_badge_open(){ ?>
	<div class="wrap_badge">
<?php }

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_new_flash', 7 );
function woocommerce_show_product_loop_new_flash() {
		wc_get_template( 'loop/new-flash.php' );
}

add_action( 'woocommerce_before_shop_loop_item_title','fleet_wrap_badge_close',10 );
function fleet_wrap_badge_close(){ ?>
	</div><!--/.wrap_badge-->
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
add_filter( 'tm_woocompare_dismiss_icon', 'fleet_delete_item_icon' );
function fleet_delete_item_icon($icon_html) {
	$result = '<i class="ftinvwl ftinvwl-times"></i>';
	return $result;
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

/*add_action( 'pwb_before_single_product_brands','fleet_single_product_brands_label');
function fleet_single_product_brands_label(){
	
}*/

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
	<a href="#modalOneClick" class="button btn_brd_light-blue-green oneclickbuy" data-toggle="modal"><?php _e('Купить в 1 клик','fleetservice'); ?></a>
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

/*******************
*My account page
*******************/
function fix_request_query_args_for_woocommerce( $query_args ) {
        if ( isset( $query_args['post_status'] ) && empty( $query_args['post_status'] ) ) {
                unset( $query_args['post_status'] );
        }
        return $query_args;
}
add_filter( 'request', 'fix_request_query_args_for_woocommerce', 1, 1 );
add_action( 'woocommerce_before_account_navigation','fleet_before_account_navigation',1 );
function fleet_before_account_navigation(){
	echo '<div class="aside_title"><span>'.__('Меню','fleetservice').'</span></div>';
}
add_action( 'woocommerce_account_content','fleet_myaccount_title',1 );
function fleet_myaccount_title(){
	echo '<h1 class="entry-title">'.get_the_title().'</h1>';
}
add_filter( 'woocommerce_my_account_my_orders_columns', 'fleet_my_order_columns');
function fleet_my_order_columns($order_table_columns) {
	$temp_str = $order_table_columns['order-total'];
	unset($order_table_columns['order-total']);
	$order_table_columns['order-total'] = $temp_str;
	return $order_table_columns;

}
// Add Link (Tab) to My Account menu
add_filter ( 'woocommerce_account_menu_items', 'misha_log_history_link', 40 );
function misha_log_history_link( $menu_links ){
 
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

/*******************
* Checkout page
*******************/
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

/*******************
* Additional functions
*******************/
//add_action( 'save_post', 'fleet_set_tag_on_product_save', 10, 1 );
add_action( 'woocommerce_update_product', 'fleet_set_tag_on_product_save', 10, 1 );
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
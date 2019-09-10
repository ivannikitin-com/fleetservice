<?php
function fleet_load_more_scripts() {
 
	global $wp_query; 
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'fleet_loadmore', get_stylesheet_directory_uri() . '/js/fleetloadmore.js', array('jquery'), null, true );
 
	/* we have to pass parameters to fleetloadmore.js script but we can get the parameters values only in PHP*/
	wp_localize_script( 'fleet_loadmore', 'fleet_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', 
		'posts' => json_encode( $wp_query->query_vars ), 
		'posts_per_page' => json_encode( $wp_query->query_vars['posts_per_page'] ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
	) );
 
 	wp_enqueue_script( 'fleet_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'fleet_load_more_scripts' );

function fleet_loadmore_ajax_handler(){
	global $wp_query;
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
			if (is_woocommerce()) {
				wc_get_template_part( 'content', 'product' );
			}
			if (is_category() && !is_woocommerce()) {
				get_template_part( 'template-parts/content', get_post_type() );
			}
			if (is_search() && !is_category() && !is_woocommerce()) {
				get_template_part( 'template-parts/content', 'search' );
			}		
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'fleet_loadmore_ajax_handler'); 
add_action('wp_ajax_nopriv_loadmore', 'fleet_loadmore_ajax_handler'); 
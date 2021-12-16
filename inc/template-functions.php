<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package fleetservice
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fleetservice_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'fleetservice_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fleetservice_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fleetservice_pingback_header' );
function phone_clean($phone){
	$phone= str_replace([' ', '(', ')', '-','<span>','</span>'], '', $phone);
	return $phone;
}
/**
 * Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
 */
add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});
add_filter( 'gettext', 'theme_change_translation', 20, 3 );
function theme_change_translation( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Цены: по возрастанию':
			$translated_text = 'Возрастанию цены';
            break;
		case 'Цены: по убыванию':
			$translated_text = 'Убыванию цены';
            break;
		case 'Товаров на странице: ':
			$translated_text = '';
            break;				
	}
	return $translated_text;
}
add_filter('excerpt_more', function($more) {
	return '';
});
add_filter('comment_form_default_fields', 'wp_url_remove');
function wp_url_remove($fields)
{
 if(isset($fields['url']))
 unset($fields['url']);
 return $fields;
}


add_action('template_redirect', 'redirect_single_post');
function redirect_single_post() {
	if (is_search()) {
		global $wp_query;
		if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
			wp_redirect(get_permalink($wp_query->posts['0']->ID));
			exit;
		}
	}
}
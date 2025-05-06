<?php
/**
 * fleetservice functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fleetservice
 */

add_theme_support( 'woocommerce' );

if ( ! function_exists( 'fleetservice_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fleetservice_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on fleetservice, use a find and replace
		 * to change 'fleetservice' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fleetservice', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'fleetservice' ),
			'menu-2' => esc_html__( 'Secondary', 'fleetservice' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'fleetservice_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'fleetservice_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fleetservice_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'fleetservice_content_width', 640 );
}
add_action( 'after_setup_theme', 'fleetservice_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fleetservice_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fleetservice' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'fleetservice' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	//register MegaMenu widget if the Mega Menu is set as the menu location
	$location = 'menu-1';
	$css_class = 'mega-menu-parent';
	$locations = get_nav_menu_locations();
	if ( isset( $locations[ $location ] ) ) {
	  $menu = get_term( $locations[ $location ], 'nav_menu' );
	  if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
	    foreach ( $items as $item ) {
	      if ( in_array( $css_class, $item->classes ) ) {
	        register_sidebar( array(
	          'id'   => 'mega-menu-item-' . $item->ID,
	          'description' => 'Mega Menu items',
	          'name' => $item->title . ' - Mega Menu',
	          'before_widget' => '<li id="%1$s" class="mega-menu-item">',
	          'after_widget' => '</li>', 

	        ));
	      }
	    }
	  }
	}
}
add_action( 'widgets_init', 'fleetservice_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fleetservice_scripts() {
	$dependencies = array('jquery');

	wp_enqueue_style( 'fleetservice-style', get_stylesheet_uri() );
	if (!is_admin()) {
		wp_register_style('google-opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&display=swap&subset=cyrillic-ext,latin-ext', array(), null, 'all');
		wp_enqueue_style('google-opensans');
		wp_register_style('google-opensanscondensed', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700&display=swap&subset=cyrillic-ext,latin-ext', array(), null, 'all');
		wp_enqueue_style('google-opensanscondensed');		
	}
	/*wp_enqueue_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array(), true );*/
	wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), true );
	
	/*wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/libs/bootstrap.min.js', array(), true );*/
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/libs/owl.carousel/dist/assets/owl.carousel.min.css');
	wp_enqueue_style( 'owl-default', get_template_directory_uri() . '/libs/owl.carousel/dist/assets/owl.theme.default.min.css');
	wp_enqueue_style( 'select2', plugins_url() . '/woocommerce/assets/css/select2.css',  null, false );
	wp_enqueue_style( 'metisMenu', get_template_directory_uri() . '/libs/metisMenu/metisMenu.min.css' );
	wp_enqueue_script( 'metisMenu', get_template_directory_uri() . '/libs/metisMenu/metisMenu.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/libs/owl.carousel/dist/owl.carousel.min.js', array('jquery'), null, true );
	if (is_category() || is_search() || is_woocommerce()) {
		wp_enqueue_script( 'imagesloaded');
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'imagesLoaded', get_template_directory_uri() . '/libs/imagesloaded.pkgd.min.js', array('jquery'), null, true );
		$dependencies[] = 'imagesloaded';
		$dependencies[] = 'masonry';

	}
	wp_enqueue_script( 'maskedinput', get_template_directory_uri() . '/libs/jquery.maskedinput.min.js', array('jquery'), null, true );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( !is_admin() ) { 
	   wp_deregister_script('jquery');
 	   //wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, false, true);
 	   wp_register_script('jquery', get_template_directory_uri() . '/libs/jquery.min.js', false, false, true); 	   
	   wp_enqueue_script('jquery');  
	}
	if (!is_page('checkout')) {
		wp_enqueue_script( 'select2', plugins_url() . '/woocommerce/assets/js/select2/select2.min.js', array('jquery'), null, true );
		$dependencies[] = 'select2';
	}

/*	if (is_front_page()) {
		wp_dequeue_script( 'slick' );
	}*/

	wp_enqueue_style( 'formstyler', get_template_directory_uri() . '/libs/jQueryFormstyler/jquery.formstyler.css' );
	wp_enqueue_style( 'formstylertheme', get_template_directory_uri() . '/libs/jQueryFormstyler/jquery.formstyler.theme.css' );		
	wp_enqueue_script( 'formstyler', get_template_directory_uri() . '/libs/jQueryFormstyler/jquery.formstyler.min.js', array('jquery'), null, true);
	$dependencies[] = 'formstyler';
	wp_enqueue_script( 'history', get_template_directory_uri() . '/libs/jquery.history.js', array('jquery'), null, true );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.css');	
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'number_input_value_validation', get_template_directory_uri() . '/js/ipq_input_value_validation.js', $dependencies, time(), true );		
	wp_enqueue_script( 'common-js', get_template_directory_uri() . '/js/common.js', $dependencies, time(), true );	
	if (!(is_woocommerce() || is_tax('pwb-brand'))) {
		wp_dequeue_style('prdctfltr-css');
	}
	//
	//wp_enqueue_style( 'modal',  $path . '/js-css/jquery.modal.min.css', array( ) );		
	wp_enqueue_style( 'fleetservice-main', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'fleetservice-additional', get_template_directory_uri() . '/css/additional.css' );
	if (is_account_page()) {
	   global $wp_version;

	    wp_enqueue_style('wooccm', plugins_url('/woocommerce-checkout-manager/assets/frontend/css/wooccm.css', null), false, null, 'all');

	    wp_enqueue_script('wooccm-checkout', plugins_url('/woocommerce-checkout-manager/assets/frontend/js/wooccm-checkout.js', null), array('jquery'), null, true);

	    wp_localize_script('wooccm-checkout', 'wooccm_upload', array(
	        'ajax_url' => admin_url('admin-ajax.php'),
	        'nonce' => wp_create_nonce('wooccm_upload'),
	        'limit' => array(
	            'max_file_size' => wp_max_upload_size(),
	            'max_files' => 4,
	        //'mime_types' => $this->get_mime_types(),
	        ),
	        'icons' => array(
	            'interactive' => site_url('wp-includes/images/media/interactive.png'),
	            'spreadsheet' => site_url('wp-includes/images/media/spreadsheet.png'),
	            'archive' => site_url('wp-includes/images/media/archive.png'),
	            'audio' => site_url('wp-includes/images/media/audio.png'),
	            'text' => site_url('wp-includes/images/media/text.png'),
	            'video' => site_url('wp-includes/images/media/video.png')
	        ),
	        'message' => array(
	            'uploading' => esc_html__('Uploading, please wait...', 'woocommerce-checkout-manager'),
	            'saving' => esc_html__('Saving, please wait...', 'woocommerce-checkout-manager'),
	            'success' => esc_html__('Files uploaded successfully.', 'woocommerce-checkout-manager'),
	            'deleted' => esc_html__('Deleted successfully.', 'woocommerce-checkout-manager'),
	        )
	    ));
	}
}
	
add_action( 'wp_enqueue_scripts', 'fleetservice_scripts' );

/*add_action('admin_enqueue_scripts', 'fleet_admin_js', 99);
 
function fleet_admin_js(){
	wp_enqueue_script('fleet-wp-admin', get_stylesheet_directory_uri() .'/js/admin-script.js', array('jquery'), null, true  );
}*/

add_action('admin_enqueue_scripts', 'fleet_early_admin_js', 1);
function fleet_early_admin_js(){
	wp_enqueue_script('early-wp-admin', get_stylesheet_directory_uri() .'/js/early-admin.js', array('jquery'), null, false  );
	wp_enqueue_script( 'select2', plugins_url() . '/woocommerce/assets/js/select2/select2.full.js', array('jquery'), null, true );
		$dependencies[] = 'select2';
}


function fleetservice_dequeue() {
	wp_dequeue_style('modal');
}

add_action( 'wp_head', 'fleetservice_dequeue', 9999 );

function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/perfect-woocommerce-brands/shortcodes/top_level_brands_shortcode.php';
require get_template_directory() . '/inc/woocommerce-functions.php';
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker-toggle-hover-open-click.php';
require get_template_directory() . '/inc/wp_bootstrap4-mega-navwalker.php';
require get_template_directory() . '/inc/loadmore.php';

add_filter( 'widget_text', 'do_shortcode' );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;        
}
class UL_Class_Walker extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth=0,  $args = array()) { 
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' );
	$display_depth=(int)$depth+2;
    $output .= "\n$indent<ul class=\"level_".$display_depth."\">\n";
  }
}

add_filter( 'walker_nav_menu_start_el','fleet_add_sub_menu_sign',1,4);   
function fleet_add_sub_menu_sign($item_output, $item, $depth, $args) {
	if (!($args->theme_location == 'menu-1' && $depth == 0)) {
		if(in_array('menu-item-has-children', $item->classes))
	    {
	      $item_output .= '<a href="#" class="my"><span class="dashicons dashicons-plus"></span></a>';
	    }
	}
	return $item_output;

}

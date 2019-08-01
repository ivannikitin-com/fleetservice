<?php
/**
 * Sidebar
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/sidebar.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>
<nav class="aside_menu clearfix" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<!--<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
						<span class="sr-only">Меню</span>
						<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
					</button>-->
					<div class="aside_title"><?php echo _e('Cataloge','fleetservice'); ?></div>
					<?php wp_nav_menu( array(
						'menu'				=> 'Catalog Menu',
						'depth'				=> 3, // 1 = with dropdowns, 0 = no dropdowns.
						'container'			=> 'div',
						'container_class'	=> '',
						'container_id'		=> 'sidebar-menu',
						'menu_class'		=> 'nav nav-stacked',
						'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
						'walker'			=> new WP_Bootstrap_Navwalker()
					) );?>
			</nav>
			<div class="aside_title"><?php echo _e('Filter','fleetservice'); ?><div>
<?php   get_sidebar( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

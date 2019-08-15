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
			<div class="aside_title"><?php echo _e('Cataloge','fleetservice'); ?></div>
			<nav class="aside_menu  navbar navbar-expand-lg" role="navigation">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
					<?php wp_nav_menu( array(
						'menu'				=> 'Catalog Menu',
						'depth'				=> 4, // 1 = with dropdowns, 0 = no dropdowns
						'container'			=> 'div',
						'container_class'	=> 'collapse navbar-collapse',
						'container_id'		=> 'sidebar-menu',
						'menu_class'		=> 'nav nav-stacked flex-column',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
						'walker'			=> new WP_Bootstrap_Navwalker()
					) );?>
			</nav>
			<?php if (is_shop() || is_tax('product_cat')) { ?>
			<div class="aside_title"><?php echo _e('Filter','fleetservice'); ?></div>
			<?php } ?>
<?php   get_sidebar( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fleetservice
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0 shrink-to-fit=no" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<?php  $class='';
if (is_page('kontakty')) { 
	$class='kontakty';
}
if (is_page('wishlist')) { 
	$class='fleet-wishlist'; 
}
?>
<body <?php body_class($class); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fleetservice' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row row_h">				
				<div class="site-branding col-3 col-sm-3 col-md-2 col-lg-2">
					<?php
					if ( is_front_page() ) :
						$logo_img = '';
						if( $custom_logo_id = get_theme_mod('custom_logo') ){
							$logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
								'class'    => 'custom-logo',
								'itemprop' => 'logo',
							) );
							echo $logo_img;
						}
						?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<?php
					else :
						the_custom_logo();?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif; ?>
				</div><!-- .site-branding -->
				
				<div class="col-9 col-sm-9 col-md-10 col-lg-10 col-xl-9 offset-xl-1 navbar-expand-lg wrap_right">
					<button class="navbar-toggler btn__navbarmain" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<nav class="navbar navbar-dark bg-dark nav-main">
						<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>-->
						
						<div class="row no-gutters">
							<div class="collapse navbar-collapse" id="navbarmain">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'container'   	=> '',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'navbar-nav mr-auto',
									'walker'  => new BootstrapNavMenuWalker()
								) );
								?>
							</div><!--/.collapse-->
						</div><!--/.row.no-gutters-->
					</nav><!--/.nav-main-->

					<div class="block-links">
						<div class="row no-gutters flex-nowrap align-items-center">
							<div class="col-auto col-lg-auto d-flex wrap_wishcompare">
								<a href="<?php echo get_theme_mod('wishist_url'); ?>" class="wishlist"><span class="d-none d-lg-inline"><?php _e('Избранное','fleetservice'); ?></span></a>
								<a href="<?php echo get_theme_mod('compare_url'); ?>" class="compare"><span class="d-none d-lg-inline"><?php _e('Сравнение','fleetservice'); ?></span></a>
							</div>
							<div class="col-auto col-lg-3 d-flex wrap_auth">
								<?php if (is_user_logged_in()) { 
									$account_anchor = __('Личный кабинет','fleetservice');
									
								} else {
									 $account_anchor = __('Вход/Регистрация','fleetservice');
								} ?>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="auth"><span class="d-none d-md-inline"><?php echo $account_anchor; ?></span></a>
							</div>
							<div class="col-auto col-lg-5 ml-auto">
								<?php $products_count = 0; //Количество товарных позации (в общем случае отличается от общего количества штук всех товаров в корзине)
								foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
									$products_count++;
								}
								$cart_contents_sum = WC()->cart->get_cart_subtotal( );
								?>
								<a href="<?php echo get_permalink( get_option('woocommerce_cart_page_id') ); ?>" class="minicart cart-contents"><span class="d-none d-sm-inline">(<?php echo $products_count; ?>) : <?php echo $cart_contents_sum; ?></span></a>
							</div>
						</div><!--/.row-->
					</div><!--/.block-links-->

					<div class="header-bott">
						<div class="row no-gutters align-items-center">
							<div class="col-lg-4"><a href="tel:<?php echo phone_clean(get_theme_mod('header_phone')); ?>" class="phone"><?php echo get_theme_mod('header_phone'); ?></a></div>
							<div class="col-lg-3 hours d-sm-block d-none">
								<?php echo get_theme_mod('working_hours'); ?>
							</div>		
							<div id="wrap-form_header" class="wrap-form col-md-auto col-lg-auto ml-auto desktop">
								<a href="#" class="site-search-toggle"></a>
								<span class="makeweight">(<?php echo $cart_contents_count; ?>) : <?php echo $cart_contents_sum; ?></span>
								<?php echo do_shortcode( '[smart_search id="3"]' ); ?>
							</div>
						</div><!--/.row-->
					</div><!--/.header-bott-->
				</div><!--/.col-->				
			</div><!--/.row-->
	
		</div><!--/.container-->

		<div class="header-mobile">
		<?php
				if ( is_front_page() ) :
					$logo_img = '';
					if( $custom_logo_id = get_theme_mod('custom_logo') ){
						$logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
							'class'    => 'custom-logo',
							'itemprop' => 'logo',
						) );
						echo $logo_img;
					}
				?>
				<?php
				else :
					the_custom_logo();?>
					
					<?php
				endif; ?>
		
		<a href="tel:<?php echo phone_clean(get_theme_mod('header_phone')); ?>" class="phone phone--mobile" title="Позвонить"><span class="phone__txt"><?php echo get_theme_mod('header_phone'); ?></span></a>
		<div class="searchMobile"><?php echo do_shortcode( '[smart_search id="1"]' ); ?></div>
			<?php if (is_user_logged_in()) { 
				$account_anchor = __('Личный кабинет','fleetservice');
				
			} else {
					$account_anchor = __('Вход/Регистрация','fleetservice');
			} ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="auth-mobile">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 20 20"><path stroke="#7B7B7B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667" d="M16.667 17.5v-1.667a3.333 3.333 0 0 0-3.334-3.333H6.667a3.333 3.333 0 0 0-3.334 3.333V17.5M10 2.5a3.333 3.333 0 1 0 0 6.667A3.333 3.333 0 0 0 10 2.5Z"/></svg>
				<span class="sr-only"><?php echo $account_anchor; ?></span>
			</a>
		</div>
		
	</header><!-- #masthead -->
	<?php if (!is_front_page()) { ?>
	<div class="breadcrumbs">
		<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		} ?>
		</div><!--/.container-->
	</div>
	<?php } ?>
	<div id="content" class="site-content">
		

		
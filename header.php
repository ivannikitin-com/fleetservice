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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fleetservice' ); ?></a>

	<header id="masthead" class="site-header sticky-top">
		<div class="container wrap_h">
			<div class="row row_h">				
				<div class="site-branding col-3 col-sm-3 col-md-2 col-lg-2">
					<?php
					/* *TODO */
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif; ?>
				</div><!-- .site-branding -->
				
				<div class="col-9 col-sm-9 col-md-10 col-lg-10 col-xl-9 offset-xl-1 navbar-expand-lg wrap_right">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<nav class="navbar navbar-dark bg-dark nav-main">
						<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>-->
						
						<div class="row">
							<div class="col-md-12">

								<div class="collapse navbar-collapse" id="navbarmain">
									<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-1',
										'container'   	=> '',
										'menu_id'        => 'primary-menu',
										'menu_class'     => 'navbar-nav',
									) );
									?>
								</div><!--/.collapse-->
						</div>
					</nav><!--/.nav-main-->

					<div class="block-links">
						<div class="row no-gutters flex-nowrap align-items-center">
							<div class="col-auto col-lg-4 d-flex wrap_wishcompare">
								<a href="#" class="wishlist"><span class="d-none d-lg-inline">Избранное</span></a>
								<a href="#" class="compare"><span class="d-none d-lg-inline">Сравнение</span></a>
							</div>
							<div class="col-auto col-lg-3 d-flex wrap_auth">
								<a href="#" class="auth"><span class="d-none d-md-inline">Вход/Регистрация</span></a>
							</div>
							<div class="col-auto col-lg-5 ml-auto">
								<a href="#" class="minicart"><span class="d-none d-sm-inline">(3) : 1 000 000 Р</span></a>
							</div>
						</div><!--/.row-->
					</div><!--/.block-links-->

					<div class="header-bott">
						<div class="row no-gutters align-items-center">
							<div class="col-lg-4"><a href="tel:+74957789000" class="phone">+7(495) <span>778-90-00</span></a></div>
							<div class="col-lg-3 hours d-sm-block d-none">
								<span><b>Пн. - Пт.:</b> 9.00-21.00</span><span><b>Сб. - Вс.:</b>10.00-18.00</span>
							</div>
								
							<div class="wrap-form col-md-auto col-lg-auto ml-auto">
								<a href="#" class="site-search-toggle"></a>
								<span class="makeweight">(3) : 1 000 000 Р</span>
								<form role="search" method="get" class="search-form" action="http://fleetservice.local/">
									<span class="screen-reader-text">Найти:</span>
									<input type="search" class="search-field" placeholder="" value="" name="s">
								</form>
							</div>
						</div><!--/.row-->
					</div><!--/.header-bott-->
				</div><!--/.col-->				
			</div><!--/.row-->
		</div><!--/.container-->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		

		
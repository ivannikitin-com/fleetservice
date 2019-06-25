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
	<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&display=swap&subset=cyrillic-ext,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700&display=swap&subset=cyrillic-ext,latin-ext" rel="stylesheet">-->
	<!--<script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fleetservice' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row">				
				<div class="site-branding col-sm-2 col-lg-2">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif; ?>
				</div><!-- .site-branding -->
				
				<div class="col-sm-10 col-lg-10">
					<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="navbarsExample05">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'container'   	=> '',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'navbar-nav',
						) );
						?>
						</div><!--/.collapse-->
					</nav><!-- #site-navigation -->

					<div class="block-links">
						<a href="#" class="favorites">Избранное</a>
						<a href="#" class="compare">Сравнение</a>
						<a href="#" class="auth">Вход/Регистрация</a>
						<a href="#" class="minicart">(3) : 1 000 000 Р</a>
					</div>

					<div class="header-bott">
						<div class="row align-items-md-center">
							<div class="col-md-4 col-lg-4"><a href="tel:+74957789000" class="phone">+7(495) <span>778-90-00</span></a></div>
							<div class="hours col-md-3 col-lg-3"><span>Пн. - Пт.: 9.00-21.00</span><span>Сб. - Вс.:10.00-18.00</span></div>
								
							<div class="wrap-form col-md-5 col-lg-5 ml-auto">
								<a href="#" class="site-search-toggle"></a>
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
		

		
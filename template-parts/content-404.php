<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fleetservice
 */

?>
<div class="container">
	<div class="entry">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if (!is_page('my-account')) { ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Страница не найдена. Попробуйте воспользоваться поиском.', 'fleetservice' ); ?></h1>
		</header><!-- .entry-header -->
		<?php } ?>

		<div class="entry-content">
			<div class="row no-gutters align-items-center justify-content-left">		
				<div class="wrap-form col-sm-12 col-md-6 col-lg-6">
					<a href="#" class="site-search-toggle"></a>
					<?php get_search_form(); ?>
				</div>
			</div>
		</div><!-- .entry-content -->

	</article><!-- #post-<?php the_ID(); ?> -->
	</div><!--/.entry-->
</div><!--container-->	

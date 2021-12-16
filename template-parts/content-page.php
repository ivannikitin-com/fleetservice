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
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php } ?>

		<?php fleetservice_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fleetservice' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-<?php the_ID(); ?> -->
	</div><!--/.entry-->
</div><!--container-->	

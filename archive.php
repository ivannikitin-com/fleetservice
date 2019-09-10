<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fleetservice
 */

get_header();
global $wp_query;
?>

<section class="news" style="background-color: #fff;">	
	<div class="container">

		<?php if ( have_posts() ) : ?>
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
		<div id="masonry_container" class="row">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile; ?>

		</div><!--/.row-->
			<?php if (  $wp_query->max_num_pages > 1 ) :
				echo '<div class="button btn_brd_black-three fleet_loadmore">'.__('Показать еще','fleetservice').'</div><span class="spinner"></span>';
			endif; 
		else:
			get_template_part( 'template-parts/content', 'none' );
		endif;?>

	</div><!--/.container-->
</section>

<?php
get_footer();

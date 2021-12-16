<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package fleetservice
 */

get_header();
global $wp_query;
?>

<section class="news" style="background-color: #fff;">	
	<div class="container">

		<?php if ( have_posts() ) : ?>

				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Результаты поиска по запросу: %s', 'fleetservice' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>

		<div id="masonry_container" class="row">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile; ?>
		</div><!--/.row-->
			<?php if (  $wp_query->max_num_pages > 1 ) :
				echo '<div class="button btn_brd_black-three fleet_loadmore">'.__('Показать еще','fleetservice').'</div><span class="spinner"></span>';
			endif; 			

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</div><!--container-->
</section>	

<?php
get_footer();

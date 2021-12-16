<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fleetservice
 */

get_header();
?>



		<?php
		while ( have_posts() ) :
			the_post();
			//echo $post->post_name;
			if (is_wc_endpoint_url("order-received") || is_page('wishlist') || is_page('cart')) {
				get_template_part( 'template-parts/content', 'page_line' );
			} else {
				get_template_part( 'template-parts/content', 'page' );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>



<?php
get_footer();

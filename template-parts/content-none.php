<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fleetservice
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry clear'); ?>>
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'fleetservice' ); ?></h1>
	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'fleetservice' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'fleetservice' ); ?></p>
			<div class="row no-gutters align-items-center justify-content-left">		
				<div class="wrap-form col-sm-12 col-md-6 col-lg-6">
					<a href="#" class="site-search-toggle"></a>
			<?php get_search_form(); ?>
				</div>
			</div>
		<?php else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fleetservice' ); ?></p>
			<?php
			//get_search_form();

		endif;
		?>
	</div><!-- .entry-content -->
</article>

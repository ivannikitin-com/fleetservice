<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fleetservice
 */

get_header();
?>
	<div class="container">
		<div class="entry">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Страница не найдена. Попробуйте воспользоваться поиском.', 'fleetservice' ); ?></h1>
				</header><!-- .page-header -->

		</div><!--/.entry-->
	</div><!--container-->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

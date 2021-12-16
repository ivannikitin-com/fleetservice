<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fleetservice
 */

?>

<div class="entry">
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if (!is_page('my-account')) { ?>
		<header class="entry-header brd-bottom">
			<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div><!--container-->
		</header><!-- .entry-header -->
		<?php } ?>
		
		<div class="container">
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</div><!--container-->
	
	</article><!-- #post-<?php the_ID(); ?> -->

</div><!--/.entry-->


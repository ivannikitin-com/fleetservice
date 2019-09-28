<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fleetservice
 */

?>
<div class="container">
	<article id="post-<?php the_ID(); ?>" <?php post_class('entry clear'); ?>>

		<?php 
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta text-uppercase mb-2">
				<time datetime="<?php echo get_the_date('Y-m-d');?>" class="news-item-date mt-md-0 mt-3"><?php echo wp_maybe_decline_date(get_the_date()); ?></time>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>		

		</header><!-- .entry-header -->
		<?php $single_post_categories = get_the_term_list($post->ID,'category');?>
		<div class="entry-meta mb-3"><?php printf( __( 'Category: %s' ), $single_post_categories );?></div><!--/.entry-meta-->
		
		<?php fleetservice_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'fleetservice' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fleetservice' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->		
	</article><!-- #post-<?php the_ID(); ?> -->

	<!-- Здесь будет блок Поделиться -->
	<div class="fleet_share">
		<div class="fleet_share__title">Поделиться</div>
	</div><!--/.fleet_share-->

</div><!--/.container-->

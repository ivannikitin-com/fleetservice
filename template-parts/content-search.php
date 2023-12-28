<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fleetservice
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('news-item col-sm-3'); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="a_wrap">
		<?php 
		$attr = array(
			'class' => 'img-fluid mb-4',
		);
		the_post_thumbnail( 'medium', $attr ); ?>
		<?php
		if ( 'post' === get_post_type() ) { ?>
		<time pubdate datetime="<?php echo get_the_date('Y-m-d');?>" class="news-item-date mt-md-0 mt-3"><?php echo wp_maybe_decline_date(get_the_date()); ?></time>	
		<?php } ?>
		<?php //the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
		<div class="news-item-descr">
		<?php
		the_excerpt();
		?>
		</div><!-- .news-item-descr -->	
	</a><!-- /.a_wrap -->
	<?php if ( 'product' === get_post_type() ) { ?>
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link button btn_brd_black-three"><?php _e('Перейти к товару', 'fleetservice'); ?></a>
	<?php } else { ?>	
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link button btn_brd_black-three"><?php _e('Читать далее', 'fleetservice'); ?></a>
	<?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
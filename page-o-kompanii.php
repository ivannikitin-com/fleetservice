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
	<div class="entry">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' )

	?>

	</div><!--/.entry-->
	<section class="catalog advantages">
		<div class="container">
			<?php $adv_section_title =  get_field ('adv_section_title');
			if ($adv_section_title) { ?>
			<h2 class="section-title" style="font-size: 30px; line-height: 33px;"><?php echo $adv_section_title; ?></h2>
			<?php } ?>
			<?php if (have_rows('advantages')): ?>
			<div class="row">
				<?php while ( have_rows('advantages') ) : the_row();
				$adv_icon = get_sub_field('icon');
				$adv_title = get_sub_field('title');
				$adv_text = get_sub_field('adv_text'); ?>
				<div class="col-sm-6 col-md-4 col-lg-3 catalog-item item-1">
					<!--<a href="<?php echo ($trend_link_url)?$trend_link_url:'#'?>" class="catalog-item-link">-->
						<div class="icon">
							<?php if ($adv_icon) { ?>
							<img src="<?php echo $adv_icon; ?>">
							<?php } ?>
						</div>
						<?php if ($adv_title) { ?>
						<div class="title-item"><?php echo $adv_title; ?></div>
						<?php } ?>
						<?php if ($adv_text) { ?>
						<div class="descr">
							<?php echo $adv_text; ?>
						</div>
						<?php } ?>
					<!--</a>-->
				</div><!--/.col-->
			<?php endwhile; ?>
			</div><!--/.row-->
			<?php endif; ?>
		</div><!--/.container-->
	</section><!--/.catalog-->

<!--Благодарственные письма -->
	<section class="testimonials">
		<div class="container">
			<?php $testim_section_title =  get_field ('testim_section_title');
			if ($testim_section_title) { ?>
			<h2 class="section-title"><?php echo $testim_section_title; ?></h2>
			<?php } ?>
		</div><!--/.container-->
	<?php $testimonials = get_field('testimonials');
	if( $testimonials ): ?>		
		<div class="testim-list">
			<div class="container">
				<div class="owl-carousel">
					<?php foreach( $testimonials as $testimonial_img ): ?>
					<a href="<?php echo esc_url($testimonial_img['url']); ?>" class="testim-list-item">
						<img src="<?php echo esc_url($testimonial_img['sizes']['medium']); ?>" alt="<?php echo esc_attr($testimonial_img['alt']); ?>">
					</a>
					<?php endforeach; ?>
				</div><!--/.owl-carousel-->
			</div><!--/.container-->
		</div><!--/.testim-list-->
	<?php endif; ?>
	</section><!--/.testimonials-->

<!--Наши клиенты -->
	<section class="clients">
		<div class="container">
			<?php $client_section_title =  get_field ('client_section_title');
			if ($client_section_title) { ?>
			<h2 class="section-title"><?php echo $client_section_title; ?></h2>
			<?php } ?>
		</div><!--/.container-->
	<?php $clients_logo = get_field('clients_logo');
	if( $clients_logo ): ?>		
		<div class="clients-list">
			<div class="container">
				<div class="owl-carousel">
					<?php foreach( $clients_logo as $clients_logo_img ): ?>
					<div class="testim-list-item">
						<img src="<?php echo esc_url($clients_logo_img['url']); ?>" alt="<?php echo esc_attr($clients_logo_img['alt']); ?>">
					</div>
					<?php endforeach; ?>
				</div><!--/.owl-carousel-->
			</div><!--/.container-->
		</div><!--/.clients-list-->
	<?php endif; ?>
	</section><!--/.clients-->	

<?php endwhile; // End of the loop. ?>

<?php get_footer();

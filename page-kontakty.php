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
	<div id="primary" class="content-area">
		<main id="main" class="site-main">	
		<?php
			while ( have_posts() ) :
				the_post(); ?>

				<!-- Карта и адрес -->
				
				<div class="container">
					<div class="row">
						<div class="col-md-6 mb-md-0 mb-4">
							<div class="map">
								<?php $main_office_map = get_field('main_office_map'); 
								if ($main_office_map) { 
									echo $main_office_map;
								} ?>
							</div>
							
						</div><!--/col-->
						<div class="col-md-6">
							<section class="module-contact-info">
								<?php the_content(); ?>
							</section><!--/.module-contact-info-->
						</div><!--/col-->
					</div><!--/.row-->
					<!-- /Карта и адрес -->
				
					<section class="module-dealers">
						<div class="row">
							<div class="col-lg-6">
								<?php $left_spoler_title = get_field('left_spoler_title'); 
								if ($left_spoler_title) { 
									echo '<h2>'.$left_spoler_title.'</h2>';
								} ?>
								<!-- Accordion -->
								<div class="accordion accordion_white" id="agency">
									<div class="card">
										<div class="card-header" id="headingOne">
											<div class="accordion__title">
												<a class="accordion__btn btn-link collapsed" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne"><?php $left_spoiler_text = get_field('left_spoiler_text'); echo $left_spoiler_text; ?></a>
											</div>
										</div>		
										<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#agency">
											<div class="map">
												<?php $left_spoiler_map = get_field('left_spoiler_map'); 
												if ($left_spoiler_map) { 
													echo $left_spoiler_map;
												} ?>
											</div><!--/.map-->	
											<?php if( have_rows('left_spoiler_content') ): ?>
											<div class="row">										
											<?php while ( have_rows('left_spoiler_content') ) : the_row();
												$agency_contact = get_sub_field('agency_contact');
												if ($agency_contact) : ?>
												<div class="col-lg-6 col-md-12 col-sm-6">
													<div class="card-body">
														<?php echo $agency_contact;?>
													</div>
												</div><!--/.col-->
												<?php endif; ?>

											<?php endwhile; ?>
											</div><!--/.row-->
											<?php endif; ?>									
										</div><!--/#collapseOne-->
									</div><!--/.card-->
								</div><!--/#agency-->
							</div><!--/col-->

							<div class="col-lg-6 mt-lg-0 mt-4 mt-md-5">
							<?php $right_spoler_title = get_field('right_spoler_title'); 
								if ($right_spoler_title) { 
									echo '<h2>'.$right_spoler_title.'</h2>';
							} ?>
							<!-- Accordion -->
							<div class="accordion accordion_white" id="dealers">
								<div class="card">
									<div class="card-header" id="headingTwo">
										<div class="accordion__title">
											<a class="accordion__btn btn-link collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="true" aria-controls="collapseTwo"><?php $right_spoiler_text = get_field('right_spoiler_text'); echo $right_spoiler_text; ?></a>
										</div>
									</div>		
									<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#dealers">
											<div class="map">
												<?php $right_spoiler_map = get_field('right_spoiler_map'); 
												if ($right_spoiler_map) { 
													echo $right_spoiler_map;
												} ?>
											</div><!--/.map-->
											<?php if( have_rows('right_spoiler_content') ): ?>
											<div class="row">
											<?php while ( have_rows('right_spoiler_content') ) : the_row();
												        $dealsers_contact = get_sub_field('dealsers_contact');
												if ($dealsers_contact) : ?>
												<div class="col-lg-6 col-md-12 col-sm-6">
													<div class="card-body">
														<?php echo $dealsers_contact;?>
													</div>
												</div><!--/.col-->
												<?php endif; ?>

											<?php endwhile; ?>
											</div><!--/.row-->
											<?php endif; ?>	
									</div>
								</div><!--/.card-->
							</div><!--/#dealers-->
						</div><!--/col-->
					</div><!--/.row-->
				</section><!--/.module-dealers-->				
			</div><!--/.container-->

			<section class="module-form-socials">
				<div class="container">
					<div class="row">
						<div class="col-md-7 col-lg-7"><?php echo do_shortcode('[contact-form-7 id="6976" title="Напишите нам"]'); ?></div>
						<div class="col-md-5 col-lg-4 offset-lg-1 pt-md-0 pt-5">
							<div class="k_social">
								<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
								<div id="vk_groups"></div>
								<script type="text/javascript">
								VK.Widgets.Group("vk_groups", {redesign: 1, mode: 3, width: "280", height: "400", color1: 'FFFFFF', color2: '6f6f6f', color3: '5E81A8'}, 23311443);
								</script>

							</div>
						</div>
					</div><!--/.row-->

				</div><!--/container-->
			</section><!--/.module-form-socials-->
		</main><!--/#main-->
	</div><!--/#primary-->
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

			endwhile; // End of the loop.

get_footer();

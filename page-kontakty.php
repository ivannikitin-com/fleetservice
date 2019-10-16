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
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					?>



		<!-- Карта и адрес -->

		<div class="container">
			<div class="row">
				<div class="col-md-6 mb-md-0 mb-4">
					<div class="map"><img src="<?php echo get_template_directory_uri(); ?>/img/map_1.png"
							class="img-fluid"></div>

				</div>
				<!--/col-->
				<div class="col-md-6">
					<section class="module-contact-info">
						<h2>Контактная информация</h2>
						<p><b class="font-size-3 secondary-font text-uppercase">ФЛИТСЕРВИС Ко</b></p>
						<p><b class="font-size-3 secondary-font">Адрес: </b>123308, г. Москва, ул. Мневники, д.1</p>
						<p><b class="font-size-3 secondary-font">Тел./факс: </b><a href="tel:+74957410869"
								class="font-size-3">+7(495)741-0869</a></p>
						<p><b class="invisible font-size-3 secondary-font">Тел./факс: </b><a href="tel:+74957410871"
								class="font-size-3">741-0871</a></p>
						<p><b class="invisible font-size-3 secondary-font">Тел./факс: </b><a href="tel:+79257712633"
								class="font-size-3">+7(925)771-2633</a></p>

						<table>
							<tbody>
								<tr>
									<td><b class="font-size-3 secondary-font">Тел./факс: </b></td>
									<td><a href="tel:+74957410869" class="font-size-3">+7(495)741-0869</a></td>
								</tr>
								<tr>
									<td><b class="font-size-3 secondary-font"></b></td>
									<td><a href="tel:+74957410871" class="font-size-3">741-0871</a></td>
								</tr>
								<tr>
									<td><b class="font-size-3 secondary-font"></b></td>
									<td><a href="tel:+79257712633" class="font-size-3">+7(925)771-2633</a></td>
								</tr>
							</tbody>

						</table>

						<p><b class="font-size-3 secondary-font">E-mail: </b><a
								href="mailto:info@fleetservice.ru">info@fleetservice.ru</a></p>
						<p><b class="font-size-3 secondary-font">Проезд: </b>м. Полежаевская, 1-й вагон из центра, на
							любом транспорте 2-я остановка "Сквер Маршала Жукова". Здание Первого Автокомбината, на
							проходной добавочный номер - 3255.</p>
						<p><b class="font-size-3 secondary-font">Часы работы: </b>пн-чт 09:00-18:00, пт 09:00-17:00</p>
						<p><b class="font-size-3 secondary-font">Часы работы склада: </b>пн–пт 09:00–17:00</p>
						<p><b class="font-size-3 secondary-font">Интернет-магазин работает круглосуточно</b></p>
					</section>
					<!--/.module-contact-info-->
				</div>
				<!--/col-->
			</div>
			<!--/.row-->
			<!-- /Карта и адрес -->

			<section class="module-dealers">
				<div class="row">
					<div class="col-lg-6">
						<h2>Представительства в регионах</h2>
						<!-- Accordion -->
						<div class="accordion accordion_white" id="agency">
							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="accordion__title">
										<a class="accordion__btn btn-link collapsed" data-toggle="collapse"
											href="#collapseOne" role="button" aria-expanded="true"
											aria-controls="collapseOne">Нажмите, чтобы посмотреть адреса наших
											представительств в регионах</a>
									</div>
								</div>
								<div id="collapseOne" class="collapse" aria-labelledby="headingOne"
									data-parent="#agency">
									<div class="row">
										<div class="col-lg-6 col-md-12 col-sm-6">
											<div class="card-body">
												<div><b class="font-size-3 secondary-font text-uppercase">г. Рязань</b>
												</div>
												<div><b class="font-size-3 secondary-font text-uppercase">ООО
														«ФЛИНТ»</b></div>
												<div><b class="font-size-3 secondary-font">Адрес: </b>308024, г.
													Белгород, Ул. Мичурина, д.39 А, офис 108</div>
												<div><b class="font-size-3 secondary-font">Тел./факс: </b><a
														href="tel:+74722372110" class="font-size-3">+7(4722)37 21 10</a>
												</div>
												<div><b class="invisible font-size-3 secondary-font">Тел./факс: </b><a
														href="tel:+74722424126" class="font-size-3">+7(4722)42 41 26</a>
												</div>
												<div><b class="font-size-3 secondary-font">E-mail: </b><a
														href="mailto:belgorod@fleetservice.ru">belgorod@fleetservice.ru</a>
												</div>
												<div class="font-size-3"><a
														href="mailto:www.flint62.ru">www.flint62.ru</a></div>
											</div>
										</div>
										<!--/.col-->

										<div class="col-lg-6 col-md-12 col-sm-6">
											<div class="card-body">
												<div><b class="font-size-3 secondary-font text-uppercase">г. Рязань</b>
												</div>
												<div><b class="font-size-3 secondary-font text-uppercase">ООО
														«ФЛИНТ»</b></div>
												<div><b class="font-size-3 secondary-font">Адрес: </b>308024, г.
													Белгород, Ул. Мичурина, д.39 А, офис 108</div>
												<div><b class="font-size-3 secondary-font">Тел./факс: </b><a
														href="tel:+74722372110" class="font-size-3">+7(4722)37 21 10</a>
												</div>
												<div><b class="invisible font-size-3 secondary-font">Тел./факс: </b><a
														href="tel:+74722424126" class="font-size-3">+7(4722)42 41 26</a>
												</div>
												<div><b class="font-size-3 secondary-font">E-mail: </b><a
														href="mailto:belgorod@fleetservice.ru">belgorod@fleetservice.ru</a>
												</div>
												<div class="font-size-3"><a
														href="mailto:www.flint62.ru">www.flint62.ru</a></div>
											</div>
										</div>
										<!--/.col-->
									</div>
									<!--/.row-->
								</div>
							</div>
							<!--/.card-->
						</div>
						<!--/#agency-->
					</div>
					<!--/col-->

					<div class="col-lg-6 mt-lg-0 mt-4 mt-md-5">
						<h2>Дилеры в регионах</h2>
						<!-- Accordion -->
						<div class="accordion accordion_white" id="dealers">
							<div class="card">
								<div class="card-header" id="headingTwo">
									<div class="accordion__title">
										<a class="accordion__btn btn-link collapsed" data-toggle="collapse"
											href="#collapseTwo" role="button" aria-expanded="true"
											aria-controls="collapseTwo">Адреса наших дилеров в регионах</a>
									</div>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
									data-parent="#dealers">
									<div class="card-body">
										<div class="map"><img
												src="<?php echo get_template_directory_uri(); ?>/img/map_2.png"
												class="img-fluid"></div>
									</div>
								</div>
							</div>
							<!--/.card-->
						</div>
						<!--/#dealers-->
					</div>
					<!--/col-->
				</div>
				<!--/.row-->
			</section>
			<!--/.module-dealers-->
		</div>
		<!--/.container-->

		<section class="module-form-socials">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-lg-7">
						<?php echo do_shortcode('[contact-form-7 id="6976" title="Напишите нам"]'); ?></div>
					<div class="col-md-5 col-lg-4 offset-lg-1 pt-md-0 pt-5">
						<div class="k_social">
							<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
							<div id="vk_groups"></div>
							<script type="text/javascript">
							VK.Widgets.Group("vk_groups", {
								redesign: 1,
								mode: 3,
								width: "280",
								height: "400",
								color1: 'FFFFFF',
								color2: '6f6f6f',
								color3: '5E81A8'
							}, 23311443);
							</script>

						</div>
					</div>
				</div>
				<!--/.row-->

			</div>
			<!--/container-->
		</section>
		<!--/.module-form-socials-->
	</main>
	<!--/#main-->
</div>
<!--/#primary-->
<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

	endwhile; // End of the loop.

get_footer();
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php if( have_rows('front_page_slider') ): ?>
<!--SLIDER-->
<section id="slider_main" class="owl-carousel owl-theme d-none d-md-block">
	<?php while ( have_rows('front_page_slider') ) : the_row();
		$image = get_sub_field('slide_img');
		$text1 = get_sub_field('slide_text_1');
		$text2 = get_sub_field('slide_text_2');
		$text3 = get_sub_field('slide_text_3'); ?>
	<div class="slider-item" style="background-image: url(<?php echo $image['url']; ?>)">	
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<div class="slider-item-content d-flex flex-column">
						<div class="slider-item-date"><span><?php echo $text1; ?></span></div>
						<div class="slider-item-caption"><?php echo $text2; ?></div>
						<div class="slider-item-descr"><?php echo $text3; ?></div>
					</div>
				</div>
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.slider-item-->
	<?php  endwhile; ?>
</section><!--/#slider_main-->
<?php endif; ?>

<section class="catalog" style="background-color: #f5f8fa;">
	<div class="container">
		<?php $catalog_section_title =  get_field ('catalog_section_title');
		if ($catalog_section_title) { ?>
		<h2 class="section-title" style="font-size: 30px; line-height: 33px;"><?php echo $catalog_section_title; ?></h2>
		<?php } ?>
		<div class="row">
			<div class="col-sm-6 col-md-4 catalog-item item-1">
				<a href="#" class="catalog-item-link">
					<div class="icon"></div>
					<div class="title-item">Отели</div>
					<div class="descr">
						<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
					</div>
					<span href="#" class="more">Посмотреть</span>
				</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4 catalog-item item-2">
				<a href="#" class="catalog-item-link">
					<div class="icon"></div>
					<div class="title-item">Недвижимость и клининг</div>
					<div class="descr">
						<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
					</div>
					<span href="#" class="more">Посмотреть</span>
				</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4 catalog-item item-3">
				<a href="#" class="catalog-item-link">
					<div class="icon"></div>
					<div class="title-item">Производство</div>
					<div class="descr">
						<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
					</div>
					<span href="#" class="more">Посмотреть</span>
				</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4 catalog-item item-4">
				<a href="#" class="catalog-item-link">
					<div class="icon"></div>
					<div class="title-item">Ресторан/кухня</div>
					<div class="descr">
						<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
					</div>
					<span href="#" class="more">Посмотреть</span>
				</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4 catalog-item item-5">
				<a href="#" class="catalog-item-link">
					<div class="icon"></div>
					<div class="title-item">Автопром</div>
					<div class="descr">
						<p>Краткое описание раздела.  Про автопром. Краткое описание раздела. Краткое описание раздела. </p>
					</div>
					<span href="#" class="more">Посмотреть</span>
				</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4 catalog-item item-6">
				<a href="#" class="catalog-item-link">
					<div class="icon"></div>
					<div class="title-item">Медицина</div>
					<div class="descr">
						<p>Краткое описание раздела.</p>
					</div>
					<span href="#" class="more">Посмотреть</span>
				</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4 catalog-item item-7">
				<a href="#" class="catalog-item-link">
					<div class="icon"></div>
					<div class="title-item">Спорт и фитнесс</div>
					<div class="descr">
						<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. Краткое описание раздела. Краткое описание раздела.</p>
					</div>
					<span href="#" class="more">Посмотреть</span>
				</a>
			</div><!--/.col-->

		</div><!--/.row-->
	</div><!--/.container-->
</section><!--/.catalog-->

<section class="brands" style="background-color: #fff;">
	<div class="container">
		<?php $brand_section_title =  get_field ('brand_section_title');
		if ($brand_section_title) { ?>
		<h2 class="section-title" style="font-size: 24px; margin-bottom: 9px; line-height: normal;"><?php echo $brand_section_title; ?></h2>
		<?php } ?>
	</div><!--/.container-->	
	<div class="brands-list">
		<div class="container">
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/allegrini.png" width="87" height="40"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/archdale.png" width="120" height="40"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/bxg.png" width="116" height="47"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/nova.png" width="146" height="42"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/notrax.png" width="140" height="40"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/diversey.png" width="115" height="60"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/i-team.png" width="153" height="40"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/pro servise.png" width="202" height="40"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/tork.png" width="117" height="57"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/nolfisk.png" width="146" height="32"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/chicopee.png" width="196" height="32"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/frepro.png" width="177" height="36"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/grass.png" width="90" height="40"></a>
			<a href="" class="c_change"><img src="<?php echo get_template_directory_uri(); ?>/img/pro servise.png" width="202" height="40"></a>
		</div><!--/.container-->		
	</div><!--.brands-list-->
</section><!--/.brands-->

<!-- ХИТЫ ПРОДАЖ -->
<section class="bestsellers" style="background: #f5f8fa;">
	<div class="container">
		<?php $products_section_title =  get_field ('products_section_title');
		if ($products_section_title) { ?>
		<h2 class="section-title" style="font-size: 30px; margin-bottom: 12px; line-height: normal;"><?php echo $products_section_title; ?></h2>
		<?php } ?> 
	</div><!--/.container-->

	<!-- Хиты продаж --->
	<div class="bestsellers-list">
		<div class="container">
			<div class="woocommerce">
				<ul class="products owl-carousel">
					<li class="product first instock">
						<div class="product-inner">
							<div class="product-top d-flex justify-content-end align-items-end">
								<a href="#" class="compare"></a><a href="#" class="wishlist"></a>
							</div>
							<a href="/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<img width="279" height="279" src="<?php echo get_template_directory_uri(); ?>/img/img-1.jpg" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="">
								<div class="sku-wrapper">Артикул: <span class="sku">7523359</span></div>							
								<h2 class="woocommerce-loop-product__title">Коврик для ног махровый Lilium и третья строка</h2>									
							</a>
							<span class="price">
								<span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span>
							</span>
							<a href="#" class="quick-view button">Быстрый просмотр</a>
							<a rel="nofollow" href="/" class="button product_type_simple add_to_cart_button">Добавить в корзину</a>
						</div><!--/.product-inner-->
					</li>

					<li class="product instock">
						<div class="product-inner">
							<div class="product-top d-flex justify-content-end align-items-end">
								<a href="#" class="compare"></a><a href="#" class="wishlist"></a>
							</div>
							<a href="/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<img width="279" height="279" src="<?php echo get_template_directory_uri(); ?>/img/img-1.jpg" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="">
								<div class="sku-wrapper">Артикул: <span class="sku">7523359</span></div>							
								<h2 class="woocommerce-loop-product__title">Коврик для ног махровый Lilium</h2>
							</a>
							<span class="price">
								<del><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></del>
								<ins><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></ins>
							</span>
							<a href="#" class="quick-view button">Быстрый просмотр</a>
							<a rel="nofollow" href="/" class="button product_type_simple add_to_cart_button">Добавить в корзину</a>
						</div><!--/.product-inner-->
					</li>
					<li class="product instock">
						<div class="product-inner">
							<div class="product-top d-flex justify-content-end align-items-end">
								<a href="#" class="compare"></a><a href="#" class="wishlist"></a>
							</div>
							<a href="/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<img width="279" height="279" src="<?php echo get_template_directory_uri(); ?>/img/img-1.jpg" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="">
								<div class="sku-wrapper">Артикул: <span class="sku">7523359</span></div>							
								<h2 class="woocommerce-loop-product__title">Коврик для ног махровый Lilium</h2>
							</a>
							<span class="price">
								<del><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></del>
								<ins><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></ins>
							</span>
							<a href="#" class="quick-view button">Быстрый просмотр</a>
							<a rel="nofollow" href="/" class="button product_type_variable add_to_cart_button">Выбрать</a>
						</div><!--/.product-inner-->
					</li>
					<li class="product instock">
						<div class="product-inner">
							<div class="product-top d-flex justify-content-end align-items-end">
								<a href="#" class="compare"></a><a href="#" class="wishlist"></a>
							</div>
							<a href="/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<img width="279" height="279" src="<?php echo get_template_directory_uri(); ?>/img/img-1.jpg" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="">
								<div class="sku-wrapper">Артикул: <span class="sku">7523359</span></div>							
								<h2 class="woocommerce-loop-product__title">Коврик для ног</h2>
							</a>
							<span class="price">
								<del><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></del>
								<ins><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></ins>
							</span>
							<a href="#" class="quick-view button">Быстрый просмотр</a>
							<a rel="nofollow" href="/" class="button product_type_variable add_to_cart_button">Выбрать</a>
						</div><!--/.product-inner-->
					</li>
					<li class="product inwishlist incompare">
						<div class="product-inner">
							<div class="product-top d-flex justify-content-end align-items-end">
								<a href="#" class="compare"></a><a href="#" class="wishlist"></a>
							</div>
							<a href="/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<img width="279" height="279" src="<?php echo get_template_directory_uri(); ?>/img/img-1.jpg" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="">
								<div class="sku-wrapper">Артикул: <span class="sku">7523359</span></div>							
								<h2 class="woocommerce-loop-product__title">Коврик для ног махровый Lilium</h2>
							</a>
							<span class="price">
								<del><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></del>
								<ins><span class="woocommerce-Price-amount amount">17 000&nbsp;<span class="woocommerce-Price-currencySymbol">руб.</span></span></ins>
							</span>
							<a href="#" class="quick-view button">Быстрый просмотр</a>
							<a rel="nofollow" href="/" class="button product_type_simple">Посмотреть подробно</a>
						</div><!--/.product-inner-->
					</li>
				</ul>
			</div><!--/.woocommerce-->
		</div><!--/.container-->
	</div><!--/.bestsellers-list-->
</section><!--/.bestsellers-->


<?php $front_page_products = get_field('front_page_products');
//print_r($front_page_products);
if(  $front_page_products ):
$args=array(
	'post_type'		=> 'product',
	'post__in'		=> $front_page_products,
	'posts_per_page'=> -1
);
$products=new WP_query( $args );
if ( $products->have_posts() ) : ?>
<section class="bestsellers" style="background: #f5f8fa;">
	<div class="container">
		<?php $products_section_title =  get_field ('products_section_title');
		if ($products_section_title) { ?>
		<h2 class="section-title" style="font-size: 30px; margin-bottom: 12px; line-height: normal;"><?php echo $products_section_title; ?></h2>
		<?php } ?> 
	</div><!--/.container-->
	<div class="bestsellers-list">
		<div class="container">
			<div class="woocommerce">
				<ul class="products owl-carousel">
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div><!--/.woocommerce-->
		</div><!--/.container-->
	</div><!--/.bestsellers-list-->
</section><!--/.bestsellers-->
<?php endif; ?>
<?php endif; ?>

<?php $short_information_img = get_field('short_information_img'); 
$short_information_title = get_field('short_information_title');
$slogun_icon = get_field('slogun_icon');
$slogun_text = get_field('slogun_text');
$front_page_content = get_the_content();
$more_info_lnk = get_field('more_info_lnk');
if ($front_page_content || $slogun_text = get_field('slogun_text')) : ?> 
<section class="about-us" style="background-color: #fff;">	
	<div class="container">
		<div class="row justify-content-between">
			<?php if ($short_information_img) { ?>
			<div class="col-md-3 col-xl-3 mb-md-0 mb-4"><img src="<?php echo $short_information_img['url']; ?>" width="265" height="516
			" class="img-fluid about-us-pic mb-2 mb-md-0"></div>
			<?php } ?>
			<div class="col-md-9 col-xl-8 mt-lg-2 mt-xl-3">	
				<?php if ($short_information_title) { ?>			
				<h2 class="section-title"><?php echo $short_information_title; ?></h2>
				<?php } ?>
				<?php if (isset($slogun_icon) || $slogun_text) { ?>
				<div class="about-us-slogan">
					<?php if ($slogun_icon) { ?>
					<img src="<?php echo $slogun_icon['url']; ?>" width="130" height="179" class="img-fluid">
					<?php } ?>
					<?php if ($slogun_text) { ?>
					<div class="about-us-slogan-txt">
					<?php echo $slogun_text; ?>
					</div>
					<?php } ?>
				</div><!--/.about-us-slogan-->
				<?php } ?>
				<?php if ($front_page_content) { ?>
				<div class="about-us-main_txt">				
				<?php echo the_content(); ?>
				</div>
				<?php if ($more_info_lnk) { ?>
				<a href="<?php echo $more_info_lnk; ?>" class="more"><?php _e('Узнать больше','fleetservice'); ?></a>
				<?php } ?>
				<?php } ?>
			</div>
		</div><!--/.row-->
	</div><!--/.container-->
</section><!--/.about-us-->
<?php endif; ?>

<?php if( have_rows('front_page_testimonials') ): ?>
<!--ОТЗЫВЫ -->
<section class="reviews" style="background-color: #f5f8fa;">
	<div class="container">
		<?php $testimonials_section_title =  get_field ('testimonials_section_title');
		if ($testimonials_section_title) { ?>
		<h2 class="section-title"><?php echo $testimonials_section_title; ?></h2>
		<?php } ?>
	</div><!--/.container-->
	<div class="reviews-list">
		<div class="container">
			<div class="owl-carousel">
				<?php while ( have_rows('front_page_testimonials') ) : the_row();
				$testimonial_name = get_sub_field('testimonial_name');
				$testimonial_post = get_sub_field('testimonial_post');
				$testimonial_text = get_sub_field('testimonial_text'); ?>
				<a href="#" class="reviews-list-item">
					<?php if ($testimonial_name || $testimonial_post) { ?>
					<div class="author"><?php if ($testimonial_name) {?><span class="fio"><?php echo $testimonial_name; ?></span><?php }?><?php if ($testimonial_post) {?><?php echo ' / '.$testimonial_post; }?></div>
					<?php } ?>
					<div class="descr"><?php if ($testimonial_text) { echo $testimonial_text; } ?></div>
				</a>
				<?php  endwhile; ?>
			</div><!--/.owl-carousel-->
		</div><!--/.container-->
	</div><!--/.reviews-list-->
</section><!--/.reviews-->
<?php endif; ?>

<?php $args = array(
	'posts_per_page' 		=> 6,
	'orderby'				=> 'DATE',
	'order'					=> 'DESC',
	'category_name' 		=> 'news',
	);
$news_posts = new WP_Query( $args );
if ($news_posts): ?> 
<!-- НОВОСТИ -->
<section class="news" style="background-color: #fff;">	
	<div class="container">
		<?php $news_section_title = get_field('news_section_title');
		if ($news_section_title) { ?>
		<h2 class="section-title" style="font-size: 30px; line-height:33px;"><?php echo $news_section_title; ?></h2>
		<?php } ?>
		<div class="grid-md-2">
			<?php $last_news_flag = true;
			$post_cntr = 1;
			while ( $news_posts->have_posts() ) : $news_posts->the_post(); ?>
				<?php
				 /**
				  * TODO:
				  * Если выбрана конкретная новость для данного блока
				  * то добавляем сюда ее изображение(кол-во постов с картинкой - 4, без картинки - 6)
				  * Example: <img src="<?php echo get_template_directory_uri(); ?>/img/news.jpg" class="img-fluid">
				  */
				  /*По просьбе заказчика картинка выводится только для самой свежей новости.*/
				  ?>
				 <?php if ($last_news_flag) { 
				 $post_thumb_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
				 if ($post_thumb_url) { ?>
				<img src="<?php echo $post_thumb_url; ?>" class="img-fluid mb-md-0 mb-4">	
				<?php } ?>
				<?php $last_news_flag = false; } ?>
				<article class="news-item mb-md-0 mb-3">
				<time pubdate datetime="<?php echo get_the_date('Y-m-d');?>" class="news-item-date mt-md-0 mt-3"><?php echo wp_maybe_decline_date(get_the_date()); ?></time>
					<div class="news-item-title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></div>
					<div class="news-item-descr">
						<?php the_excerpt(); ?>
					</div>
				</article>
				<?php $post_cntr++;
				if ($post_thumb_url && $post_cntr == 5) { break; } ?>
		<?php endwhile; ?>
		<?php wp_reset_postdata();?>		
		</div><!--/.row-->
		<?php 
		$news_lnk_label = get_field('news_lnk_label');
		if (!$news_lnk_label ) {
			$news_lnk_label = _e('All news','fleetservice');
		} ?>
		<div class="col-12 all_news"><a href="/category/news/"><?php echo $news_lnk_label; ?></a></div>
	</div><!--/.container-->
</section>
<?php endif; ?>
<?php endwhile; ?>
<?php get_footer();
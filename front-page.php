<?php get_header(); ?>

<section class="catalog">
	<div class="container">
		<h2 class="section-title">Каталог товаров</h2>
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<img src="<?php echo get_template_directory_uri(); ?>/img/1.svg" width="69" height="69">
				<div class="icon"></div>
				<a href="" class="title-item">Отели</a>
				<div class="descr">
					<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
				</div>
				<a href="" class="more">Посмотреть</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4">
				<img src="<?php echo get_template_directory_uri(); ?>/img/2.svg" width="72" height="63">
				<div class="icon"></div>
				<a href="" class="title-item">Недвижимость и клининг</a>
				<div class="descr">
					<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
				</div>
				<a href="" class="more">Посмотреть</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4">
				<img src="<?php echo get_template_directory_uri(); ?>/img/3.svg" width="75" height="75">
				<div class="icon"></div>
				<a href="" class="title-item">Производство</a>
				<div class="descr">
					<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
				</div>
				<a href="" class="more">Посмотреть</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4">
				<img src="<?php echo get_template_directory_uri(); ?>/img/4.svg" width="54" height="50">
				<div class="icon"></div>
				<a href="" class="title-item">Ресторан/кухня</a>
				<div class="descr">
					<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
				</div>
				<a href="" class="more">Посмотреть</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4">
				<img src="<?php echo get_template_directory_uri(); ?>/img/5.svg" width="72" height="44">
				<div class="icon"></div>
				<a href="" class="title-item">Автопром</a>
				<div class="descr">
					<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
				</div>
				<a href="" class="more">Посмотреть</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4">
				<img src="<?php echo get_template_directory_uri(); ?>/img/6.svg" width="54" height="39">
				<div class="icon"></div>
				<a href="" class="title-item">Медицина</a>
				<div class="descr">
					<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
				</div>
				<a href="" class="more">Посмотреть</a>
			</div><!--/.col-->

			<div class="col-sm-6 col-md-4">
				<img src="<?php echo get_template_directory_uri(); ?>/img/7.svg" width="54" height="44">
				<div class="icon"></div>
				<a href="" class="title-item">Спорт и фитнесс</a>
				<div class="descr">
					<p>Краткое описание раздела.  Про отели. Краткое описание раздела. Краткое описание раздела. </p>
				</div>
				<a href="" class="more">Посмотреть</a>
			</div><!--/.col-->

		</div><!--/.row-->
	</div><!--/.container-->
</section>

<section class="brands">
	<div class="container">
		<h2 class="section-title">Бренды</h2>
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
		</div><!--/.container-->	
		
	</div><!--.brands-list-->

</section>

<?php while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; ?>
		<ul>
			<li>Пункт-1 Длинный пункт Длинный пункт Длинный пункт Длинный пункт Длинный пункт Длинный пунктДлинный пункт</li>
			<li>Пункт-2</li>
			<li>Пункт-3</li>
		</ul>

<?php get_footer();
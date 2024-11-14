<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fleetservice
 */

?>
<?php
		// wp_nav_menu( array(
		// 	'theme_location' => 'menu-3',
		// 	'container'   	=> '',
		// 	'menu_class'     => 'bottom_navbar__menu-list',
		// ) );
		?>
 
		<nav class="bottom_navbar">
      <div class="bottom_navbar__menu">
        <ul class="bottom_navbar__menu-list">
          <li class="bottom_navbar__menu-item bottom_navbar__menu-item--icon-home menu-item">
            <a class="bottom_navbar__link" href="/">
              <svg class=" bottom_navbar__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"
                  d="m3 7.5 7.5-5.833L18 7.5v9.167a1.667 1.667 0 0 1-1.667 1.666H4.667A1.667 1.667 0 0 1 3 16.667V7.5Z" />
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"
                  d="M8 18.333V10h5v8.333" />
              </svg>

              <div class="bottom_navbar__txt">Главная</div>
            </a>
          </li>
					
          <li class="menu-item bottom_navbar__menu-item bottom_navbar__menu-item--icon-menu mobile-menu-toggle">
						<button class="bottom_navbar__button navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
								<svg class="bottom_navbar__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"
										d="M3 10h15M3 5h15M3 15h15" />
								</svg>

								<div class="bottom_navbar__txt">Меню</div>
						</button>
          </li>

          <!-- <li class="menu-item bottom_navbar__menu-item bottom_navbar__menu-item--icon-menu mobile-menu-toggle">
            <a class="bottom_navbar__link" href="#">
              <svg class="bottom_navbar__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"
                  d="M3 10h15M3 5h15M3 15h15" />
              </svg>

              <div class="bottom_navbar__txt">Меню</div>
            </a>
          </li> -->

          <li class="menu-item bottom_navbar__menu-item bottom_navbar__menu-item--icon-catalog">
            <a class="bottom_navbar__link" href="/shop/">
              <svg class="bottom_navbar__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"
                  d="M3 2.5h5.833v5.833H3V2.5ZM12.167 2.5H18v5.833h-5.833V2.5ZM12.167 11.667H18V17.5h-5.833v-5.833ZM3 11.667h5.833V17.5H3v-5.833Z" />
              </svg>

              <div class="bottom_navbar__txt">Каталог</div>
            </a>
          </li>

          <li class="menu-item bottom_navbar__menu-item bottom_navbar__menu-item--icon-minicart">
            <a class="bottom_navbar__link bottom_navbar__link--minicart" href="<?php echo get_permalink( get_option('woocommerce_cart_page_id') ); ?>">
              <span class="bottom_navbar__quantity"><?php echo $products_count; ?></span>

              <svg class="bottom_navbar__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none">
                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"
                  clip-path="url(#a)">
                  <path
                    d="M8 16.667a.833.833 0 1 0 0 1.666.833.833 0 0 0 0-1.666Zm9.167 0a.833.833 0 1 0 0 1.667.833.833 0 0 0 0-1.667ZM1.333.833h3.334L6.9 11.992a1.667 1.667 0 0 0 1.667 1.341h8.1a1.666 1.666 0 0 0 1.666-1.341L19.667 5H5.5" />
                </g>
                <defs>
                  <clipPath id="a">
                    <path fill="currentColor" d="M.5 0h20v20H.5z" />
                  </clipPath>
                </defs>
              </svg>

              <div class="bottom_navbar__txt"><?php _e( 'Cart', 'woocommerce' ); ?></div>
            </a>
          </li>

          <li class="menu-item bottom_navbar__menu-item bottom_navbar__menu-item--icon-wishlist">
            <a href="<?php echo get_theme_mod('wishist_url'); ?>">
              <svg class="bottom_navbar__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none">
                <g clip-path="url(#a)">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"
                    d="M17.867 3.842a4.584 4.584 0 0 0-6.484 0l-.883.883-.883-.883a4.584 4.584 0 0 0-6.484 6.483l.884.883 6.483 6.484 6.483-6.484.884-.883a4.584 4.584 0 0 0 0-6.483Z" />
                </g>
                <defs>
                  <clipPath id="a">
                    <path fill="currentColor" d="M.5 0h20v20H.5z" />
                  </clipPath>
                </defs>
              </svg>

              <div class="bottom_navbar__txt"><?php _e('Избранное','fleetservice'); ?></div>
            </a>
          </li>
        </ul>
      </div>

    </nav>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class=" footer_main">
				<div class="row search-in-footer">
					<div class="col-sm-12">
						<div class="wrap-form">
							<div class="site-search-toggle"></div>
							<form role="search" method="get" class="search-form" action="https://fleetservice.ru/" style="background: #fff;">
								<span class="screen-reader-text">Найти:</span>
								<input type="search" class="search-field" placeholder="" value="" name="s" style="width: calc( 100% - 35px);border-right: none;">
							</form>							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="f_title"><?php _e('Контакты','fleetservice'); ?></div>
						<div><?php echo get_theme_mod( 'footer_address' ); ?></div>
						<div class="email"><a href="mailto:<?php echo get_theme_mod( 'footer_email' ); ?>"><?php echo get_theme_mod( 'footer_email' ); ?></a></div>
						<div class="phone"><a href="tel:<?php echo phone_clean(get_theme_mod( 'footer_phone' )); ?>"><?php echo get_theme_mod( 'footer_phone' ); ?></a></div>
						<div class="copyright">© <?php echo date('Y'); ?>  <?php echo get_theme_mod( 'footer_copyright' ); ?></div>
					</div>
					<div class="col-sm-6 col-md-4 mt-sm-0 mt-4">
						<div class="f_title"><?php _e('Ссылки','fleetservice'); ?></div>
								<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-2',
									'container'   	=> 'nav',
									'menu_id'        => '',
									'items_wrap'     => '<ul id="%1$s" class="list-unstyled">%3$s</ul>'
								) );
								?>							     
					</div>	
					<div class="col-sm-12 col-md-4 mt-4 mt-md-0">
						<div class="f_title"><?php _e('Мы в соцсетях','fleetservice'); ?></div>
						<div class="socials">
							<?php if (get_theme_mod( 'footer_twitter_lnk' )) { ?>
							<a rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_twitter_lnk' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
 width="17px" height="14px">
<image  x="0px" y="0px" width="17px" height="14px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAOCAQAAABj5D8/AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfjBRQRMipgsNjUAAAAmElEQVQY03WRUQ3DMAwFb2MQCqFQCqNQCqUQCqGwQSiFFkIpZBBK4fYRqUra9fnDsnyy9WzEQbp4W5WMZgO+LMYGSLYanXBUd6cDKR2yCMajyCLuDbCL4HAa7RV5ea9F5MnKyp1qRwwmt79ThroIuQHm6rEiwfkCFEOLIOaTl+PmNUWXDtjap2A+tYup/9nDai+QgC+fq/Mf4IBHab1D148AAAAASUVORK5CYII=" />
</svg></a><?php } ?>
							<?php if (get_theme_mod( 'footer_instagram_lnk' )) { ?>
							<a rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_instagram_lnk' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"><image  x="0px" y="0px" width="20px" height="20px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAQAAAAngNWGAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfjBRQRDw2vUiUBAAABb0lEQVQoz33TPUjVYRgF8N/9qzU4lIYGYgkRDUJpYSHRGm21aYPRB1QQNYlbY2tTTQU1FjfoY2lqaqmsoIhAiAapBCPE4kKpXE9D19s/1M4zHc457/O8vM9bCdDjuAEb/Isl79z1CURkJAtZD8sZi6iEYx5iwguLKqXz4pvdHmBUVbqSLKUn1qj2dKc9C0l6C2cxbsZqdKqZtdFhnCsM4mlTHHDHdz9UDZrzEx0m0S/VJPsbrU4lSeYzlyQ5HemL7E1yr1BHC9jptpqDNut0wLxbtplGUC9KM13FsGfgpSHcbNweZeNR89432UczjvwVy8ZGtonlMikbH+uwq8m26/VkbeM4ntsH9niFibKxBXUw5bwOr33x2VtdLnlDQy0KFSw2YjcMu2+Lbo8ccr25QxRyOcmFNV96pU4muSJbk/xK17q2Takl6Ws1a0TVVxdNNkdYQZsh17Q6YfpPaiz/w5mVxYUdRvVrW/UVplR9gN/F5/StJYN4jQAAAABJRU5ErkJggg==" />
</svg></a><?php } ?>
							<?php if (get_theme_mod( 'footer_facebook_lnk' )) { ?>
							<a rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_facebook_lnk' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
 width="8px" height="14px">
<image  x="0px" y="0px" width="8px" height="14px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAOCAQAAAC4X5UdAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfjBRQRNhG11/T0AAAAVUlEQVQI162OQQ2AQBDECsEAWkACWrCABdAEEu4sIAEL5bFccoEv/U2z2RlExNlL1RRxsJBaACYADhrGEEEGqEVgb83+vjijZVF1Fb8//hDdM3orS2+CFzfF/Hrq0wAAAABJRU5ErkJggg==" />
</svg></a><?php } ?>
							<?php if (get_theme_mod( 'footer_OK_lnk' )) { ?>
							<a class="socials__ok-link" rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_OK_lnk' ); ?>" title="в Oдноклассники">
							<svg class="socials__ok-image" xmlns="http://www.w3.org/2000/svg" width="389.404" height="387.417" viewBox="0 0 389.404 387.417" xml:space="preserve"><path fill="#FAAB62" d="M389.404 330.724c0 31.312-25.383 56.693-56.693 56.693H56.693C25.382 387.417 0 362.036 0 330.724V56.693C0 25.382 25.382 0 56.693 0h276.018c31.311 0 56.693 25.382 56.693 56.693v274.031z"/><path fill="#F7931E" d="M387.404 329.317c0 30.989-25.122 56.11-56.111 56.11H58.11c-30.989 0-56.11-25.121-56.11-56.11V58.1C2 27.111 27.122 1.99 58.11 1.99h273.183c30.989 0 56.111 25.122 56.111 56.11v271.217z"/><path fill="#FFF" d="M194.485 57.901c-38.593 0-69.878 31.286-69.878 69.878 0 38.593 31.285 69.881 69.878 69.881s69.878-31.288 69.878-69.881c0-38.592-31.285-69.878-69.878-69.878zm0 98.766c-15.953 0-28.886-12.934-28.886-28.887s12.933-28.886 28.886-28.886 28.886 12.933 28.886 28.886-12.933 28.887-28.886 28.887z"/><g fill="#FFF"><path d="M219.155 253.262c27.975-5.699 44.739-18.947 45.626-19.658 8.186-6.565 9.501-18.523 2.936-26.71-6.564-8.186-18.521-9.501-26.709-2.937-.173.14-18.053 13.856-47.472 13.876-29.418-.02-47.676-13.736-47.849-13.876-8.188-6.564-20.145-5.249-26.709 2.937-6.565 8.187-5.25 20.145 2.936 26.71.899.721 18.355 14.314 47.114 19.879l-40.081 41.888c-7.284 7.554-7.065 19.582.489 26.866 3.687 3.555 8.439 5.322 13.187 5.322 4.978 0 9.951-1.945 13.679-5.812l37.235-39.665 40.996 39.922c7.428 7.416 19.456 7.404 26.87-.021 7.414-7.426 7.405-19.456-.021-26.87l-42.227-41.851z"/><path d="M193.536 217.832c-.047 0 .046.001 0 .002-.046-.001.047-.002 0-.002z"/></g></svg>							
							</a><?php } ?>							
							<?php if (get_theme_mod( 'footer_VK_lnk' )) { ?>
							<a class="socials__vk-link" rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_VK_lnk' ); ?>" title="в ВКонтакте">
							<svg class="socials__vk-image" width="22" height="22" viewBox="0 0 202 202" xmlns="http://www.w3.org/2000/svg"><defs><path id="a" d="M71.6 5h58.9C184.3 5 197 17.8 197 71.6v58.9c0 53.8-12.8 66.5-66.6 66.5H71.5C17.7 197 5 184.2 5 130.4V71.5C5 17.8 17.8 5 71.6 5z"/></defs><use xlink:href="#a" overflow="visible" fill-rule="evenodd" clip-rule="evenodd" fill="#1e88e5"/><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path d="M0 0h202v202H0z" clip-path="url(#b)" fill="#1e88e5"/><path d="M162.2 71.1c.9-3 0-5.1-4.2-5.1h-14c-3.6 0-5.2 1.9-6.1 4 0 0-7.1 17.4-17.2 28.6-3.3 3.3-4.7 4.3-6.5 4.3-.9 0-2.2-1-2.2-4V71.1c0-3.6-1-5.1-4-5.1H86c-2.2 0-3.6 1.7-3.6 3.2 0 3.4 5 4.2 5.6 13.6v20.6c0 4.5-.8 5.3-2.6 5.3-4.7 0-16.3-17.4-23.1-37.4-1.4-3.7-2.7-5.3-6.3-5.3H42c-4 0-4.8 1.9-4.8 4 0 3.7 4.7 22.1 22.1 46.4C70.9 133 87.2 142 102 142c8.9 0 10-2 10-5.4V124c0-4 .8-4.8 3.7-4.8 2.1 0 5.6 1 13.9 9 9.5 9.5 11.1 13.8 16.4 13.8h14c4 0 6-2 4.8-5.9-1.3-3.9-5.8-9.6-11.8-16.4-3.3-3.9-8.2-8-9.6-10.1-2.1-2.7-1.5-3.9 0-6.2 0-.1 17.1-24.1 18.8-32.3z" fill-rule="evenodd" clip-rule="evenodd" fill="#fff"/></svg>
							</a><?php } ?>

							<?php if (get_theme_mod( 'footer_Telegram_lnk' )) { ?>
								<a class="socials__telegram-link" rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_Telegram_lnk' ); ?>" title="в Telegram">									
									<svg class="socials__telegram-image" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
										<path
											d="M248 8C111.033 8 0 119.033 0 256s111.033 248 248 248 248-111.033 248-248S384.967 8 248 8Zm114.952 168.66c-3.732 39.215-19.881 134.378-28.1 178.3-3.476 18.584-10.322 24.816-16.948 25.425-14.4 1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25 5.342-39.5 3.652-3.793 67.107-61.51 68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608 69.142-14.845 10.194-26.894 9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7 18.45-13.7 108.446-47.248 144.628-62.3c68.872-28.647 83.183-33.623 92.511-33.789 2.052-.034 6.639.474 9.61 2.885a10.452 10.452 0 0 1 3.53 6.716 43.765 43.765 0 0 1 .417 9.769Z" />
									</svg>
								</a>
							<?php } ?>
							<?php if (get_theme_mod( 'footer_Yandex_Zen_lnk' )) { ?>
								<a class="socials__yandex_zen-link" rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_Yandex_Zen_lnk' ); ?>" title="в Яндекс.Дзен">									
									<svg class="socials__yandex_zen-image" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28">
										<path fill="#2C3036"
											d="M16.7 16.7c-2.2 2.27-2.36 5.1-2.55 11.3 5.78 0 9.77-.02 11.83-2.02 2-2.06 2.02-6.24 2.02-11.83-6.2.2-9.03.35-11.3 2.55M0 14.15c0 5.59.02 9.77 2.02 11.83 2.06 2 6.05 2.02 11.83 2.02-.2-6.2-.35-9.03-2.55-11.3-2.27-2.2-5.1-2.36-11.3-2.55M13.85 0C8.08 0 4.08.02 2.02 2.02.02 4.08 0 8.26 0 13.85c6.2-.2 9.03-.35 11.3-2.55 2.2-2.27 2.36-5.1 2.55-11.3m2.85 11.3C14.5 9.03 14.34 6.2 14.15 0c5.78 0 9.77.02 11.83 2.02 2 2.06 2.02 6.24 2.02 11.83-6.2-.2-9.03-.35-11.3-2.55" />
										<path fill="#fff"
											d="M28 14.15v-.3c-6.2-.2-9.03-.35-11.3-2.55-2.2-2.27-2.36-5.1-2.55-11.3h-.3c-.2 6.2-.35 9.03-2.55 11.3-2.27 2.2-5.1 2.36-11.3 2.55v.3c6.2.2 9.03.35 11.3 2.55 2.2 2.27 2.36 5.1 2.55 11.3h.3c.2-6.2.35-9.03 2.55-11.3 2.27-2.2 5.1-2.36 11.3-2.55" />
									</svg>
								</a>
							<?php } ?>

						</div>
						<?php if (get_theme_mod( 'footer_text_block' )) { ?>
						<div class="info mt-4 mt-md-auto"><?php echo get_theme_mod( 'footer_text_block' ); ?></div>
						<?php } ?>
					</div>
				</div><!--/.row-->
			</div><!-- footer_main-->
		</div><!--/.container-->
		<div class="footer_bott">
			<div class="container">
				<?php if (get_theme_mod( 'footer_iks' )) { ?>
					<?php echo get_theme_mod( 'footer_iks' ); ?>
				<?php } ?>
			</div><!--/.container-->
		</div><!--/.footer_bott-->
	</footer><!-- #colophon -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>

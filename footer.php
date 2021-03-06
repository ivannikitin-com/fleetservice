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

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class=" footer_main">
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
							<a rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_instagram_lnk' ); ?>"><svg 
 xmlns="http://www.w3.org/2000/svg"
 xmlns:xlink="http://www.w3.org/1999/xlink"
 width="8px" height="14px">
<image  x="0px" y="0px" width="8px" height="14px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAOCAQAAAC4X5UdAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfjBRQRNhG11/T0AAAAVUlEQVQI162OQQ2AQBDECsEAWkACWrCABdAEEu4sIAEL5bFccoEv/U2z2RlExNlL1RRxsJBaACYADhrGEEEGqEVgb83+vjijZVF1Fb8//hDdM3orS2+CFzfF/Hrq0wAAAABJRU5ErkJggg==" />
</svg></a><?php } ?>
							<?php if (get_theme_mod( 'footer_OK_lnk' )) { ?>
							<a rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_OK_lnk' ); ?>"><svg xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink"
 width="11px" height="20px"><image  x="0px" y="0px" width="11px" height="20px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAAUCAQAAADxJQ/jAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfjBRQRDDY1dJ/mAAABB0lEQVQY01WPrUuDcRSFn70MERyzCSoIliFoEcThsCyJMxls2g3+BSaLaJ1mu7YpKKZh0KDwCqsKFj/GZAqG4TsUH8N+DnfSvecc7jkXEdNueOWrTx67IIKY8dT/2OzQ+2FNukIJx/xUtWzOvJeqXuCyqrGIOGGiNiMyADTooE4bSEfcAVAgD8A6WaCJfd6q+uGh5yFyG3HeVk/B2MFOUME4UF8emZWUIxSpUmeWSRKueWCOUbxR392z6Lg5V6yobWx0b/50pyRijVronOIPFcR+F60G37dlZyQCEu4ZDr6IIWJAnPa5p/eZAzjli6otS24F4QQPArkk4m7nKVy16WMgEXd8s/YLj4Yg36TsWhUAAAAASUVORK5CYII=" />
</svg></a><?php } ?>							
							<?php if (get_theme_mod( 'footer_VK_lnk' )) { ?>
							<a rel="nofollow" target="_blank" href="<?php echo get_theme_mod( 'footer_VK_lnk' ); ?>"><svg 
 xmlns="http://www.w3.org/2000/svg"
 xmlns:xlink="http://www.w3.org/1999/xlink"
 width="21px" height="11px">
<image  x="0px" y="0px" width="21px" height="11px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAALCAQAAAA6wg72AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfjBRQRNxWroQGsAAAA10lEQVQY03WMIUtDcRRHz9uGMDFYTUtiWbAIarLYxDSwCBabDAYm0Wxbs1j3BcTkBxBsGgyDieDag8EYe0EQBsfg3d+nsF8653K4mftsUCHjkRegwzlLzBjSIgcyTqmRUaWPXX/2JWLTz/ADEc+cr4d1RyEnIt6G7YmYh01dQzwKHYl4E7YtttPPXUHEjzhcir1grKTwSubpTjpe+B7U9SnoQX5TvHPxtv6mNScL02eXyylu/gvGDhMPXCmneOislB5b9S1ZbqOc4rr3Ti0sLGyKq76G6fU3PjRbJepriiQAAAAASUVORK5CYII=" />
</svg></a><?php } ?>
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
				<img src="<?php echo get_template_directory_uri(); ?>/img/counter.jpg" width="112" height="41" class="img-fluid">
			</div><!--/.container-->
		</div><!--/.footer_bott-->
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php /*
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<span class="screen-reader-text"><?php _e('Найти:','fleetservice'); ?></span>
	<input type="search" class="search-field" placeholder="" value="<?php echo get_search_query(); ?>" name="s">
</form>
*/ ?>
<?php echo do_shortcode( '[smart_search id="1"]' ); ?>
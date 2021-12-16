<?php
/**
 * My Account page
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 */?>
<!--<div class="container">--->
	<div class="row">
		<div class="col-md-3 order-1">
<?php do_action( 'woocommerce_account_navigation' ); ?>
		</div><!--/end col-md-3-->
		<div class="col-md-9 order-12">
			<div class="woocommerce-MyAccount-content">
				<?php
					/**
					 * My Account content.
					 */
					do_action( 'woocommerce_account_content' );
				?>
			</div>
		</div><!--/end col-md-9-->
	</div><!--/.row-->
<!--</div>--><!--/.container-->

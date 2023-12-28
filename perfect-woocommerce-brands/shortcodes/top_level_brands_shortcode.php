<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function top_level_brands_shortcode( $atts ) {

    $atts = shortcode_atts( array(
      'per_page'       => "10",
      'image_size'     => "thumbnail",
      'hide_empty'     => false,
      'order_by'       => 'name',
      'order'          => 'ASC',
      'title_position' => 'before'
    ), $atts, 'pwb-all-brands' );

    if ($atts['hide_empty'] === "true" ) {
      $atts['hide_empty'] = 1;
    }

    ob_start();

    $brands_args = array( 'hide_empty' => $atts['hide_empty'], 'orderby' => $atts['order_by'], 'order' =>$atts['order'], 'parent' => 0 );

    $brands = array();
    /*if( $atts['order_by'] == 'rand' ){
      $brands = \Perfect_Woocommerce_Brands\Perfect_Woocommerce_Brands::get_brands( $hide_empty );
      shuffle( $brands );
    }else{
      $brands = \Perfect_Woocommerce_Brands\Perfect_Woocommerce_Brands::get_brands( $hide_empty, $atts['order_by'], $atts['order'] );
    }*/

    $brands = get_terms('pwb-brand', $brands_args);   
    foreach( $brands as $key => $brand ){
          $brand_image_id = get_term_meta($brand->term_id, 'pwb_brand_image', true);
          $brand_banner_id = get_term_meta($brand->term_id, 'pwb_brand_banner', true);
          $brand->brand_image = wp_get_attachment_image_src($brand_image_id);
          $brand->brand_banner = wp_get_attachment_image_src($brand_banner_id);
    }

    //remove residual empty brands
    foreach ( $brands as $key => $brand ) {

      //$count = self::count_visible_products( $brand->term_id );
      //$count = 1;

      if ( ! $brand->count && $brands_args['hide_empty'] ){
        unset( $brands[$key] );
      } else {
        $brands[$key]->count_pwb = $brand->count;
      }

    }

    ?>
    <div class="pwb-all-brands">
      <?php pagination( $brands, $atts['per_page'], $atts['image_size'], $atts['title_position'] );?>
    </div>
    <?php

    return ob_get_clean();
  }

function top_level_brands_shortcode_4_frontpage( $atts ) {

    $atts = shortcode_atts( array(
      'number'        => 44,
      'hide_empty'     => true,
      'order_by'       => 'name',
      'order'          => 'ASC',
      'title_position' => 'before'
    ), $atts, 'pwb-all-brands' );

    $hide_empty = ( $atts['hide_empty'] != 'true' ) ? false : true;

    ob_start();

    $brands_args = array( 'hide_empty' => $hide_empty, 'orderby' => $atts['order_by'], 'order' =>$atts['order'], 'parent' => 0 );

    $brands = array();
    $brands = get_terms('pwb-brand', $brands_args);

    //remove residual empty brands
    foreach ( $brands as $brand ) { 
      $brand_image_id = get_term_meta($brand->term_id, 'pwb_brand_image', true);
      $brand_image = wp_get_attachment_image($brand_image_id, 'thumbnail', array('class'  => 'attachment-full size-full'));
          ?>
      <a href="<?php echo get_term_link( $brand );?>" title="<?php echo $brand->name; ?>" class="c_change">
        <?php echo $brand_image;?></a>
    <?php } ?>
    </div><!--/.container-->

    <?php return ob_get_clean();
  }  

  /**
   *  WP_Term->count property don´t care about hidden products
   *  Counts the products in a specific brand
   */
function count_visible_products( $brand_id ) {

    $args = array(
      'posts_per_page' => -1,
      'post_type'      => 'product',
      'tax_query'      => array(
        array(
          'taxonomy'  => 'pwb-brand',
          'field'     => 'ID',
          'terms'     => $brand_id
        ),
        array(
          'taxonomy' => 'product_visibility',
          'field'    => 'name',
          'terms'    => 'exclude-from-catalog',
          'operator' => 'NOT IN',
        )
      )
    );
    $wc_query = new \WP_Query($args);

    return $wc_query->found_posts;

  }

function pagination( $display_array, $show_per_page, $image_size, $title_position ) {
    $page = 1;

    if( isset( $_GET['pwb-page'] ) && filter_var( $_GET['pwb-page'], FILTER_VALIDATE_INT ) == true ){
      $page = $_GET['pwb-page'];
    }

    $page = $page < 1 ? 1 : $page;

    // start position in the $display_array
    // +1 is to account for total values.
    $start = ($page - 1) * ($show_per_page);
    $offset = $show_per_page;

    $outArray = array_slice($display_array, $start, $offset);

    //pagination links
    $total_elements = count($display_array);
    $pages = ((int)$total_elements / (int)$show_per_page);
    $pages = ceil($pages);
    if($pages>=1 && $page <= $pages){

      ?>
      <div class="pwb-brands-cols-outer">
        <?php
        foreach( $outArray as $brand ) {

          $brand_id   = $brand->term_id;
          $brand_name = $brand->name;
          $brand_link = get_term_link($brand_id);

          $attachment_id = get_term_meta( $brand_id, 'pwb_brand_image', 1 );
          $attachment_html = $brand_name;
          if($attachment_id!=''){
            $attachment_html = wp_get_attachment_image( $attachment_id, $image_size );
          }

          ?>
          <div class="pwb-brands-col3">

            <?php if( $title_position != 'none' && $title_position != 'after' ): ?>
              <p>
                <a href="<?php echo $brand_link;?>"><?php echo $brand_name;?></a>
                <small>(<?php echo $brand->count_pwb;?>)</small>
              </p>
            <?php endif; ?>

            <div>
              <a href="<?php echo $brand_link;?>" title="<?php echo $brand_name;?>"><?php echo $attachment_html;?></a>
            </div>

            <?php if( $title_position != 'none' && $title_position == 'after' ): ?>
              <p>
                <a href="<?php echo $brand_link;?>"><?php echo $brand_name;?></a>
                <small>(<?php echo $brand->count_pwb;?>)</small>
              </p>
            <?php endif; ?>

          </div>
          <?php
        }
        ?>
      </div>
      <?php
      $next = $page + 1;
      $prev = $page - 1;

      echo '<div class="pwb-pagination-wrapper">';
      if($prev>1){
        echo '<a href="'.get_the_permalink().'" class="pwb-pagination prev" title="'.__('First page','perfect-woocommerce-brands').'">&laquo;</a>';
      }
      if($prev>0){
        echo '<a href="'.get_the_permalink().'?pwb-page='.$prev.'" class="pwb-pagination last" title="'.__('Previous page','perfect-woocommerce-brands').'">&lsaquo;</a>';
      }

      if($next<=$pages){
        echo '<a href="'.get_the_permalink().'?pwb-page='.$next.'" class="pwb-pagination first" title="'.__('Next page','perfect-woocommerce-brands').'">&rsaquo;</a>';
      }
      if($next<$pages){
        echo '<a href="'.get_the_permalink().'?pwb-page='.$pages.'" class="pwb-pagination next" title="'.__('Last page','perfect-woocommerce-brands').'">&raquo;</a>';
      }
      echo '</div>';

    }else{
      echo __('No results','perfect-woocommerce-brands');
    }

  }

  function top_level_brands_list_shortcode( $atts ) {
    //$grouped_brands = get_transient( 'pwb_az_listing_cache_' . get_locale() );
    $grouped_brands = array();    

    if ( ! $grouped_brands ) {

      $atts = shortcode_atts( array(
        'hide_empty'     => false,
        'order_by'       => 'name',
        'order'          => 'ASC'
      ), $atts, 'top-level-brands-list' );

      if ($atts['hide_empty'] === "true" ) {
        $atts['hide_empty'] = true;
      }
      $brands_args = array( 'get'=>'all', 'hide_empty' => true, 'orderby' => $atts['order_by'], 'order' =>$atts['order'], 'parent' => 0 );

      $grouped_brands = array();

      $brands = get_terms('pwb-brand', $brands_args);

      foreach ( $brands as $brand ) {

        if ( ! $hide_empty || ( $hide_empty && check_products( $brand->term_id ) ) ) {

          $letter                      = mb_substr( htmlspecialchars_decode( $brand->name ), 0, 1 );
          $letter                      = strtolower( $letter );
          $grouped_brands[ $letter ][] = array( 'brand_term' => $brand );

        }
      }

      //set_transient( 'pwb_az_listing_cache_' . get_locale(), $grouped_brands, 43200 );// 12 hours
      ob_start();
      include WP_PLUGIN_DIR . '/perfect-woocommerce-brands/templates/shortcodes/az-listing.php';
      return ob_get_clean();
    }
  }

  function check_products( $brand_id ) {

    $args = array(
      'posts_per_page' => -1,
      'post_type'      => 'product',
      'post_status'    => 'publish',
      'tax_query'      => array(
        array(
          'taxonomy' => 'pwb-brand',
          'field'    => 'term_id',
          'terms'    => array( $brand_id ),
        ),
      ),
      'fields'         => 'ids',
    );

    if ( get_option( 'woocommerce_hide_out_of_stock_items' ) === 'yes' ) {
      $args['meta_query'] = array(
        array(
          'key'     => '_stock_status',
          'value'   => 'outofstock',
          'compare' => 'NOT IN',
        ),
      );
    }

    $wp_query = new WP_Query( $args );
    wp_reset_postdata();
    return $wp_query->posts;

  }
<?php
/**
 * The template for displaying the carousels
 * @version 1.0.0
 */

 defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>

  <?php foreach( $brands as $brand ): ?>
      <a href="<?php echo $brand['link'];?>" title="<?php echo $brand['name']; ?>" class="c_change">
        <?php echo $brand['attachment_html'];?>
      </a>
  <?php endforeach; ?>

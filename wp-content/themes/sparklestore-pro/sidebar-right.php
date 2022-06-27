<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SparkleStore Pro
 */

$sparklestore_pro_sidebar_right = rwmb_meta('right_sidebar') ? rwmb_meta('right_sidebar') : 'sparklesidebarone';

if ( ! is_active_sidebar( $sparklestore_pro_sidebar_right )) {
	return;
}
?>
<aside id="secondary" class="widget-area" role="complementary">

	<?php dynamic_sidebar( $sparklestore_pro_sidebar_right ); ?>
	
</aside><!-- #secondary -->

<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SparkleStore Pro
 */

$sparklestore_pro_sidebar_left = rwmb_meta('left_sidebar') ? rwmb_meta('left_sidebar') : 'sparklesidebartwo';

if ( ! is_active_sidebar( $sparklestore_pro_sidebar_left )) {
	return;
}
?>
<aside id="secondary" class="widget-area left" role="complementary">

	<?php dynamic_sidebar( $sparklestore_pro_sidebar_left ); ?>

</aside><!-- #secondary -->

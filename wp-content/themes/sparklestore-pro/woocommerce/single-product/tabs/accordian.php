<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
global $tab_style;

if ( ! empty( $tabs ) ) : ?>
<div class="product-page-accordian">
	<div class="accordion" rel="1">
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="accordion-box <?php if( $key == 'description' ){ echo esc_attr('open'); } ?>">
				<div class="accordion-header plain <?php echo esc_attr($tab_style); ?>" href="javascript:void();">
					<i class="icofont-thin-down"></i> <i class="icofont-thin-up"></i> <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
				</div>
				<div class="accordion-content">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
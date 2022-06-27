<div class="cclw_cart_table">
   <h3 class="border_html"><?php esc_html_e('Review Order', 'cclw' ); ?></h3>
	 <?php include_once CCLW_PLUGIN_DIR . 'WooCommerce/checkout/cclw_includes/cclw_review_order_section.php'; ?> 
</div>

<div class="two-column-layout-left">
    <h3 class="border_html"> <?php esc_html_e('Billing Details', 'cclw' ); ?></h3>
	<?php include_once CCLW_PLUGIN_DIR . 'WooCommerce/checkout/cclw_includes/cclw_billing_details_section.php';	?>

</div>
<div class="two-column-layout-right">
 	<h3 class="border_html"><?php esc_html_e('Confirm & Pay', 'cclw' ); ?></h3>
	<?php include_once CCLW_PLUGIN_DIR . 'WooCommerce/checkout/cclw_includes/cclw_payment_section.php'; ?>
	
</div>
<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>		
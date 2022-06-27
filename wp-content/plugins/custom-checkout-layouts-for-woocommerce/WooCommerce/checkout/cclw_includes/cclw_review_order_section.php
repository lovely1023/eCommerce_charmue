<div id="cclw_order_details_table">
	<div id="order_review_table">
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
     	<?php remove_action( 'woocommerce_checkout_order_review','woocommerce_checkout_payment',20 ); ?>	
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>
</div>



<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php $checkout_options = get_option( 'custom_checkout_settings' );?>
<div class="shop_table woocommerce-checkout-review-order-table">
    <table class="onestepcheckout-summary">
    <thead>
        <tr>
            <th class="thumb"><?php esc_html_e( 'Product', 'cclw' ); ?></th>
            <th class="qty"><?php esc_html_e( 'Qty', 'cclw' ); ?></th>
           
            <th class="total"><?php esc_html_e( 'Total', 'cclw' ); ?></th>
			<th class="removepro"><?php esc_html_e( 'Remove', 'cclw' ); ?></th>
        </tr>
    </thead>
	<tbody>
	<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) )
				{
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				}
				?>
				
	<tr>
	
        <td class="thumb">
			<?php
			$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(array( 50, 80 )), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
			?>
			
         
        </td>
		
        <td class="cclw_qty" nowrap="">
		
		<div class="wrapper_qty">
		<?php
		if($checkout_options['cclw_skip_qty'] == 'yes')
		{
		   echo $cart_item['quantity'];
		}
		else
		{
			?>
			
			<button type="button" class="cclwminus" >-</button>
			<input type="number" id="qty1" class="input-text qty text" step="1" min="1" max="<?php echo $_product->backorders_allowed() ? '' : $_product->get_stock_quantity();?>" name="cart[<?php echo $cart_item_key; ?>][qty]" value="<?php echo $cart_item['quantity'];?>" title="Qty" size="4" inputmode="numeric">
			<button type="button" class="cclwplus" >+</button>
			<?php
		}
		?>
	
		</div>
		</td>
      
        <td class="total">
                        <span class="price"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></span>
		</td>
		 <td class="removepro">
		 	 <a href="<?php echo  esc_url( wc_get_cart_remove_url( $cart_item_key ) );?>" class="cclw_remove" title="Remove this item">x</a>				
		 </td>	
	 
    </tr>
	<tr>
	<td colspan="4" class="name more_details" style="text-align:left !important;">
	<?php  echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';          ?>
	 <div class="more_details_slide"><?php   echo wc_get_formatted_cart_item_data( $cart_item ); ?></div>
	
	</td>	
	</tr>
	
				<?php
			
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );?>

	<tbody>
   </table>	  

    <div class="cart_totals">
	<!--	<h3 class="border_html"><?php //esc_html_e('Order total', 'cclw'); ?></h3>-->
	   
		<div class="cart-subtotal">
			<p class="left-corner"><?php esc_html_e( 'Subtotal', 'cclw' ); ?></p>
			<span class="right-corner"><?php wc_cart_totals_subtotal_html(); ?></span>
		</div>
		 <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
        <div class="shipping-total">
		    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
			<p class="left-corner"><?php esc_html_e( 'Shipping', 'cclw' ); ?></p>
			<span class="right-corner">	<?php wc_cart_totals_shipping_html(); ?></span>
           
			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
		</div>

	<?php endif; ?>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<p class="left-corner"><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
				<span class="right-corner"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</div>
		<?php endforeach; ?>
		
       
		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee">
				<p class="left-corner"><?php echo esc_html( $fee->name ); ?></p>
				<span class="right-corner"><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<div class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<p class="left-corner"><?php echo esc_html( $tax->label ); ?></p>
						<span class="right-corner"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="tax-total">
					<p class="left-corner"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></p>
					<span class="right-corner"><?php wc_cart_totals_taxes_total_html(); ?></span>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
		<div class="order-total">
			<p class="left-corner"><?php esc_html_e( 'Total', 'cclw' ); ?></p>
			<span class="right-corner"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</div>
</div>

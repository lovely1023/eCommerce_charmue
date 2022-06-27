<?php
/**
 * Newsletter form
 *
 * @package Meta Box
 */

?>

<form method="post" action="https://app.zetamail.vn/form.php?form=77" target="_blank" class="newsletter">
	<h3><span class="dashicons dashicons-email-alt"></span> <?php esc_html_e( 'Meta Box Newsletter', 'sparklestore-pro' ); ?></h3>
	<input name="format" value="h" type="hidden">
	<p><?php esc_html_e( 'Want to learn how to use Meta Box to its full potential? Sign up to get valuable tips and resources. We will never spam you.', 'sparklestore-pro' ); ?></p>
	<input name="email" value="" placeholder="joe@gmail.com" required type="email">
	<button class="button button-primary"><?php esc_html_e( 'Subscribe', 'sparklestore-pro' ); ?></button>
</form>

<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
$gallery_layout = get_theme_mod('sparklestore_pro_woo_product_gallery_layout', 'default');
if( !$attachment_ids ) $gallery_layout = 'cfull';

$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	
	<figure class="woocommerce-product-gallery__wrapper gallery-layout-<?php echo esc_attr($gallery_layout); ?>">
		<?php
		if ( $product->get_image_id() ) {
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'sparklestore-pro' ) );
			$html .= '</div>';
		}

		// echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
        
        ?>
        <?php 
            $vertical_slider = false;
            $product_image_zoom = get_theme_mod('sparklestore_pro_woo_product_image_zoom', true);
            $lightbox = get_theme_mod('sparklestore_pro_woo_product_image_lightbox', true);
            if( $gallery_layout == 'left' || $gallery_layout == 'right' ){
                $vertical_slider = true;
            }    
		?>
		<?php if( $gallery_layout == 'left') : ?>
			<div class="woocommerce-small-thumbnails" data-vertical="<?php echo intval($vertical_slider); ?>">
				<?php echo $html; ?>
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>
			</div>
		<?php endif; ?>


		<div class="woocommerce-product-thumbnails gallery-layout-<?php echo esc_attr($gallery_layout); ?>" data-layout="<?php echo esc_attr($gallery_layout); ?>" data-szoom="<?php echo intval($product_image_zoom); ?>" data-lightbox="<?php echo intval($lightbox); ?>">
			<?php echo $html; ?>
            <?php do_action( 'woocommerce_product_thumbnails' ); ?>
        </div>

		<?php if( $gallery_layout == 'default' ||  $gallery_layout == 'right' || $gallery_layout == 'wide') : ?>
			<div class="woocommerce-small-thumbnails <?php echo esc_attr($gallery_layout); ?>" data-vertical="<?php echo intval($vertical_slider); ?>">
				<?php echo $html; ?>
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>
			</div>
		<?php endif; ?>

		
	</figure>
</div>

<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Sparkle Store Pro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sparklestore_pro_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}


	if(is_singular(array( 'post','page' ))){
		global $post;
		$post_sidebar = esc_attr( get_post_meta($post->ID, 'sparklestore_pro_page_layouts', true) );
		if(!$post_sidebar){
			$post_sidebar = 'rightsidebar';
		}
		$classes[] = $post_sidebar;
	}

  	if( is_home() || is_search() || is_category() || is_tag() || is_attachment() ){
		$classes[] = 'rightsidebar';
	}

	if ( class_exists( 'WooCommerce' ) ){
	    
	    if( is_product_category() || is_shop() ) {
	        $woo_page_layout = esc_attr( get_theme_mod( 'sparklestore_pro_woocommerce_products_page_layout','rightsidebar' ) );
	        if(!$woo_page_layout){
	            $woo_page_layout = 'rightsidebar';
	        }
	        $classes[] = $woo_page_layout;
	    }

	    if( is_singular('product') ) {
	        $woo_page_layout = esc_attr( get_theme_mod( 'sparklestore_pro_woocommerce_single_products_page_layout','rightsidebar' ) );
	        if(!$woo_page_layout){
	            $woo_page_layout = 'rightsidebar';
	        }
	        $classes[] = $woo_page_layout;
	    }

        $classes[] = 'woocommerce';
	}

	$classes[] = get_theme_mod( 'sparklestore_pro_web_page_layout_options', 'disable' );
	$woo_pagination_type = get_theme_mod('sparklestore_pro_pagination_style', 'normal');
	$classes[] = 'woo-pagination-'. $woo_pagination_type;
	
	return $classes;
}
add_filter( 'body_class', 'sparklestore_pro_body_classes' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
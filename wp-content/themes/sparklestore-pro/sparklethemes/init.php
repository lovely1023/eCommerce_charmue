<?php
/**
 * Main Custom admin functions area
 *
 * @since SparklewpThemes
 *
 * @param SparkleStore
 *
*/
if( !function_exists('sparklestore_pro_file_directory') ){

    function sparklestore_pro_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Load Custom Admin functions that act independently of the theme functions.
*/
require sparklestore_pro_file_directory('sparklethemes/functions.php');

/**
 * Implement the Custom Header feature.
*/
require sparklestore_pro_file_directory('sparklethemes/core/custom-header.php');

/**
 * Custom template tags for this theme.
*/
require sparklestore_pro_file_directory('sparklethemes/core/template-tags.php');

/**
 * Custom functions that act independently of the theme templates.
*/
require sparklestore_pro_file_directory('sparklethemes/core/extras.php');

/**
 * Load Jetpack compatibility file.
*/
require sparklestore_pro_file_directory('sparklethemes/core/jetpack.php');

/**
 * Load header hooks file.
*/
require sparklestore_pro_file_directory('sparklethemes/hooks/header.php');

/**
 * Load footer hooks file.
*/
require sparklestore_pro_file_directory('sparklethemes/hooks/footer.php');

if ( class_exists( 'WooCommerce' ) ) {
    /**
     * Load woocommerce hooks file.
    */
    require sparklestore_pro_file_directory('sparklethemes/hooks/woocommerce.php');
}

/**
 * Load dynamic css file.
 */
require sparklestore_pro_file_directory('sparklethemes/dynamic-css.php');

/**
 * Load breadcrumbs class
 */
if ( ! function_exists( 'breadcrumb_trail' ) ) {

	require get_template_directory() . '/sparklethemes/breadcrumbs.php';
}
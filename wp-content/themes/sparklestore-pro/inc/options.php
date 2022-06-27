<?php

/*Define Constants for this theme*/
define( 'SPARKLESTORE_PRO_VERSION', '1.2.8' );
define( 'SPARKLESTORE_PRO_PATH', get_template_directory() );
define( 'SPARKLESTORE_PRO_URL', get_template_directory_uri() );
define( 'SPARKLESTORE_PRO_SCRIPT_PREFIX', ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' );


if ( ! function_exists( 'sparklewp_site_general_layout_option' ) ) :

	/**
	 * Site General Layout
	 * This is apply for header, footer and site main content
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_site_general_layout_option
	 *
	 */
	function sparklewp_site_general_layout_option( $not_dependent = false ) {
		$sparklewp_site_general_layout_option = array(
			'spwp-full-width'  => esc_html__( 'Full Width', 'sparklestore-pro' ),
			// 'spwp-boxed-width' => esc_html__( 'Boxed Width', 'sparklestore-pro' ),
			'spwp-fluid-width' => esc_html__( 'Fluid Width', 'sparklestore-pro' ),
		);
		if ( ! $not_dependent ) {
			$dependent                           = array( 'inherit' => esc_html__( 'Inherit', 'sparklestore-pro' ) );
			$sparklewp_site_general_layout_option = array_merge( $dependent, $sparklewp_site_general_layout_option );
		}
		return apply_filters( 'sparklewp_site_general_layout_option', $sparklewp_site_general_layout_option );
	}
endif;


if ( ! function_exists( 'sparklewp_background_image_size_options' ) ) :

	/**
	 * Background Image Size Options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_background_image_size_options
	 *
	 */
	function sparklewp_background_image_size_options() {

		$sparklewp_background_image_size_options = array(
			'auto'    => esc_html__( 'Auto', 'sparklestore-pro' ),
			'cover'   => esc_html__( 'Cover', 'sparklestore-pro' ),
			'contain' => esc_html__( 'Contain', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_background_image_size_options', $sparklewp_background_image_size_options );
	}
endif;

if ( ! function_exists( 'sparklewp_background_image_position_options' ) ) :

	/**
	 * Background Image Position Options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_background_image_position_options
	 *
	 */
	function sparklewp_background_image_position_options() {

		$sparklewp_background_image_position_options = array(
			'center'        => esc_html__( 'Center', 'sparklestore-pro' ),
			'left_center'   => esc_html__( 'Left Center', 'sparklestore-pro' ),
			'right_center'  => esc_html__( 'Right Center', 'sparklestore-pro' ),
			'top_left'      => esc_html__( 'Top Left', 'sparklestore-pro' ),
			'top_right'     => esc_html__( 'Top Right', 'sparklestore-pro' ),
			'top_center'    => esc_html__( 'Top Center', 'sparklestore-pro' ),
			'bottom_left'   => esc_html__( 'Bottom Left', 'sparklestore-pro' ),
			'bottom_right'  => esc_html__( 'Bottom Right', 'sparklestore-pro' ),
			'bottom_center' => esc_html__( 'Bottom Center', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_background_image_position_options', $sparklewp_background_image_position_options );
	}
endif;

if ( ! function_exists( 'sparklewp_background_image_repeat_options' ) ) :

	/**
	 * Background Image Repeat Options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_background_image_repeat_options
	 *
	 */
	function sparklewp_background_image_repeat_options() {

		$sparklewp_background_image_repeat_options = array(
			'no-repeat' => esc_html__( 'No Repeat', 'sparklestore-pro' ),
			'repeat'    => esc_html__( 'Repeat', 'sparklestore-pro' ),
			'repeat-x'  => esc_html__( 'Repeat X', 'sparklestore-pro' ),
			'repeat-y'  => esc_html__( 'Repeat Y', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_background_image_repeat_options', $sparklewp_background_image_repeat_options );
	}
endif;

if ( ! function_exists( 'sparklewp_background_image_attachment_options' ) ) :

	/**
	 * Background Image Attachment Options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_background_image_attachment_options
	 *
	 */
	function sparklewp_background_image_attachment_options() {

		$sparklewp_background_image_attachment_options = array(
			'scroll' => esc_html__( 'Scroll', 'sparklestore-pro' ),
			'fixed'  => esc_html__( 'Fixed', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_background_image_attachment_options', $sparklewp_background_image_attachment_options );
	}
endif;

if ( ! function_exists( 'sparklewp_header_border_style' ) ) :

	/**
	 * Header Border Style
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_header_border_style
	 *
	 */
	function sparklewp_header_border_style() {
		$sparklewp_header_border_style = array(
			'none'   => esc_html__( 'None', 'sparklestore-pro' ),
			'solid'  => esc_html__( 'Solid', 'sparklestore-pro' ),
			'dotted' => esc_html__( 'Dotted', 'sparklestore-pro' ),
			'dashed' => esc_html__( 'Dashed', 'sparklestore-pro' ),
			'double' => esc_html__( 'Double', 'sparklestore-pro' ),
			'ridge'  => esc_html__( 'Ridge', 'sparklestore-pro' ),
			'inset'  => esc_html__( 'Inset', 'sparklestore-pro' ),
			'outset' => esc_html__( 'outset', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_header_border_style', $sparklewp_header_border_style );
	}
endif;

if ( ! function_exists( 'sparklewp_header_top_height_option' ) ) :

	/**
	 * Header Top Options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_header_top_height_option
	 *
	 */
	function sparklewp_header_top_height_option() {
		$sparklewp_header_top_height_option = array(
			'auto'   => esc_html__( 'Auto', 'sparklestore-pro' ),
			'custom' => esc_html__( 'Custom', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_header_top_height_option', $sparklewp_header_top_height_option );
	}
endif;

if ( ! function_exists( 'sparklewp_get_default_theme_options' ) ) :
	/**
	*  Default Theme layout options
	*
	* @since SparkleStore Pro 1.2.8
	*
	* @param null
	* @return array $sparklewp_theme_layout
	*
	*/

	function sparklewp_get_default_theme_options() {

		$default_theme_options = array(

			/*Header top options*/
			'header-top-options' => 'hide',
			'ajax-show-more'     => '',
			'ajax-no-more'       => '',
		);
		// $data = apply_filters( 'sparklewp_default_theme_options', $default_theme_options );
		return apply_filters( 'sparklewp_default_theme_options', $default_theme_options );
	}

	sparklewp_get_default_theme_options();
endif;


if ( ! function_exists( 'sparklewp_get_theme_options' ) ) :
	/**
	* Get theme options
	*
	* @since SparkleStore Pro 1.2.8
	*
	* @param null
	* @return mixed sparklewp_theme_options
	*
	*/
	function sparklewp_get_theme_options( $key = '', $value='' ) {
		
		if ( ! empty( $key ) ) {
			$sparklewp_default_theme_options = sparklewp_get_default_theme_options();
			$sparklewp_get_theme_options     = get_theme_mod( $key, isset( $sparklewp_default_theme_options[ $key ] ) ? $sparklewp_default_theme_options[ $key ] : $value );
			return apply_filters( 'sparklewp_' . $key, $sparklewp_get_theme_options );
		}
		return false;
	}
endif;

if ( ! function_exists( 'sparklewp_menu_indicator_options' ) ) :

	/**
	 * Menu Indicator options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_menu_indicator_options
	 *
	 */
	function sparklewp_menu_indicator_options() {
		$sparklewp_menu_indicator_options = array(
			'text' => esc_html__( 'Text', 'sparklestore-pro' ),
			'icon' => esc_html__( 'Icon', 'sparklestore-pro' ),
			'both' => esc_html__( 'Icon & Text', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_menu_indicator_options', $sparklewp_menu_indicator_options );
	}
endif;


if ( ! function_exists( 'sparklewp_icon_position' ) ) :

	/**
	 * Icon Position
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_icon_position
	 *
	 */
	function sparklewp_icon_position() {
		$sparklewp_icon_position = array(
			'before' => esc_html__( 'Before', 'sparklestore-pro' ),
			'after'  => esc_html__( 'After', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_icon_position', $sparklewp_icon_position );
	}
endif;

if ( ! function_exists( 'sparklewp_flex_align' ) ) :

	/**
	 * Flex Align
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_align
	 *
	 */
	function sparklewp_flex_align() {
		$sparklewp_flex_align = array(
			'swp-flex-align-left'   => esc_html__( 'Left', 'sparklestore-pro' ),
			'swp-flex-align-center' => esc_html__( 'Center', 'sparklestore-pro' ),
			'swp-flex-align-right'  => esc_html__( 'Right', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_flex_align', $sparklewp_flex_align );
	}
endif;

if ( ! function_exists( 'sparklewp_header_bg_options' ) ) :

	/**
	 * Header Background options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_header_bg_options
	 *
	 */
	function sparklewp_header_bg_options() {
		$sparklewp_header_bg_options = array(
			'none'   => esc_html__( 'None', 'sparklestore-pro' ),
			'custom' => esc_html__( 'Custom', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_header_bg_options', $sparklewp_header_bg_options );
	}
endif;

if ( ! function_exists( 'sparklewp_get_nav_menus' ) ) :

	/**
	 * Get Nav Menus Array
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $nav_menus
	 *
	 */
	function sparklewp_get_nav_menus( $options = array() ) {
		$sparklewp_get_nav_menus = array();
		$nav_menus              = wp_get_nav_menus();
		foreach ( $nav_menus as $menu ) {
			$sparklewp_get_nav_menus[ $menu->term_id ] = ucwords( $menu->name );
		}
		return apply_filters( 'sparklewp_get_nav_menus', $sparklewp_get_nav_menus );
	}
endif;

/**
 * Default color palettes
 *
 * @since SparkleStore Pro 1.2.8
 * @param null
 * @return array $sparklewp_default_color_palettes
 *
 */
if ( ! function_exists( 'sparklewp_default_color_palettes' ) ) {

	function sparklewp_default_color_palettes() {

		$palettes = array(
			'#000000',
			'#ffffff',
			'#dd3333',
			'#dd9933',
			'#eeee22',
			'#81d742',
			'#1e73be',
			'#8224e3',
		);
		return apply_filters( 'sparklewp_default_color_palettes', $palettes );
	}
}

if ( ! function_exists( 'sparklewp_header_layout_options' ) ) :

	/**
	 * Header layout options
	 *
	 * @since SparkleStore Pro 1.2.8
	 *
	 * @param null
	 * @return array $sparklewp_header_layout_options
	 *
	 */
	function sparklewp_header_layout_options() {
		$layout = array(
			'normal'                  => esc_html__( 'Normal', 'sparklestore-pro' ),
			'sticky'                  => esc_html__( 'Sticky', 'sparklestore-pro' ),
			'fixed'       			  => esc_html__( 'Fixed Header', 'sparklestore-pro' ),
			'transparent'             => esc_html__( 'Transparent Header', 'sparklestore-pro' ),
		);
		return apply_filters( 'sparklewp_header_layout_options', $layout );
	}
endif;
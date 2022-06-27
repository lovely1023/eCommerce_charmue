<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Header Options Defaults
 *
 */
$header_defaults = array(

	$this->builder_section_controller           => array(
		'desktop' => array(
			'top'    => array(
				array(
					'x' 	=> 0,
					'y'		=> 1,
					'width' => 6,
					'height' => 1,
					'id'	 => 'sparklestore_pro_header_quickinfo'
				),
				array(
					'x' 	=> 8,
					'y'		=> 1,
					'width' => 4,
					'height' => 3,
					'id'	 => 'sparklestore_pro_social_link_activate_settings'
				),

			),
			'main'   => array(
				array(
					'x'      => '0',
					'y'      => '1',
					'width'  => '3',
					'height' => '1',
					'id'     => 'title_tagline',
				),
				array(
					'x'      => '4',
					'y'      => '1',
					'width'  => '6',
					'height' => '1',
					'id'     => 'sparklestore_pro_header_search',
				),
				array(
					'x'      => '11',
					'y'      => '1',
					'width'  => '1',
					'height' => '1',
					'id'     => 'sparklestore_pro_cart',
				),
			),
			'bottom' => array(
				array(
					'x'      => '0',
					'y'      => '1',
					'width'  => '3',
					'height' => '1',
					'id'     => 'sparklestore_vertical_menu_section',
				),
				array(
					'x'      => '3',
					'y'      => '1',
					'width'  => '9',
					'height' => '1',
					'id'     => 'sparklestore_pro_primary_menu',
				),
			),
		),
		'mobile'  => array(
			'top'    => '',
			'main'   => array(
				'0' => array(
					'x'      => '0',
					'y'      => '1',
					'width'  => '1',
					'height' => '1',
					'id'     => 'sparkletheme_menu_toggle',
				),

				'1' => array(
					'x'      => '2',
					'y'      => '1',
					'width'  => '8',
					'height' => '1',
					'id'     => 'title_tagline',
				),
				'1' => array(
					'x'      => '11',
					'y'      => '1',
					'width'  => '1',
					'height' => '1',
					'id'     => 'sparklestore_pro_cart',
				),
				
			),
			'bottom' => '',
		),
		'all'     => array(
			'sidebar' => array(
				'0' => array(
					'x'      => '0',
					'y'      => '1',
					'width'  => '1',
					'height' => '1',
					'id'     => 'sparklestore_pro_primary_menu',
				),
			),
		),
	),
	/*Header General*/
	'header-position-options'                   => 'normal',
	'header-general-width'                      => 'inherit',
	'header-general-padding'                    => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'header-general-margin'                     => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'header-general-border-styling'             => json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'box-shadow-css'   => array(
				'desktop' => array(
					'x'           => '',
					'Y'           => '',
					'BLUR'        => '',
					'SPREAD'      => '',
					'cssbox_link' => true,
				),
			),
			'border-radius'    => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
		)
	),
	'header-general-background-options'         => json_encode(
		array(
			'background-color'      => '#fff',
			'background-image'      => '',
			'background-size'       => 'cover',
			'background-position'   => 'center',
			'background-repeat'     => 'no-repeat',
			'background-attachment' => 'scroll',
		)
	),


	/*Header Top*/
	'top-header-padding'                        => json_encode(
		array(
			'desktop' => array(
				'top'         => '0',
				'right'       => '0',
				'bottom'      => '0',
				'left'        => '0',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '0',
				'right'       => '0',
				'bottom'      => '10',
				'left'        => '0',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '0',
				'right'       => '0',
				'bottom'      => '0',
				'left'        => '0',
				'cssbox_link' => true,
			),
		)
	),
	'top-header-margin'                         => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),

	'header-top-height-option'                  => 'auto',
	'top-header-height'                         => '0',
	'header-top-border-styling'                 => json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'box-shadow-css'   => array(
				'desktop' => array(
					'x'           => '',
					'Y'           => '',
					'BLUR'        => '',
					'SPREAD'      => '',
					'cssbox_link' => true,
				),
			),
			'border-radius'    => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
		)
	),
	'header-top-background-options'             => json_encode(
		array(
			'background-color'      => '#444',
			'background-image'      => '',
			'background-size'       => 'cover',
			'background-position'   => 'center',
			'background-repeat'     => 'no-repeat',
			'background-attachment' => 'scroll',
		)
	),
	'header-top-bg-options'                     => 'none',

	/*Header Main*/
	'header-main-padding'                       => json_encode(
		array(
			'desktop' => array(
				'top'         => '25',
				'right'       => '0',
				'bottom'      => '25',
				'left'        => '0',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '10',
				'right'       => '0',
				'bottom'      => '10',
				'left'        => '0',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '10',
				'right'       => '0',
				'bottom'      => '10',
				'left'        => '0',
				'cssbox_link' => true,
			),
		)
	),
	'header-main-margin'                        => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'sparklestore_pro_main_header_bg_type'      => 'color-bg',
	'sparklestore_pro_main_header_bg_color' 	=> '#fff',
	'header-main-border-styling'                => json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '',
			'border-width'     => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'box-shadow-css'   => array(
				'desktop' => array(
					'x'           => '',
					'Y'           => '',
					'BLUR'        => '',
					'SPREAD'      => '',
					'cssbox_link' => true,
				),
			),
			'border-radius'    => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
		)
	),

	/*Header bottom*/
	'header-bottom-margin'                      => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'header-bottom-padding'                     => json_encode(
		array(
			'desktop' => array(
				'top'         => '0',
				'right'       => '0',
				'bottom'      => '0',
				'left'        => '0',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'header-bottom-height-option'               => 'auto',
	'bottom-header-height'                      => '0',
	'header-bottom-border-styling'              => json_encode(
		array(
			'border-style'     => 'none',
			'border-color'     => '',
			'box-shadow-color' => '#1e73be',
			'border-width'     => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'box-shadow-css'   => array(
				'desktop' => array(
					'x'           => '',
					'Y'           => '',
					'BLUR'        => '',
					'SPREAD'      => '',
					'cssbox_link' => true,
				),
			),
			'border-radius'    => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
		)
	),
	'header-bottom-bg-options'                  => 'custom',
	'header-bottom-background-options'          => json_encode(
		array(
			'background-color'      => '#033772',
			'background-image'      => '',
			'background-size'       => 'cover',
			'background-position'   => 'center',
			'background-repeat'     => 'no-repeat',
			'background-attachment' => 'scroll',
		)
	),

	/*Header social icon
	Icon fixed on get*/
	//search 
	'sparklestore_pro_search_type_options'      => 'advancesearch',
	'sparklestore_search_icon_size'             => 18,
	
	'sparklestore_search_icon_padding'           => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'sparklestore_search_icon_margin'           => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	
	/*primary menu*/
	'primary-menu-custom-menu'                  => '',
	'primary-menu-disable-sub-menu'             => false,
	'primary-menu-padding'                      => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'primary-menu-margin'                       => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'primary-menu-align'                        => 'swp-flex-align-left',
	'primary-menu-item-padding'                 => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'primary-menu-item-margin'                  => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'primary-menu-styling'                      => json_encode(
		array(
			'normal-text-color'    => '#333',
			'normal-bg-color'      => '',
			'normal-border-style'  => 'none',
			'normal-border-color'  => '',
			'hover-text-color'     => '#275cf6',
			'hover-bg-color'       => '',
			'hover-border-style'   => 'none',
			'hover-border-color'   => '',
			'active-text-color'    => '#275cf6',
			'active-bg-color'      => '',
			'active-border-style'  => 'none',
			'active-border-color'  => '',
			'normal-border-width'  => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'normal-border-radius' => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'hover-border-width'   => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'hover-border-radius'  => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'active-border-width'  => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
			'active-border-radius' => array(
				'desktop' => array(
					'top'         => '',
					'right'       => '',
					'bottom'      => '',
					'left'        => '',
					'cssbox_link' => true,
				),
			),
		)
	),
	'primary-menu-sub-menu-item-padding'        => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'primary-menu-sub-menu-item-margin'         => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	

	/*secondary menu*/
	'secondary-menu-custom-menu'                => '',
	'secondary-menu-disable-sub-menu'           => true,
	'secondary-menu-padding'                    => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'secondary-menu-margin'                     => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'secondary-menu-align'                      => 'spwp-flex-align-left',
	'secondary-menu-item-padding'               => json_encode(
		array(
			'desktop' => array(
				'top'         => '10',
				'right'       => '10',
				'bottom'      => '10',
				'left'        => '10',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'secondary-menu-item-margin'                => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'secondary-menu-sub-menu-item-padding'      => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'secondary-menu-sub-menu-item-margin'       => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	/** menu icon */
	'menu-open-icon-padding'       => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),
	'menu-open-icon-margin'       => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),

	/**
	 * Site Logo alignemnt
	 */
	'sparklestore_pro_title_tagline_alignment' => json_encode(
		array(
			'desktop' => 'left',
			'tablet'  => 'center',
			'mobile'  => 'center',
		)
	),

	/*button one*/
	'button-one-text'                           => esc_html__( 'Button One', 'sparklestore-pro' ),
	'button-one-class-name'                     => '',
	'button-one-enable-icon'                    => true,
	'button-one-align'                          => json_encode(
		array(
			'desktop' => '',
			'tablet'  => '',
			'mobile'  => 'spwp-flex-align-left',
		)
	),
	'button-one-icon'                           => 'fas fa-bars', /*fixed on frontend*/
	'button-one-icon-position'                  => 'before',
	'button-one-url'                            => '#',
	'button-one-open-link-new-tab'              => '1',
	'button-one-padding'                        => json_encode(
		array(
			'desktop' => array(
				'top'         => '6',
				'right'       => '12',
				'bottom'      => '6',
				'left'        => '12',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '6',
				'right'       => '12',
				'bottom'      => '6',
				'left'        => '12',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '6',
				'right'       => '12',
				'bottom'      => '6',
				'left'        => '12',
				'cssbox_link' => true,
			),
		)
	),
	'button-one-margin'                         => json_encode(
		array(
			'desktop' => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'tablet'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
			'mobile'  => array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'cssbox_link' => true,
			),
		)
	),

	/** home slider */
	'sparklestore_pro_slider_pause' => 5,
	'sparklestore_pro_slider_arrow' => 1,
	'sparklestore_pro_slider_loop' => 1,
	'sparklestore_pro_slider_dots' => 1,
	'sparklestore_pro_slider_loop' => 1,
	'sparklestore_pro_slider_auto_play' => 1,
	'sparklestore_pro_slider_mouse_drag' => 1,


);

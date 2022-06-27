<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*General Header*/
$wp_customize->add_section(
	'sparklewp-header-general',
	array(
		'title'    => esc_html__( 'Header General ', 'sparklestore-pro' ),
		'panel'    => $this->panel,
		'priority' => 10,
	)
);

/*Header Position*/
$wp_customize->add_setting(
	'header-position-options',
	array(
		'default'           => 'normal',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$choices = sparklewp_header_layout_options();
$wp_customize->add_control(
	'header-position-options',
	array(
		'choices'  => $choices,
		'label'    => esc_html__( 'Header Position', 'sparklestore-pro' ),
		'section'  => 'sparklewp-header-general',
		'settings' => 'header-position-options',
		'type'     => 'select',
	)
);

/*General Header Width*/
$choices = sparklewp_site_general_layout_option();
$wp_customize->add_setting(
	'header-general-width',
	array(
		'default'           => 'inherit',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'header-general-width',
	array(
		'label'           => esc_html__( 'Header General Width', 'sparklestore-pro' ),
		'type'            => 'select',
		'section'         => 'sparklewp-header-general',
		'settings'        => 'header-general-width',
		'priority'        => 10,
		'choices'         => $choices,
	)
);


/*Top Header Styling*/
$wp_customize->add_setting(
	'header-general-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'header-general-styling-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => 'sparklewp-header-general',
		)
	)
);

/*Header margin*/
$wp_customize->add_setting(
	'header-general-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['header-general-margin'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new sparklewp_Custom_Control_Cssbox(
		$wp_customize,
		'header-general-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => 'sparklewp-header-general',
			'settings' => 'header-general-margin',
		),
		array(),
		array()
	)
);

/*Header padding*/
$wp_customize->add_setting(
	'header-general-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['header-general-padding'],
		// 'transport'         => 'postMessage',

	)
);
$wp_customize->add_control(
	new sparklewp_Custom_Control_Cssbox(
		$wp_customize,
		'header-general-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => 'sparklewp-header-general',
			'settings' => 'header-general-padding',
		),
		array(),
		array()
	)
);

/*Heading Background Options*/
$wp_customize->add_setting(
	'header-general-bg-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'header-general-bg-styling-msg',
		array(
			'label'   => esc_html__( 'Background Options', 'sparklestore-pro' ),
			'section' => 'sparklewp-header-general',
		)
	)
);

/*Custom Background*/
$wp_customize->add_setting(
	'header-general-background-options',
	array(
		'sanitize_callback' => 'sparklewp_sanitize_field_background',
		'default'           => $header_defaults['header-general-background-options'],
		// 'transport'         => 'postMessage',
	)
);
$background_image_size_options       = sparklewp_background_image_size_options();
$background_image_position_options   = sparklewp_background_image_position_options();
$background_image_repeat_options     = sparklewp_background_image_repeat_options();
$background_image_attachment_options = sparklewp_background_image_attachment_options();
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Group(
		$wp_customize,
		'header-general-background-options',
		array(
			'label'    => esc_html__( 'Background Option', 'sparklestore-pro' ),
			'section'  => 'sparklewp-header-general',
			'settings' => 'header-general-background-options',
		),
		array(
			'background-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Color', 'sparklestore-pro' ),
			),
			'background-image'         => array(
				'type'  => 'image',
				'label' => esc_html__( 'Background Image', 'sparklestore-pro' ),
			),
			'background-size'          => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Size', 'sparklestore-pro' ),
				'options' => $background_image_size_options,
				'class'   => 'image-properties',
			),
			'background-position'      => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Position', 'sparklestore-pro' ),
				'options' => $background_image_position_options,
				'class'   => 'image-properties',
			),
			'background-repeat'        => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Repeat', 'sparklestore-pro' ),
				'options' => $background_image_repeat_options,
				'class'   => 'image-properties',
			),
			'background-attachment'    => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Attachment', 'sparklestore-pro' ),
				'options' => $background_image_attachment_options,
				'class'   => 'image-properties',
			),
			'enable-overlay'           => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable Overlay', 'sparklestore-pro' ),
				'class' => 'image-properties image-properties-checkbox',
			),
			'background-overlay-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Overlay Color', 'sparklestore-pro' ),
				'class' => 'image-properties',
			),
		)
	)
);

/*Heading border Info*/
$wp_customize->add_setting(
	'header-general-border-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'header-general-border-styling-msg',
		array(
			'label'   => esc_html__( 'Border & Box Shadow Options', 'sparklestore-pro' ),
			'section' => 'sparklewp-header-general',
		)
	)
);

/*Border & Box Shadow*/
$wp_customize->add_setting(
	'header-general-border-styling',
	array(
		'sanitize_callback' => 'sparklewp_sanitize_field_border',
		'default'           => $header_defaults['header-general-border-styling'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Group(
		$wp_customize,
		'header-general-border-styling',
		array(
			'label'    => esc_html__( 'Border & Box Shadow', 'sparklestore-pro' ),
			'section'  => 'sparklewp-header-general',
			'settings' => 'header-general-border-styling',
		),
		array(
			'border-style'     => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Border Style', 'sparklestore-pro' ),
				'options' => sparklewp_header_border_style(),
			),
			'border-width'     => array(
				'type'       => 'cssbox',
				'label'      => esc_html__( 'Border Width', 'sparklestore-pro' ),
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'top'    => true,
					'right'  => true,
					'bottom' => true,
					'left'   => true,
				),
				'attr'       => array(
					'min'       => 0,
					'max'       => 1000,
					'step'      => 1,
					'link'      => 1,
					'devices'   => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text' => esc_html__( 'Link', 'sparklestore-pro' ),
				),
			),
			'border-color'     => array(
				'type'  => 'color',
				'label' => esc_html__( 'Border Color', 'sparklestore-pro' ),
			),
			'border-radius'    => array(
				'type'       => 'cssbox',
				'class'      => 'spwp-element-show',
				'label'      => esc_html__( 'Border Radius', 'sparklestore-pro' ),
				'box_fields' => array(
					'top'    => true,
					'right'  => true,
					'bottom' => true,
					'left'   => true,
				),
				'attr'       => array(
					'min'       => 0,
					'max'       => 1000,
					'step'      => 1,
					'link'      => 1,
					'devices'   => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text' => esc_html__( 'Link', 'sparklestore-pro' ),
				),
			),
			'box-shadow-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Box Shadow Color', 'sparklestore-pro' ),
			),
			'box-shadow-css'   => array(
				'type'       => 'cssbox',
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'x'      => true,
					'Y'      => true,
					'BLUR'   => true,
					'SPREAD' => true,
				),
				'attr'       => array(
					'min'         => -1000,
					'max'         => 1000,
					'step'        => 1,
					'link'        => 1,
					'link_toggle' => false,
					'devices'     => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text'   => esc_html__( 'INSET', 'sparklestore-pro' ),
				),
			),
		)
	)
);
